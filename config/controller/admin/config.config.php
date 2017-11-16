<?php
$isProd = in_array(\Arr::get($_SERVER, 'NOS_ENV', ''), array('prod', 'production'));

$config = array(
    'form_name' => __('Your Google SEO Tools'),
    'tab' => array(
        'label' => 'Google SEO Tools',
    ),
    'layout' => array(
        'lines' => array(
            1 => array(
                'cols' => array(
                    1 => array(
                        'col_number' => 6,
                        'view' => 'nos::form/expander',
                        'params' => array(
                            'title'   => __('Paramètres Google Analytics'),
                            'options' => array(
                                'allowExpand' => false,
                            ),
                            'content' => array(
                                'view' => 'nos::form/fields',
                                'params' => array(
                                    'fields' => array(
                                        'google_analytics_tag',
                                        'full_script',
                                        'use_universal_analytics',
                                    ),
                                ),
                            ),
                        ),
                    ),
                    2 => array(
                        'col_number' => 6,
                        'view' => 'nos::form/expander',
                        'params' => array(
                            'title'   => __('General parameters'),
                            'options' => array(
                                'allowExpand' => false,
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
                ),
            ),
            2 => array(
                'cols' => array(
                    1 => array(
                        'col_number' => 6,
                        'view' => 'nos::form/expander',
                        'params' => array(
                            'title' => __('Paramètre google tag manager'),
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
                    2 => array(
                        'col_number' => 6,
                        'view' => 'nos::form/expander',
                        'params' => array(
                            'title'   => __('Paramètres expert'),
                            'options' => array(
                                'allowExpand' => true,
                                'expanded' => false,
                            ),
                            'content' => array(
                                'view' => 'nos::form/fields',
                                'params' => array(
                                    'fields' => array(
                                        'label_cookie_tracking',
                                        'tracking_cookie_name',
                                        'tracking_cookie_value',
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
            3 => array(
                'cols' => array(
                    1 => array(
                        'col_number' => 6,
                        'view' => 'nos::form/expander',
                        'params' => array(
                            'title'   => __('Hotjar parameters'),
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
                    2 => array(
                        'col_number' => 6,
                        'view' => 'nos::form/expander',
                        'params' => array(
                            'title'   => __('Google webmaster tools'),
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
                ),
            ),
            4 => array(
                'cols' => array(
                    1 => array(
                        'col_number' => 6,
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
                                    ),
                                ),
                            ),
                        ),
                    ),
                    2 => array(
                        'col_number' => 6,
                        'view' => 'nos::form/expander',
                        'params' => array(
                            'title'   => __('Google optimize parameters'),
                            'options' => array(
                                'allowExpand' => true,
                                'expanded' => false,
                            ),
                            'content' => array(
                                'view' => 'nos::form/fields',
                                'params' => array(
                                    'fields' => array(
                                        'full_script_googleOptimize',
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
            100 => array(
                'cols' => array(
                    1 => array(
                        'col_number' => 6,
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
        'google_analytics_tag' => array(
            'label' => __('Tag google analytics'),
            'form' => array(
                'type' => 'text',
            ),
        ),
        'full_script' => array(
            'label' => __('Script entier'),
            'form' => array(
                'type' => 'textarea',
            ),
        ),
        'full_script_hotjar' => array(
            'label' => __('Script entier'),
            'form' => array(
                'type' => 'textarea',
            ),
        ),
        'full_script_fbPixel' => array(
            'label' => __('Script entier'),
            'form' => array(
                'type' => 'textarea',
            ),
            'template' => '            
            <table class="fieldset">
            <tbody>
                <tr>
                    <td class="">{label}</td>
			        <td class="">{field}</td>
			    </tr>
			</tbody>
			</table>
			<p>Valable uniquement pour le script Website tag universel. La mise en place d\'un script Website tag d\'événement unique nécessite une intervention sur mesure. Contacter votre chef de projet Novius.</p>',
        ),
        'full_script_twitterPixel' => array(
            'label' => __('Script entier'),
            'form' => array(
                'type' => 'textarea',
            ),
            'template' => '            
            <table class="fieldset">
            <tbody>
                <tr>
                    <td class="">{label}</td>
			        <td class="">{field}</td>
			    </tr>
			</tbody>
			</table>
			<p>Valable uniquement pour le script Website tag universel. La mise en place d\'un script Website tag d\'événement unique nécessite une intervention sur mesure. Contacter votre chef de projet Novius.</p>',
        ),
        'full_script_googleOptimize' => array(
            'label' => __('Google optimize tag (GTM-xxxxxx)'),
            'form' => array(
                'type' => 'textarea',
            ),
            'template' => '
                <table class="fieldset">
                <tbody>
                    <tr>
                        <td class="">{label}</td>
                        <td class="">{field}</td>
                    </tr>
                </tbody>
                </table>
                <p>ATTENTION : nécéssite impérativement l\'utilisation d\'Universal Analytics. Ne peut pas être configuré sans avoir configuré Google Analytics settings. Si vous avez utilisé le champ full script, ne pas utiliser ce module mais insérer la ligne de code tel qu\'indique par Google Optimize.</p>
            ',
        ),
        'label_verification' => array(
            'label' => '<strong>'.__('Méthode de vérification du site').'</strong>',
            'form' => array(
                'type' => 'text',
                'tag' => 'label',
            ),
        ),
        'google_site_verification' => array(
            'label' => __('Contenu de la balise meta'),
            'form' => array(
                'type' => 'text',
            ),
        ),
        'label_or' => array(
            'label' => '<strong>'.__('OU (utiliser les deux méthodes est inutile)').'</strong>',
            'form' => array(
                'type' => 'text',
                'tag' => 'label',
            ),
        ),
        'google_site_verification_html' => array(
            'label' => __('Nom de la page html de vérification'),
            'form' => array(
                'type' => 'text',
            ),
        ),
        'use_universal_analytics' => array(
            'label' => __('Utiliser Universal analytics'),
            'form' => array(
                'type' => 'checkbox',
                'value' => '1',
                'empty' => '0',
            ),
        ),
        'label_cookie_tracking' => array(
            'label' => '<strong>'.__('Cookie de tracking').'</strong>',
            'form' => array(
                'type' => 'text',
                'tag' => 'label',
            ),
            'expert' => true,
        ),
        'tracking_cookie_name' => array(
            'label' => __('Nom du cookie'),
            'form' => array(
                'type' => 'text',
            ),
            'expert' => true,
        ),
        'tracking_cookie_value' => array(
            'label' => __('Valeur du cookie'),
            'form' => array(
                'type' => 'text',
            ),
            'expert' => true,
        ),
        'do_not_track_logged_user' => array(
            'label' => __('Exclure les administrateurs'),
            'form' => array(
                'type' => 'checkbox',
                'value' => '1',
                'empty' => '0',
            ),
        ),
        'track_dev' => array(
            'label' => __('Activer en développement'),
            'form' => array(
                'type' => 'checkbox',
                'value' => '1',
                'empty' => '0',
            ),
        ),
        'google_tagmanager_tag' => array(
            'label' => __('Tag google tag manager'),
            'form' => array(
                'type' => 'text',
            ),
        ),
        'tagmanager_full_script_head' => array(
            'label' => __('Script entier avant le tag &lt;&sol;head&gt;'),
            'form' => array(
                'type' => 'textarea',
                'rows' => 12
            ),
        ),
        'tagmanager_full_script_body' => array(
            'label' => __('Script entier après le tag &lt;body&gt;'),
            'form' => array(
                'type' => 'textarea',
                'rows' => 10
            ),
        ),
    ),
);

return $config;