<?php

/**
 * Helper for choosing a forum.
 *
 * @package XenForo_Options
 */
abstract class XenForo_Option_ForumChooser
{
	/**
	 * Renders the forum chooser option.
	 *
	 * @param XenForo_View $view View object
	 * @param string $fieldPrefix Prefix for the HTML form field name
	 * @param array $preparedOption Prepared option info
	 * @param boolean $canEdit True if an "edit" link should appear
	 *
	 * @return XenForo_Template_Abstract Template object
	 */
	public static function renderOption(XenForo_View $view, $fieldPrefix, array $preparedOption, $canEdit)
	{
		$value = $preparedOption['option_value'];

		$editLink = $view->createTemplateObject('option_list_option_editlink', array(
			'preparedOption' => $preparedOption,
			'canEditOptionDefinition' => $canEdit
		));

		/* @var $nodeModel XenForo_Model_Node */
		$nodeModel = XenForo_Model::create('XenForo_Model_Node');

		$forumOptions = $nodeModel->getNodeOptionsArray($nodeModel->getAllNodes(), $preparedOption['option_value'], '(unspecified)');

		return $view->createTemplateObject('option_list_option_select', array(
			'fieldPrefix' => $fieldPrefix,
			'listedFieldName' => $fieldPrefix . '_listed[]',
			'preparedOption' => $preparedOption,
			'formatParams' => $forumOptions,
			'editLink' => $editLink
		));
	}
}