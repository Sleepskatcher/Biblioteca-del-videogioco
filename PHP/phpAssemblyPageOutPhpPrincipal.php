<?php

function assemblyPageOutPhpPrincipal(&$principalPage, &$outPage) {

    $principalPage = file_get_contents('../HTML/PrincipalPage2.html');
    $header = file_get_contents('../HTML/generalheader.html');
    $menu = file_get_contents('../HTML/generalmenu.html');
    $breadcrumb = file_get_contents('../HTML/Breadcrumb.html');
    $footer = file_get_contents('../HTML/generalfooter.html');

    assemblyHeader($header);
    $principalPage = str_replace('$HEADER$', $header, $principalPage);
    $principalPage = str_replace('$FOOTER$', $footer, $principalPage);
    assemblyMenu($menu);
    $principalPage = str_replace('$MENU$', $menu, $principalPage);
    assemblyBreadcrumb($breadcrumb);
    $principalPage = str_replace('$BREADCRUMB$', $breadcrumb, $principalPage);

    $principalPage = str_replace('$CENTRALBODY$', $outPage, $principalPage);

    $principalPage = str_replace('$LATERALSUBMENU$', '', $principalPage);

}

?>
