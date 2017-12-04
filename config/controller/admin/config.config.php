<?php

return array(
    'form_name' => __('Your SEO Tools'),
    'tab' => array(
        'label' => __('Google SEO Tools'),
    ),
    'layout' => array(
        'lines' => array(
            1 => array(
                'cols' => array(
                    1 => array(
                        'col_number' => 8,
                        'view' => 'lib_options::admin/options_layout',
                        'params' => array(
                            'lines' => array(
                                1 => array(
                                    'cols' => array(
                                        1 => array(
                                            'col_number' => 12,
                                            'view' => 'nos::form/expander',
                                            'params' => array(
                                                'title'   => __('Google Analytics'),
                                                'options' => array(
                                                    'allowExpand' => true,
                                                    'expanded' => false,
                                                ),
                                                'content' => array(
                                                    'view' => 'nos::form/fields',
                                                    'params' => array(
                                                        'fields' => array(
                                                            'google_analytics_tag',
                                                            'full_script',
                                                        ),
                                                    ),
                                                ),
                                            ),
                                        ),
                                        2 => array(
                                            'col_number' => 12,
                                            'view' => 'nos::form/expander',
                                            'params' => array(
                                                'title' => __('Google Tag Manager'),
                                                'options' => array(
                                                    'allowExpand' => true,
                                                    'expanded' => false,
                                                ),
                                                'content' => array(
                                                    'view' => 'nos::form/fields',
                                                    'params' => array(
                                                        'fields' => array(
                                                            'google_tagmanager_tag',
                                                            'tagmanager_full_script_head',
                                                            'tagmanager_full_script_body',
                                                        ),
                                                    ),
                                                ),
                                            ),
                                        ),
                                        3 => array(
                                            'col_number' => 12,
                                            'view' => 'nos::form/expander',
                                            'params' => array(
                                                'title'   => __('Google Webmaster Tools'),
                                                'options' => array(
                                                    'allowExpand' => true,
                                                    'expanded' => false,
                                                ),
                                                'content' => array(
                                                    'view' => 'nos::form/fields',
                                                    'params' => array(
                                                        'fields' => array(
                                                            'label_verification',
                                                            'google_site_verification_html',
                                                            'label_or',
                                                            'google_site_verification',
                                                        ),
                                                    ),
                                                ),
                                            ),
                                        ),
                                        4 => array(
                                            'col_number' => 12,
                                            'view' => 'nos::form/expander',
                                            'params' => array(
                                                'title'   => __('Google Optimize'),
                                                'options' => array(
                                                    'allowExpand' => true,
                                                    'expanded' => false,
                                                ),
                                                'content' => array(
                                                    'view' => 'nos::form/fields',
                                                    'params' => array(
                                                        'fields' => array(
                                                            'full_script_googleOptimize',
                                                            'googleOptimize_help',
                                                        ),
                                                    ),
                                                ),
                                            ),
                                        ),
                                        5 => array(
                                            'col_number' => 12,
                                            'view' => 'nos::form/expander',
                                            'params' => array(
                                                'title'   => __('Hotjar'),
                                                'options' => array(
                                                    'allowExpand' => true,
                                                    'expanded' => false,
                                                ),
                                                'content' => array(
                                                    'view' => 'nos::form/fields',
                                                    'params' => array(
                                                        'fields' => array(
                                                            'full_script_hotjar',
                                                        ),
                                                    ),
                                                ),
                                            ),
                                        ),
                                        6 => array(
                                            'col_number' => 12,
                                            'view' => 'nos::form/expander',
                                            'params' => array(
                                                'title'   => __('Facebook Pixel'),
                                                'options' => array(
                                                    'allowExpand' => true,
                                                    'expanded' => false,
                                                ),
                                                'content' => array(
                                                    'view' => 'nos::form/fields',
                                                    'params' => array(
                                                        'fields' => array(
                                                            'full_script_fbPixel',
                                                            'fbPixel_help',
                                                        ),
                                                    ),
                                                ),
                                            ),
                                        ),
                                        7 => array(
                                            'col_number' => 12,
                                            'view' => 'nos::form/expander',
                                            'params' => array(
                                                'title'   => __('Twitter Pixel'),
                                                'options' => array(
                                                    'allowExpand' => true,
                                                    'expanded' => false,
                                                ),
                                                'content' => array(
                                                    'view' => 'nos::form/fields',
                                                    'params' => array(
                                                        'fields' => array(
                                                            'full_script_twitterPixel',
                                                            'twitterPixel_help',
                                                        ),
                                                    ),
                                                ),
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                        ),
                    ),
                    2 => array(
                        'col_number' => 4,
                        'view' => 'lib_options::admin/options_layout',
                        'params' => array(
                            'lines' => array(
                                1 => array(
                                    'cols' => array(
                                        1 => array(
                                            'col_number' => 12,
                                            'view' => 'nos::form/expander',
                                            'params' => array(
                                                'title'   => __('General settings'),
                                                'options' => array(
                                                    'allowExpand' => false,
                                                    'expanded' => true,
                                                ),
                                                'content' => array(
                                                    'view' => 'nos::form/fields',
                                                    'params' => array(
                                                        'fields' => array(
                                                            'do_not_track_logged_user',
                                                            'track_dev',
                                                        ),
                                                    ),
                                                ),
                                            ),
                                        ),
                                        2 => array(
                                            'col_number' => 12,
                                            'view' => 'nos::form/expander',
                                            'params' => array(
                                                'title'   => __('Expert settings'),
                                                'options' => array(
                                                    'allowExpand' => false,
                                                    'expanded' => true,
                                                ),
                                                'content' => array(
                                                    'view' => 'nos::form/fields',
                                                    'params' => array(
                                                        'fields' => array(
                                                            'label_cookie_tracking',
                                                            'tracking_cookie_name',
                                                            'tracking_cookie_value',
                                                            'tracking_cookie_name_help',
                                                        ),
                                                    ),
                                                ),
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'fields' => array(

        /**
         * Google Analytics
         */
        'google_analytics_tag' => array(
            'label' => __('Tracking ID (UA-xxxxxx-x)'),
            'form' => array(
                'type' => 'text',
                'rows' => '12',
            ),
        ),
        'full_script' => array(
            'label' => __('Full script'),
            'form' => array(
                'type' => 'textarea',
                'rows' => '12',
            ),
        ),

        /**
         * Google Tag Manager
         */
        'google_tagmanager_tag' => array(
            'label' => __('Container ID (GTM-xxxxxx)'),
            'form' => array(
                'type' => 'text',
            ),
        ),
        'tagmanager_full_script_head' => array(
            'label' => __('Full script before the &lt;&sol;head&gt; tag'),
            'form' => array(
                'type' => 'textarea',
                'rows' => 12
            ),
        ),
        'tagmanager_full_script_body' => array(
            'label' => __('Full script after the &lt;body&gt; tag'),
            'form' => array(
                'type' => 'textarea',
                'rows' => 10
            ),
        ),

        /**
         * Google Webmaster Tools
         */
        'label_verification' => array(
            'label' => '<strong>'.__('Website verification method :').'</strong>',
            'form' => array(
                'type' => 'text',
                'tag' => 'label',
            ),
        ),
        'google_site_verification' => array(
            'label' => __('Meta tag content'),
            'form' => array(
                'type' => 'text',
            ),
        ),
        'label_or' => array(
            'label' => '<strong>'.__('OR (using both at same time is useless) :').'</strong>',
            'form' => array(
                'type' => 'text',
                'tag' => 'label',
            ),
        ),
        'google_site_verification_html' => array(
            'label' => __('Name of the HTML verification page'),
            'form' => array(
                'type' => 'text',
            ),
        ),

        /**
         * Google Optimize
         */
        'full_script_googleOptimize' => array(
            'label' => __('Optimize container ID (GTM-xxxxxx)'),
            'form' => array(
                'type' => 'text',
            ),
        ),
        'googleOptimize_help' => array(
            'label' => '',
            'renderer' => \Nos\Renderer_Text::class,
            'template' => '<tr><td colspan="2" style="font-style: italic;">'.__('WARNING: It is imperative to use Universal Analytics. Can not be configured without setting up Google Analytics. If you have filled in the "Full script" field, do not use this module but instead insert the line of code provided by Google Optimize.').'</td></tr>',
        ),

        /**
         * Hotjar
         */
        'full_script_hotjar' => array(
            'label' => __('Full script'),
            'form' => array(
                'type' => 'textarea',
                'rows' => '12',
            ),
        ),

        /**
         * Facebook Pixel
         */
        'full_script_fbPixel' => array(
            'label' => __('Full script'),
            'form' => array(
                'type' => 'textarea',
                'rows' => '12',
            ),
        ),
        'fbPixel_help' => array(
            'label' => '',
            'renderer' => \Nos\Renderer_Text::class,
            'template' => '<tr><td colspan="2" style="font-style: italic;">'.__('Valid only for the page tracking script. Setting up a Facebook Pixel script on specific pages or for the triggering of particular events requires a tailor-made intervention. Contact your Project Manager.').'</td></tr>',
        ),

        /**
         * Twitter pixel
         */
        'full_script_twitterPixel' => array(
            'label' => __('Full script'),
            'form' => array(
                'type' => 'textarea',
                'rows' => '12',
            ),
        ),
        'twitterPixel_help' => array(
            'label' => '',
            'renderer' => \Nos\Renderer_Text::class,
            'template' => '<tr><td colspan="2" style="font-style: italic;">'.__('Valid only for the universal website tag script. Setting up a website tag script for particular events requires a tailor-made intervention. Contact your Project Manager.').'</td></tr>',
        ),

        /**
         * General settings
         */
        'do_not_track_logged_user' => array(
            'label' => __('Exclude administrators'),
            'form' => array(
                'type' => 'checkbox',
                'value' => '1',
                'empty' => '0',
            ),
        ),
        'track_dev' => array(
            'label' => __('Activate on development mode'),
            'form' => array(
                'type' => 'checkbox',
                'value' => '1',
                'empty' => '0',
            ),
        ),

        /**
         * Expert settings
         */
        'label_cookie_tracking' => array(
            'label' => __('User tracking consent cookie :'),
            'renderer' => \Nos\Renderer_Text::class,
            'template' => '<tr><td colspan="2"><strong>{label}</strong></td></tr>',
            'expert' => true,
        ),
        'tracking_cookie_name_help' => array(
            'label' => '',
            'renderer' => \Nos\Renderer_Text::class,
            'template' => '<tr><td colspan="2" style="font-style: italic;">'.__('To use the consent cookie of the application Novius Cookie Banner, set "novius_cookies_banner" as the name and "true" as the value.').'</td></tr>',
            'expert' => true,
        ),
        'tracking_cookie_name' => array(
            'label' => __('Cookie name'),
            'form' => array(
                'type' => 'text',
            ),
            'expert' => true,
        ),
        'tracking_cookie_value' => array(
            'label' => __('Cookie value'),
            'form' => array(
                'type' => 'text',
            ),
            'expert' => true,
        ),
    ),
);
