<?php

use Bru\Google\Seo\Tools\Tools_Google_Seo;

/**
 * Event triggered after cache has been written
 */
Event::register_function('front.response', function ($params) {
    // Checks if tracking scripts must be injected after cache
    if (!Tools_Google_Seo::trackingAfterCache()) {
        return false;
    }

    $html =& $params['content'];
    $html = Tools_Google_Seo::injectTrackingScripts($html);
});

/**
 * Event triggered before cache is written
 */
Event::register_function('front.display', function (&$html) {

    // Checks if tracking scripts must be injected before cache
    if (Tools_Google_Seo::trackingAfterCache()) {
        return false;
    }

    $html = Tools_Google_Seo::injectTrackingScripts($html);
});

Event::register('front.pageFound', function ($params) {
    //Search the context's config. If there is not : do nothing
    $config = Bru\Google\Seo\Tools\Controller_Admin_Config::getOptions();
    $config = \Arr::get($config, \Nos\Nos::main_controller()->getContext());
    if (empty($config)) {
        return false;
    }

    if (isset($config['google_site_verification']) && !empty($config['google_site_verification'])) {
        $meta_tag = '<meta name="google-site-verification" content="'.$config['google_site_verification'].'" />';
        \Nos\Nos::main_controller()->addMeta($meta_tag);
    }
});

Event::register('front.404NotFound', function ($params) {
    $config = Bru\Google\Seo\Tools\Controller_Admin_Config::getOptions();
    $url =& $params['url'];
    $sHtmlExtension = '.html';

    $iSlashPosition = strpos($url, '/');
    if ($iSlashPosition !== false) {
        //There is a '/' in the requested URI : the google verification can't work
        return false;
    }

    foreach ($config as $context => $context_config) {
        // Test if the context url is the same that the base URI. If not, continue;
        if (\Nos\Tools_Url::context($context) != \Uri::base(false)) continue;

        if (empty($context_config)) continue;
        $html_page_name = \Arr::get($context_config, 'google_site_verification_html');
        if (empty($html_page_name)) continue;

        // Remove the '.html' to match with the request URI
        if (\Str::ends_with($html_page_name, $sHtmlExtension)) {
            $html_page_name = \Str::sub($html_page_name, 0, strlen($html_page_name) - strlen($sHtmlExtension));
        }
        // If the google verification page is requested, send the view and exit
        if ($url == $html_page_name) {
            $google_site_verification_code = $html_page_name.$sHtmlExtension;
            \Response::forge(\View::forge('bru_google_seo_tools::google_site_verification', array(
                'google_site_verification_code' => $google_site_verification_code,
            ), false), 200)->send();
            exit();
        }
    }

    return false;
});

