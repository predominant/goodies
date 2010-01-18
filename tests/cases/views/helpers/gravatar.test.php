<?php
App::import('Core', array('ClassRegistry', 'Controller', 'Helper', 'AppHelper', 'View', 'Security'));
App::import('Helper', array('Html', 'Goodies.Gravatar'));

/**
 * CakePHP Gravatar Helper Test
 *
 * @copyright Copyright 2010, Graham Weldon
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 * @package goodies
 * @subpackage goodies.tests.cases.helpers
 *
 */
class GravatarHelperTest extends CakeTestCase {

/**
 * Gravatar helper
 *
 * @var GravatarHelper
 * @access public
 */
	public $Gravatar = null;

/**
 * Start Test
 *
 * @return void
 * @access public
 */
	public function startTest() {
		$this->Gravatar =& ClassRegistry::init('GravatarHelper');
		$this->Gravatar->Html =& ClassRegistry::init('HtmlHelper');
	}

/**
 * End Test
 *
 * @return void
 * @access public
 */
	public function endTest() {
		unset($this->Controller);
		unset($this->Gravatar);
	}

/**
 * testUrl
 *
 * @return void
 * @access public
 */
	public function testUrl() {
		$expected = 'http://www.gravatar.com/avatar/' . Security::hash('example@gravatar.com', 'md5');
		$result = $this->Gravatar->url('example@gravatar.com', array('ext' => false));
		$this->assertEqual($expected, $result);

		$_SERVER['HTTPS'] = true;
		$expected = 'https://secure.gravatar.com/avatar/' . Security::hash('example@gravatar.com', 'md5');
		$result = $this->Gravatar->url('example@gravatar.com', array('ext' => false));
		$this->assertEqual($expected, $result);
	}
}
?>