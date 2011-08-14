<?php
/**
 * CakePHP Thumboo Helper
 *
 * A CakePHP View Helper for the display of Thumboo sourced website thumbnails (http://thumboo.com)
 *
 * @copyright Copyright 2010, Graham Weldon (http://grahamweldon.com)
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 * @package goodies
 * @subpackage goodies.views.helpers
 */
class ThumbooHelper extends AppHelper {

/**
 * Permitted size strings for image generation
 *
 * @var array
 */
	protected $_sizes = array('small', 'medium', 'large', 'huge');

/**
 * URL for the Thumboo thumb generator service.
 *
 * @var string
 */
	protected $_thumbooUrl = 'http://counter.goingup.com/thumboo/snapshot.php';

/**
 * Generate image outpout
 *
 * @param string $url Url to thumbnail
 * @param string $size Size to display
 * @param string $key API Key from http://thumboo.com
 * @return string HTML for page
 */
	public function image($url, $size = null, $key = null) {
		if (!$key) {
			// Try to load a config file
			if (!Configure::load('thumboo')) {
				return '<em>' . __('Your API Key was not provided, and is not readable at /config/thumboo.php', true) . '</em>';
			} else {
				$key = Configure::read('Thumboo.Key');
			}
		}
		
		if (!$size || !in_array($size, $this->_sizes)) {
			$size = 'large';
		}

		$protocol = env('HTTPS');
		$protocol = !empty($protocol) ? 'https' : 'http';
		$params = 'u=' . urlencode($protocol . '://' . env('HTTP_HOST') . env('REQUEST_URI'));
		$params .= '&su=' . urlencode($url);
		$params .= '&c=' . $size;
		$params .= '&api=' . $key;
		return @file_get_contents($this->_thumbooUrl . '?' . $params);
	}
}
