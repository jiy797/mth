<?php

class XenForo_ViewPublic_Account_GenderChange extends XenForo_ViewPublic_Base
{
	public function renderJson()
	{
		$avatarUrls = XenForo_Template_Helper_Core::getAvatarUrls($this->_params['user']);

		return XenForo_ViewRenderer_Json::jsonEncodeForOutput(array(
			'user_id' => $this->_params['user']['user_id'],
			'avatarUrls' => $avatarUrls,
		));
	}
}