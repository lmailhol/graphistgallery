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

function no_extension($file) {
    $dot = strpos($file, '.');
    $noex_file = substr($file, 0, $dot);
    return $noex_file;
}

function add_page($nom_fichier,$contenu_page) {
    require("../default_config.php");
    require("../config.php");
    require("../".$rep_lang.$lang.".php");

    if(!isset($admin_rep_pages)){$admin_rep_pages="../".$rep_pages."";}
    
    if($nom_fichier != "" AND $nouvelle_page = fopen($admin_rep_pages.$nom_fichier, "a+")) {
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
    
    if(!isset($admin_rep_pages)){$admin_rep_pages="../".$rep_pages;}
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
    
    if(!isset($admin_rep_pages)){$admin_rep_pages="../".$rep_pages;}
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
    if($dir_pages=opendir("../".$rep_pages)) {
        while (false !== ($pages = readdir($dir_pages))) {
            if(!in_array($pages, $suppr)) {
                echo "<tbody><tr>";
                echo "<td>". $pages ."</td>";
                echo "<td><a href=\"admin_pages.php?fichier=". $pages ."&amp;action=modif\"><img src=\"../".$rep_img."modif.png\" class=\"button\" title=\"".$modif."\" alt=\"".$modif."\" /></a></td>";
                if($pages==$index){ echo"<td>X</td>";} else {echo "<td><a href=\"admin_pages.php?fichier=". $pages ."&amp;action=suppr\"><img src=\"../".$rep_img."suppr.png\" title=\"".$suppression."\" class=\"button\" alt=\"".$suppression."\" /></a></td>";}
                echo "</tr></tbody>";
            }
        }
    } else {
        echo $erreur;
    }
    closedir($dir_pages);
}

function show_form_list_pages() {
    require("../default_config.php");
    require("../config.php");
    $suppr=array(".", "..");
    if($dir_pages=opendir("../".$rep_pages)) {
        while (false !== ($pages = readdir($dir_pages))) {
            if(!in_array($pages, $suppr)) {
                if($pages==$index) {$selected_page='selected="selected"';} else {$selected_page='';}
                echo "<option ".$selected_page." value=\"".$pages."\">".$pages."</option>";
            }
        }
    } else {
        echo $erreur;
    }
    closedir($dir_pages);
}

function show_languages() {
    require("../default_config.php");
    require("../config.php");
    $suppr=array(".", "..");
    if($dir_lang=opendir("../".$rep_lang)) {
        while (false !== ($languages = readdir($dir_lang))) {
            if(!in_array($languages, $suppr)) {
                if(no_extension($languages)==$lang) {$selected_language='selected="selected"';} else {$selected_language='';}
                echo "<option ".$selected_language." value=\"".no_extension($languages)."\">".no_extension($languages)."</option>";
            }
        }
    } else {
        echo $erreur;
    }
    closedir($dir_lang);
}

function show_themes() {
    require("../default_config.php");
    require("../config.php");
    $suppr=array(".", "..");
    if($dir_themes=opendir("../".$rep_resources."template/")) {
        while (false !== ($themes = readdir($dir_themes))) {
            if(!in_array($themes, $suppr)) {
                if($themes==$style) {$selected_theme='selected="selected"';} else {$selected_theme='';}
                echo "<option ".$selected_theme." value=\"".$themes."\">".$themes."</option>";
            }
        }
    } else {
        echo $erreur;
    }
    closedir($dir_themes);
}


function admin_connection() {
    
    require("../default_config.php");
    require("../config.php");
    require("../".$rep_lang.$lang.".php");
    
    echo'<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentification &ndash; Graphist Gallery</title>
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
<div class="content"><h2 class="content-subhead">Administration</h2> 
<p>'.$auth_text.'</p><div class="l-centered">';
    
    if(isset($_POST['name']) AND isset($_POST['psw'])) {
        if($_POST['name']==$user AND $_POST['psw']==$psw) {
            $_SESSION['name']=htmlspecialchars($_POST['name']);
            $_SESSION['psw']=htmlspecialchars($_POST['psw']);
            echo "<div class=\"box\">";
            echo $login_done."<br/>";
            echo "<a class=\"pure-button\" href=\"index.php\">".$recharger."</a>";
            echo "</div>";
        } else {
            echo "<div class=\"box\">";
            echo $erreur_login."<br/>";
            echo "<a class=\"pure-button\" href=\"index.php\">".$recharger."</a>";
            echo "</div>";
        }
    } else {
        echo "<div class=\"pure-form pure-form-aligned\">";
        echo "<form action=\"index.php\" method=\"post\">";
        echo "<fieldset>";
        echo "<legend>".$login."</legend>";
        echo "<div class=\"pure-control-group\"><label for=\"name\"><i class=\"icon-user\"></i>&nbsp;&nbsp;".$login_name."</label><input type=\"text\" id=\"name\" name=\"name\" /></div>";
        echo "<div class=\"pure-control-group\"><label for=\"psw\"><i class=\"icon-unlock\"></i>&nbsp;&nbsp;".$login_psw."</label><input type=\"password\" id=\"psw\" name=\"psw\" /></div>";
        echo "<button type=\"submit\" class=\"pure-button pure-button-primary\">".$submit."</button>";
        echo "</fieldset></form>";
    }
    echo '</div>
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
}

function write_config($name,$url,$index,$lang,$footer,$user,$psw,$style) {    
    $config = fopen("../config.php", "w+");
    $modif_config='
    <?php
// If you don\'t understand this file, read the documentation : http://codingteam.net/project/gallery/doc
// Si vous ne comprenez pas ce fichier, référez vous à la documentation : http://codingteam.net/project/gallery/doc

$style = "'.$style.'"; // Choose your template
$lang ="'.$lang.'"; //FR_fr, EN_us
$index ="'.$index.'"; //Name of your index page. You can change it by the name of a page who exist (folder pages/)
$title ="'.$name.'"; //Website\'s title
$footer_text ="'.$footer.'"; //Website\'s footer
$site ="'.$url.'"; //Website\'s URL
$user ="'.$user.'"; //Your admin username
$psw ="'.$psw.'"; //Your admin password

$show_exif_data =1; #1 - Show the exif data, 0 - Don\'t show

$rep_content ="content/"; //The path to the content directory (from the site root)
$rep_pages ="pages/"; //The path to the static pages directory (from the site root)
$rep_lang ="lang/"; //The path to the langs directory (from the site root)
$rep_img ="img/"; //The path to the images directory (from the site root)
$rep_resources ="resources/"; //The path to the resources directory (from the site root)
?>';
    fputs($config, $modif_config);
    fclose($config);
}

?>
