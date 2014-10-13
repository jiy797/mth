<?php

class XenForo_ControllerAdmin_StyleProperty extends XenForo_ControllerAdmin_Abstract
{
	protected function _preDispatch($action)
	{
		$this->assertAdminPermission('style');
	}

	public function actionIndex()
	{
		$styleId = XenForo_Helper_Cookie::getCookie('edit_style_id');
		if ($styleId === false)
		{
			$styleId = (XenForo_Application::debugMode()
				? 0
				: XenForo_Application::get('options')->defaultStyleId
			);
		}

		if (!XenForo_Application::debugMode() && !$styleId)
		{
			$styleId = XenForo_Application::get('options')->defaultStyleId;
		}

		$style = $this->_getStyleModel()->getStyleById($styleId, true);
		if (!$style || !$this->_getStylePropertyModel()->canEditStyleProperty($styleId))
		{
			$style = $this->_getStyleModel()->getStyleById(XenForo_Application::get('options')->defaultStyleId);
		}

		return $this->responseRedirect(
			XenForo_ControllerResponse_Redirect::RESOURCE_CANONICAL_PERMANENT,
			XenForo_Link::buildAdminLink('styles/style-properties', $style)
		);
	}

	/**
	 * @return XenForo_Model_Style
	 */
	protected function _getStyleModel()
	{
		return $this->getModelFromCache('XenForo_Model_Style');
	}

	/**
	 * @return  XenForo_Model_StyleProperty
	 */
	protected function _getStylePropertyModel()
	{
		return $this->getModelFromCache('XenForo_Model_StyleProperty');
	}
}