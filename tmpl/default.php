<?php

// no direct access
/**
 * @module	RA Walks Filter
 * @author	Chris Vaughan
 * @website	http://ramblers-webs.org.uk/
 * @copyright	Copyright (C) 2013 Chris Vaughan webmaster@ramblers-webs.org.uk All rights reserved.
 * @license	http://www.gnu.org/licenses/gpl.html GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');
// Add a reference to a CSS file
// The default path is 'media/system/css/'

$filterhtml = file_get_contents("modules/mod_rawalkfilter/tmpl/filter.html");
echo $filterhtml;

$table = $params->get('Table');
$list = $params->get('List');
$map = $params->get('Map');
$select = false;
if ($table) {
    $select = true;
}
if ($list) {
    $select = true;
}
if ($map) {
    $select = true;
}

if ($select) {
   //echo "<select id=\"RA_Display_Format\" onchange=\"javascript:ra_format(event)\">";
    echo "<div id='raDisplayOptions'>";
    echo "<table><tr>";
    RaDisplayOption("Grade","OptionFull");
    if ($table) {
        RaDisplayOption("Table","OptionTable");
    }
    if ($list) {
         RaDisplayOption("List","OptionList");
    }
    if ($map) {
        RaDisplayOption("Map","OptionMap");
    }
      echo "</tr></table></div>";
}
 function RaDisplayOption($title,$value){
    
   // $link="<a onclick=\"javascript:ra_format('".$title."','".$value."')\">".$title."</a>";
    echo "<td id='".$value."' onclick=\"javascript:ra_format('".$title."','".$value."')\">".$title."</td>";
}


// end

