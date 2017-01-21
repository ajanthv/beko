<?php

use Jenssegers\Agent\Agent;

if (!function_exists('getIpAddress')) {
    /**
     * Generate User IP address.
     * @return mixed
     */
    function getIpAddress()
    {
        foreach ([
                     'HTTP_CLIENT_IP',
                     'HTTP_X_FORWARDED_FOR',
                     'HTTP_X_FORWARDED',
                     'HTTP_X_CLUSTER_CLIENT_IP',
                     'HTTP_FORWARDED_FOR',
                     'HTTP_FORWARDED',
                     'REMOTE_ADDR'
                 ] as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip);
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }
    }
}

if (!function_exists('getUserAgent')) {
    /**
     * Generate User IP address.
     * @return mixed
     */
    function getUserAgent()
    {
        return Request()->header('User-Agent');
    }
}

if (!function_exists('getUserDevice')) {
    /**
     * Generate User IP address.
     * @return mixed
     */
    function getUserDevice()
    {
        $userAgent = Request()->header('User-Agent');
        $agent = new Agent();

        if ($agent->isMobile($userAgent)) {
            return 'mobile';
        } else {
            return 'desktop';
        }

    }

}

if (!function_exists('getDomainFromUrl')) {
    /**
     * @param string $url
     * @return string
     */
    function getDomainFromUrl($url = "")
    {
        $url = parse_url($url, PHP_URL_HOST);

        if ($url == null || !$url) {
            return "";
        }

        // Remove WWW from host if exists
        return preg_match('#^www\.(.+\.)#i', $url) ? preg_replace('#^www\.(.+\.)#i', '$1', $url) : $url;
    }
}

if (!function_exists('formatNumber')) {
    /**
     * Generate formatted numbers if its digits exceeds five.
     *
     * @param  int  $number
     * @return string
     */
    function formatNumber($number)
    {
        $stringLength = strlen($number);

        if ($stringLength > 5) {
            return round($number / 1000, 2).'K';
        }
        return $number;
    }
}

if (!function_exists('hexToRgba')) {
    /**
     * Covert hex color code to rgb.
     *
     * @param string $hex
     * @param int $opacity
     * @return string
     */
    function hexToRgba($hex, $opacity = 0)
    {
        $hex = str_replace("#", "", $hex);

        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1).substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1).substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1).substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        $rgb = array($r, $g, $b);
        $opacity = ($opacity >= 0 && $opacity <= 1 && $opacity != null) ? $opacity : 1 ;
        return "rgba(" . implode(",", $rgb) . "," .$opacity. ")";
    }
}

if (!function_exists('activePath')) {
    /**
     * Find active path.
     *
     * @param string $path
     * @param string $activePath
     * @return bool
     */
    function activePath($path, $activePath)
    {
        if (trim($path) === trim($activePath)) {
            return true;
        }
        return false;
    }

}
