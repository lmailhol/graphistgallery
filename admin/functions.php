<?php
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
require("../".$rep_lang."/".$lang.".php");

function check_version() {
    
    require("../config.php");
    require("../default_config.php"); 
    require("../".$rep_lang."/".$lang.".php");

    if($last_version = fopen("http://codingteam.net/project/gallery/upload/briefcase/version", "r")) {
        if($version = fopen("version", "r")) {
            $last_version = fgets($last_version);
            $version = fgets($version);
            if($version == $last_version) {
                echo $version_ok;
            } else {
                echo $bad_version;
            }
        }
    }
}

function add_page($nom_fichier,$contenu_page) {
    require("../default_config.php");
    require("../config.php");
    require("../".$rep_lang.$lang.".php");

    if(!isset($admin_rep_pages)){$admin_rep_pages="../".$rep_pages."";}
    
    if($nouvelle_page = fopen($admin_rep_pages.$nom_fichier, "a+")) {
        fputs($nouvelle_page, $contenu_page);
        fclose($nouvelle_page);
    echo $ajout_page_done."<br/>";
    echo "<a href=\"admin_pages.php\">".$retour."</a>";
    } else {
        echo $erreur_ajout_page."<br/>";
        echo "<a href=\"admin_pages.php\">".$retour."</a>";
    }
}

function modif_page($nom_fichier,$contenu_page, $nom_change) {
    require("../default_config.php");
    require("../config.php");
    require("../".$rep_lang."/".$lang.".php");
    
    if(!isset($admin_rep_pages)){$admin_rep_pages="../".$rep_pages."";}
    if(file_exists($admin_rep_pages.$nom_fichier)) {
        if($modif_page = fopen($admin_rep_pages.$nom_fichier, "w+")) {
            fputs($modif_page, $contenu_page);
            fclose($modif_page);
            if($nom_fichier!=$nom_change) {rename($admin_rep_pages.$nom_fichier, $admin_rep_pages.$nom_change);}
            if($nom_fichier=="../config.php"){ 
                echo $modif_config_done."<br/>";
                echo "<a href=\"admin_site_configuration.php\">".$retour."</a>";
            } elseif(preg_match("#../".$rep_resources."template/#",$nom_fichier)) {
                echo $modif_template_done."<br/>";
                echo "<a href=\"admin_theme_configuration.php\">".$retour."</a>";
            } else {
                echo $modif_page_done."<br/>";
                echo "<a href=\"admin_pages.php\">".$retour."</a>";
            }
        } else {
            if($nom_fichier=="../config.php"){ 
                echo $erreur_modif_config."<br/>";
                echo "<a href=\"admin_site_configuration.php\">".$retour."</a>";
            } elseif(preg_match("#../".$rep_resources."template/#",$nom_fichier)) {
                echo $modif_template_done."<br/>";
                echo "<a href=\"admin_theme_configuration.php\">".$retour."</a>";
            } else {
                echo $erreur_modif_page."<br/>";
                echo "<a href=\"admin_pages.php\">".$retour."</a>";
            }
        }
    } else {
        if($nom_fichier=="../config.php"){ 
            echo $erreur_modif_config."<br/>";
            echo "<a href=\"admin_site_configuration.php\">".$retour."</a>";
        } elseif(preg_match("#../".$rep_resources."template/#",$nom_fichier)) {
                echo $modif_template_done."<br/>";
                echo "<a href=\"admin_theme_configuration.php\">".$retour."</a>";
        } else {
            echo $erreur_modif_page."<br/>";
            echo "<a href=\"admin_pages.php\">".$retour."</a>";
        }
    }
}

function suppr_page($nom_fichier) {
    
    require("../default_config.php");
    require("../config.php");
    require("../".$rep_lang."/".$lang.".php");
    
    if(!isset($admin_rep_pages)){$admin_rep_pages="../".$rep_pages."";}
    if(unlink($admin_rep_pages.$nom_fichier)) {
        echo $suppr_page_done."<br/>";
        echo "<a href=\"admin_pages.php\">".$retour."</a>";
    } else {
        echo $erreur_suppr_page."<br/>";
        echo "<a href=\"admin_pages.php\">".$retour."</a>";
    }
}

function show_list_pages() {

    require("../default_config.php");
    require("../config.php");
    require("../".$rep_lang.$lang.".php");
    
    $suppr=array(".", "..");
    if(!isset($admin_rep_pages)){$admin_rep_pages="../".$rep_pages."";}
    if($dir_pages=opendir($admin_rep_pages)) {
        while (false !== ($pages = readdir($dir_pages))) {
            if(!in_array($pages, $suppr)) {
                echo "<tr>";
                echo "<td>". $pages ."</td>";
                echo "<td><a href=\"admin_pages.php?fichier=". $pages ."&amp;action=modif\"><img src=\"../".$rep_img."modif.png\" class=\"button\" title=\"".$modif."\" alt=\"".$modif."\" /></a></td>";
                if($pages==$index){ echo"<td>X</td>";} else {echo "<td><a href=\"admin_pages.php?fichier=". $pages ."&amp;action=suppr\"><img src=\"../".$rep_img."suppr.png\" title=\"".$suppression."\" class=\"button\" alt=\"".$suppression."\" /></a></td>";}
                echo "</tr>";
            }
        }
    } else {
        echo $erreur;
    }
    closedir($dir_pages);
}

function admin_connection() {
    
    require("../default_config.php");
    require("../config.php");
    require("../".$rep_lang.$lang.".php");
    
    echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">";
    echo "<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"fr\" lang=\"fr\">";
    echo "<head>";
    echo "<meta http-equiv=\"Content-Type\" content=\"text/html\" charset=\"UTF-8\" />";
    echo "<link rel=\"StyleSheet\" href=\"template/admin_template.css\" type=\"text/css\" media=\"all\" />";
    echo "<title>Graphist Gallery - Auth</title>";
    echo "</head><body>";
    
    if(isset($_POST['name']) AND isset($_POST['psw'])) {
        if($_POST['name']==$user AND $_POST['psw']==$psw) {
            $_SESSION['name']=htmlspecialchars($_POST['name']);
            $_SESSION['psw']=htmlspecialchars($_POST['psw']);
            echo "<div class=\"box\">";
            echo $login_done."<br/>";
            echo "<a href=\"index.php\">".$recharger."</a>";
            echo "</div>";
        } else {
            echo "<div class=\"box\">";
            echo $erreur_login."<br/>";
            echo "<a href=\"index.php\">".$recharger."</a>";
            echo "</div>";
        }
    } else {
        echo "<div class=\"connect\">";
        echo "<img src=\"../".$rep_img."logo_gg_admin.png\" alt=\"logo GG\" />";
        echo "<form action=\"index.php\" method=\"post\">";
        echo "<fieldset>";
        echo "<legend><em>".$login."</em></legend>";
        echo "<p>";
        echo "<label for=\"name\">".$login_name."</label><br/><input type=\"text\" id=\"name\" name=\"name\" /><br/>";
        echo "<label for=\"psw\">".$login_psw."</label><br/><input type=\"password\" id=\"psw\" name=\"psw\" /><br/>";
        echo "<input type=\"submit\" value=\"".$submit."\" />";
        echo "</fieldset></p></form>";
        if(isset($site)){echo "<p><a href=\"".$site."\">".$retour_site."</a></p>";}
    }
    
    echo "</div></body></html>";
}

?>
