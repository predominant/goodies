<?php

App::uses('HtmlHelper', 'View/Helper');

/**
 * Disqus Helper
 *
 * Helper to provide convenience functions for Disqus service usage (http://disqus.com)
 *
 * @copyright   Copyright 2009-2011, Graham Weldon (http://grahamweldon.com)
 * @package     Goodies
 * @subpackage  Goodies.View.Helper
 * @author      Graham Weldon (http://grahamweldon.com)
 * @license     http://www.opensource.org/licenses/mit-license.php The MIT License
 */
class DisqusHelper extends HtmlHelper {

	protected $_defaultOptions = array(
		'title' => null,
		'url' => null,
		'identifier' => null,
		'developer' => null,
	);

/**
 * Configuration path
 *
 * @var string
 */
	protected $_configPath = null;

/**
 * Embed the comments system for the specified shortname
 *
 * You need to register this shortname with Disqus first: http://disqus.com
 *
 * @param string $shortname Shortname defined on disqus
 * @return string Html snippet
 */
	public function embed($shortname, $options = array()) {
		$options = array_merge($this->_defaultOptions, $options);
		$options['shortname'] = $shortname;
		
		if ($options['developer'] === null && Configure::read('debug') !== 0) {
			$options['developer'] = 1;
		}
		
		$vars = $this->_constructVariables($options);
		
		$threadDiv = $this->tag('div', '', array('id' => 'disqus_thread'));
		$scriptBlock = $this->_generateScriptBlock($vars);
		$noscript = $this->tag('noscript', __d('goodies', 'Please enable Javascript to view the comments on this page.'));
		
		return $threadDiv . $scriptBlock . $noscript;
	}

/**
 * Read the options and construct a javascript string for use in the output snippet
 *
 * @param array $options Array of options
 * @return string Javascript variables
 */
	protected function _constructVariables($options) {
		$template = 'var disqus_%s = "%s"; ';
		$result = '';
		foreach ($options as $key => $value) {
			if ($value !== null) {
				$result .= sprintf($template, $key, $value);
			}
		}
		return $result;
	}

/**
 * Generate the main script block to display the disqus thingo
 *
 * @param string $vars Javascript variables to include before the snippet
 * @return String Script string
 */
	protected function _generateScriptBlock($vars) {
		$block = <<<ENDBLOCK
(function() {
	var dsq = document.createElement("script"); dsq.type = "text/javascript"; dsq.async = true; dsq.src = "http://" + disqus_shortname + ".disqus.com/embed.js";
	(document.getElementsByTagName("head")[0] || document.getElementsByTagName("body")[0]).appendChild(dsq);
})();
ENDBLOCK;
		return $this->scriptBlock($vars . $block);
	}
}
