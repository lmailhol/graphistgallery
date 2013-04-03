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
 
// Hello world

#####################################
########## Include/Require ##########
#####################################

require("config.php");
require($rep_lang.$lang.".php");
if(file_exists("".$rep_resources."template/".$style."/config_".$style.".php")){
    require("".$rep_resources."template/".$style."/config_".$style.".php");
}

###############################
########## Fonctions ##########
###############################

//Display the pictures

function display_pic($dir, $dir2, $folder_number) { // The first dir and the second (if it exist) 

    require("default_config.php");    
    require("config.php");
    require($rep_lang.$lang.".php");
    $config = $pictures_view;
    if($folder_number==1) {
        $folder_number="";
        $folder_number_url="";
    } else {
        $folder_number_url="content=".$folder_number."&amp;";
    }
    	
    $suppr=array(".","..");
    if(!in_array($dir, $suppr) AND !in_array($dir2, $suppr) AND !preg_match("#../#",$dir) AND !preg_match("#../#",$dir2)) {
    $dir_img=$folder_number.$rep_content.$dir."/".$dir2."/";
    if($pic_folder=@opendir($dir_img)) { //If config != 0, import the view corresponding to the chosen number selected in config.php. Else, list view
        if(isset($config) AND $config!=0) {  
            include("".$rep_resources."views/view-".$config.".php");
        } else {
        while(false !== ($fichier=readdir($pic_folder))) {
            if(!in_array($fichier,$suppr) AND !preg_match("#.txt#",$fichier) AND !preg_match("#.txt#",$fichier)) {
                $link=$dir_img."/".$fichier;
                if(file_exists($link)) {
                    
                    if(!empty($dir2)) {$dir2_url="dir2=".$dir2."&amp;";} else {$dir2_url="";}
                    echo "<a href=\"index.php?dir=".$dir."&amp;".$dir2_url.$folder_number_url."img=".$fichier."\"><img src=\"" . $link . "\" alt=\"" . $link . "\"/><br /></a>";
                    if(comment_img_exist($link)==1) {
                        echo "<div id=\"single_img_comment\">";
                            show_img_comment($link);
                        echo "</div><br/><br/>";
                    }
                    
                }
            }
        }
        }
        closedir($pic_folder);
    } else {
        echo $erreur;
    }
} else {
	echo $erreur;
}
}

function display_one_pic($dir, $dir2, $folder_number, $img) {
    
    require("default_config.php");    
    require("config.php");
    require($rep_lang.$lang.".php");
    if($folder_number==1) {
        $folder_number="";
        $folder_number_url="";
    } else {
        $folder_number_url="content=".$folder_number."&amp;";
    }
    $suppr=array(".","..");
     
    if(!in_array($dir, $suppr) AND !in_array($dir2, $suppr) AND !preg_match("#../#",$dir) AND !preg_match("#../#",$dir2)) {
        $link_img=$folder_number.$rep_content.$dir."/".$dir2."/".$img;
        if(file_exists($link_img)) {
            echo "<a href=\"".$link_img."\"><img src=\"" . $link_img . "\" alt=\"" . $link . "\"/><br /></a>";
            if(comment_img_exist($link)==1) {
                echo "<div class=\"single_img_comment\">";
                    show_img_comment($link);
                echo "</div>";
            }
            if(!empty($dir2)) {$dir2_url="&amp;dir2=".$dir2."&amp;";} else {$dir2_url="";}
            
            if(comment_img_exist($link_img)==1) {
                echo "<div id=\"single_img_comment\">";
                show_img_comment($link_img);
                echo "</div>";
            }
            
            echo "<div class=\"exif_display\">";
            $exif_data_tab = exif_img($link_img);
            
            foreach($exif_data_tab as $exif_data) {
                echo $exif_data . "<br />";
            }

            echo "</div>";
                
            echo "<div class=\"single_img_retour\">";
            echo "<br/><br/><a href=\"index.php?dir=".$dir.$dir2_url.$folder_number_url."\">Retour aux images</a>";
            echo "</div>";
        }
    }
}

//Showing a static page

function display_page($page) {
    
    require("config.php");
    require("default_config.php");    
    require($rep_lang.$lang.".php");
    
    $suppr=array(".","..");
    if(!in_array($page, $suppr) AND !preg_match("#../#",$page)) {
		if(file_exists($rep_pages.$page)) { //On vérifie si le fichier correspondant à la page existe
            $page_file=file_get_contents($rep_pages.$page);
            echo nl2br($page_file);
		} else {
			echo $erreur;
		}
	} else {
		echo $erreur;
	}
}

//Template functions

//Import the differents files that Graphist Gallery need (css, js, etc.)

function show_head() {
    
    require("config.php");
    require("default_config.php");
    if($include_jquery!=0){echo "<script type=\"text/javascript\" src=\"".$rep_resources."js/jquery.js\"></script>";}
    if($pictures_view!=0){echo "<script type=\"text/javascript\" src=\"".$rep_resources."views/view-".$pictures_view.".js\"></script>\n"; }
    if($pictures_view!=0){echo "<link rel=\"StyleSheet\" href=\"".$rep_resources."views/view-".$pictures_view.".css\" type=\"text/css\" media=\"all\" />\n";}
    echo "<link rel=\"StyleSheet\" href=\"".$rep_resources."template/".$style."/".$style.".css\" type=\"text/css\" media=\"all\" />\n";   
}

//Show the body code

function show_body() {
    
    require("config.php");   
    require("default_config.php");

    if(isset($_GET['dir']) OR isset($_GET['dir2'])) { //Display pictures ?...
    
        $dir=htmlspecialchars(($_GET['dir']));
		$dir2=htmlspecialchars(($_GET['dir2']));
        if(isset($_GET['content'])){$folder_number=htmlspecialchars(($_GET['content']));} else {$folder_number=1;}

        if(isset($_GET['img'])) {
            $img=htmlspecialchars(($_GET['img']));
            display_one_pic($dir, $dir2, $folder_number, $img); 
        } else {
            display_pic($dir, $dir2, $folder_number);
        }
    
    } elseif(isset($_GET['page'])) { //... a static page ?...
    
        $page=htmlspecialchars(($_GET['page']));
    
        display_page($page);
    } else { //... or the index page ?
    
        $page=$index;
        if(file_exists($rep_pages.$page)) {
            $page=file_get_contents($rep_pages.$page);
            echo nl2br($page);
        } else {
            echo $erreur;
        }
    }
}

//Listing the statics pages (folder "pages/")

function show_pages($f_ul, $f_li) { //Set the first ul class and the first li class
	
    require("config.php");
    require($rep_lang.$lang.".php");
    require("default_config.php");
    
    $suppr=array(".","..","comment.txt", $index);
    
	echo "<ul class=\"".$f_ul."\" >";    
	if($dir_pages=opendir($rep_pages)) {
        echo "<li class=\"".$f_li."\"><a href=\"index.php?page=".$index."\">".ucfirst(str_replace('_','&nbsp;',$index))."</a></li>"; //Show the index page in first
		$pages=array("");
        while(false !== ($f_pages=readdir($dir_pages))) {
			if(!in_array($f_pages, $suppr)) {
                array_push($pages, $f_pages);
			}
		}
        sort($pages);
        foreach($pages as $page_url) {
            if($page_url != NULL) {
                echo "<li class=\"".$f_li."\"><a href=\"index.php?page=".$page_url."\">".ucfirst(str_replace('_','&nbsp;',$page_url))."</a></li>";
            }
        }
	} else {
		echo $erreur;
	}
	echo "</ul>";
}

//Listing the categories and sub-categories (folder "contenu/")

function show_categories($f_ul, $f_li_sr, $f_li, $s_ul, $s_li, $folder_number) { //You can set the : first_ul class, first_li_class when there are sub-folders, first_li class when there are no sub-folders, second_ul class and second_li class
	
    require("default_config.php");
    require("config.php");
    require($rep_lang."/".$lang.".php");
     
    $suppr=array(".","..","comment.txt");
    if($folder_number==1){$folder_number="";}
    echo "<ul class=\"".$f_ul."\">";
    if($dir=opendir($folder_number.$rep_content)) { //If you have more than one "content/" folder, it will open <folder number (1,2,3...)>content/
    while(false !== ($f = readdir($dir))) { //One reads the content folder
        if(is_dir($folder_number.$rep_content.$f) AND !in_array($f, $suppr)) {
            $sub_rep = $folder_number.$rep_content.$f."/";
            if($sub_dir = opendir($sub_rep)) {
                $i = ""; //One initializes the variable i ← NULL. Like that, the folders will be displayed only once.
                while(false !== ($sf = readdir($sub_dir))) {
                    if(is_dir($sub_rep.$sf) AND !in_array($sf, $suppr) AND $i==NULL) { //One checks if the parent-folder countains sub-categories. If i not null, one doesn't re-run the condition to not display the same folder multiple times.
                    echo "<li class=\"".$f_li_sr."\"><span>\n".ucfirst(strtolower(trim($f)))."</span>";
                    echo "\n <ul class=\"".$s_ul."\">\n";
                    if(isset($open)==isset($_GET['open'])){unset($open);}
                    $sub_rep2 = $folder_number.$rep_content.$f."/";
                        if($LastDir = opendir($sub_rep2)) {
                        while (false !== ($lsf = readdir($LastDir))) { //Now, loop to display the subfolders
                            if(!in_array($lsf, $suppr)) {
                                if($folder_number!=""){$folder_number_url="content=".$folder_number."&amp;";} else {$folder_number_url="";} //If the content folder is not the first one, one send the number in the url
                                echo "<li class=\"".$s_li."\"><a href=\"index.php?dir=".$f."&amp;dir2=".$lsf."&amp;".$folder_number_url."\">".ucfirst(strtolower(trim($lsf)))."</a></li>\n";
                                $i=1; //One allocates a value to i. i not NULL now : the condition will be false.
                            }
                        }        
                        closedir($LastDir);
                        } else {
                           echo $erreur;
                        }
                        echo "</ul>\n";
                        echo "</li>\n";
                    } elseif(is_file($sub_rep.$sf) AND $i==NULL) { //If instead of subfolder, they are files in the parent folder, one shows a direct link
                        if($folder_number!=""){$folder_number_url="&amp;content=".$folder_number;} else {$folder_number_url="";}
                        echo "<li class=\"".$f_li."\"><a href=\"index.php?dir=".$f."".$folder_number_url."\">".ucfirst(strtolower(trim($f)))."</a></li>\n"; 
                        $i=1;
                    }
                }
                closedir($sub_dir);
            } else {
                echo $erreur;
            }
        }
    }
    closedir($dir);
    echo "</ul>";
    } else {
        echo $erreur;
    }
}

function comment_exist() {

    require("config.php");  
    require("default_config.php");
    
    if(isset($_GET['dir']) OR isset($_GET['dir2'])) {
        if(isset($_GET['content'])){$folder_number=htmlspecialchars(($_GET['content']));}
        $rep_comment = $folder_number.$rep_content.htmlspecialchars(($_GET['dir']))."/".htmlspecialchars(($_GET['dir2']));
        if(file_exists($rep_comment."/comment.txt")) {
            return 1;
        } else {
            return 0;
        }
    }

}
//Showing the comments for a picture list, if they exits

function show_comment() {
    
    require("config.php");  
    require("default_config.php");
    if(isset($_GET['dir']) OR isset($_GET['dir2'])) {
        if(isset($_GET['content'])){$folder_number=htmlspecialchars(($_GET['content']));}

        $rep_comment = $folder_number.$rep_content.htmlspecialchars(($_GET['dir']))."/".htmlspecialchars(($_GET['dir2']));
	
        echo "<p>";
        $comment = fopen($rep_comment."/comment.txt", "r+");
        while($ligne = fgets($comment)) {
            echo $ligne; //One shows the comment
        }
        fclose($comment);
        echo "</p>";
    }
}

//Check if a comment exist for a single picture

function comment_img_exist($img_link) { //Take the link of the picture in arg
    
    if(file_exists($img_link.".txt")) {
        return 1;
    } else {
        return 0;
    }

}

//Showing the comments for one picture, if it exits

function show_img_comment($img_link) { //Take the link of the picture in arg
    
    echo "<p>";
    $comment_img = fopen($img_link.".txt", "r+");
    while($ligne = fgets($comment_img)) {
        echo $ligne; //One shows the comment
    }
    fclose($comment_img);
    echo "</p>";
    
}

function exif_img($img_link) {
    
    require("config.php");  
    require("default_config.php");
    require($rep_lang."/".$lang.".php");
    
    if($show_exif_data==1) {
    
    if(in_array(strtolower(end(explode('.', $img_link))), array('jpg', 'jpeg', 'tif', 'tiff'))) { //If the image is a jpg or a tiff file
        if($exif = exif_read_data($img_link, EXIF, true)) { //Check if there are exif data
            foreach ($exif as $key => $section) {       
                foreach ($section as $name => $value) {
                    $exif_tab[$name] .= $value;
                }
            }
        }
    }

    $exif_data_tab=array("");

    if($show_exif_make==1 AND $exif_tab['Make']) {// Marque de l'appareil
        $make = $exif_tab['Make'];
        array_push($exif_data_tab, $exif_make.$make);
    }
    if($show_exif_model==1 AND $exif_tab['Model']) {// Modèle de l'appareil
        $model = $exif_tab['Model'];
        array_push($exif_data_tab, $exif_model.$model);
    }
    if($show_exif_aperture==1 AND $exif_tab['ApertureFNumber']) {// Vitesse d'obturation
        $aperture = $exif_tab['ApertureFNumber'];
        array_push($exif_data_tab, $exif_aperture.$aperture);
    }
    if($show_exif_exposure==1 AND $exif_tab['ExposureTime']) {// Vitesse d'obturation
        $exposure = $exif_tab['ExposureTime'];
        array_push($exif_data_tab, $exif_exposure.$exposure);
    }
    if($show_exif_iso==1 AND $exif_tab['ISOSpeedRatings']) {// Valeur iso 
        $iso = $exif_tab['ISOSpeedRatings'];
        array_push($exif_data_tab, $exif_iso.$iso);
    }
    if($show_exif_date==1 AND $exif_tab['DateTimeOriginal']) {
        $date = $exif_tab['DateTimeOriginal'];
        array_push($exif_data_tab, $date);
    }
    return $exif_data_tab;
    }
}

##########################
########## Body ##########
##########################

require("default_config.php");
$path_style = $rep_resources."template/".$style."/";

if(isset($style) AND file_exists("".$rep_resources."/template/".$style."/".$style.".php")){
    include("".$rep_resources."template/".$style."/".$style.".php");
} else { 
    $style="bleu";
    if(file_exists("".$rep_resources."template/".$style."/".$style.".php")) {
        include("".$rep_resources."template/".$style."/".$style.".php");
    } else {
        echo $error_template;
    }
}
?>


		

