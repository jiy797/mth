<?php

class XenForo_Option_DefaultLanguage
{
	/**
	 * Renders the default language option.
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
		$preparedOption['formatParams'] = XenForo_Model::create('XenForo_Model_Language')->getLanguagesForOptionsTag(
			$preparedOption['option_value']
		);

		return XenForo_ViewAdmin_Helper_Option::renderOptionTemplateInternal(
			'option_list_option_radio',
			$view, $fieldPrefix, $preparedOption, $canEdit
		);
	}
}