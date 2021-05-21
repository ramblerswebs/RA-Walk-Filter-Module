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

$colheaders = ["Col1Head", "Col2Head", "Col3Head", "Col4Head", "Col5Head", "Col6Head", "Col7Head", "Col8Head", "Col9Head"];
$colvalues = ["Col1", "Col2", "Col3", "Col4", "Col5", "Col6", "Col7", "Col8", "Col9"];

$position = $params->get('position');
if ($position == null) {
    $position = 'In Article, below tabs';
}
if ($position == 'In module' or $position == 1) {
    echo "<div id='js-walksFilterPos1' ></div>";
}
$default = $params->get('defaultOption');
$details = $params->get('Details');
$table = $params->get('Table');
$list = $params->get('List');
$map = $params->get('Map');
$leaders = $params->get('Leaders');
$diagnostics = $params->get('diagnostics');

$options = new stdClass();
$options->filterPosition = $position;
$options->defaultView = $default;
$options->detailsView = $details == "1";
$options->tableView = $table == "1";
$options->listView = $list == "1";
$options->mapView = $map == "1";
$options->contactsView = $leaders == "1";
$options->diagnostics = $diagnostics === "1";

$i = 0;
$items = [];
foreach ($colheaders as $colheader) {
    $header = $params->get($colheader);
    $colvalue = $colvalues[$i];
    //   $values = RaProcessItem($params->get($colvalue));
    $values = $params->get($colvalue);
    if ($header != "") {
        $item = new stdClass();
        $item->title = $header;
        $item->items = $values;
        $items[] = $item;
    }
    $i += 1;
}
if (count($items) > 0) {
    $options->tableFormat = $items;
} else {
    $options->tableFormat = null;
}
$options->detailsFormat = $params->get('DetailsFormat');
$options->listFormat = $params->get('ListFormat');

$out = "return'" . addslashes(json_encode($options)) . "';";
$document = JFactory::getDocument();
$document->addScriptDeclaration("  function addFilterFormats() {" . $out . "};", "text/javascript");
