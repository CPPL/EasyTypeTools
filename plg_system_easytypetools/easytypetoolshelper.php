<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

/**
 *
 * @author Craig Phillips
 * @copyright Copyright © 2015 Craig Phillips Pty Ltd - All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE file
 *
 */
class EasyTypeToolsHelper
{
    /**@PROBLOCK_START@**/
    const pro = true;
    const latest_version = '4.4.0';
    /**@PROBLOCK_END@**/

    /**
     * Assemble our link to the Font Awesome resources
     *
     * @param Joomla\Registry\Registry $params
     *
     * @return string
     */
    public static function buildFontAwesomeLink($params)
    {
        $version = $params->get('version', 'latest');
        $enabled  = $params->get('enable_fa', 0);


        if ($enabled) {
        /**@PROBLOCK_START@**/
            if (self::pro) {
                $cdn = (bool)$params->get('source', true);
                $min = JDEBUG ? '' : '.min';
                    if ($cdn) {
                        $link = "https://maxcdn.bootstrapcdn.com/font-awesome/$version/css/font-awesome$min.css";
                    } else {
                        $version = $version == 'latest' ? self::latest_version : $version;
                        $link    = "/media/plg_content_easytypetools/font-awesome/$version/css/font-awesome$min.css";
                    }
            } else {
                /**@PROBLOCK_END@**/

                $link = "https://maxcdn.bootstrapcdn.com/font-awesome/$version/css/font-awesome.min.css";

                /**@PROBLOCK_START@**/
            }
        /**@PROBLOCK_END@**/
        } else {
            $link = '';
        }

        return $link;
    }

    /**
     * Assemble our link to the correct KDB element CSS
     *
     * @param Joomla\Registry\Registry $params
     *
     * @return string
     */
    public static function buildKBDLink($params) {
        $enabled    = (bool)$params->get('enable_kbd', 0);
        $bkgnd_css = $params->get('bkgnd_css', 'light');

        if ($enabled) {
            /**@PROBLOCK_START@**/
            if (self::pro) {
                $theme = $params->get('theme', '');
                $theme = empty($theme) ? '' : '_' . $theme;
                /** @todo Remove next line to renable themes $theme */
                $min = JDEBUG ? '' : '.min';

                if ($enabled) {
                    $link = "/media/plg_content_easytypetools/css/$bkgnd_css/keys$theme$min.css";
                } else {
                    $link = '';
                }

// @todo If theme is Droid add this Google CDN version of Roboto font.
// <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

            } else {
                /**@PROBLOCK_END@**/

                $link = "/media/plg_content_easytypetools/css/$bkgnd_css/keys.css";

                /**@PROBLOCK_START@**/
            }
            /**@PROBLOCK_END@**/
        } else {
            $link = '';
        }

        return $link;
    }

    /**
     * Load our array of links into the document head if:
     *  1. It's a HTML document
     *  2. The type is 'css' or 'js'
     *  3. It's an array of links passed in.
     *
     * @param  array    $links An array of CSS/JS links.
     * @param  string   $type  The type of the links in the $links array, either 'css' or 'js'
     *
     * @return null
     */
    public static function addLinksToDoc($links, $type = 'css')
    {
        if(is_array($links) || !in_array($type, array('css','js'))) {
            // Get current document and inject script
            $doc = JFactory::getDocument();

            foreach ($links as $link) {
                if (empty($link)) {
                    continue;
                }

                if ($type == 'js') {
                    $doc->addScript($link, "text/javascript");
                } elseif ($type == 'css') {
                    $doc->addStyleSheet($link, "text/css");
                }
            }
        }
    }

    /**
     * Simple bool check that we're not in backend.
     *
     * @return bool
     * @throws Exception
     */
    public static function allGood()
    {
        $app = JFactory::getApplication();
        $backEnd = $app->isAdmin();

        return !$backEnd;
    }

}
