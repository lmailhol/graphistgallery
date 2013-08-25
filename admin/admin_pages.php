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

include("include/header.php"); ?>
    
<div class="pure-u-1" id="main">
<div class="header">
    <h1>Graphist Gallery</h1>
    <h2>Pages Administration</h2>
</div>


<div class="content">
    
    <h2 class="content-subhead">Pages</h2>
    
<?php
    
if(isset($_GET['action']) OR isset($_GET['fichier'])) {
    
    if($_GET['action']=="ajout") {
        if(isset($_POST["page"]) AND isset($_POST["nom"])) {
            add_page($_POST["nom"],$_POST["page"]);
        } else {
            echo "<form class=\"pure-form pure-form-stacked\" action=\"admin_pages.php?action=ajout\" method=\"post\">";
            echo "<fieldset>";
			echo "<legend>".$form_info_content."</legend>";
            echo "<script>edToolbar('page'); </script>";
            echo "<textarea id=\"page\" name=\"page\" rows=\"25\" cols=\"98\" class=\"ed\"></textarea>";
            echo $form_info_name."<br/>"; 
            echo "<label for=\"nom\">".$form_name."</label> <input type=\"text\" id=\"nom\" name=\"nom\" />";
            echo "<button type=\"submit\" class=\"pure-button pure-button-primary\">".$publication."</button>";
            echo "</fieldset></form>";
        }
    } elseif($_GET['action']=="modif" OR $_GET['action']=="modif_done") {
        if($_GET['action']=="modif_done") {
            if(isset($_POST["page"]) AND isset($_POST["nom"]) AND isset($_POST["nom_change"])) {
                modif_page($_POST["nom"],$_POST["page"],$_POST["nom_change"]);
            } else { echo $erreur_modif_page; }
        } elseif($_GET['action']=="modif") {
            if(!isset($admin_rep_pages)){$admin_rep_pages="../".$rep_pages."";}
            if(file_exists($admin_rep_pages.$_GET['fichier'])){
				echo "<form class=\"pure-form pure-form-stacked\" action=\"admin_pages.php?action=modif_done\" method=\"post\">";
				echo "<fieldset>";
				echo "<legend>".$form_info_content."</legend>";
                echo "<script>edToolbar('page'); </script>";
				echo "<textarea name=\"page\" id=\"page\" rows=\"25\" cols=\"98\" class=\"ed\">".file_get_contents($admin_rep_pages.$_GET['fichier'])."</textarea>";
                if($_GET['fichier']=="../config.php" OR preg_match("#../".$rep_resources."template/#",$_GET['fichier'])) {
                    //If the file is a config file, you can't change the file's name
                    echo "<input type=\"hidden\" name=\"nom_change\" value=\"".$_GET['fichier']."\" />";
                } else {echo "<label for=\"nom_change\">".$form_name_modif."</label> <input type=\"text\" id=\"nom_change\" value=\"".$_GET['fichier']."\" name=\"nom_change\" />";}
                echo "<input type=\"hidden\" name=\"nom\" value=\"".$_GET['fichier']."\" />";
				echo "<button type=\"submit\" class=\"pure-button pure-button-primary\">".$modif."</button>";
				echo "</fieldset></form>";
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
				echo "<form class=\"pure-form pure-form-stacked\" action=\"admin_pages.php?action=suppr&amp;fichier=".$_GET['fichier']."\" method=\"post\">";
				echo "<fieldset>";
                echo "<legend>".$suppression."</legend>";
                echo "<label for=\"suppr_done\" class=\"pure-checkbox\"><input type=\"checkbox\" name=\"suppr_done\"/> ".$suppr_sur." </label>";
				echo "<input type=\"hidden\" name=\"suppr\" value=\"1\" />"; 
				echo "<button type=\"submit\" class=\"pure-button pure-button-primary\">".$submit."</button>";
				echo "</fieldset></form>";
                
                
			} else { echo $admin_error_pages; }
        }
    } else {
        echo $admin_error_pages;
    }
} else {

echo "<div class=\"pure-g-r\"><div class=\"pure-u-1-2\">";
echo "<div class=\"l-centered\"><table class=\"pure-table\">";
echo "<caption><a href=\"admin_pages.php?action=ajout\"><img src=\"../".$rep_img."/add.png\" alt=\"".$ajout_page."\" class=\"button\" \"/></a></caption>";
echo "<thead><tr>";
echo "<th>Pages</th>";
echo "<th>".$modif."</th>";
echo "<th>".$suppression."</th>";
echo "</tr></thead>";
show_list_pages();
echo "</table></div></div>";
echo "<div class=\"pure-u-1-2\">";
echo "Coucou";    
echo "</div></div>";
echo "<h2 class=\"content-subhead\">Commentaires</h2>";
} 
?>

</div>
</div>

<?php
    
include("include/footer.php");


} else {
    admin_connection();
}
?>
