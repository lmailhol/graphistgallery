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

require("functions.php");
require("../config.php");
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
echo "<h1>Pages</h1>";

if(isset($_GET['action']) OR isset($_GET['fichier'])) {
    
    if($_GET['action']=="ajout") {
        if(isset($_POST["page"]) AND isset($_POST["nom"])) {
            add_page($_POST["nom"],$_POST["page"]);
        } else {
            echo "<form action=\"admin_pages.php?action=ajout\" method=\"post\">";
            echo "<p>";
			echo $form_info_content."<br/>";
            echo "<script>edToolbar('page'); </script>";
            echo "<textarea id=\"page\" name=\"page\" rows=\"25\" cols=\"98\" class=\"ed\"></textarea><br/>";
            echo $form_info_name."<br/>"; 
            echo "<label for=\"nom\">".$form_name."</label> <input type=\"text\" id=\"nom\" name=\"nom\" /><br/>";
 
            echo "<input type=\"submit\" value=\"".$publication."\" />";
            echo "</p></form>";
        }
    } elseif($_GET['action']=="modif" OR $_GET['action']=="modif_done") {
        if($_GET['action']=="modif_done") {
            if(isset($_POST["page"]) AND isset($_POST["nom"]) AND isset($_POST["nom_change"])) {
                modif_page($_POST["nom"],$_POST["page"],$_POST["nom_change"]);
            } else { echo $erreur_modif_page; }
        } elseif($_GET['action']=="modif") {
            if(!isset($admin_rep_pages)){$admin_rep_pages="../".$rep_pages."";}
            if(file_exists($admin_rep_pages.$_GET['fichier'])){
				echo "<form action=\"admin_pages.php?action=modif_done\" method=\"post\">";
				echo "<p>";
				echo $form_info_content."<br/>";
                echo "<script>edToolbar('page'); </script>";
				echo "<textarea name=\"page\" id=\"page\" rows=\"25\" cols=\"98\" class=\"ed\">".file_get_contents($admin_rep_pages.$_GET['fichier'])."</textarea><br/>";
                if($_GET['fichier']=="../config.php" OR preg_match("#../".$rep_resources."template/#",$_GET['fichier'])) {
                    //If the file is a config file, you can't change the file's name
                    echo "<input type=\"hidden\" name=\"nom_change\" value=\"".$_GET['fichier']."\" />";
                } else {echo "<label for=\"nom_change\">".$form_name_modif."</label> <input type=\"text\" id=\"nom_change\" value=\"".$_GET['fichier']."\" name=\"nom_change\" /><br/>";}
                echo "<input type=\"hidden\" name=\"nom\" value=\"".$_GET['fichier']."\" />";
				echo "<input type=\"submit\" value=\"".$modif."\" />";
				echo "</p></form>";
			} else { echo $admin_error_pages; }
        }
    
    } elseif($_GET['action']=="suppr") { 
        if(isset($_POST["suppr_done"])==10 AND isset($_GET['fichier']) AND isset($_POST["suppr"])==1) {
            suppr_page($_GET['fichier']);
        } elseif(!isset($_POST["suppr_done"]) AND isset($_GET['fichier']) AND isset($_POST["suppr"])==1) {
            echo $non_modif_page."<br/>";
            echo "<a href=\"admin_pages.php\">".$retour."</a>";
        } else {
			if(!isset($admin_rep_pages)){$admin_rep_pages="../".$rep_pages."";}
            if(file_exists($admin_rep_pages.$_GET['fichier'])){
				echo "<form action=\"admin_pages.php?action=suppr&amp;fichier=".$_GET['fichier']."\" method=\"post\">";
				echo "<p>";
				echo $suppr_sur;
				echo "<input type=\"checkbox\" name=\"suppr_done\"/><br/>";
				echo "<input type=\"hidden\" name=\"suppr\" value=\"1\" />";
				echo "<input type=\"submit\" value=\"".$submit."\" />";
				echo "</p></form>";
			} else { echo $admin_error_pages; }
        }
    } else {
        echo $admin_error_pages;
    }
} else {

echo "<table>";
echo "<caption><a href=\"admin_pages.php?action=ajout\"><img src=\"../".$rep_img."/add.png\" alt=\"".$ajout_page."\" class=\"button\" \"/></a></caption>";
echo "<tr>";
echo "<th>Pages</th>";
echo "<th>".$modif."</th>";
echo "<th>".$suppression."</th>";
echo "</tr>";
show_list_pages();
echo "</table>";
} 

echo "<h1>Commentaires</h1>";

                                                          
          
?>
            
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
