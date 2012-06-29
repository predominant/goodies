<?php
/**
 * CakePHP Ustream Helper
 *
 * A CakePHP View Helper for the embedding of Ustream videos (http://ustream.tv)
 *
 * @copyright Copyright 2012, Graham Weldon (http://grahamweldon.com)
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 * @package Goodies
 * @subpackage Goodies.View.Helper
 */
App::uses('AppHelper', 'View/Helper');

class UstreamHelper extends HtmlHelper {

/**
 * Embed URI
 *
 * @var string
 */
	protected $_embedUri = 'http://www.ustream.tv/embed/recorded/';

/**
 * Default options
 *
 * @var array
 */
	protected $_defaultOptions = array(
		'width' => 640,
		'height' => 360,
		'frameborder' => 0,
		'scrolling' => 'no',
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

		if (!$options['frameborder']) {
			$options['style'] = 'border: 0px none transparent;';
		}

		return $this->tag('iframe', '', $options);
	}
}
