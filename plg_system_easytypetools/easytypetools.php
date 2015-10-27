<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

/**
 *
 * @author Craig Phillips
 * @copyright Copyright © 2015 Craig Phillips Pty Ltd - All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE file
 *
 * This plugin is based off the CPPL Skeleton Plugin which you can find on GitHub to
 * build your own Joomla plugins. https://github.com/cppl/Skeleton-Plugin-for-Joomla
 *
 */

class plgContentEasyTypeTools extends JPlugin
{
    protected $trackAdmin;

    protected $website_GoSqr_Token;

    protected $enabledUserProperties;

    protected $weAreDoingIt;

    /**
     * @access      public
     * @param       object $subject The object to observe
     * @param       array $config An array that holds the plugin configuration
     */
    public function __construct(& $subject, $config)
    {
        parent::__construct($subject, $config);

        // Strictly speaking Joomla doesn't really need you to load the language anymore.
        $this->loadLanguage();

        // Load some settings
        $this->weAreDoingIt = $this->areWeDoingThis();
    }

    /**
     * Based on the events you want to act on (within a your plugins group) you will
     * need a matching method of a form similar to this one.
     *
     * Plugin Events can be found here: http://docs.joomla.org/Plugin/Events
     *
     * Please note this is not a real event method, it's just an example of the form they take
     */
    function onContentPrepare()
    {
        if ($this->weAreDoingIt) {
            // Build the CSS Links
            $links[] = EasyTypeToolsHelper::buildFontAwesomeLink($this->params);
            $links[] = EasyTypeToolsHelper::buildKBDLink($this->params);

            // Add CSS links to document
            EasyTypeToolsHelper::addLinksToDoc($links, 'css');

            // Only Do This once!
            $this->weAreDoingIt = false;
        }

        return true;
    }

    /**
     * A simple check to makes sure the plugin is installed correctly before
     * using the helper file functions (it also loads the helper file :))
     *
     * @return bool
     */
    private function areWeDoingThis() {
        // Check the installation
        $path_to_helper = JPATH_PLUGINS . '/system/easytypetools/easytypetoolshelper.php';

        if (file_exists($path_to_helper)) {
            // Yes! Now lets get the helper
            require_once $path_to_helper;

            if (class_exists('EasyTypeToolsHelper') && EasyTypeToolsHelper::allGood()) {
                // Looks like the real helper, so we're good to go...
                return true;
            }
        }

        // Ok if we got here something went wrong.
        return false;
    }
}

