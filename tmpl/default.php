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
$colheaders = ["Col1Head", "Col2Head", "Col3Head", "Col4Head", "Col5Head", "Col6Head", "Col7Head", "Col8Head", "Col9Head"];
$colvalues = ["Col1", "Col2", "Col3", "Col4", "Col5", "Col6", "Col7", "Col8", "Col9"];

$filterhtml = file_get_contents("modules/mod_rawalkfilter/tmpl/filter.html");
echo $filterhtml;

$default = $params->get('defaultOption');
$grades = $params->get('Grades');
$table = $params->get('Table');
$list = $params->get('List');
$map = $params->get('Map');
$leaders = $params->get('Leaders');
$select = false;
if ($grades) {
    $select = true;
}
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
    echo "<div id='raDisplayOptions'>";
    echo "<table><tr>";
    if ($grades) {
        RaDisplayOption("Grades", "OptionGrades");
    }
    if ($table) {
        RaDisplayOption("Table", "OptionTable");
    }
    if ($list) {
        RaDisplayOption("List", "OptionList");
    }
    if ($map) {
        RaDisplayOption("Map", "OptionMap");
    }
    if ($leaders) {
        RaDisplayOption("Contacts", "OptionContacts");
    }
    echo "</tr></table></div>";
}
$i = 0;
$items = [];
foreach ($colheaders as $colheader) {
    $header = $params->get($colheader);
    $colvalue = $colvalues[$i];
    $values = RaProcessItem($params->get($colvalue));
    if ($header != "") {
        $item = new ra_item;
        $item->title = $header;
        $item->items = $values;
        $items[] = $item;
    }
    $i+=1;
}
$out = "";
$out.="ramblerswalksDetails.displayDefault='".$default."';";
if (count($items) > 0) {
    $out.= "ramblerswalksDetails.tableFormat='" . addslashes(json_encode($items)) . "';";
}

$list = $params->get('ListFormat');

if (!empty($list)) {
    $items = RaProcessItem($list);
    $out.= "ramblerswalksDetails.listFormat='" . addslashes(json_encode($items)) . "';";
}
$document = JFactory::getDocument();
$document->addScriptDeclaration("  function addFilterFormats() {" . $out . "};", "text/javascript");

function RaDisplayOption($title, $value) {
    echo "<td id='" . $value . "' onclick=\"javascript:ra_format('" . $value . "')\">" . $title . "</td>";
}

function RaProcessItem($value) {
    $items = [];
    $item = "";
    $array = str_split($value);
    $inBracket = false;
    foreach ($array as $char) {
        switch ($char):
            case "{":
                if ($item != "") {
                    $items[] = $item;
                }
                $item.=$char;
                $inBracket = true;
                break;
            case "}":
                If ($inBracket) {
                    $item.=$char;
                    $items[] = $item;
                    $item = "";
                } else {
                    $item.=$char;
                }
                break;
            default:
                $item.=$char;
        endswitch;
    }

    return $items;
}

class ra_item {

    public $title = "";
    public $items = [];

}

// end