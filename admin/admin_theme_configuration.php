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

<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>Graphist Gallery - Administration</title>
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
  ================================================== -->
	<link rel="stylesheet" href="template/base.css">
	<link rel="stylesheet" href="template/skeleton.css">
	<link rel="stylesheet" href="template/layout.css">

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">

</head>
<body>
    
	<!-- Primary Page Layout
	================================================== -->

	<!-- Delete everything in this .container and get started on your own site! -->

	<div class="container">
		<div class="sixteen columns">
			<h1 class="remove-bottom" style="margin-top: 40px">Skeleton</h1>
			<h5>Version 1.2</h5>
			<hr />
		</div>
		<div class="sixteen columns"><h3><?php echo $admin_menu; ?></h3>
        <ul>
            <li><a href="index.php"><?php echo $retour_index; ?></a></li>
            <li><a href="admin_pages.php"><?php echo $pages_admin; ?></a></li>
            <li><a href="admin_site_configuration.php"><?php echo $config_admin; ?></a></li>
            <li><a href="admin_theme_configuration.php"><?php echo $template_admin; ?></a></li>
        </ul>
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

    <hr />
		</div>
        <div class="sixteen columns">
            <a href="<?php echo $site; ?>"><?php echo $retour_site; ?></a> | <a href="deco.php"><?php echo $deconnexion; ?></a>
        </div>

	</div><!-- container -->


<!-- End Document
================================================== -->
</body>
</html>

<?php
} else {
    admin_connection();
}

?>