<?php

namespace Core;

    class Sanitizer
    {
        private function __construct()
        {
        }

        /*
         * Sanitize a given URL
         */
        public static function sanitizeURL($url)
        {
            return htmlspecialchars(strip_tags($url));
        }
    }
