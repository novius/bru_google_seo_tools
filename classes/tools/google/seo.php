<?php

namespace Bru\Google\Seo\Tools;

class Tools_Google_Seo
{
    /**
     * Returns the domain of the context send in argument or of the current context without any subdomain
     *
     * @return String
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
     * Returns the script tag wich contain the google analytics javascript
     *
     * @return string
     */
    public static function getAnalyticsTrackingScript()
    {
        $config = static::getConfig();
        if (empty($config)) {
            return '';
        }

        if (!empty($config['full_script'])) {
            if (\Str::starts_with($config['full_script'], '<script')) {
                $fullScript = $config['full_script'];
            } else {
                $fullScript = '<script type="text/javascript">'.$config['full_script'].'</script>';
            }
        } else {
            $tag = \Arr::get($config, 'google_analytics_tag');
            if (empty($tag)) return '';

            if (\Arr::get($config, 'use_universal_analytics')) {
                $view = 'bru_google_seo_tools::js_tag_universal_analitycs';
                $datas = array(
                    'tag' => $tag,
                    'domain' => self::getDomain(),
                );
            } else {
                $view = 'bru_google_seo_tools::js_tag';
                $datas = array(
                    'tag' => $tag,
                );
            }
            $fullScript = \View::forge($view, $datas, false);
        }

        $fullScript = static::getCodeWithoutComment($fullScript);

        if (empty($fullScript)) {
            return '';
        } else {
            self::_doNotTrack($fullScript);

            return (string) $fullScript;
        }
    }

    /**
     * Returns the body script tagmanager wich contain the google analytics javascript
     *
     * @return string
     */
    public static function getTagmanagerTrackingScriptBody()
    {
        $config = static::getConfig();

        if (empty($config)) {
            return '';
        }

        if (!empty($config['tagmanager_full_script_body'])) {
            if (\Str::starts_with($config['tagmanager_full_script_body'], '<script')) {
                $fullScript = $config['tagmanager_full_script_body'];
            } else {
                $fullScript = '<script type="text/javascript">'.$config['tagmanager_full_script_body'].'</script>';
            }
        } else {
            $tag = \Arr::get($config, 'google_tagmanager_tag');
            $fullScript = \View::forge('bru_google_seo_tools::js_tagmanager_body', compact('tag'), false);
        }

        $fullScript = static::getCodeWithoutComment($fullScript);

        if (!empty($fullScript)) {
            self::_doNotTrack($fullScript);
        }

        return (string) $fullScript;
    }

    /**
     * Returns the head script tagmanager wich contain the google analytics javascript
     *
     * @return string
     */
    public static function getTagmanagerTrackingScriptHead()
    {
        $config = static::getConfig();

        if (empty($config)) {
            return '';
        }

        if (!empty($config['tagmanager_full_script_head'])) {
            if (\Str::starts_with($config['tagmanager_full_script_head'], '<script')) {
                $fullScript = $config['tagmanager_full_script_head'];
            } else {
                $fullScript = '<script type="text/javascript">'.$config['tagmanager_full_script_head'].'</script>';
            }
        } else {
            $tag = \Arr::get($config, 'google_tagmanager_tag');
            $fullScript = \View::forge('bru_google_seo_tools::js_tagmanager_head', compact('tag'), false);
        }

        $fullScript = static::getCodeWithoutComment($fullScript);

        if (!empty($fullScript)) {
            self::_doNotTrack($fullScript);
        }

        return (string) $fullScript;
    }

    /**
     * @return string
     */
    public static function getTrackingCookieName()
    {
        //Search the context's config. If there is not : do nothing
        $config = static::getConfig();

        if (empty($config)) {
            return '';
        }

        //Check if a tracking cookie name is set
        $cookie_name = \Arr::get($config, 'tracking_cookie_name', '');

        return $cookie_name;
    }

    /**
     * Return the script embed in html comments if we are in a case that user do not want the page to appears in Google Analytics
     * @return string
     */
    protected static function _doNotTrack(&$full_script)
    {
        //Search the context's config. If there is not : do nothing
        $config = static::getConfig();

        //No tracking if it's a preview
        if (\Nos\Nos::main_controller()->isPreview()) {
            $full_script = '<!--'.$full_script.'-->';

            return $full_script;
        }

        //No script if we do not want logged in users to be tracked
        if (\Arr::get($config, 'do_not_track_logged_user', 0) && \Nos\Auth::check()) {
            $full_script = '<!--'.$full_script.'-->';

            return $full_script;
        }

        //Pas de tracking en local ou en préprod
        if (!in_array(\Arr::get($_SERVER, 'NOS_ENV', ''), array('prod', 'production')) && !\Arr::get($config, 'track_dev', false)) {
            $full_script = '<!--'.$full_script.'-->';

            return $full_script;
        }
    }

    /**
     * Check if the tracking script must be add after the cache
     * @return bool
     */
    public static function trackingAfterCache()
    {
        $config = static::getConfig();
        if (empty($config)) {
            return false;
        }

        //Check if a tracking cookie name is set
        $cookie_name = \Bru\Google\Seo\Tools\Tools_Google_Seo::getTrackingCookieName();
        //If $cookie_name is set, the tracking script is add after the cache, because we need to check the user's cookie
        if (!empty($cookie_name)) return true;

        //If we don't want users to be tracked, we must out of the cache if the current user is logged in or not
        if (\Arr::get($config, 'do_not_track_logged_user', 0)) {
            return true;
        }

        return false;
    }

    protected static function getConfig()
    {
        $config = Controller_Admin_Config::getOptions();
        $currentContext = \Nos\Nos::main_controller()->getContext();

        return \Arr::get($config, $currentContext);
    }

    protected static function getCodeWithoutComment($code)
    {
        return preg_replace('/<!--(.*)-->/Uis', '', $code);
    }
}
