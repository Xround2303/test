<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

foreach ($arResult as $section) {
    echo "-- " . $section["NAME"];
    foreach ($section["ELEMENTS"] as $element) {
        echo "-- " . $element["NAME"] . " (" . $element["TAGS"] . ")";
    }
}

?>