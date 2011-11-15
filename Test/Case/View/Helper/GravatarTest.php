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
//App::import('Helper', array('Html', 'Goodies.Gravatar'));
App::uses('Helper', 'View');
App::uses('Controller', 'Controller');
App::uses('GravatarHelper', 'Goodies.View/Helper');

/**
 * GravatarTestController class
 *
 * @package Goodies
 * @subpackage Goodies.Test.Case.View.Helper
 */
class GravatarTestController extends Controller {

/**
 * name property
 *
 * @var string 'TheTest'
 */
	public $name = 'Gravatar';

/**
 * uses property
 *
 * @var mixed null
 */
	public $uses = null;
}

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
 */
	public $Gravatar = null;

/**
 * Start Test
 *
 * @return void
 */
	public function startTest() {
		$this->View = new View(new GravatarTestController());
		$this->Gravatar = new GravatarHelper($this->View);
	}

/**
 * End Test
 *
 * @return void
 */
	public function endTest() {
		unset($this->Gravatar);
	}

/**
 * testBaseUrlGeneration
 *
 * @return void
 */
	public function testBaseUrlGeneration() {
		$expected = 'http://www.gravatar.com/avatar/' . Security::hash('example@gravatar.com', 'md5');
		$result = $this->Gravatar->url('example@gravatar.com', array('ext' => false, 'default' => 'wavatar'));
		list($url, $params) = explode('?', $result);
		$this->assertEqual($expected, $url);
	}

/**
 * testExtensions
 *
 * @return void
 */
	public function testExtensions() {
		$result = $this->Gravatar->url('example@gravatar.com', array('ext' => true, 'default' => 'wavatar'));
		$this->assertPattern('/\.jpg(?:$|\?)/', $result);
	}

/**
 * testRating
 *
 * @return void
 */
	public function testRating() {
		$result = $this->Gravatar->url('example@gravatar.com', array('ext' => true, 'default' => 'wavatar'));
		$this->assertPattern('/\.jpg(?:$|\?)/', $result);
	}

/**
 * testAlternateDefaultIcon
 *
 * @return void
 */
	public function testAlternateDefaultIcon() {
		$result = $this->Gravatar->url('example@gravatar.com', array('ext' => false, 'default' => 'wavatar'));
		list($url, $params) = explode('?', $result);
		$this->assertPattern('/default=wavatar/', $params);
	}

/**
 * testAlternateDefaultIconCorrection
 *
 * @return void
 */
	public function testAlternateDefaultIconCorrection() {
		$result = $this->Gravatar->url('example@gravatar.com', array('ext' => false, 'default' => '12345'));
		$this->assertPattern('/[^\?]+/', $result);
	}

/**
 * testSize
 *
 * @return void
 */
	public function testSize() {
		$result = $this->Gravatar->url('example@gravatar.com', array('size' => '120'));
		list($url, $params) = explode('?', $result);
		$this->assertPattern('/size=120/', $params);
	}

/**
 * testImageTag
 *
 * @return void
 */
	public function testImageTag() {
		$expected = '<img src="http://www.gravatar.com/avatar/' . Security::hash('example@gravatar.com', 'md5') . '" alt="" />';
		$result = $this->Gravatar->image('example@gravatar.com', array('ext' => false));
		$this->assertEqual($expected, $result);

		$expected = '<img src="http://www.gravatar.com/avatar/' . Security::hash('example@gravatar.com', 'md5') . '" alt="Gravatar" />';
		$result = $this->Gravatar->image('example@gravatar.com', array('ext' => false, 'alt' => 'Gravatar'));
		$this->assertEqual($expected, $result);
	}

/**
 * testDefaulting
 *
 * @return void
 */
	public function testDefaulting() {
		$result = $this->Gravatar->url('example@gravatar.com', array('default' => 'wavatar', 'size' => 'default'));
		list($url, $params) = explode('?', $result);
		$this->assertEqual($params, 'default=wavatar');
	}

/**
 * testNonSecureUrl
 *
 * @return void
 */
	public function testNonSecureUrl() {
		$_SERVER['HTTPS'] = false;
		
		$expected = 'http://www.gravatar.com/avatar/' . Security::hash('example@gravatar.com', 'md5');
		$result = $this->Gravatar->url('example@gravatar.com', array('ext' => false));
		$this->assertEqual($expected, $result);

		$expected = 'http://www.gravatar.com/avatar/' . Security::hash('example@gravatar.com', 'md5');
		$result = $this->Gravatar->url('example@gravatar.com', array('ext' => false, 'secure' => false));
		$this->assertEqual($expected, $result);

		$_SERVER['HTTPS'] = true;
		$this->Gravatar = new GravatarHelper($this->View);
		$expected = 'http://www.gravatar.com/avatar/' . Security::hash('example@gravatar.com', 'md5');
		$result = $this->Gravatar->url('example@gravatar.com', array('ext' => false, 'secure' => false));
		$this->assertEqual($expected, $result);
	}

/**
 * testSecureUrl
 *
 * @return void
 */
	public function testSecureUrl() {
		$expected = 'https://secure.gravatar.com/avatar/' . Security::hash('example@gravatar.com', 'md5');
		$result = $this->Gravatar->url('example@gravatar.com', array('ext' => false, 'secure' => true));
		$this->assertEqual($expected, $result);

		$_SERVER['HTTPS'] = true;
		$this->Gravatar = new GravatarHelper($this->View);
		$expected = 'https://secure.gravatar.com/avatar/' . Security::hash('example@gravatar.com', 'md5');
		$result = $this->Gravatar->url('example@gravatar.com', array('ext' => false));
		$this->assertEqual($expected, $result);

		$expected = 'https://secure.gravatar.com/avatar/' . Security::hash('example@gravatar.com', 'md5');
		$result = $this->Gravatar->url('example@gravatar.com', array('ext' => false, 'secure' => true));
		$this->assertEqual($expected, $result);
	}

/**
 * testForceDefault
 *
 * @return void
 */
	public function testForceDefault() {
		$result = $this->Gravatar->url('example@gravatar.com', array('forcedefault' => true));
		$this->assertPattern('/\?/', $result);
		list($url, $params) = explode('?', $result);
		$this->assertPattern('/f=y/', $params);
	}
}
