<?php

class XenForo_Model_Import extends XenForo_Model
{
	/**
	 * Static array listing extra importers that aren't in the right directory.
	 *
	 * @var array
	 */
	public static $extraImporters = array();

	public function getImporterList()
	{
		$importerDir = XenForo_Autoloader::getInstance()->getRootDir() . '/XenForo/Importer';

		$importers = array();
		foreach (glob($importerDir . '/*.php') AS $importerFile)
		{
			$key = substr(basename($importerFile), 0, -4);
			if ($key == 'Abstract')
			{
				continue;
			}

			$importers[$key] = $this->getImporterName($key);
		}
		foreach (self::$extraImporters AS $extra)
		{
			$importers[$extra] = $this->getImporterName($extra);
		}

		asort($importers);
		return $importers;
	}

	public function getImporterName($key)
	{
		if (strpos($key, '_') && !in_array($key, self::$extraImporters))
		{
			throw new XenForo_Exception('Trying to load a non-registered importer.');
		}

		$class = (strpos($key, '_') ? $key : 'XenForo_Importer_' . $key);
		return call_user_func(array($class, 'getName'));
	}

	/**
	 * Gets the specified importer.
	 *
	 * @param string $key Name of importer (key); just last part of name, not full path.
	 *
	 * @return XenForo_Importer_Abstract
	 */
	public function getImporter($key)
	{
		if (strpos($key, '_') && !in_array($key, self::$extraImporters))
		{
			throw new XenForo_Exception('Trying to load a non-registered importer.');
		}

		$class = (strpos($key, '_') ? $key : 'XenForo_Importer_' . $key);
		$createClass = XenForo_Application::resolveDynamicClass($class, 'importer');

		return new $createClass();
	}

	public function canRunStep($step, array $steps, array $runSteps)
	{
		if (!empty($runSteps[$step]['run']))
		{
			return false;
		}

		if (!isset($steps[$step]))
		{
			return true; // "hidden" steps are always runnable
		}

		if (!empty($steps[$step]['depends']))
		{
			foreach ($steps[$step]['depends'] AS $dependency)
			{
				if (empty($runSteps[$dependency]['run']))
				{
					return false;
				}
			}
		}

		return true;
	}

	public function addImportStateToSteps(array $steps, array $runSteps)
	{
		foreach ($steps AS $step => &$info)
		{
			$info['runnable'] = $this->canRunStep($step, $steps, $runSteps);
			$info['hasRun'] = !empty($runSteps[$step]['run']);
			$info['importTotal'] = ($info['hasRun'] ? $runSteps[$step]['importTotal'] : null);

			if (!empty($runSteps[$step]))
			{
				$runStep = $runSteps[$step];
				$info['hasRun'] = !empty($runStep['run']);

				if (!empty($runStep['startTime']) && !empty($runStep['endTime']))
				{
					$time = $runStep['endTime'] - $runStep['startTime'];
					$info['runTime'] = array();
					if ($time >= 3600)
					{
						$info['runTime']['hours'] = floor($time / 3600);
						$time -= $info['runTime']['hours'] * 3600;
					}
					if ($time >= 60)
					{
						$info['runTime']['minutes'] = floor($time / 60);
						$time -= $info['runTime']['minutes'] * 60;
					}
					$info['runTime']['seconds'] = $time;
				}
			}
		}

		return $steps;
	}

	/**
	 * Returns true if there is data that has been imported;
	 *
	 * @return boolean
	 */
	public function hasImportedData()
	{
		$db = $this->_getDb();
		$data = $db->fetchRow($db->limit('
			SELECT *
			FROM xf_import_log
		', 1));
		return ($data ? true : false);
	}

	/**
	 * Resets the import log table.
	 */
	public function resetImportLog()
	{
		$this->_getDb()->query('
			TRUNCATE TABLE xf_import_log
		');
		$this->_getDb()->query('ALTER TABLE xf_import_log ENGINE = MyISAM');
	}

	public function logImportData($contentType, $oldId, $newId)
	{
		$this->_getDb()->query('
			INSERT INTO xf_import_log
				(content_type, old_id, new_id)
			VALUES
				(?, ?, ?)
			ON DUPLICATE KEY UPDATE new_id = VALUES(new_id)
		', array($contentType, strval($oldId), strval($newId)));
	}

	protected $_contentMapCache = array();

	public function getImportContentMap($contentType, $ids = false)
	{
		$db = $this->_getDb();

		if ($ids === false)
		{
			return $db->fetchPairs('
				SELECT old_id, new_id
				FROM xf_import_log
				WHERE content_type = ?
			', $contentType);
		}

		if (!is_array($ids))
		{
			$ids = array($ids);
		}
		if (!$ids)
		{
			return array();
		}

		$final = array();
		if (isset($this->_contentMapCache[$contentType]))
		{
			$lookup = $this->_contentMapCache[$contentType];
			foreach ($ids AS $key => $id)
			{
				if (isset($lookup[$id]))
				{
					$final[$id] = $lookup[$id];
					unset($ids[$key]);
				}
			}
		}

		if (!$ids)
		{
			return $final;
		}

		foreach ($ids AS &$id)
		{
			$id = strval($id);
		}

		$merge = $db->fetchPairs('
			SELECT old_id, new_id
			FROM xf_import_log
			WHERE content_type = ?
				AND old_id IN (' . $db->quote($ids) . ')
		', $contentType);

		if (isset($this->_contentMapCache[$contentType]))
		{
			$this->_contentMapCache[$contentType] += $merge;
		}
		else
		{
			$this->_contentMapCache[$contentType] = $merge;
		}

		return $final + $merge;
	}

	public function getUserIdsMapFromArray(array $source, $key)
	{
		$userIds = array();
		foreach ($source AS $data)
		{
			$userIds[] = $data[$key];
		}
		return $this->getImportContentMap('user', $userIds);
	}

	public function getThreadIdsMapFromArray(array $source, $key)
	{
		$userIds = array();
		foreach ($source AS $data)
		{
			$userIds[] = $data[$key];
		}
		return $this->getImportContentMap('thread', $userIds);
	}

	public function getPostIdsMapFromArray(array $source, $key)
	{
		$userIds = array();
		foreach ($source AS $data)
		{
			$userIds[] = $data[$key];
		}
		return $this->getImportContentMap('post', $userIds);
	}

	public function mapUserId($id, $default = null)
	{
		$ids = $this->getImportContentMap('user', $id);
		return ($ids ? reset($ids) : $default);
	}

	public function mapThreadId($id, $default = null)
	{
		$ids = $this->getImportContentMap('thread', $id);
		return ($ids ? reset($ids) : $default);
	}

	public function mapPostId($id, $default = null)
	{
		$ids = $this->getImportContentMap('post', $id);
		return ($ids ? reset($ids) : $default);
	}

	public function mapNodeId($id, $default = null)
	{
		$ids = $this->getImportContentMap('node', $id);
		return ($ids ? reset($ids) : $default);
	}

	public function getUserIdByEmail($email)
	{
		return $this->_getDb()->fetchOne('
			SELECT user_id
			FROM xf_user
			WHERE email = ?
		', $email);
	}

	public function getUserIdByUserName($name)
	{
		return $this->_getDb()->fetchOne('
			SELECT user_id
			FROM xf_user
			WHERE username = ?
		', $name);
	}

	protected function _importData($oldId, $dwName, $contentKey, $idKey, array $info, $errorHandler = false)
	{
		if (!$errorHandler)
		{
			$errorHandler = XenForo_DataWriter::ERROR_ARRAY;
		}

		XenForo_Db::beginTransaction();

		$dw = XenForo_DataWriter::create($dwName, $errorHandler);
		$dw->setImportMode(true);
		$dw->bulkSet($info);
		if ($dw->save())
		{
			$newId = $dw->get($idKey);
			if ($oldId !== 0 && $oldId !== '')
			{
				$this->logImportData($contentKey, $oldId, $newId);
			}
		}
		else
		{
			$newId = false;
		}

		XenForo_Db::commit();

		return $newId;
	}

	public function importUserGroup($oldId, array $info)
	{
		if (isset($info['permissions']))
		{
			$permissions = $info['permissions'];
			unset($info['permissions']);
		}
		else
		{
			$permissions = false;
		}

		$userGroupId = $this->_importData($oldId, 'XenForo_DataWriter_UserGroup', 'userGroup', 'user_group_id', $info);
		if ($userGroupId)
		{
			if ($permissions)
			{
				$this->getModelFromCache('XenForo_Model_Permission')->updateGlobalPermissionsForUserCollection($permissions, $userGroupId);
			}
		}

		return $userGroupId;
	}

	public function importUser($oldId, array $info, &$failedKey = '')
	{
		$failedKey = '';

		if (strpos($info['username'], ',') !== false)
		{
			$failedKey = 'username';
			return false;
		}

		if (!empty($info['is_admin']))
		{
			$isAdmin = true;
			$adminPerms = (!empty($info['admin_permissions']) ? $info['admin_permissions'] : array());
			unset($info['admin_permissions']);
		}
		else
		{
			$isAdmin = false;
			$adminPerms = array();
		}

		if (!empty($info['ip']))
		{
			$ip = $info['ip'];
		}
		else
		{
			$ip = false;
		}
		unset($info['ip']);

		XenForo_Db::beginTransaction();

		$dw = XenForo_DataWriter::create('XenForo_DataWriter_User');
		$dw->setImportMode(true);

		if (isset($info['secondary_group_ids']))
		{
			$dw->setSecondaryGroups($info['secondary_group_ids']);
			unset($info['secondary_group_ids']);
		}

		if (isset($info['identities']))
		{
			if ($info['identities'])
			{
				$dw->setIdentities($info['identities']);
			}
			unset($info['identities']);
		}

		$dw->set('scheme_class', $info['authentication']['scheme_class']);
		$dw->set('data', serialize($info['authentication']['data']), 'xf_user_authenticate');
		unset($info['authentication']);

		$dw->bulkSet($info);
		if ($dw->save())
		{
			$dw->rebuildPermissionCombinationId(false);
			// all other things will be rebuilt at the end of the import

			$newId = $dw->get('user_id');
			$this->logImportData('user', $oldId, $newId);

			if ($isAdmin)
			{
				$adminId = $this->_importData('', 'XenForo_DataWriter_Admin', '', 'user_id', array(
					'user_id' => $newId
				));
				if ($adminId && $adminPerms)
				{
					$this->getModelFromCache('XenForo_Model_Admin')->updateUserAdminPermissions($newId, $adminPerms);
				}
			}

			if ($ip)
			{
				$registerDate = !empty($info['register_date']) ? $info['register_date'] : null;
				$this->importIp($newId, 'user', $newId, 'register', $ip, $registerDate);
			}
		}
		else
		{
			$newId = false;
		}

		XenForo_Db::commit();

		return $newId;
	}

	public function resolveTimeZoneOffset($offset, $useDst)
	{
		switch ($offset)
		{
			case -12: return 'Pacific/Midway'; // not right, but closest
			case -11: return 'Pacific/Midway';
			case -10: return 'Pacific/Honolulu';
			case -9.5: return 'Pacific/Marquesas';
			case -9: return 'America/Anchorage';
			case -8: return 'America/Los_Angeles';
			case -7: return ($useDst ? 'America/Denver' : 'America/Phoenix');
			case -6: return ($useDst ? 'America/Chicago' : 'America/Belize');
			case -5: return ($useDst ? 'America/New_York' : 'America/Bogota');
			case -4.5: return 'America/Caracas';
			case -4: return ($useDst ? 'America/Halifax' : 'America/La_Paz');
			case -3.5: return 'America/St_Johns';
			case -3: return ($useDst ? 'America/Argentina/Buenos_Aires' : 'America/Argentina/Mendoza');
			case -2: return 'America/Noronha';
			case -1: return ($useDst ? 'Atlantic/Azores' : 'Atlantic/Cape_Verde');
			case 0: return ($useDst ? 'Europe/London' : 'Atlantic/Reykjavik');
			case 1: return ($useDst ? 'Europe/Amsterdam' : 'Africa/Algiers');
			case 2: return ($useDst ? 'Europe/Athens' : 'Africa/Johannesburg');
			case 3: return ($useDst ? 'Europe/Moscow' : 'Africa/Nairobi');
			case 3.5: return 'Asia/Tehran';
			case 4: return ($useDst ? 'Asia/Yerevan' : 'Asia/Dubai');
			case 4.5: return 'Asia/Kabul';
			case 5: return ($useDst ? 'Indian/Mauritius' : 'Asia/Tashkent');
			case 5.5: return 'Asia/Kolkata';
			case 5.75: return 'Asia/Kathmandu';
			case 6: return ($useDst ? 'Asia/Novosibirsk' : 'Asia/Almaty');
			case 6.5: return 'Asia/Rangoon';
			case 7: return ($useDst ? 'Asia/Krasnoyarsk' : 'Asia/Bangkok');
			case 8: return ($useDst ? 'Asia/Irkutsk' : 'Asia/Hong_Kong');
			case 9: return ($useDst ? 'Asia/Yakutsk' : 'Asia/Tokyo');
			case 9.5: return ($useDst ? 'Australia/Adelaide' : 'Australia/Darwin');
			case 10: return ($useDst ? 'Australia/Hobart' : 'Australia/Brisbane');
			case 11: return ($useDst ? 'Asia/Magadan' : 'Pacific/Noumea');
			case 11.5: return 'Pacific/Norfolk';
			case 12: return ($useDst ? 'Pacific/Auckland' : 'Pacific/Fiji');
			case 12.75: return 'Pacific/Chatham';
			case 13: return 'Pacific/Tongatapu';
			case 14: return 'Pacific/Kiritimati';

			default: return 'Europe/London';
		}

	}

	public function importBan(array $info)
	{
		return $this->_importData('', 'XenForo_DataWriter_UserBan', 'userBan', 'user_id', $info);
	}

	public function importFollowing($userId, array $followUserIds)
	{
		if (!$followUserIds)
		{
			return;
		}

		$db = $this->_getDb();
		XenForo_Db::beginTransaction($db);

		foreach ($followUserIds AS $followUserId)
		{
			$db->query('
				INSERT IGNORE INTO xf_user_follow
					(user_id, follow_user_id, follow_date)
				VALUES
					(?, ?, ?)
			', array($userId, $followUserId, XenForo_Application::$time));
		}

		$this->getModelFromCache('XenForo_Model_User')->updateFollowingDenormalizedValue($userId);

		XenForo_Db::commit($db);
	}

	public function importAvatar($oldUserId, $userId, $fileName)
	{
		try
		{
			$this->getModelFromCache('XenForo_Model_Avatar')->applyAvatar($userId, $fileName);
			$this->logImportData('avatar', $oldUserId, $userId);

			return $userId;
		}
		catch (Exception $e)
		{
			return false;
		}
	}

	public function importConversation($oldId, array $conversation, array $recipients, array $messages)
	{
		if (!$messages || $conversation['title'] === '')
		{
			return false;
		}

		$hasRecipients = false;
		foreach ($recipients AS $recipient)
		{
			if ($recipient['recipient_state'] == 'active')
			{
				$hasRecipients = true;
				break;
			}
		}
		if (!$hasRecipients)
		{
			return false;
		}

		$conversation['reply_count'] = count($messages) - 1;
		$conversation['recipient_count'] = count($recipients);

		$db = $this->_getDb();
		XenForo_Db::beginTransaction($db);

		$conversationId = $this->_importData($oldId, 'XenForo_DataWriter_ConversationMaster', 'conversation', 'conversation_id', $conversation);
		if ($conversationId)
		{
			$firstMessage = null;
			$lastMessage = null;

			foreach ($messages AS $message)
			{
				$message['conversation_id'] = $conversationId;
				$messageId = $this->_importData('', 'XenForo_DataWriter_ConversationMessage', '', 'message_id', $message);
				if (!$messageId)
				{
					continue;
				}
				$message['message_id'] = $messageId;

				if (!$firstMessage)
				{
					$firstMessage = $message;
				}
				$lastMessage = $message;
			}

			if (!$firstMessage)
			{
				XenForo_Db::rollback($db);
				return false;
			}

			$conversationUpdate = array(
				'first_message_id' => $firstMessage['message_id'],
				'last_message_id' => $lastMessage['message_id'],
				'last_message_date' => $lastMessage['message_date'],
				'last_message_user_id' => $lastMessage['user_id'],
				'last_message_username' => $lastMessage['username']
			);
			$conversation += $conversationUpdate;
			$db->update('xf_conversation_master', $conversationUpdate, 'conversation_id = ' . $db->quote($conversationId));

			foreach ($recipients AS $userId => $info)
			{
				$db->insert('xf_conversation_recipient', array(
					'conversation_id' => $conversationId,
					'user_id' => $userId,
					'recipient_state' => $info['recipient_state'],
					'last_read_date' => $info['last_read_date']
				));

				if ($info['recipient_state'] == 'active')
				{
					$recipientUser = array(
						'conversation_id' => $conversationId,
						'owner_user_id' => $userId,
						'is_unread' => ($info['last_read_date'] >= $lastMessage['message_date'] ? 0 : 1),
						'reply_count' => $conversation['reply_count'],
						'last_message_date' => $conversation['last_message_date'],
						'last_message_id' => $conversation['last_message_id'],
						'last_message_user_id' => $conversation['last_message_user_id'],
						'last_message_username' => $conversation['last_message_username'],
					);

					$db->insert('xf_conversation_user', $recipientUser);
				}
			}
		}

		XenForo_Db::commit($db);

		return $conversationId;
	}

	public function importProfilePost($oldId, array $info)
	{
		if (isset($info['ip']))
		{
			$ip = $info['ip'];
			unset($info['ip']);
		}
		else
		{
			$ip = false;
		}

		$profilePostId = $this->_importData($oldId, 'XenForo_DataWriter_DiscussionMessage_ProfilePost', 'profilePost', 'profile_post_id', $info);
		if ($profilePostId)
		{
			if ($info['message_state'] == 'moderated')
			{
				$this->_getDb()->query('
					INSERT IGNORE INTO xf_moderation_queue
						(content_type, content_id, content_date)
					VALUES
						(?, ?, ?)
				', array('profile_post', $profilePostId, $info['post_date']));
			}

			if ($ip)
			{
				$ipId = $this->importIp($info['user_id'], 'profile_post', $profilePostId, 'insert', $ip, $info['post_date']);
				if ($ipId)
				{
					$this->_getDb()->update('xf_profile_post',
						array('ip_id' => $ipId),
						'profile_post_id = ' . $this->_getDb()->quote($profilePostId)
					);
				}
			}
		}

		return $profilePostId;
	}

	public function importForum($oldId, array $info)
	{
		return $this->_importData($oldId, 'XenForo_DataWriter_Forum', 'node', 'node_id', $info);
	}

	public function importCategory($oldId, array $info)
	{
		return $this->_importData($oldId, 'XenForo_DataWriter_Category', 'node', 'node_id', $info);
	}

	public function importLinkForum($oldId, array $info)
	{
		return $this->_importData($oldId, 'XenForo_DataWriter_LinkForum', 'node', 'node_id', $info);
	}

	public function getNodePermissionsGrouped()
	{
		$nodeTypePermissionGroups = $this->getModelFromCache('XenForo_Model_Node')->getNodeTypesGroupedByPermissionGroup();
		$permissionsGrouped = $this->getModelFromCache('XenForo_Model_Permission')->getAllPermissionsGrouped();

		foreach ($permissionsGrouped AS $groupId => $permissions)
		{
			if (!isset($nodeTypePermissionGroups[$groupId]))
			{
				unset($permissionsGrouped[$groupId]);
			}
		}

		return $permissionsGrouped;
	}

	public function insertNodePermissionEntries($nodeId, $userGroupId, $userId, array $perms)
	{
		$db = $this->_getDb();

		XenForo_Db::beginTransaction($db);

		foreach ($perms AS $groupId => $groupPerms)
		{
			foreach ($groupPerms AS $permId => $value)
			{
				if ($value === 'unset')
				{
					continue;
				}

				$valueInt = 0;
				if (is_int($value))
				{
					$valueInt = $value;
					$value = 'use_int';
				}

				$db->query('
					INSERT INTO xf_permission_entry_content
						(content_type, content_id, user_group_id, user_id,
						permission_group_id, permission_id, permission_value, permission_value_int)
					VALUES
						(\'node\', ?, ?, ?,
						?, ?, ?, ?)
					ON DUPLICATE KEY UPDATE
						permission_value = VALUES(permission_value),
						permission_value_int = VALUES(permission_value_int)
				', array($nodeId, $userGroupId, $userId, $groupId, $permId, $value, $valueInt));
			}
		}

		XenForo_Db::commit($db);
	}

	public function insertGlobalPermissionEntries($userGroupId, $userId, array $perms)
	{
		$db = $this->_getDb();

		XenForo_Db::beginTransaction($db);

		foreach ($perms AS $groupId => $groupPerms)
		{
			foreach ($groupPerms AS $permId => $value)
			{
				if ($value === 'unset')
				{
					continue;
				}

				$valueInt = 0;
				if (is_int($value))
				{
					$valueInt = $value;
					$value = 'use_int';
				}

				$db->query('
					INSERT INTO xf_permission_entry
						(user_group_id, user_id, permission_group_id, permission_id, permission_value, permission_value_int)
					VALUES
						(?, ?, ?, ?, ?, ?)
					ON DUPLICATE KEY UPDATE
						permission_value = VALUES(permission_value),
						permission_value_int = VALUES(permission_value_int)
				', array($userGroupId, $userId, $groupId, $permId, $value, $valueInt));
			}
		}

		XenForo_Db::commit($db);
	}

	public function importGlobalModerator($oldId, array $info)
	{
		$mod = $this->getModelFromCache('XenForo_Model_Moderator')->getGeneralModeratorByUserId($info['user_id']);
		if ($mod)
		{
			return false; // already exists
		}

		XenForo_Db::beginTransaction();

		$userId = $this->_importData($oldId, 'XenForo_DataWriter_Moderator', 'moderator', 'user_id', $info);
		if ($userId)
		{
			if (!empty($info['moderator_permissions']))
			{
				$finalPermissions = $this->getModelFromCache('XenForo_Model_Moderator')->getModeratorPermissionsForUpdate(
					$info['moderator_permissions'], array()
				);

				$this->getModelFromCache('XenForo_Model_Permission')->updateGlobalPermissionsForUserCollection(
					$finalPermissions, 0, $userId
				);
			}

			$db = $this->_getDb();
			$db->update('xf_user', array('is_moderator' => 1), 'user_id = ' . $db->quote($userId));
		}

		XenForo_Db::commit();

		return $userId;
	}

	public function importNodeModerator($oldNodeId, $oldUserId, array $info)
	{
		$mod = $this->getModelFromCache('XenForo_Model_Moderator')->getContentModeratorByContentAndUserId('node', $info['content_id'], $info['user_id']);
		if ($mod)
		{
			return false; // already exists
		}

		XenForo_Db::beginTransaction();

		$dw = XenForo_DataWriter::create('XenForo_DataWriter_ModeratorContent');
		$dw->setImportMode(true);
		$dw->set('content_type', 'node');
		$dw->bulkSet($info);
		if ($dw->save())
		{
			$newId = $dw->get('moderator_id');
			$this->logImportData('moderatorNode', "n$oldNodeId-u$oldUserId", "n$info[content_id]-u$info[user_id]");

			if (!empty($info['moderator_permissions']))
			{
				$finalPermissions = $this->getModelFromCache('XenForo_Model_Moderator')->getModeratorPermissionsForUpdate(
					$info['moderator_permissions'], array(), 'content_allow'
				);

				$this->getModelFromCache('XenForo_Model_Permission')->updateContentPermissionsForUserCollection(
					$finalPermissions, $dw->get('content_type'), $dw->get('content_id'), 0, $dw->get('user_id')
				);
			}

			$db = $this->_getDb();
			$db->update('xf_user', array('is_moderator' => 1), 'user_id = ' . $db->quote($dw->get('user_id')));
		}
		else
		{
			$newId = false;
		}

		XenForo_Db::commit();

		return $newId;
	}

	public function importThread($oldId, array $info)
	{
		$threadId = $this->_importData($oldId, 'XenForo_DataWriter_Discussion_Thread', 'thread', 'thread_id', $info);
		if ($threadId)
		{
			if ($this->getModelFromCache('XenForo_Model_Thread')->isModerated($info))
			{
				$this->_getDb()->query('
					INSERT IGNORE INTO xf_moderation_queue
						(content_type, content_id, content_date)
					VALUES
						(?, ?, ?)
				', array('thread', $threadId, $info['post_date']));
			}
		}

		return $threadId;
	}

	public function importThreadWatch($userId, $threadId, $emailSubscribe)
	{
		$this->_getDb()->query('
			INSERT IGNORE INTO xf_thread_watch
				(user_id, thread_id, email_subscribe)
			VALUES
				(?, ?, ?)
		', array($userId, $threadId, $emailSubscribe));
	}

	public function importPost($oldId, array $info)
	{
		if (isset($info['ip']))
		{
			$ip = $info['ip'];
			unset($info['ip']);
		}
		else
		{
			$ip = false;
		}

		$postId = $this->_importData($oldId, 'XenForo_DataWriter_DiscussionMessage_Post', 'post', 'post_id', $info);
		if ($postId)
		{
			if ($info['message_state'] == 'moderated')
			{
				$this->_getDb()->query('
					INSERT IGNORE INTO xf_moderation_queue
						(content_type, content_id, content_date)
					VALUES
						(?, ?, ?)
				', array('post', $postId, $info['post_date']));
			}

			if ($ip)
			{
				$ipId = $this->importIp($info['user_id'], 'post', $postId, 'insert', $ip, $info['post_date']);
				if ($ipId)
				{
					$this->_getDb()->update('xf_post',
						array('ip_id' => $ipId),
						'post_id = ' . $this->_getDb()->quote($postId)
					);
				}
			}
		}

		return $postId;
	}

	public function importIp($userId, $contentType, $contentId, $action, $ipAddress, $date)
	{
		$ipId = $this->getModelFromCache('XenForo_Model_Ip')->logIp(
			$userId, $contentType, $contentId, $action, $ipAddress, $date
		);
		return ($ipId ? $ipId : false);
	}

	public function importThreadPoll($oldId, $threadId, array $info, array $responses, &$responseIds = null)
	{
		$info['content_type'] = 'thread';
		$info['content_id'] = $threadId;

		$responseIds = array();

		$db = $this->_getDb();
		XenForo_Db::beginTransaction($db);

		$pollId = $this->_importData($oldId, 'XenForo_DataWriter_Poll', 'poll', 'poll_id', $info);
		if ($pollId)
		{
			foreach ($responses AS $response)
			{
				$dw = XenForo_DataWriter::create('XenForo_DataWriter_PollResponse');
				$dw->setImportMode(true);
				$dw->set('poll_id', $pollId);
				$dw->set('response', $response);
				$dw->save();

				$responseIds[] = $dw->get('poll_response_id');
			}

			$this->logImportData('poll', $oldId, $pollId);

			$db->update('xf_thread',
				array('discussion_type' => 'poll'),
				'thread_id = ' . $db->quote($threadId)
			);
		}

		XenForo_Db::commit($db);

		return $pollId;
	}

	public function importPollVote($pollId, $userId, $responseId, $voteDate)
	{
		$this->_getDb()->query('
			INSERT IGNORE INTO xf_poll_vote
				(poll_id, user_id, poll_response_id, vote_date)
			VALUES
				(?, ?, ?, ?)
		', array($pollId, $userId, $responseId, $voteDate));
	}

	public function importPostAttachment($oldAttachmentId, $fileName, $tempFile, $userId, $postId, $date, array $attach = array())
	{
		$upload = new XenForo_Upload($fileName, $tempFile);

		try
		{
			$dataExtra = array('upload_date' => $date, 'attach_count' => 1);
			$dataId = $this->getModelFromCache('XenForo_Model_Attachment')->insertUploadedAttachmentData($upload, $userId, $dataExtra);
		}
		catch (XenForo_Exception $e)
		{
			return false;
		}

		$dw = XenForo_DataWriter::create('XenForo_DataWriter_Attachment');
		$dw->setImportMode(true);
		$dw->bulkSet(array(
			'data_id' => $dataId,
			'content_type' => 'post',
			'content_id' => $postId,
			'attach_date' => $date,
			'unassociated' => 0
		));
		$dw->bulkSet($attach);
		$dw->save();

		$attachmentId = $dw->get('attachment_id');

		$this->_getDb()->query('
			UPDATE xf_post SET
				attach_count = attach_count + 1
			WHERE post_id = ?
		', $postId);

		$this->logImportData('attachment', $oldAttachmentId, $attachmentId);

		return $attachmentId;
	}

	public function getUserIdsWithKey(array $conditions, $key, $lowerKey = true)
	{
		$users = $this->_getUserModel()->getUsers($conditions);
		$output = array();
		foreach ($users AS $user)
		{
			$keyValue = $user[$key];
			if ($lowerKey)
			{
				$keyValue = strtolower($user[$key]);
			}
			$output[$keyValue] = $user['user_id'];
		}
		return $output;
	}

	public function getUserIdsByEmails(array $emails)
	{
		if (!$emails)
		{
			return array();
		}

		$emails = $this->getUserIdsWithKey(array('emails' => $emails), 'email');
		unset($emails['']);
		return $emails;
	}

	public function getUserIdsByNames(array $names)
	{
		if (!$names)
		{
			return array();
		}

		return $this->getUserIdsWithKey(array('usernames' => $names), 'username');
	}

	/**
	 * @return XenForo_Model_User
	 */
	protected function _getUserModel()
	{
		return $this->getModelFromCache('XenForo_Model_User');
	}
}