<?php

App::uses('AppHelper', 'View/Helper');

class YouTubeHelper extends HtmlHelper {

	protected $_embedUri = 'http://www.youtube.com/embed/';

	protected $_defaultOptions = array(
		'related' => true,
		'width' => 640,
		'height' => 360,
		'frameborder' => 0,
//		'allowfullscreen',
		
	);

	public function embed($id, $options = array()) {
		$options = array_merge($this->_defaultOptions, $options);
		$options['src'] = $this->_embedUri . $id;

		if (!$options['related']) {
			$options['src'] .= '?rel=0';
		}
		unset($options['related']);

		return $this->tag('iframe', '', $options);
	}
}
