<?php
/**
 * CakePHP Gravatar Helper Test
 *
 * @copyright Copyright 2009, Graham Weldon
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 * @author jadb
 * @package goodies
 * @subpackage goodies.tests.cases.helpers
 */
App::import('Core', array('ClassRegistry', 'Controller', 'Helper', 'AppHelper', 'View', 'Security'));
App::import('Helper', array('Html', 'Goodies.Gravatar'));
class UsabilityHelperTest extends CakeTestCase {
	public $Gravatar = null;
	public function startTest() {
		$this->Gravatar =& ClassRegistry::init('GravatarHelper');
		$this->Gravatar->Html =& ClassRegistry::init('HtmlHelper');
	}
	public function endTest() {
		unset($this->Controller);
		unset($this->Gravatar);
	}
	public function testCorrectInstances() {
		$this->assertIsA($this->Gravatar, 'GravatarHelper');
		$this->assertIsA($this->Gravatar->Html, 'HtmlHelper');
	}
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