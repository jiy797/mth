<?php

class XenForo_ViewPublic_Error_RegistrationRequired extends XenForo_ViewPublic_Base
{
	public function renderJson()
	{
		$output = $this->_renderer->getDefaultOutputArray(get_class($this), $this->_params, $this->_templateName);

		if (!empty($this->_params['text']))
		{
			$output['error'] = $this->_params['text'];
		}

		return $output;
	}
}