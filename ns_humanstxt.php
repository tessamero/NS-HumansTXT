<?php
/**
* @version		v3.0
* @package		Joomla!®
* @copyright	Copyright © 2011 Natural Selection Web Design LLC.
* @support      http://nsel.co
* @license		GNU/GPL, see license.txt
*/

// no direct access
defined('_JEXEC') or die;

jimport('joomla.plugin.plugin');

class plgSystemns_humanstxt extends JPlugin {
	/**
	 * Constructor.
	 */
	function plgSystemns_humanstxt(&$subject, $config) {
		parent::__construct($subject, $config);
	}

	/**
	 * onAfterRoute hook.
	 */
	function onAfterRoute() {
		$app = &JFactory::getApplication();
		
		if ($app->isSite()) {
			// check if humans.txt exists
			jimport('joomla.filesystem.file');
			
			if (!JFile::exists(JPATH_ROOT.DS.'humans.txt')) {
				JFile::copy(JPATH_PLUGINS.'/system/ns_humanstxt/humans.txt', JPATH_ROOT.'/humans.txt');
			}
			
			$document	= JFactory::getDocument();
			$live_site	= JURI::base();
			$tag		= '<link type="text/plain" rel="author" href="' . $live_site . 'humans.txt" />';
			
			$document->addCustomTag($tag);
		}
	}
}