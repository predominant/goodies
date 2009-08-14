<?php
/**
 * CakeTime JavaScript Helper
 *
 * Facilitates JavaScript Automatic loading and inclusion for page specific JS
 *
 * @copyright   Copyright 2009, Graham Weldon
 * @link        http://grahamweldon.com/projects/caketime CakeTime Project
 * @package     caketime
 * @subpackage  caketime.views.helpers
 * @author      Graham Weldon
 * @license     http://www.opensource.org/licenses/mit-license.php The MIT License
 */
class AutoJavascriptHelper extends AppHelper {

/**
 * Options
 *
 * path => Path from which the controller/action file path will be built
 *         from. This is relative to the 'WWW_ROOT/js' directory
 *
 * @var array
 * @access private
 */
	private $__options = array('path' => 'autoload');

/**
 * View helpers required by this helper
 *
 * @var array
 * @access public
 */
	public $helpers = array('Javascript');

/**
 * Object constructor
 *
 * Allows passing in options to change class behavior
 *
 * @param string $options Key value array of options
 * @access public
 */
	public function __construct($options = array()) {
		$this->__options = am($this->__options, $options);
	}

/**
 * Before Render callback
 *
 * @return void
 * @access public
 */
	public function beforeRender() {
		extract($this->__options);
		if (!empty($path)) {
			$path .= DS;
		}

		$files = array(
			$this->params['controller'] . '.js',
			$this->params['controller'] . DS . $this->params['action'] . '.js');

		foreach ($files as $file) {
			$file = $path . $file;
			$includeFile = WWW_ROOT . 'js' . DS . $file;
			if (file_exists($includeFile)) {
				$this->Javascript->link($file, false);
			}
		}
	}
}
?>