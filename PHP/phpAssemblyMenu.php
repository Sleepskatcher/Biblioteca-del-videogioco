<?php

function assemblyMenu(&$menu) {

    if(isset($_GET["menu"]) && ((isset($_SESSION["username"]) && $_SESSION["username"] != 'admin' && ($_GET["menu"] == 'elencoprenotazionitot' || $_GET["menu"] == 'inserimentovid')) || (!isset($_SESSION["username"]) && ($_GET["menu"] == 'elencoprenotazionitot' || $_GET["menu"] == 'inserimentovid' || $_GET["menu"] == 'prenotazioni')))) {

        $menu = '';

    } else {

        //assemblo SEMPRE e SOLO homepage
        if(!isset($_GET["menu"]) && !isset($_GET["console"]) && !isset($_GET["search"]) && empty($_GET)) {

            if(!isset($_SESSION["username"])) {

                $menu = str_replace('$MENUHOMEPAGE$', '<li class="hamburger" id="NoClickItem"><span xml:lang="en" lang="en">Home</span></li>', $menu);
                $menu = str_replace('$MENUCATALOGO$', '<li class="hamburger"><a href="phpPrincipal.php?menu=catalogo" tabindex="6">Catalogo</a></li>', $menu);
                $menu = str_replace('$MENUFUNZNOLEGGIO$', '<li class="hamburger"><a href="phpPrincipal.php?menu=comefunzionanoleggio" tabindex="7">Come funziona il noleggio</a></li>', $menu);
                $menu = str_replace('$MENUCHISIAMO$', '<li class="hamburger"><a href="phpPrincipal.php?menu=chisiamo" tabindex="8">Chi siamo</a></li>', $menu);
                $menu = str_replace('$MENUPAGPRENOTAZIONITOT$', '', $menu);
                $menu = str_replace('$MENUPAGADMINAGGIUNGIELEMENTO$', '', $menu);
                $menu = str_replace('$MENUPRENOTAZIONIUTENTE$', '', $menu);

            } else {

                if(isset($_SESSION["username"]) && $_SESSION["username"] == 'admin') {

                    $menu = str_replace('$MENUHOMEPAGE$', '<li class="hamburger" id="NoClickItem"><span xml:lang="en" lang="en">Home</span></li>', $menu);
                    $menu = str_replace('$MENUCATALOGO$', '<li class="hamburger"><a href="phpPrincipal.php?menu=catalogo" tabindex="6">Modifica - elimina videogioco</a></li>', $menu);
                    $menu = str_replace('$MENUFUNZNOLEGGIO$', '', $menu);
                    $menu = str_replace('$MENUCHISIAMO$', '', $menu);
                    $menu = str_replace('$MENUPAGPRENOTAZIONITOT$', '<li class="hamburger"><a href="phpPrincipal.php?menu=elencoprenotazionitot&amp;startpr=0&amp;finishpr=10" tabindex="7">Elenco prenotazioni</a></li>', $menu);
                    $menu = str_replace('$MENUPAGADMINAGGIUNGIELEMENTO$', '<li class="hamburger"><a href="phpAddNewItem.php?menu=inserimentovid" tabindex="8">Inserimento videogioco</a></li>', $menu);
                    //$menu = str_replace('$MENUPRENOTAZIONIUTENTE$', '<li class="hamburger"><a href="phpPrincipal.php?menu=prenotazioni&pstart=0&pfinish=5&fromVideogame=no" tabindex="9">Prenotazioni</a></li>', $menu); lasciato per ricordarmi che c'era, non è una dimenticanza
                    $menu = str_replace('$MENUPRENOTAZIONIUTENTE$', '', $menu);


                } elseif(isset($_SESSION["username"]) && $_SESSION["username"] != 'admin') {

                    $menu = str_replace('$MENUHOMEPAGE$', '<li class="hamburger" id="NoClickItem"><span xml:lang="en" lang="en">Home</span></li>', $menu);
                    $menu = str_replace('$MENUCATALOGO$', '<li class="hamburger"><a href="phpPrincipal.php?menu=catalogo" tabindex="6">Catalogo</a></li>', $menu);
                    $menu = str_replace('$MENUFUNZNOLEGGIO$', '<li class="hamburger"><a href="phpPrincipal.php?menu=comefunzionanoleggio" tabindex="7">Come funziona il noleggio</a></li>', $menu);
                    $menu = str_replace('$MENUCHISIAMO$', '<li class="hamburger"><a href="phpPrincipal.php?menu=chisiamo" tabindex="8">Chi siamo</a></li>', $menu);
                    $menu = str_replace('$MENUPAGPRENOTAZIONITOT$', '', $menu);
                    $menu = str_replace('$MENUPAGADMINAGGIUNGIELEMENTO$', '', $menu);
                    $menu = str_replace('$MENUPRENOTAZIONIUTENTE$', '<li class="hamburger"><a href="phpPrincipal.php?menu=prenotazioni&amp;pstart=0&amp;pfinish=10&amp;fromVideogame=no" tabindex="9">Prenotazioni</a></li>', $menu);

                } else {

                    $menu = '';

                }

            }

            //qui sotto assemblo gli altri menu semplici: chisiamo, dovesiamo, comefunzionanoleggio, inseriscividEogame
        } elseif(isset($_GET["menu"]) && $_GET["menu"] != 'elencoprenotazionitot' && $_GET["menu"] != 'prenotazioni' && ($_GET["menu"] == 'catalogo' || $_GET["menu"] == 'chisiamo' || $_GET["menu"] == 'comefunzionanoleggio' || $_GET["menu"] == 'inserimentovid') && !isset($_GET["console"]) && !isset($_GET["search"]) && count($_GET) < 2) {

            if(!isset($_SESSION["username"]) || (isset($_SESSION["username"]) && $_SESSION["username"] != 'admin')) {

                if($_GET["menu"] == 'catalogo') {

                    $menu = str_replace('$MENUHOMEPAGE$', '<li class="hamburger"><a href="phpPrincipal.php" tabindex="6"><span xml:lang="en" lang="en">Home</span></a></li>', $menu);
                    $menu = str_replace('$MENUCATALOGO$', '<li class="hamburger" id="NoClickItem">Catalogo</li>', $menu);
                    $menu = str_replace('$MENUFUNZNOLEGGIO$', '<li class="hamburger"><a href="phpPrincipal.php?menu=comefunzionanoleggio" tabindex="7">Come funziona il noleggio</a></li>', $menu);
                    $menu = str_replace('$MENUCHISIAMO$', '<li class="hamburger"><a href="phpPrincipal.php?menu=chisiamo" tabindex="8">Chi siamo</a></li>', $menu);

                } elseif($_GET["menu"] == 'chisiamo') {

                    $menu = str_replace('$MENUHOMEPAGE$', '<li class="hamburger"><a href="phpPrincipal.php" tabindex="6"><span xml:lang="en" lang="en">Home</span></a></li>', $menu);
                    $menu = str_replace('$MENUCATALOGO$', '<li class="hamburger"><a href="phpPrincipal.php?menu=catalogo" tabindex="7">Catalogo</a></li>', $menu);
                    $menu = str_replace('$MENUFUNZNOLEGGIO$', '<li class="hamburger"><a href="phpPrincipal.php?menu=comefunzionanoleggio" tabindex="8">Come funziona il noleggio</a></li>', $menu);
                    $menu = str_replace('$MENUCHISIAMO$', '<li class="hamburger" id="NoClickItem">Chi siamo</li>', $menu);

                } elseif($_GET["menu"] == 'comefunzionanoleggio') {

                    $menu = str_replace('$MENUHOMEPAGE$', '<li class="hamburger"><a href="phpPrincipal.php" tabindex="6"><span xml:lang="en" lang="en">Home</span></a></li>', $menu);
                    $menu = str_replace('$MENUCATALOGO$', '<li class="hamburger"><a href="phpPrincipal.php?menu=catalogo" tabindex="7">Catalogo</a></li>', $menu);
                    $menu = str_replace('$MENUFUNZNOLEGGIO$', '<li class="hamburger" id="NoClickItem">Come funziona il noleggio</li>', $menu);
                    $menu = str_replace('$MENUCHISIAMO$', '<li class="hamburger"><a href="phpPrincipal.php?menu=chisiamo" tabindex="8">Chi siamo</a></li>', $menu);

                } else {

                    $menu = '';

                }

                $menu = str_replace('$MENUPAGPRENOTAZIONITOT$', '', $menu);
                $menu = str_replace('$MENUPAGADMINAGGIUNGIELEMENTO$', '', $menu);

                if(!isset($_SESSION["username"])) {

                    $menu = str_replace('$MENUPRENOTAZIONIUTENTE$', '', $menu);

                } else {

                    $menu = str_replace('$MENUPRENOTAZIONIUTENTE$', '<li class="hamburger"><a href="phpPrincipal.php?menu=prenotazioni&amp;pstart=0&amp;pfinish=10&amp;fromVideogame=no" tabindex="9">Prenotazioni</a></li>', $menu);

                }

            } elseif(isset($_SESSION["username"]) && $_SESSION["username"] == 'admin') {

                if($_GET["menu"] == 'catalogo') {

                    $menu = str_replace('$MENUHOMEPAGE$', '<li class="hamburger"><a href="phpPrincipal.php" tabindex="6"><span xml:lang="en" lang="en">Home</span></a></li>', $menu);
                    $menu = str_replace('$MENUCATALOGO$', '<li class="hamburger" id="NoClickItem">Modifica - Elimina videogioco</li>', $menu);
                    $menu = str_replace('$MENUFUNZNOLEGGIO$', '', $menu);
                    $menu = str_replace('$MENUCHISIAMO$', '', $menu);
                    $menu = str_replace('$MENUPAGPRENOTAZIONITOT$', '<li class="hamburger"><a href="phpPrincipal.php?menu=elencoprenotazionitot&amp;startpr=0&amp;finishpr=10" tabindex="7">Elenco prenotazioni</a></li>', $menu);
                    $menu = str_replace('$MENUPAGADMINAGGIUNGIELEMENTO$', '<li class="hamburger"><a href="phpAddNewItem.php?menu=inserimentovid" tabindex="8">Inserimento videogioco</a></li>', $menu);
                    $menu = str_replace('$MENUPRENOTAZIONIUTENTE$', '', $menu);

                } elseif($_GET["menu"] == 'inserimentovid') {

                    $menu = str_replace('$MENUHOMEPAGE$', '<li class="hamburger"><a href="phpPrincipal.php" tabindex="6"><span xml:lang="en" lang="en">Home</span></a></li>', $menu);
                    $menu = str_replace('$MENUCATALOGO$', '<li class="hamburger"><a href="phpPrincipal.php?menu=catalogo" tabindex="7">Modifica - Elimina videogioco</a></li>', $menu);
                    $menu = str_replace('$MENUFUNZNOLEGGIO$', '', $menu);
                    $menu = str_replace('$MENUCHISIAMO$', '', $menu);
                    $menu = str_replace('$MENUPAGPRENOTAZIONITOT$', '<li class="hamburger"><a href="phpPrincipal.php?menu=elencoprenotazionitot&amp;startpr=0&amp;finishpr=10" tabindex="8">Elenco prenotazioni</a></li>', $menu);
                    $menu = str_replace('$MENUPAGADMINAGGIUNGIELEMENTO$', '<li class="hamburger" id="NoClickItem">Inserimento videogioco</li>', $menu);
                    $menu = str_replace('$MENUPRENOTAZIONIUTENTE$', '', $menu);

                } else {

                    $menu = '';
                }

            } else {

                $menu = '';

            }

            //qui sotto gestisco catalogo console quindi quando ho selezionato una console
        } elseif((isset($_GET["menu"]) && $_GET["menu"] == 'elencoprenotazionitot' && !isset($_GET["console"]) &&  !isset($_GET["search"]) && isset($_GET["startpr"]) && isset($_GET["finishpr"]) && count($_GET) < 4) || (isset($_GET["menu"]) && $_GET["menu"] == 'elencoprenotazionitot' && !isset($_GET["console"]) &&  !isset($_GET["search"]) && isset($_GET["startpr"]) && isset($_GET["finishpr"]) && isset($_GET["deletePr"]) && ($_GET["deletePr"] == 'yes' || $_GET["deletePr"] == 'no') && count($_GET) < 5)) {

            if(!isset($_SESSION["username"]) || (isset($_SESSION["username"]) && $_SESSION["username"] != 'admin')) {

                $menu = '';

            } elseif(isset($_SESSION["username"]) && $_SESSION["username"] == 'admin') {

                $menu = str_replace('$MENUHOMEPAGE$', '<li class="hamburger"><a href="phpPrincipal.php" tabindex="6"><span xml:lang="en" lang="en">Home</span></a></li>', $menu);
                $menu = str_replace('$MENUCATALOGO$', '<li class="hamburger"><a href="phpPrincipal.php?menu=catalogo" tabindex="7">Modifica - Elimina videogioco</a></li>', $menu);
                $menu = str_replace('$MENUFUNZNOLEGGIO$', '', $menu);
                $menu = str_replace('$MENUCHISIAMO$', '', $menu);
                $menu = str_replace('$MENUPAGPRENOTAZIONITOT$', '<li class="hamburger" id="NoClickItem">Elenco prenotazioni</li>', $menu);
                $menu = str_replace('$MENUPAGADMINAGGIUNGIELEMENTO$', '<li class="hamburger"><a href="phpAddNewItem.php?menu=inserimentovid" tabindex="8">Inserimento videogioco</a></li>', $menu);
                $menu = str_replace('$MENUPRENOTAZIONIUTENTE$', '', $menu);

            }

            //qui sotto assemblo il menu prenotazione sia per l'username che per l'admin
        } elseif((isset($_GET["menu"]) && $_GET["menu"] == 'prenotazioni' && !isset($_GET["console"]) && !isset($_GET["search"]) && isset($_GET["pstart"]) && isset($_GET["pfinish"]) && isset($_GET["fromVideogame"]) && ($_GET["fromVideogame"] == 'yes' || $_GET["fromVideogame"] == 'no') && count($_GET) < 5) || (isset($_GET["menu"]) && $_GET["menu"] == 'prenotazioni' && !isset($_GET["console"]) && !isset($_GET["search"]) && isset($_GET["pstart"]) && isset($_GET["pfinish"]) && isset($_GET["fromVideogame"]) && ($_GET["fromVideogame"] == 'yes' || $_GET["fromVideogame"] == 'no') && isset($_GET["deletePr"]) && ($_GET["deletePr"] == 'yes' || $_GET["deletePr"] == 'no') && count($_GET) < 6) || (isset($_GET["menu"]) && $_GET["menu"] == 'prenotazioni' && !isset($_GET["console"]) && !isset($_GET["search"]) && isset($_GET["tipeOfConsole"]) && ($_GET["tipeOfConsole"] == 'Xbox360' || $_GET["tipeOfConsole"] == 'XboxOne' || $_GET["tipeOfConsole"] == 'Wii' || $_GET["tipeOfConsole"] == 'WiiU' || $_GET["tipeOfConsole"] == 'Switch' || $_GET["tipeOfConsole"] == 'PlayStation3' || $_GET["tipeOfConsole"] == 'PlayStation4') && isset($_GET["fromVideogame"]) && ($_GET["fromVideogame"] == 'yes' || $_GET["fromVideogame"] == 'no') && isset($_GET["pstart"]) && isset($_GET["pfinish"]) && count($_GET) < 7) || (isset($_GET["menu"]) && $_GET["menu"] == 'prenotazioni' && !isset($_GET["console"]) && !isset($_GET["search"]) && isset($_GET["tipeOfConsole"]) && ($_GET["tipeOfConsole"] == 'Xbox360' || $_GET["tipeOfConsole"] == 'XboxOne' || $_GET["tipeOfConsole"] == 'Wii' || $_GET["tipeOfConsole"] == 'WiiU' || $_GET["tipeOfConsole"] == 'Switch' || $_GET["tipeOfConsole"] == 'PlayStation3' || $_GET["tipeOfConsole"] == 'PlayStation4') && isset($_GET["fromVideogame"]) && ($_GET["fromVideogame"] == 'yes' || $_GET["fromVideogame"] == 'no') && isset($_GET["pstart"]) && isset($_GET["pfinish"]) && isset($_GET["deletePr"]) && ($_GET["deletePr"] == 'yes' || $_GET["deletePr"] == 'no') && count($_GET) < 8)) {

            if(!isset($_SESSION["username"])) {

                $menu = '';

            } elseif(isset($_SESSION["username"])) {

                if($_SESSION["username"] == 'admin') {

                    $menu = str_replace('$MENUHOMEPAGE$', '<li class="hamburger"><a href="phpPrincipal.php" tabindex="6"><span xml:lang="en" lang="en">Home</span></a></li>', $menu);
                    $menu = str_replace('$MENUCATALOGO$', '<li class="hamburger"><a href="phpPrincipal.php?menu=catalogo" tabindex="7">Modifica - Elimina videogioco</a></li>', $menu);
                    $menu = str_replace('$MENUFUNZNOLEGGIO$', '', $menu);
                    $menu = str_replace('$MENUCHISIAMO$', '', $menu);
                    $menu = str_replace('$MENUPAGPRENOTAZIONITOT$', '<li class="hamburger"><a href="phpPrincipal.php?menu=elencoprenotazionitot&amp;startpr=0&amp;finishpr=10" tabindex="8">Elenco prenotazioni</a></li>', $menu);
                    $menu = str_replace('$MENUPAGADMINAGGIUNGIELEMENTO$', '<li class="hamburger"><a href="phpAddNewItem.php?menu=inserimentovid" tabindex="9">Inserimento videogioco</a></li>', $menu);
                    $menu = str_replace('$MENUPRENOTAZIONIUTENTE$', '', $menu);

                } else {

                    $menu = str_replace('$MENUHOMEPAGE$', '<li class="hamburger"><a href="phpPrincipal.php" tabindex="6"><span xml:lang="en" lang="en">Home</span></a></li>', $menu);
                    $menu = str_replace('$MENUCATALOGO$', '<li class="hamburger"><a href="phpPrincipal.php?menu=catalogo" tabindex="7">Catalogo</a></li>', $menu);
                    $menu = str_replace('$MENUFUNZNOLEGGIO$', '<li class="hamburger"><a href="phpPrincipal.php?menu=comefunzionanoleggio" tabindex="8">Come funziona il noleggio</a></li>', $menu);
                    $menu = str_replace('$MENUCHISIAMO$', '<li class="hamburger"><a href="phpPrincipal.php?menu=chisiamo" tabindex="9">Chi siamo</a></li>', $menu);
                    $menu = str_replace('$MENUPAGPRENOTAZIONITOT$', '', $menu);
                    $menu = str_replace('$MENUPAGADMINAGGIUNGIELEMENTO$', '', $menu);
                    $menu = str_replace('$MENUPRENOTAZIONIUTENTE$', '<li class="hamburger" id="NoClickItem">Prenotazioni</li>', $menu);

                }

            } else {

                $menu = '';

            }

            //qui sotto assemblo videogioco che sono più casi ma che bisogna settare per forza di cose in quanto ci devono essere tutti i contolli
        } else {

            if(!isset($_SESSION["username"])) {

                $menu = str_replace('$MENUHOMEPAGE$', '<li class="hamburger"><a href="phpPrincipal.php" tabindex="6"><span xml:lang="en" lang="en">Home</span></a></li>', $menu);
                $menu = str_replace('$MENUCATALOGO$', '<li class="hamburger"><a href="phpPrincipal.php?menu=catalogo" tabindex="7">Catalogo</a></li>', $menu);
                $menu = str_replace('$MENUFUNZNOLEGGIO$', '<li class="hamburger"><a href="phpPrincipal.php?menu=comefunzionanoleggio" tabindex="8">Come funziona il noleggio</a></li>', $menu);
                $menu = str_replace('$MENUCHISIAMO$', '<li class="hamburger"><a href="phpPrincipal.php?menu=chisiamo" tabindex="9">Chi siamo</a></li>', $menu);
                $menu = str_replace('$MENUPAGPRENOTAZIONITOT$', '', $menu);
                $menu = str_replace('$MENUPAGADMINAGGIUNGIELEMENTO$', '', $menu);
                $menu = str_replace('$MENUPRENOTAZIONIUTENTE$', '', $menu);

            } else {

                if(isset($_SESSION["username"]) && $_SESSION["username"] == 'admin') {

                    $menu = str_replace('$MENUHOMEPAGE$', '<li class="hamburger"><a href="phpPrincipal.php" tabindex="6"><span xml:lang="en" lang="en">Home</span></a></li>', $menu);
                    $menu = str_replace('$MENUCATALOGO$', '<li class="hamburger"><a href="phpPrincipal.php?menu=catalogo" tabindex="7">Modifica - Elimina videogioco</a></li>', $menu);
                    $menu = str_replace('$MENUFUNZNOLEGGIO$', '', $menu);
                    $menu = str_replace('$MENUCHISIAMO$', '', $menu);
                    $menu = str_replace('$MENUPAGPRENOTAZIONITOT$', '<li class="hamburger"><a href="phpPrincipal.php?menu=elencoprenotazionitot&amp;startpr=0&amp;finishpr=10" tabindex="8">Elenco prenotazioni</a></li>', $menu);
                    $menu = str_replace('$MENUPAGADMINAGGIUNGIELEMENTO$', '<li class="hamburger"><a href="phpAddNewItem.php?menu=inserimentovid" tabindex="9">Inserimento videogioco</a></li>', $menu);
                    $menu = str_replace('$MENUPRENOTAZIONIUTENTE$', '', $menu);

                } elseif(isset($_SESSION["username"]) && $_SESSION["username"] != 'admin') {

                    $menu = str_replace('$MENUHOMEPAGE$', '<li class="hamburger"><a href="phpPrincipal.php" tabindex="6"><span xml:lang="en" lang="en">Home</span></a></li>', $menu);
                    $menu = str_replace('$MENUCATALOGO$', '<li class="hamburger"><a href="phpPrincipal.php?menu=catalogo" tabindex="7">Catalogo</a></li>', $menu);
                    $menu = str_replace('$MENUFUNZNOLEGGIO$', '<li class="hamburger"><a href="phpPrincipal.php?menu=comefunzionanoleggio" tabindex="8">Come funziona il noleggio</a></li>', $menu);
                    $menu = str_replace('$MENUCHISIAMO$', '<li class="hamburger"><a href="phpPrincipal.php?menu=chisiamo" tabindex="9">Chi siamo</a></li>', $menu);
                    $menu = str_replace('$MENUPAGPRENOTAZIONITOT$', '', $menu);
                    $menu = str_replace('$MENUPAGADMINAGGIUNGIELEMENTO$', '', $menu);
                    $menu = str_replace('$MENUPRENOTAZIONIUTENTE$', '<li class="hamburger"><a href="phpPrincipal.php?menu=prenotazioni&amp;pstart=0&amp;pfinish=10&amp;fromVideogame=no" tabindex="10">Prenotazioni</a></li>', $menu);

                } else {

                    $menu = '';

                }

            }

        }

    }

};


?>
