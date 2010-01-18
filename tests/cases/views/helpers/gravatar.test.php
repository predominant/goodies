<?php
/**
 * CakePHP Gravatar Helper Test
 *
 * @copyright Copyright 2010, Graham Weldon
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 * @package goodies
 * @subpackage goodies.tests.cases.helpers
 *
 */
App::import('Helper', array('Html', 'Goodies.Gravatar'));

/**
 * GravatarHelper Test
 *
 * @package goodies
 * @subpackage goodies.test.cases.views.helpers
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
	}

/**
 * End Test
 *
 * @return void
 * @access public
 */
	public function endTest() {
		unset($this->Gravatar);
	}

/**
 * testNonSecureUrl
 *
 * @return void
 * @access public
 */
	public function testNonSecureUrl() {
		$expected = 'http://www.gravatar.com/avatar/' . Security::hash('example@gravatar.com', 'md5');
		$result = $this->Gravatar->url('example@gravatar.com', array('ext' => false));
		$this->assertEqual($expected, $result);

		$_SERVER['HTTPS'] = true;
		$expected = 'http://www.gravatar.com/avatar/' . Security::hash('example@gravatar.com', 'md5');
		$result = $this->Gravatar->url('example@gravatar.com', array('ext' => false, 'secure' => false));
		$this->assertEqual($expected, $result);
	}

/**
 * testSecureUrl
 *
 * @return void
 * @author Predominant
 */
	public function testSecureUrl() {
		$expected = 'https://secure.gravatar.com/avatar/' . Security::hash('example@gravatar.com', 'md5');
		$result = $this->Gravatar->url('example@gravatar.com', array('ext' => false, 'secure' => true));
		$this->assertEqual($expected, $result);

		$_SERVER['HTTPS'] = true;
		$expected = 'https://secure.gravatar.com/avatar/' . Security::hash('example@gravatar.com', 'md5');
		$result = $this->Gravatar->url('example@gravatar.com', array('ext' => false));
		$this->assertEqual($expected, $result);
	}
}
?>