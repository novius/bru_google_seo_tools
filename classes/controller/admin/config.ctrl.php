<?php
/**
 * NOVIUS OS - Web OS for digital communication
 *
 * @copyright 2011 Novius
 * @license GNU Affero General Public License v3 or (at your option) any later version
 * http://www.gnu.org/licenses/agpl-3.0.html
 * @link http://www.novius-os.org
 */

namespace Bru\Google\Seo\Tools;

class Controller_Admin_Config extends \Lib\Options\Controller_Admin_Options
{
    public function action_save($view = null)
    {
        if (!empty($_POST['full_script_googleOptimize'])) {

            if (empty($_POST['google_analytics_tag']) && empty($_POST['full_script'])) {
                $return = array(
                    'error' => __('Vous devez renseigner le champ "Google Analytics Tag" avant de paramétrer Optimize.'),
                );

                return \Format::forge($return)->to_json();
            }

            if (empty($_POST['google_analytics_tag']) && !empty($_POST['full_script'])) {
                $return = array(
                    'error' =>  __('Vous devez ajouter manuellement le code ga(\'require\', \'GTM-xxxxxx\'); dans le champs Full script Google Analytics.'),
                );

                return \Format::forge($return)->to_json();
            }
        }

        return parent::action_save();
    }
}