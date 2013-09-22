<?php
session_start();

$menu = "theme";

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
require("functions.php");
require("../".$rep_lang.$lang.".php");
require("../default_config.php");

if(isset($_SESSION['name']) AND isset($_SESSION['psw'])) {

include("include/header.php"); ?>
    
<div class="pure-u-1" id="main">
<div class="header">
    <h1>Graphist Gallery</h1>
    <h2>Template Panel</h2>
</div>


<div class="content">    
    
    <h2 action="admin_theme_configuration.php" method="post" class="content-subhead">Template</h2>

<?php

echo $admin_config_theme;

echo "<p>".$info_theme.$style.".<br/>";
echo "".$info_config_theme."|&nbsp;<a href=\"admin_pages.php?fichier=../".$rep_resources."template/".$style."/index.html&amp;action=modif\">index.html</a>&nbsp;|&nbsp;";
if(file_exists("../".$rep_resources."template/".$style."/config_".$style.".php")) {
    echo "<a href=\"admin_pages.php?fichier=../".$rep_resources."template/".$style."/config_".$style.".php&amp;action=modif\">Config_".$style.".php</a>&nbsp;|";
}
echo "</p>";
?>

</div>
</div>

<?php
    
include("include/footer.php");


} else {
    admin_connection();
}
?>
