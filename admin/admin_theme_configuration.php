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
require("functions.php");
require("../".$rep_lang.$lang.".php");
require("../default_config.php");

if(isset($_SESSION['name']) AND isset($_SESSION['psw'])) {

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="StyleSheet" href="admin_template.css" type="text/css" media="all" />
    <title>Graphist Gallery - Administration</title>
</head>
<body>
<div class="menu">        
<h3><?php echo $admin_menu; ?></h3>
<ul>
    <li><a href="index.php"><?php echo $retour_index; ?></a></li>
    <li><a href="admin_pages.php"><?php echo $pages_admin; ?></a></li>
    <li><a href="admin_site_configuration.php"><?php echo $config_admin; ?></a></li>
    <li><a href="admin_theme_configuration.php"><?php echo $template_admin; ?></a></li>
</ul>
</div>

<div id="body">
<?php
echo "<h1>Template</h1>";

echo $admin_config_theme;

echo "<p>".$info_theme.$style.".<br/>";
echo "".$info_config_theme."|&nbsp;<a href=\"admin_pages.php?fichier=../".$rep_resources."template/".$style."/".$style.".php&amp;action=modif\">".$style.".php</a>&nbsp;|&nbsp;";
if(file_exists("../".$rep_resources."template/".$style."/config_".$style.".php")) {
    echo "<a href=\"admin_pages.php?fichier=../".$rep_resources."template/".$style."/config_".$style.".php&amp;action=modif\">Config_".$style.".php</a>&nbsp;|";
}
echo "</p>";
?>
</div>
<div id="footer">
<a href="<?php echo $site; ?>"><?php echo $retour_site; ?></a> | <a href="deco.php"><?php echo $deconnexion; ?></a>
</div>
</body>
</html>

<?php
} else {
    admin_connection();
}

?>
