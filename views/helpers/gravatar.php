<?php 
/**
 * A CakePHP View Helper for the display of Gravatar images (http://www.gravatar.com)
 *
 * Copyright 2009, Graham Weldon
 * http://grahamweldon.com
 * Newcastle, Australia
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2008, Graham Weldon
 * @version 1.1
 * @author Graham Weldon <graham@grahamweldon.com>
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 */
App::import(array('Security', 'Validation'));

class GravatarHelper extends AppHelper {
        private $__url = 'http://www.gravatar.com/avatar/';
        private $__hashType = 'md5';
        private $__allowedRatings = array('g', 'pg', 'r', 'x');
        private $__defaultIcons = array('identicon', 'monsterid', 'wavatar');
        private $__default = array('default' => 'identicon', 'size' => null, 'rating' => null, 'ext' => false);

        public $helpers = array('Html');

        public function image($email, $options = array()) {
                $options = $this->__cleanOptions(am($this->__default, $options));

                $ext = $options['ext'];
                unset($options['ext']);

                $imageUrl = $this->__url . $this->__emailHash(strtolower($email), $this->__hashType) . ($ext ? '.jpg' : '') . $this->__buildOptions($options);
                unset($options['default'], $options['size'], $options['rating']);

                return $this->Html->image($imageUrl, $options);
        }

        private function __cleanOptions($options) {
                if (!$options['size']) {
                        unset($options['size']);
                } else {
                        if ($options['size'] < 1) {
                                $options['size'] = 1;
                        } elseif ($options['size'] > 512) {
                                $options['size'] = 512;
                        }
                }

                if (!$options['rating'] || !in_array($options['rating'], $this->__allowedRatings)) {
                        unset($options['rating']);
                }

                if (!$options['default']) {
                        unset($options['default']);
                } else {
                        if (!in_array($options['default'], $this->__defaultIcons) && !Validation::url($options['default'])) {
                                unset($options['default']);
                        }
                }

                return $options;
        }

        private function __emailHash($email, $type) {
                return Security::hash($email, $type);
        }

        private function __buildOptions($options) {
                if (count($options)) {
                        $optionArray = array();
                        foreach ($options as $k => $v) {
                                $optionArray[] = $k . '=' . $v;
                        }
                        return '?' . implode('&amp;', $optionArray);
                }
                return '';
        }

}
?>