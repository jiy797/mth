<?php

class XenForo_ViewPublic_Post_LikeConfirmed extends XenForo_ViewPublic_Base
{
	public function renderJson()
	{
		$message = $this->_params['post'];

		if (!empty($message['likeUsers']))
		{
			$params = array(
				'message' => $message,
				'likesUrl' => XenForo_Link::buildPublicLink('posts/likes', $message)
			);

			$output = $this->_renderer->getDefaultOutputArray(get_class($this), $params, 'likes_summary');
		}
		else
		{
			$output = array('templateHtml' => '', 'js' => '', 'css' => '');
		}

		$output['term'] = ($this->_params['liked'] ? new XenForo_Phrase('unlike') : new XenForo_Phrase('like'));

		return XenForo_ViewRenderer_Json::jsonEncodeForOutput($output);
	}
}