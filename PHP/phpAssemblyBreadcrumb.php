<?php

function assemblyBreadcrumb(&$breadcrumb) {

    if(isset($_GET["menu"]) && ((isset($_SESSION["username"]) && $_SESSION["username"] != 'admin' && ($_GET["menu"] == 'elencoprenotazionitot' || $_GET["menu"] == 'inserimentovid' || $_GET["menu"] == 'modifica')) || (!isset($_SESSION["username"]) && ($_GET["menu"] == 'elencoprenotazionitot' || $_GET["menu"] == 'inserimentovid' || $_GET["menu"] == 'prenotazioni')))) {

        $breadcrumb = '';

    } else {

        //assemblo SEMPRE e SOLO homepage
        if(!isset($_GET["menu"]) && !isset($_GET["console"]) && !isset($_GET["search"]) && empty($_GET)) {

            $breadcrumb = str_replace('$BREADHOMEPAGE$', 'Sei qui: <span xml:lang="en" lang="en">Home</span> ', $breadcrumb);
            $breadcrumb = str_replace('$BREADMENU$', '', $breadcrumb);
            $breadcrumb = str_replace('$BREADCATALOGOSUBMENU$', '', $breadcrumb);
            $breadcrumb = str_replace('$BREADCATATLOGOCONSOLE$', '', $breadcrumb);
            $breadcrumb = str_replace('$BREADCATALOGOSUBMENUVIDEOGIOCO$', '', $breadcrumb);

            //qui sotto assemblo gli altri menu semplici: chisiamo, dovesiamo, comefunzionanoleggio, inserisciVideogame
        } elseif(isset($_GET["menu"]) && $_GET["menu"] != 'elencoprenotazionitot' && $_GET["menu"] != 'prenotazioni' && ($_GET["menu"] == 'catalogo' || $_GET["menu"] == 'chisiamo' || $_GET["menu"] == 'comefunzionanoleggio' || $_GET["menu"] == 'inserimentovid') && !isset($_GET["console"]) && !isset($_GET["search"]) && count($_GET) < 2) {

            $breadcrumb = str_replace('$BREADHOMEPAGE$', 'Sei qui: <a title="Link alla home" href="phpPrincipal.php" tabindex="10"><span xml:lang="en" lang="en">Home</span></a> ', $breadcrumb);

            if($_GET["menu"] == 'catalogo') {

                if(!isset($_SESSION["username"]) || (isset($_SESSION["username"]) && $_SESSION["username"] != 'admin')) $breadcrumb = str_replace('$BREADMENU$', '>> Catalogo ', $breadcrumb);
                else $breadcrumb = str_replace('$BREADMENU$', '>> Modifica/Elimina videogioco ', $breadcrumb);

            } elseif($_GET["menu"] == 'chisiamo') {

                $breadcrumb = str_replace('$BREADMENU$', '>> Chi siamo ', $breadcrumb);

            } elseif($_GET["menu"] == 'comefunzionanoleggio') {

                $breadcrumb = str_replace('$BREADMENU$', '>> Come funziona il noleggio ', $breadcrumb);

            } elseif(isset($_SESSION["username"]) && $_SESSION["username"] == 'admin' && $_GET["menu"] == 'inserimentovid') {

                $breadcrumb = str_replace('$BREADMENU$', '>> Inserimento videogioco ', $breadcrumb);

            } else {

                $breadcrumb = '';

            }

            $breadcrumb = str_replace('$BREADCATALOGOSUBMENU$', '', $breadcrumb);
            $breadcrumb = str_replace('$BREADCATATLOGOCONSOLE$', '', $breadcrumb);
            $breadcrumb = str_replace('$BREADCATALOGOSUBMENUVIDEOGIOCO$', '', $breadcrumb);

            //qui sotto gestisco catalogo console quindi quando ho selezionato una console
        } elseif((isset($_GET["menu"]) && $_GET["menu"] == 'catalogo' && isset($_GET["console"]) && ($_GET["console"] == 'microsoft' || $_GET["console"] == 'nintendo' || $_GET["console"] == 'sony') && !isset($_GET["search"]) && isset($_GET["start"]) && isset($_GET["finish"]) && count($_GET) < 5) || (isset($_GET["menu"]) && $_GET["menu"] == 'catalogo' && isset($_GET["console"]) && ($_GET["console"] == 'microsoft' || $_GET["console"] == 'nintendo' || $_GET["console"] == 'sony') && !isset($_GET["search"]) && isset($_GET["start"]) && isset($_GET["finish"]) && ((isset($_GET["radioXbox"]) && ($_GET["radioXbox"] == 'Xbox360' || $_GET["radioXbox"] == 'XboxOne')) || (isset($_GET["radioNintendo"]) && ($_GET["radioNintendo"] == 'Wii' || $_GET["radioNintendo"] == 'WiiU' || $_GET["radioNintendo"] == 'Switch')) || (isset($_GET["radioSony"]) && ($_GET["radioSony"] == 'PlayStation3' || $_GET["radioSony"] == 'PlayStation4'))) && count($_GET) < 6)) {

            if(isset($_GET["menu"]) && $_GET["menu"] == 'catalogo' && isset($_GET["console"]) && ($_GET["console"] == 'microsoft' || $_GET["console"] == 'nintendo' || $_GET["console"] == 'sony') && !isset($_GET["search"]) && isset($_GET["start"]) && isset($_GET["finish"]) && count($_GET) < 5) {

                $breadcrumb = str_replace('$BREADHOMEPAGE$', 'Sei qui: <a title="Link alla home" href="phpPrincipal.php" tabindex="11"><span xml:lang="en" lang="en">Home</span></a> ', $breadcrumb);

                if(!isset($_SESSION["username"]) || (isset($_SESSION["username"]) && $_SESSION["username"] != 'admin')) $breadcrumb = str_replace('$BREADMENU$', '>> <a title="Link al catalogo" href="phpPrincipal.php?menu=catalogo" tabindex="12">Catalogo</a> ', $breadcrumb);
                else $breadcrumb = str_replace('$BREADMENU$', '>> <a title="Link al Modifica e Elimina videogioco" href="phpPrincipal.php?menu=catalogo" tabindex="12">Modifica/Elimina videogioco</a> ', $breadcrumb);

                if($_GET["console"] == 'microsoft') {

                    $breadcrumb = str_replace('$BREADCATALOGOSUBMENU$', '>> <span xml:lang="en" lang="en">Microsoft</span> ', $breadcrumb);

                } elseif($_GET["console"] == 'nintendo') {

                    $breadcrumb = str_replace('$BREADCATALOGOSUBMENU$', '>> Nintendo ', $breadcrumb);

                } elseif($_GET["console"] == 'sony') {

                    $breadcrumb = str_replace('$BREADCATALOGOSUBMENU$', '>> <span xml:lang="en" lang="en">Sony</span> ', $breadcrumb);

                } else {

                    $breadcrumb;

                }
                $breadcrumb = str_replace('$BREADCATATLOGOCONSOLE$', '', $breadcrumb);
                $breadcrumb = str_replace('$BREADCATALOGOSUBMENUVIDEOGIOCO$', '', $breadcrumb);

            } elseif(isset($_GET["menu"]) && $_GET["menu"] == 'catalogo' && isset($_GET["console"]) && ($_GET["console"] == 'microsoft' || $_GET["console"] == 'nintendo' || $_GET["console"] == 'sony') && !isset($_GET["search"]) && isset($_GET["start"]) && isset($_GET["finish"]) && ((isset($_GET["radioXbox"]) && ($_GET["radioXbox"] == 'Xbox360' || $_GET["radioXbox"] == 'XboxOne')) || (isset($_GET["radioNintendo"]) && ($_GET["radioNintendo"] == 'Wii' || $_GET["radioNintendo"] == 'WiiU' || $_GET["radioNintendo"] == 'Switch')) || (isset($_GET["radioSony"]) && ($_GET["radioSony"] == 'PlayStation3' || $_GET["radioSony"] == 'PlayStation4'))) && count($_GET) < 6) {

                $breadcrumb = str_replace('$BREADHOMEPAGE$', 'Sei qui: <a title="Link alla home" href="phpPrincipal.php" tabindex="11"><span xml:lang="en" lang="en">Home</span></a> ', $breadcrumb);

                if(!isset($_SESSION["username"]) || (isset($_SESSION["username"]) && $_SESSION["username"] != 'admin')) $breadcrumb = str_replace('$BREADMENU$', '>> <a title="Link al catalogo" href="phpPrincipal.php?menu=catalogo" tabindex="12">Catalogo</a> ', $breadcrumb);
                else $breadcrumb = str_replace('$BREADMENU$', '>> <a title="Link al Modifica e Elimina videogioco" href="phpPrincipal.php?menu=catalogo" tabindex="12">Modifica/Elimina videogioco</a> ', $breadcrumb);

                if($_GET["console"] == 'microsoft') {

                    $breadcrumb = str_replace('$BREADCATALOGOSUBMENU$', '>> <a title="Link al catalogo Microsoft" href="phpPrincipal.php?menu=catalogo&amp;console=microsoft&amp;start=0&amp;finish=20" tabindex="13"><span xml:lang="en" lang="en">Microsoft</span></a> ', $breadcrumb);

                } elseif($_GET["console"] == 'nintendo') {

                    $breadcrumb = str_replace('$BREADCATALOGOSUBMENU$', '>> <a title="Link al catalogo Nintendo" href="phpPrincipal.php?menu=catalogo&amp;console=nintendo&amp;start=0&amp;finish=20" tabindex="13">Nintendo</a> ', $breadcrumb);

                } elseif($_GET["console"] == 'sony') {

                    $breadcrumb = str_replace('$BREADCATALOGOSUBMENU$', '>> <a title="Link al catalogo Sony" href="phpPrincipal.php?menu=catalogo&amp;console=sony&amp;start=0&amp;finish=20" tabindex="13"><span xml:lang="en" lang="en">Sony</span></a> ', $breadcrumb);

                } else {

                    $breadcrumb = '';

                }

                if(isset($_GET["radioXbox"])) {

                    if($_GET["radioXbox"] == 'Xbox360') {

                        $breadcrumb = str_replace('$BREADCATATLOGOCONSOLE$', '>> <span xml:lang="en" lang="en">Xbox</span> 360 ', $breadcrumb);

                    } elseif($_GET["radioXbox"] == 'XboxOne') {

                        $breadcrumb = str_replace('$BREADCATATLOGOCONSOLE$', '>> <span xml:lang="en" lang="en">Xbox One</span> ', $breadcrumb);

                    } else {

                        $breadcrumb = '';

                    }

                } elseif(isset($_GET["radioNintendo"])) {

                    if($_GET["radioNintendo"] == 'Wii') {

                        $breadcrumb = str_replace('$BREADCATATLOGOCONSOLE$', '>> <span xml:lang="en" lang="en">Wii</span> ', $breadcrumb);

                    } elseif($_GET["radioNintendo"] == 'WiiU') {

                        $breadcrumb = str_replace('$BREADCATATLOGOCONSOLE$', '>> <span xml:lang="en" lang="en">Wii U</span> ', $breadcrumb);

                    } elseif($_GET["radioNintendo"] == 'Switch') {

                        $breadcrumb = str_replace('$BREADCATATLOGOCONSOLE$', '>> <span xml:lang="en" lang="en">Switch</span> ', $breadcrumb);

                    } else {

                        $breadcrumb = '';

                    }

                } elseif(isset($_GET["radioSony"])) {

                    if($_GET["radioSony"] == 'PlayStation3') {

                        $breadcrumb = str_replace('$BREADCATATLOGOCONSOLE$', '>> <span xml:lang="en" lang="en">PlayStation</span> 3 ', $breadcrumb);

                    } elseif($_GET["radioSony"] == 'PlayStation4') {

                        $breadcrumb = str_replace('$BREADCATATLOGOCONSOLE$', '>> <span xml:lang="en" lang="en">PlayStation</span> 4 ', $breadcrumb);

                    } else {

                        $breadcrumb = '';

                    }

                } else {

                    $breadcrumb = '';

                }

                $breadcrumb = str_replace('$BREADCATALOGOSUBMENUVIDEOGIOCO$', '', $breadcrumb);

            } else {

                $breadcrumb;

            }

            //qui sotto assemblo il menu elencoprenotazionitot solo per l'admin e quindi lo tengo diviso
        } elseif((isset($_GET["menu"]) && $_GET["menu"] == 'elencoprenotazionitot' && !isset($_GET["console"]) &&  !isset($_GET["search"]) && isset($_GET["startpr"]) && isset($_GET["finishpr"]) && count($_GET) < 4) || (isset($_GET["menu"]) && $_GET["menu"] == 'elencoprenotazionitot' && !isset($_GET["console"]) &&  !isset($_GET["search"]) && isset($_GET["startpr"]) && isset($_GET["finishpr"]) && isset($_GET["deletePr"]) && ($_GET["deletePr"] == 'yes' || $_GET["deletePr"] == 'no') && count($_GET) < 5)) {

            if(isset($_SESSION["username"]) && $_SESSION["username"] == 'admin') {

                $breadcrumb = str_replace('$BREADHOMEPAGE$', 'Sei qui: <a title="Link alla home" href="phpPrincipal.php" tabindex="11"><span xml:lang="en" lang="en">Home</span></a> ', $breadcrumb);
                $breadcrumb = str_replace('$BREADMENU$', '>> Elenco prenotazioni ', $breadcrumb);
                $breadcrumb = str_replace('$BREADCATALOGOSUBMENU$', '', $breadcrumb);
                $breadcrumb = str_replace('$BREADCATATLOGOCONSOLE$', '', $breadcrumb);
                $breadcrumb = str_replace('$BREADCATALOGOSUBMENUVIDEOGIOCO$', '', $breadcrumb);

            } else {

                $breadcrumb = '';

            }

            //qui sotto assemblo il menu prenotazione sia per l'username che per l'admin
        } elseif((isset($_GET["menu"]) && $_GET["menu"] == 'prenotazioni' && !isset($_GET["console"]) && !isset($_GET["search"]) && isset($_GET["pstart"]) && isset($_GET["pfinish"]) && isset($_GET["fromVideogame"]) && ($_GET["fromVideogame"] == 'yes' || $_GET["fromVideogame"] == 'no') && count($_GET) < 5) || (isset($_GET["menu"]) && $_GET["menu"] == 'prenotazioni' && !isset($_GET["console"]) && !isset($_GET["search"]) && isset($_GET["pstart"]) && isset($_GET["pfinish"]) && isset($_GET["fromVideogame"]) && ($_GET["fromVideogame"] == 'yes' || $_GET["fromVideogame"] == 'no') && isset($_GET["deletePr"]) && ($_GET["deletePr"] == 'yes' || $_GET["deletePr"] == 'no') && count($_GET) < 6) || (isset($_GET["menu"]) && $_GET["menu"] == 'prenotazioni' && !isset($_GET["console"]) && !isset($_GET["search"]) && isset($_GET["tipeOfConsole"]) && ($_GET["tipeOfConsole"] == 'Xbox360' || $_GET["tipeOfConsole"] == 'XboxOne' || $_GET["tipeOfConsole"] == 'Wii' || $_GET["tipeOfConsole"] == 'WiiU' || $_GET["tipeOfConsole"] == 'Switch' || $_GET["tipeOfConsole"] == 'PlayStation3' || $_GET["tipeOfConsole"] == 'PlayStation4') && isset($_GET["fromVideogame"]) && ($_GET["fromVideogame"] == 'yes' || $_GET["fromVideogame"] == 'no') && isset($_GET["pstart"]) && isset($_GET["pfinish"]) && count($_GET) < 7) || (isset($_GET["menu"]) && $_GET["menu"] == 'prenotazioni' && !isset($_GET["console"]) && !isset($_GET["search"]) && isset($_GET["tipeOfConsole"]) && ($_GET["tipeOfConsole"] == 'Xbox360' || $_GET["tipeOfConsole"] == 'XboxOne' || $_GET["tipeOfConsole"] == 'Wii' || $_GET["tipeOfConsole"] == 'WiiU' || $_GET["tipeOfConsole"] == 'Switch' || $_GET["tipeOfConsole"] == 'PlayStation3' || $_GET["tipeOfConsole"] == 'PlayStation4') && isset($_GET["fromVideogame"]) && ($_GET["fromVideogame"] == 'yes' || $_GET["fromVideogame"] == 'no') && isset($_GET["pstart"]) && isset($_GET["pfinish"]) && isset($_GET["deletePr"]) && ($_GET["deletePr"] == 'yes' || $_GET["deletePr"] == 'no') && count($_GET) < 8)) {

            if(isset($_SESSION["username"])) {

                $breadcrumb = str_replace('$BREADHOMEPAGE$', 'Sei qui: <a title="Link alla home" href="phpPrincipal.php" tabindex="9"><span xml:lang="en" lang="en">Home</span></a> ', $breadcrumb);
                $breadcrumb = str_replace('$BREADMENU$', '>> Prenotazioni ', $breadcrumb);
                $breadcrumb = str_replace('$BREADCATALOGOSUBMENU$', '', $breadcrumb);
                $breadcrumb = str_replace('$BREADCATATLOGOCONSOLE$', '', $breadcrumb);
                $breadcrumb = str_replace('$BREADCATALOGOSUBMENUVIDEOGIOCO$', '', $breadcrumb);

            } else {

                $breadcrumb = '';

            }

            //qui sotto assemblo videogioco che sono più casi ma che bisogna settare per forza di cose in quanto ci devono essere tutti i contolli
        } elseif((!isset($_GET["menu"]) && !isset($_GET["console"]) && !isset($_GET["search"]) && isset($_GET["tipeOfConsole"]) && isset($_GET["code"]) && count($_GET) < 3) || (isset($_GET["menu"]) && $_GET["menu"] == 'catalogo' && isset($_GET["console"]) && ($_GET["console"] == 'microsoft' || $_GET["console"] == 'nintendo' || $_GET["console"] == 'sony') && !isset($_GET["search"]) && isset($_GET["tipeOfConsole"]) && isset($_GET["code"]) && count($_GET) < 5) || (isset($_GET["menu"]) && $_GET["menu"] == 'catalogo' && isset($_GET["console"]) && ($_GET["console"] == 'microsoft' || $_GET["console"] == 'nintendo' || $_GET["console"] == 'sony') && !isset($_GET["search"]) && isset($_GET["tipeOfConsole"]) && isset($_GET["code"]) && ((isset($_GET["radioXbox"]) && ($_GET["radioXbox"] == 'Xbox360' || $_GET["radioXbox"] == 'XboxOne')) || (isset($_GET["radioNintendo"]) && ($_GET["radioNintendo"] == 'Wii' || $_GET["radioNintendo"] == 'WiiU' || $_GET["radioNintendo"] == 'Switch')) || (isset($_GET["radioSony"]) && ($_GET["radioSony"] == 'PlayStation3' || $_GET["radioSony"] == 'PlayStation4'))) && count($_GET) < 6) || (!isset($_GET["menu"]) && !isset($_GET["console"]) && isset($_GET["search"]) && isset($_GET["tipeOfConsole"]) && isset($_GET["code"]) && count($_GET) < 4)) {

            if(!isset($_GET["menu"]) && !isset($_GET["console"]) && !isset($_GET["search"]) && isset($_GET["tipeOfConsole"]) && isset($_GET["code"]) && count($_GET) < 3) {

                $breadcrumb = str_replace('$BREADHOMEPAGE$', 'Sei qui: <a title="Link alla home" href="phpPrincipal.php" tabindex="11"><span xml:lang="en" lang="en">Home</span></a> ', $breadcrumb);
                $breadcrumb = str_replace('$BREADMENU$', '>> Videogioco ', $breadcrumb);
                $breadcrumb = str_replace('$BREADCATALOGOSUBMENU$', '', $breadcrumb);
                $breadcrumb = str_replace('$BREADCATATLOGOCONSOLE$', '', $breadcrumb);
                $breadcrumb = str_replace('$BREADCATALOGOSUBMENUVIDEOGIOCO$', '', $breadcrumb);

            } elseif(isset($_GET["menu"]) && $_GET["menu"] == 'catalogo' && isset($_GET["console"]) && ($_GET["console"] == 'microsoft' || $_GET["console"] == 'nintendo' || $_GET["console"] == 'sony') && !isset($_GET["search"]) && isset($_GET["tipeOfConsole"]) && isset($_GET["code"]) && count($_GET) < 5) {

                $breadcrumb = str_replace('$BREADHOMEPAGE$', 'Sei qui: <a title="Link alla home" href="phpPrincipal.php" tabindex="11"><span xml:lang="en" lang="en">Home</span></a> ', $breadcrumb);

                if(!isset($_SESSION["username"]) || (isset($_SESSION["username"]) && $_SESSION["username"] != 'admin')) $breadcrumb = str_replace('$BREADMENU$', '>> <a title="Link al catalogo" href="phpPrincipal.php?menu=catalogo" tabindex="12">Catalogo</a> ', $breadcrumb);
                else $breadcrumb = str_replace('$BREADMENU$', '>> <a title="Link al Modifica e Elimina videogioco" href="phpPrincipal.php?menu=catalogo" tabindex="12">Modifica/Elimina videogioco</a> ', $breadcrumb);

                if($_GET["console"] == 'microsoft') {

                    $breadcrumb = str_replace('$BREADCATALOGOSUBMENU$', '>> <a title="Link al catalogo Microsoft" href="phpPrincipal.php?menu=catalogo&amp;console=microsoft&amp;start=0&amp;finish=20" tabindex="13"><span xml:lang="en" lang="en">Microsoft</span></a> ', $breadcrumb);

                } elseif($_GET["console"] == 'nintendo') {

                    $breadcrumb = str_replace('$BREADCATALOGOSUBMENU$', '>> <a title="Link al catalogo Nintendo" href="phpPrincipal.php?menu=catalogo&amp;console=nintendo&amp;start=0&amp;finish=20" tabindex="13">Nintendo</a> ', $breadcrumb);

                } elseif($_GET["console"] == 'sony') {

                    $breadcrumb = str_replace('$BREADCATALOGOSUBMENU$', '>> <a title="Link al catalogo Sony" href="phpPrincipal.php?menu=catalogo&amp;console=sony&amp;start=0&amp;finish=20" tabindex="13"><span xml:lang="en" lang="en">Sony</span></a> ', $breadcrumb);

                } else {

                    $breadcrumb;

                }
                $breadcrumb = str_replace('$BREADCATATLOGOCONSOLE$', '', $breadcrumb);
                $breadcrumb = str_replace('$BREADCATALOGOSUBMENUVIDEOGIOCO$', '>> Videogioco ', $breadcrumb);


            } elseif(isset($_GET["menu"]) && $_GET["menu"] == 'catalogo' && isset($_GET["console"]) && ($_GET["console"] == 'microsoft' || $_GET["console"] == 'nintendo' || $_GET["console"] == 'sony') && !isset($_GET["search"]) && isset($_GET["tipeOfConsole"]) && isset($_GET["code"]) && ((isset($_GET["radioXbox"]) && ($_GET["radioXbox"] == 'Xbox360' || $_GET["radioXbox"] == 'XboxOne')) || (isset($_GET["radioNintendo"]) && ($_GET["radioNintendo"] == 'Wii' || $_GET["radioNintendo"] == 'WiiU' || $_GET["radioNintendo"] == 'Switch')) || (isset($_GET["radioSony"]) && ($_GET["radioSony"] == 'PlayStation3' || $_GET["radioSony"] == 'PlayStation4'))) && count($_GET) < 6) {

                $breadcrumb = str_replace('$BREADHOMEPAGE$', 'Sei qui: <a title="Link alla home" href="phpPrincipal.php" tabindex="11"><span xml:lang="en" lang="en">Home</span></a> ', $breadcrumb);

                if(!isset($_SESSION["username"]) || (isset($_SESSION["username"]) && $_SESSION["username"] != 'admin')) $breadcrumb = str_replace('$BREADMENU$', '>> <a title="Link al catalogo" href="phpPrincipal.php?menu=catalogo" tabindex="12">Catalogo</a> ', $breadcrumb);
                else $breadcrumb = str_replace('$BREADMENU$', '>> <a title="Link al Modifica e Elimina videogioco" href="phpPrincipal.php?menu=catalogo" tabindex="12">Modifica/Elimina videogioco</a> ', $breadcrumb);

                if($_GET["console"] == 'microsoft') {

                    $breadcrumb = str_replace('$BREADCATALOGOSUBMENU$', '>> <a title="Link al catalogo Microsoft" href="phpPrincipal.php?menu=catalogo&amp;console=microsoft&amp;start=0&amp;finish=20" tabindex="13"><span xml:lang="en" lang="en">Microsoft</span></a> ', $breadcrumb);

                } elseif($_GET["console"] == 'nintendo') {

                    $breadcrumb = str_replace('$BREADCATALOGOSUBMENU$', '>> <a title="Link al catalogo Nintendo" href="phpPrincipal.php?menu=catalogo&amp;console=nintendo&amp;start=0&amp;finish=20" tabindex="13">Nintendo</a> ', $breadcrumb);

                } elseif($_GET["console"] == 'sony') {

                    $breadcrumb = str_replace('$BREADCATALOGOSUBMENU$', '>> <a title="Link al catalogo Sony" href="phpPrincipal.php?menu=catalogo&amp;console=sony&amp;start=0&amp;finish=20" tabindex="13"><span xml:lang="en" lang="en">Sony</span></a> ', $breadcrumb);

                } else {

                    $breadcrumb = '';

                }

                if(isset($_GET["radioXbox"])) {

                    if($_GET["radioXbox"] == 'Xbox360') {

                        $breadcrumb = str_replace('$BREADCATATLOGOCONSOLE$', '>> <a title="Link pagina iniziale catalogo Xbox 360" href="phpPrincipal.php?menu=catalogo&amp;console=microsoft&amp;start=0&amp;finish=20&amp;radioXbox=Xbox360" tabindex="14"><span xml:lang="en" lang="en">Xbox</span> 360</a> ', $breadcrumb);

                    } elseif($_GET["radioXbox"] == 'XboxOne') {

                        $breadcrumb = str_replace('$BREADCATATLOGOCONSOLE$', '>> <a title="Link pagina iniziale catalogo Xbox One" href="phpPrincipal.php?menu=catalogo&amp;console=microsoft&amp;start=0&amp;finish=20&amp;radioXbox=XboxOne" tabindex="14"><span xml:lang="en" lang="en">Xbox One</span></a> ', $breadcrumb);

                    } else {

                        $breadcrumb = '';

                    }

                } elseif(isset($_GET["radioNintendo"])) {

                    if($_GET["radioNintendo"] == 'Wii') {

                        $breadcrumb = str_replace('$BREADCATATLOGOCONSOLE$', '>> <a title="Link pagina iniziale catalogo Wii" href="phpPrincipal.php?menu=catalogo&amp;console=nintendo&amp;start=0&amp;finish=20&amp;radioNintendo=Wii"  tabindex="14"><span xml:lang="en" lang="en">Wii</span></a> ', $breadcrumb);

                    } elseif($_GET["radioNintendo"] == 'WiiU') {

                        $breadcrumb = str_replace('$BREADCATATLOGOCONSOLE$', '>> <a title="Link pagina iniziale catalogo Wii U" href="phpPrincipal.php?menu=catalogo&amp;console=nintendo&amp;start=0&amp;finish=20&amp;radioNintendo=WiiU" tabindex="14"><span xml:lang="en" lang="en">Wii U</span></a> ', $breadcrumb);

                    } elseif($_GET["radioNintendo"] == 'Switch') {

                        $breadcrumb = str_replace('$BREADCATATLOGOCONSOLE$', '>> <a title="Link pagina iniziale catalogo Switch" href="phpPrincipal.php?menu=catalogo&amp;console=nintendo&amp;start=0&amp;finish=20&amp;radioNintendo=Switch" tabindex="14"><span xml:lang="en" lang="en">Switch</span></a> ', $breadcrumb);

                    } else {

                        $breadcrumb = '';

                    }

                } elseif(isset($_GET["radioSony"])) {

                    if($_GET["radioSony"] == 'PlayStation3') {

                        $breadcrumb = str_replace('$BREADCATATLOGOCONSOLE$', '>> <a title="Link pagina iniziale catalogo PlayStation 3" href="phpPrincipal.php?menu=catalogo&amp;console=sony&amp;start=0&amp;finish=20&amp;radioSony=PlayStation3" tabindex="14"><span xml:lang="en" lang="en">PlayStation</span> 3</a> ', $breadcrumb);

                    } elseif($_GET["radioSony"] == 'PlayStation4') {

                        $breadcrumb = str_replace('$BREADCATATLOGOCONSOLE$', '>> <a title="Link pagina iniziale catalogo PlayStation 4" href="phpPrincipal.php?menu=catalogo&amp;console=sony&amp;start=0&amp;finish=20&amp;radioSony=PlayStation4" tabindex="14"><span xml:lang="en" lang="en">PlayStation</span> 4</a> ', $breadcrumb);

                    } else {

                        $breadcrumb = '';

                    }

                } else {

                    $breadcrumb = '';

                }

                $breadcrumb = str_replace('$BREADCATALOGOSUBMENUVIDEOGIOCO$', '>> Videogioco ', $breadcrumb);

            } elseif(!isset($_GET["menu"]) && !isset($_GET["console"]) && isset($_GET["search"]) && isset($_GET["tipeOfConsole"]) && isset($_GET["code"]) && count($_GET) < 4) {

                $breadcrumb = str_replace('$BREADHOMEPAGE$', 'Sei qui: <a title="Link alla home" href="phpPrincipal.php" tabindex="11"><span xml:lang="en" lang="en">Home</span></a> ', $breadcrumb);
                $breadcrumb = str_replace('$BREADMENU$', '>> <a title="Link alla ricerca effettuata" href="phpPrincipal.php?searchstart=0&amp;searchfinish=20&amp;search=' . $_GET["search"] . '" tabindex="12">Ricerca</a> ', $breadcrumb);
                $breadcrumb = str_replace('$BREADCATALOGOSUBMENU$', '>> Videogioco ', $breadcrumb);
                $breadcrumb = str_replace('$BREADCATATLOGOCONSOLE$', '', $breadcrumb);
                $breadcrumb = str_replace('$BREADCATALOGOSUBMENUVIDEOGIOCO$', '', $breadcrumb);

            } else {

                $breadcrumb = '';

            }

            //qui assemblo la ricerca prenotazioni, caso solo admin
        } elseif((isset($_GET["menu"]) && $_GET["menu"] == 'elencoprenotazionitot' && !isset($_GET["console"]) && isset($_GET["search"]) && isset($_GET["searchstart"]) && isset($_GET["searchfinish"]) && count($_GET) < 5) || (isset($_GET["menu"]) && $_GET["menu"] == 'elencoprenotazionitot' && !isset($_GET["console"]) && isset($_GET["search"]) && isset($_GET["searchstart"]) && isset($_GET["searchfinish"]) && isset($_GET["deletePr"]) && ($_GET["deletePr"] == 'yes' || $_GET["deletePr"] == 'no') && count($_GET) < 6)) {

            if(isset($_SESSION["username"]) && $_SESSION["username"] == 'admin') {

                $breadcrumb = str_replace('$BREADHOMEPAGE$', 'Sei qui: <a title="Link alla home" href="phpPrincipal.php" tabindex="11"><span xml:lang="en" lang="en">Home</span></a> ', $breadcrumb);
                $breadcrumb = str_replace('$BREADMENU$', '>> Elenco prenotazioni ', $breadcrumb);
                $breadcrumb = str_replace('$BREADCATALOGOSUBMENU$', '', $breadcrumb);
                $breadcrumb = str_replace('$BREADCATATLOGOCONSOLE$', '', $breadcrumb);
                $breadcrumb = str_replace('$BREADCATALOGOSUBMENUVIDEOGIOCO$', '', $breadcrumb);

            } else {

                $breadcrumb = '';

            }

            //qui assemblo ricerca generale videogioco, quindi che va bene per tutto
        } elseif(!isset($_GET["menu"]) && !isset($_GET["console"]) && isset($_GET["search"]) && isset($_GET["searchstart"]) && isset($_GET["searchfinish"]) && count($_GET) < 4) {

            $breadcrumb = str_replace('$BREADHOMEPAGE$', 'Sei qui: <a title="Link alla home" href="phpPrincipal.php" tabindex="11"><span xml:lang="en" lang="en">Home</span></a> ', $breadcrumb);
            $breadcrumb = str_replace('$BREADMENU$', '>> Ricerca ', $breadcrumb);
            $breadcrumb = str_replace('$BREADCATALOGOSUBMENU$', '', $breadcrumb);
            $breadcrumb = str_replace('$BREADCATATLOGOCONSOLE$', '', $breadcrumb);
            $breadcrumb = str_replace('$BREADCATALOGOSUBMENUVIDEOGIOCO$', '', $breadcrumb);

            //assemblo modifica/elimina videogioco e modifica/elimina prenotazione
        } elseif(isset($_GET["menu"]) && ($_GET["menu"] == 'modificavid' || $_GET["menu"] == 'eliminavid' || $_GET["menu"] == 'modificapren' || $_GET["menu"] == 'eliminapren') && count($_GET) < 2) {

            if(isset($_SESSION["username"]) && $_SESSION["username"] == 'admin') {

                $breadcrumb = str_replace('$BREADHOMEPAGE$', 'Sei qui: <a title="Link alla home" href="phpPrincipal.php" tabindex="11"><span xml:lang="en" lang="en">Home</span></a> ', $breadcrumb);

                if($_GET["menu"] == 'modificavid') {

                    $breadcrumb = str_replace('$BREADMENU$', '>> Modifica videogioco ', $breadcrumb);

                } elseif($_GET["menu"] == 'eliminavid') {

                    $breadcrumb = str_replace('$BREADMENU$', '>> Elimina videogioco ', $breadcrumb);

                } elseif($_GET["menu"] == 'modificapren') {

                    //$numPrenotazione = $_POST["numprenotazione"];

                    $inizio = $_POST["startpr"];
                    $fine = $_POST["finishpr"];

                    $breadcrumb = str_replace('$BREADMENU$', '>> <a title="Link all\'elenco prenotazioni" href="phpPrincipal.php?menu=elencoprenotazionitot&amp;startpr=' . $inizio . '&amp;finishpr=' . $fine . '" tabindex="12">Elenco prenotazioni</a> ', $breadcrumb);
                    $breadcrumb = str_replace('$BREADCATALOGOSUBMENU$', '>> Modifica prenotazione ', $breadcrumb);

                } else {

                    $breadcrumb = str_replace('$BREADMENU$', '>> Elimina prenotazione ', $breadcrumb);

                }

                $breadcrumb = str_replace('$BREADCATALOGOSUBMENU$', '', $breadcrumb);
                $breadcrumb = str_replace('$BREADCATATLOGOCONSOLE$', '', $breadcrumb);
                $breadcrumb = str_replace('$BREADCATALOGOSUBMENUVIDEOGIOCO$', '', $breadcrumb);

            } else {

                $breadcrumb = '';

            }

        } else {

            $breadcrumb = '';

        }

    }

};


?>
