<?php

/**
 * Controller for managing the moderation queue.
 *
 * @package XenForo_Moderation
 */
class XenForo_ControllerPublic_ModerationQueue extends XenForo_ControllerPublic_Abstract
{
	/**
	 * Pre-dispatch, ensure visitor is a moderator.
	 */
	protected function _preDispatch($action)
	{
		$visitor = XenForo_Visitor::getInstance();
		if (!$visitor['is_moderator'] && !$visitor['is_admin'])
		{
			throw $this->getNoPermissionResponseException();
		}
	}

	/**
	 * Displays a list of all messages/discussions in the moderation queue.
	 *
	 * @return XenForo_ControllerResponse_Abstract
	 */
	public function actionIndex()
	{
		$moderationQueueModel = $this->_getModerationQueueModel();

		$viewParams = array(
			'queue' => $moderationQueueModel->getVisibleModerationQueueEntriesForUser(
				$moderationQueueModel->getModerationQueueEntries()
			),
		);

		return $this->responseView('XenForo_ViewPublic_ModerationQueue_List', 'moderation_queue_list', $viewParams);
	}

	/**
	 * Saves changes to the messages/discussions in the mdoeration queue.
	 *
	 * @return XenForo_ControllerResponse_Abstract
	 */
	public function actionSave()
	{
		$this->_assertPostOnly();

		$queue = $this->_input->filterSingle('queue', XenForo_Input::ARRAY_SIMPLE);

		$this->_getModerationQueueModel()->saveModerationQueueChanges($queue);

		return $this->responseRedirect(
			XenForo_ControllerResponse_Redirect::SUCCESS,
			XenForo_Link::buildPublicLink('moderation-queue')
		);
	}

	/**
	 * Session activity details.
	 * @see XenForo_Controller::getSessionActivityDetailsForList()
	 */
	public static function getSessionActivityDetailsForList(array $activities)
	{
		return new XenForo_Phrase('performing_moderation_duties');
	}

	/**
	 * @return XenForo_Model_ModerationQueue
	 */
	protected function _getModerationQueueModel()
	{
		return $this->getModelFromCache('XenForo_Model_ModerationQueue');
	}
}