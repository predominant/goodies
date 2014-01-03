<?php

App::uses('AppHelper', 'View/Helper');

/**
 * CakePHP Google Analytics Helper
 *
 * A helper for the generation of Google Analytics snippets and code
 *
 * @copyright   Copyright 2009-2011, Graham Weldon (http://grahamweldon.com)
 * @package     Goodies
 * @subpackage  Goodies.View.Helper
 * @author      Graham Weldon (http://grahamweldon.com)
 * @license     http://www.opensource.org/licenses/mit-license.php The MIT License
 */
class GoogleAnalyticsHelper extends AppHelper {

/**
 * Output the GA PageTracker code snippet
 *
 * @return string Html output for code snippet
 */
	public function pageTracker($account, $domain = null, $universal = true) {
		if ($universal) {
			return "<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	ga('create', '" . $account . "', '" . $domain . "');
	ga('send', 'pageview');
</script>";
		} else {
			return '<script>
	var _gaq=[["_setAccount","' . $account . '"],["_trackPageview"]];
	(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
	g.src=("https:"==location.protocol?"//ssl":"//www")+".google-analytics.com/ga.js";
	s.parentNode.insertBefore(g,s)}(document,"script"));
</script>';
		}
	}
}
