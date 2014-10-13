<?php

class XenForo_ViewPublic_Member_MiniStats extends XenForo_ViewPublic_Base
{
	public function renderXml()
	{
		$document = new DOMDocument('1.0', 'utf-8');
		$document->formatOutput = true;

		$rootNode = $document->createElement('user');
		$document->appendChild($rootNode);

		foreach ($this->_params['user'] AS $key => $value)
		{
			$rootNode->appendChild($document->createElement($key, $value));
		}

		return $document->saveXML();
	}

	public function renderJson()
	{
		return $this->_params['user'];
	}
}