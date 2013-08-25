<?php
session_start();

/*
 * Copyright (C) 2010 Mailhol Luca
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
 */

require("../config.php");
require("../".$rep_lang.$lang.".php");

echo'<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Deconnexion &ndash; Graphist Gallery</title>

<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.2.1/pure-min.css">
<link href="http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" href="template/admin_template.css">
<script src="http://use.typekit.net/ajf8ggy.js"></script>
<script>
    try { Typekit.load(); } catch (e) {}
</script>

</head>
<body><div class="pure-g-r" id="layout">
    <a href="#menu" id="menuLink" class="pure-menu-link">
        <span></span>
    </a>
    <div class="pure-u" id="menu">
    <div class="pure-menu pure-menu-open">
        <a class="pure-menu-heading" href="index.php">Admin</a>
        <ul>
        <li><a href="'.$site.'">'.$retour_site.'</a></li>
        </ul>
    </div>
</div>
<div class="pure-u-1" id="main">
<div class="header">
    <h1>Graphist Gallery</h1>
    <h2>Authentification</h2>
</div>
<div class="content"><h2 class="content-subhead">Administration</h2><div class="l-centered">';

if(isset($_SESSION['name']) AND isset($_SESSION['psw'])) {
    session_destroy();
    echo $deco_done."<br/>";
    echo "<a class=\"pure-button\" href=\"index.php\">".$recharger."</a>";
} else {
    echo $erreur_deco."<br/>";
    echo "<a class=\"pure-button\" href=\"index.php\">".$recharger."</a>";
}
echo '</div></div>
</div>
</div>
<div class="legal pure-g-r">
    <div class="pure-u-2-5">
    <p>&nbsp;</p>
    </div>

    <div class="pure-u-1-5">
        <div class="l-box legal-logo">
            <a href="http://radek411.github.io/graphistgallery/">
                <img src="../img/logo_gg_gris.jpg" height="30"
                     alt="Graphist Gallery">
            </a>
        </div>
    </div>
    <div class="pure-u-2-5">
    <p>&nbsp;</p>
    </div>
</div>


</div>
</div> 


<script src="../resources/js/rainbow-min.js"></script>

</body>
</html>';
?>
