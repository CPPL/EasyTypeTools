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

    public static function buildFontAwesomeLink($params)
    {
        $link = self::fa_link($params);

        return $link;
    }

    private static function fa_link($params)
    {
        $version   = $params->get('version', 'latest');

        /**@PROBLOCK_START@**/
        if (self::pro) {
            $enable_fa = $params->get('enable_fa', 1);
            $cdn       = (bool)$params->get('source', true);
            $min       = JDEBUG ? '' : '.min';

            if ($enable_fa) {
                if($cdn) {
                    $fa_link = <<<facdnlink
https://maxcdn.bootstrapcdn.com/font-awesome/$version/css/font-awesome$min.css
facdnlink;
                } else {
                    $version = self::latest_version;
                    $fa_link = <<<falink
/media/plg_content_easytypetools/$version/font-awesome/css/font-awesome$min.css
falink;
                }
            } else {
                $fa_link = '';
            }
        } else {
            /**@PROBLOCK_END@**/

            $fa_link = <<<facdnlink
https://maxcdn.bootstrapcdn.com/font-awesome/$version/css/font-awesome.min.css
facdnlink;

            /**@PROBLOCK_START@**/
        }
        /**@PROBLOCK_END@**/

        return $fa_link;
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
