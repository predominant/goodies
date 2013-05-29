<?php

App::uses('AppHelper', 'View/Helper');
App::uses('HtmlHelper', 'View/Helper');

/**
 * Automatic JavaScript Helper
 *
 * Facilitates JavaScript Automatic loading and inclusion for page specific JS
 *
 * @copyright   Copyright 2009-2011, Graham Weldon (http://grahamweldon.com)
 * @package     goodies
 * @subpackage  goodies.View.Helper
 * @author      Graham Weldon (http://grahamweldon.com)
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
 */
	private $__options = array(
		'path' => 'autoload',
		'theme' => true);

/**
 * View helpers required by this helper
 *
 * @var array
 */
	public $helpers = array('Html');

/**
 * Object constructor
 *
 * Allows passing in options to change class behavior
 *
 * @param string $options Key value array of options
 */
	public function __construct(View $view, $options = array()) {
		if ($options == null) {
			$options = array();
		}
		parent::__construct($view, $options);
		$this->__options = array_merge($this->__options, $options);
	}

/**
 * Before Render callback
 *
 * @return void
 */
	public function beforeRender($file) {
		extract($this->__options);
		if (!empty($path)) {
			$path .= DS;
		}

		$files = array(
			$this->request->controller . '.js',
			$this->request->controller . DS . $this->request->action . '.js');

		foreach ($files as $file) {
			$file = $path . $file;
			if ($theme && !empty($this->theme)) {
				$includeFile = VIEWS . 'themed' . DS . $this->theme . DS . 'webroot' . DS . 'js' . DS . $file;
			} else {
				$includeFile = JS . $file;
			}
			if (file_exists($includeFile)) {
				$file = str_replace('\\', '/', $file);
				$this->Html->script($file, array('inline' => false));
			}
		}
	}
}
