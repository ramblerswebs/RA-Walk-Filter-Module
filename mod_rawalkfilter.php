<?php

/**
 * @module	RA Header
 * @author	Chris Vaughan
 * @website	http://ramblers-webs.org.uk/
 * @copyright	Copyright (C) 2013 Chris Vaughan webmaster@ramblers-webs.org.uk All rights reserved.
 * @license	http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// no direct access
defined( "_JEXEC" ) or die( "Restricted access" );

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require(JModuleHelper::getLayoutPath('mod_rawalkfilter', $params->get('layout', 'default')));

