<?php

namespace Bru\Google\Seo\Tools;

use Nos\Nos;

class Tools_Google_Seo
{
    /**
     * Returns the domain of the context sent in argument or of the current context without any subdomain
     *
     * @param string $context
     * @return string
     */
    public static function getDomain($context = '')
    {
        if (empty($context)) $context = \Nos\Nos::main_controller()->getContext();
        $url = \Nos\Tools_Url::context($context);
        $sHttpProtocol = 'http://';
        if (\Str::starts_with($url, $sHttpProtocol)) $url = substr($url, strlen($sHttpProtocol));
        preg_match('#^[\w.-]*\.(\w+\.[a-z]{2,6})[\w/._-]*$#', $url, $match);
        $domain = isset($match[1]) ? $match[1] : '';

        return $domain;
    }

    /**
     * Returns the head script for Google Analytics
     *
     * @return string
     */
    public static function getAnalyticsTrackingScriptHead()
    {
        $config = static::getConfig();

        $fullScript = '';

        // Auto-generated script based on the options chosen by the user
        if (!empty($config['google_analytics_tag'])) {
            $fullScript = \View::forge('bru_google_seo_tools::js_tag_universal_analytics', array(
                'tag' => \Arr::get($config, 'google_analytics_tag'),
                'domain' => static::getDomain(),
                'optimize_code' => static::getGoogleOptimizeTrackingCode(),
            ), false);
        }
        // Script provided by the user
        elseif (!empty($config['full_script'])) {
            $fullScript = static::getCodeWithScriptTag($config['full_script']);
        }

        if (empty($fullScript)) {
            return '';
        }

        $fullScript = static::getCodeWithoutComment($fullScript);

        static::_shouldITrack($fullScript);

        return (string) $fullScript;
    }

    /**
     * @deprecated Please use getAnalyticsTrackingScriptHead() instead
     *
     * @return string
     */
    public static function getAnalyticsTrackingScript()
    {
        return static::getAnalyticsTrackingScriptHead();
    }

    /**
     * Returns the head script for Google Tag Manager
     *
     * @return string
     */
    public static function getTagmanagerTrackingScriptHead()
    {
        $config = static::getConfig();

        $fullScript = '';

        // Script provided by the user
        if (!empty($config['tagmanager_full_script_head'])) {
            $fullScript = $config['tagmanager_full_script_head'];
        }
        // Auto-generated script based on the options chosen by the user
        elseif (!empty($config['google_tagmanager_tag'])) {
            $fullScript = \View::forge('bru_google_seo_tools::js_tagmanager_head', array(
                'tag' => $config['google_tagmanager_tag'],
            ), false);
        }

        if (empty($fullScript)) {
            return '';
        }

        $fullScript = static::getCodeWithoutComment($fullScript);

        static::_shouldITrack($fullScript);

        return (string) $fullScript;
    }

    /**
     * Returns the body script for Google Tag Manager
     *
     * @return string
     */
    public static function getTagmanagerTrackingScriptBody()
    {
        $config = static::getConfig();

        $fullScript = '';

        // Script provided by the user
        if (!empty($config['tagmanager_full_script_body'])) {
            $fullScript = $config['tagmanager_full_script_body'];
        }
        // Auto-generated script based on the options chosen by the user
        elseif (!empty($config['google_tagmanager_tag'])) {
            $fullScript = \View::forge('bru_google_seo_tools::js_tagmanager_body', array(
                'tag' => \Arr::get($config, 'google_tagmanager_tag'),
            ), false);
        }

        if (empty($fullScript)) {
            return '';
        }

        $fullScript = static::getCodeWithoutComment($fullScript);

        static::_shouldITrack($fullScript);

        return (string) $fullScript;
    }

    /**
     * Returns the Hotjar script
     *
     * @return string
     */
    public static function getHotjarTrackingScriptHead()
    {
        $config = static::getConfig();

        // Gets the script provided by the user
        $fullScript = \Arr::get($config, 'full_script_hotjar');
        if (empty($fullScript)) {
            return '';
        }

        $fullScript = static::getCodeWithoutComment($fullScript);

        static::_shouldITrack($fullScript);

        return (string) $fullScript;
    }

    /**
     * Returns the Facebook Pixel script
     *
     * @return string
     */
    public static function getFbPixelTrackingScriptHead()
    {
        $config = static::getConfig();

        // Gets the script provided by the user
        $fullScript = \Arr::get($config, 'full_script_fbPixel');
        if (empty($fullScript)) {
            return '';
        }

        $fullScript = static::getCodeWithoutComment($fullScript);

        static::_shouldITrack($fullScript);

        return (string) $fullScript;
    }

    /**
     * Returns the Twitter Pixel script
     *
     * @return string
     */
    public static function getTwitterPixelTrackingScriptBody()
    {
        $config = static::getConfig();

        // Gets the script provided by the user
        $fullScript = \Arr::get($config, 'full_script_twitterPixel');
        if (empty($fullScript)) {
            return '';
        }

        $fullScript = static::getCodeWithoutComment($fullScript);

        static::_shouldITrack($fullScript);

        return (string) $fullScript;
    }

    /**
     * Returns the Google Optimize tracking code that should be injected within the GA script
     *
     * @return string
     */
    public static function getGoogleOptimizeTrackingCode()
    {
        $config = static::getConfig();

        // Gets the script provided by the user
        $fullScript = \Arr::get($config, 'full_script_googleOptimize');
        if (empty($fullScript)) {
            return '';
        }

        return (string) $fullScript;
    }

    /**
     * Gets the tracking cookie name
     *
     * @return string
     */
    public static function getTrackingCookieName()
    {
        return \Arr::get(static::getConfig(), 'tracking_cookie_name', '');
    }

    /**
     * Gets the tracking cookie expected value
     * @return mixed
     */
    public static function getTrackingCookieExpectedValue()
    {
        return \Arr::get(static::getConfig(), 'tracking_cookie_value');
    }

    /**
     * Injects the tracking scripts in the given HTML document
     *
     * @param $html
     * @return mixed
     */
    public static function injectTrackingScripts($html)
    {
        // Injects tracking scripts before </head>
        $html = Tools_Google_Seo::injectCodeAtHeadEnd($html, array_filter(array(
            Tools_Google_Seo::getAnalyticsTrackingScriptHead(),
            Tools_Google_Seo::getTagmanagerTrackingScriptHead(),
            Tools_Google_Seo::getHotjarTrackingScriptHead(),
            Tools_Google_Seo::getFbPixelTrackingScriptHead(),
        )));

        // Injects tracking scripts after <body>
        $html = Tools_Google_Seo::injectCodeAtBodyStart($html, Tools_Google_Seo::getTagmanagerTrackingScriptBody());

        // Injects tracking scripts before </body>
        $html = Tools_Google_Seo::injectCodeAtBodyEnd($html, Tools_Google_Seo::getTwitterPixelTrackingScriptBody());

        return $html;
    }

    /**
     * Injects the given code before </head> in the given HTML document
     *
     * @param $html
     * @param string|array $code
     * @return mixed
     */
    public static function injectCodeAtHeadEnd($html, $code)
    {
        if (is_array($code)) {
            $code = implode("\n\n", $code);
        }

        if (!empty($code) && preg_match('/<\/head>/i', $html, $matches)) {
            $html = str_replace($matches[0], "\n\n".$code."\n\n".$matches[0], $html);
        }

        return $html;
    }

    /**
     * Injects the given code after <body> in the given HTML document
     *
     * @param $html
     * @param string|array $code
     * @return mixed
     */
    public static function injectCodeAtBodyStart($html, $code)
    {
        if (is_array($code)) {
            $code = implode("\n\n", $code);
        }

        if (!empty($code) && preg_match('/<body[^>]*>/i', $html, $matches)) {
            $html = str_replace($matches[0], $matches[0]."\n\n".$code."\n\n", $html);
        }

        return $html;
    }

    /**
     * Injects the given code before </body> in the given HTML document
     *
     * @param $html
     * @param string|array $code
     * @return mixed
     */
    public static function injectCodeAtBodyEnd($html, $code)
    {
        if (is_array($code)) {
            $code = implode("\n\n", $code);
        }

        if (!empty($code) && preg_match('/<\/body>/i', $html, $matches)) {
            $html = str_replace($matches[0], "\n\n".$code."\n\n".$matches[0], $html);
        }

        return $html;
    }

    /**
     * Return the script embed in html comments if we are in a case that user do not want the page to appears in Google Analytics
     *
     * @return string
     */
    protected static function _shouldITrack(&$fullScript)
    {
        // Search the context's config. If there is not : do nothing
        $config = static::getConfig();

        $fullScript = trim($fullScript);

        if (!empty($fullScript)) {

            // Tracking not allowed
            if (!static::trackingAllowed()) {
                $fullScript = '<!-- Script removed (tracking not allowed) -->';
            }

            // If it's a preview we'll disable tracking
            elseif (\Nos\Nos::main_controller()->isPreview()) {
                $fullScript = '<!--'.$fullScript.'-->';
            }
            // If we dont want to track users who are logged-in
            elseif (\Arr::get($config, 'do_not_track_logged_user', 0) && \Nos\Auth::check()) {
                $fullScript = '<!--'.$fullScript.'-->';
            }
            // Pas de tracking en local ou en préprod
            elseif (!in_array(\Arr::get($_SERVER, 'NOS_ENV', ''), array('prod', 'production')) && !\Arr::get($config, 'track_dev', false)) {
                $fullScript = '<!--'.$fullScript.'-->';
            }
        }

        return $fullScript;
    }

    /**
     * Check if the tracking script must be added after the cache
     *
     * @return bool
     */
    public static function trackingAfterCache()
    {
        $config = static::getConfig();

        // If a tracking cookie has been set, the tracking scripts must be added after the cache,
        // because we need to check if the user has the cookie
        $cookie_name = static::getTrackingCookieName();
        if (!empty($cookie_name)) {
            return true;
        }

        // If we don't want users to be tracked, the tracking scripts must be added after the cache,
        // because we need to check if the current user is logged in or not
        if (\Arr::get($config, 'do_not_track_logged_user', 0)) {
            return true;
        }

        return false;
    }

    /**
     * Checks if tracking is allowed (in some cases, the user must give his consent)
     *
     * @return bool
     */
    public static function trackingAllowed()
    {
        // Checks the user consent cookie
        $cookie_name = static::getTrackingCookieName();
        $cookie_expected_value = static::getTrackingCookieExpectedValue();
        if (!empty($cookie_name) && (!\Cookie::get($cookie_name, false) || \Cookie::get($cookie_name) != $cookie_expected_value)) {
            // The cookie is not set or its value is not good
            return false;
        }

        return true;
    }

    /**
     * Gets the configuration for the current context
     *
     * @return mixed
     */
    public static function getConfig()
    {
        $config = Controller_Admin_Config::getOptions();

        // Gets the current context
        if (Nos::main_controller() && method_exists(Nos::main_controller(), 'getContext')) {
            $currentContext = Nos::main_controller()->getContext();
        } else {
            $currentContext = null;
        }

        if (empty($currentContext)) {
            return array();
        }

        return \Arr::get($config, $currentContext, array());
    }

    /**
     * Gets the given code without comments
     *
     * @param $code
     * @return mixed
     */
    protected static function getCodeWithoutComment($code)
    {
        return preg_replace('/<!--(.*)-->/Uis', '', $code);
    }

    /**
     * Gets the given code surrounded with a <script> tag
     *
     * @param $code
     * @return string
     */
    protected static function getCodeWithScriptTag($code)
    {
        if (!\Str::starts_with(trim($code), '<script')) {
            $code = '<script type="text/javascript">'.$code.'</script>';
        }

        return $code;
    }
}
