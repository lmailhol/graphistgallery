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
echo "<h1>Administration</h1>";

echo "<p>".$admin_welcome."</p>";

echo "<ul class=\"menu_img\">";
echo "<li><a href=\"admin_pages.php\"><img src=\"../".$rep_img."admin_page.png\" alt=\"".$pages_admin."\" title=\"".$pages_admin."\" class=\"button\" /></a></li>";
echo "<li><a href=\"admin_site_configuration.php\"><img src=\"../".$rep_img."admin_config.png\" alt=\"".$config_admin."\" title=\"".$config_admin."\" class=\"button\" \"/></a></li>";
echo "<li><a href=\"admin_theme_configuration.php\"><img src=\"../".$rep_img."admin_template.png\" alt=\"".$template_admin."\" title=\"".$template_admin."\" class=\"button\" \"/></a></li>";
echo "</ul>";

echo "<p>".$info_version."</p>";

check_version();

echo "<ul>";
echo "<li>".$page_codingteam."<a href=\"http://codingteam.net/project/gallery\">Graphist Gallery</a></li>";
echo "<li>".$documentation."<a href=\"http://codingteam.net/project/gallery/doc\">Documentation Graphist Gallery</a></li>";
echo "<li>".$news."<a href=\"http://codingteam.net/project/gallery/doc\">News</a></li>";
echo "<li>".$site_projet."<a href=\"http://gallery.radek411.org\">Gallery.radek411.org</a></li>";
echo "<li>".$xmpp_projet."<a href=\"https://www.jappix.com/?r=gallery@conference.codingteam.net\">Chat</a></li>";
echo "</ul>";

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
