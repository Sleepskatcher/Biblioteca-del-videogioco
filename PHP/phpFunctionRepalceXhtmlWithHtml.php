<?php

function replaceXhtmlWithHtml(&$page) {

    while(strpos($page, 'xml:lang')) {

        $page = str_replace('xml:lang', 'lang', $page);

    }

}

?>
