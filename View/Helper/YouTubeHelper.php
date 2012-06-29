<?php
/**
 * CakePHP YouTube Helper
 *
 * A CakePHP View Helper for the embedding of YouTube videos (http://youtube.com)
 *
 * @copyright Copyright 2012, Graham Weldon (http://grahamweldon.com)
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 * @package Goodies
 * @subpackage Goodies.View.Helper
 */
App::uses('AppHelper', 'View/Helper');

class YouTubeHelper extends HtmlHelper {

/**
 * Embed URI
 *
 * @var string
 */
	protected $_embedUri = 'http://www.youtube.com/embed/';

/**
 * Default options
 *
 * @var array
 */
	protected $_defaultOptions = array(
		'related' => true,
		'width' => 640,
		'height' => 360,
		'frameborder' => 0,
//		'allowfullscreen',
		
	);

/**
 * Embed a video
 *
 * @return string <iframe> element for video
 */
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
