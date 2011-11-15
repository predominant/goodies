<?php
/**
 * CakePHP Placeholder Helper
 *
 * A CakePHP View Helper for inserting placeholder information into pages
 *
 * @copyright Copyright 2011, Graham Weldon (http://grahamweldon.com)
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 * @package goodies
 * @subpackage goodies.views.helpers
 */
class PlaceHelper extends Apphelper {

/**
 * View helper dependencies
 *
 * @var array
 */
	public $helpers = array('Html');

/**
 * Generate placeholder image
 *
 * @param int $width Image Width
 * @param int $height Image Height
 * @param string $type Image type
 * @return string
 */
	public function image($width, $height, $type = null) {
		if (!$type) {
			$type = 'kitten';
		}
		$typeMethod = $this->_typeMethod($type);
		if (!$typeMethod) {
			return sprintf(__('Failed to generate placeholder type "%s".', true), $type);
		}
		return $this->Html->image($this->$typeMethod($width, $height));
	}

/**
 * Generate method name for image type
 *
 * @param string $type Image type
 * @return mixed False if failed to find method, otherwise the string method name
 */
	protected function _typeMethod($type) {
		$method = '_image' . Inflector::camelize($type);
		if (!method_exists($this, $method)) {
			return false;
		}
		return $method;
	}

/**
 * Generate kitten image
 *
 * @param int $width Width
 * @param int $height Height
 * @return string URI for image
 */
	protected function _imageKitten($width, $height) {
		return sprintf('http://placekitten.com/%s/%s', $width, $height);
	}
}
