<?php

class XenForo_ViewPublic_Helper_Search
{
	public static function renderSearchResults(XenForo_View $view, array $results, array $search = array(), array $handlers = null)
	{
		if ($handlers === null)
		{
			$handlers = $results['handlers'];
			$results = $results['results'];
		}

		$output = array();
		foreach ($results AS $result)
		{
			$output[] = $handlers[$result['content_type']]->renderResult($view, $result['content'], $search);
		}

		return $output;
	}
}