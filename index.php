<?php
require("default_config.php");
require("config.php");
require($rep_lang.$lang.".php");

include $rep_resources."lib/rain.tpl.class.php"; //include Rain TPL
raintpl::$tpl_dir = $rep_resources."template/".$style."/"; // template directory
raintpl::$cache_dir = "cache/"; // cache directory

$tpl = new raintpl(); //include Rain TPL
$tpl->assign( 'message', 'Hello World!' );

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

function no_extension($file) {
    $dot = strpos($file, '.');
    $noex_file = substr($file, 0, $dot);
    return $noex_file;
}

//Display the pictures

function display_pic($dir, $dir2, $folder_number) { // The first dir and the second (if it exist) 

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
    $dir_img=$folder_number.$rep_content.$dir."/".$dir2."/";
    if($pic_folder=scandir($dir_img)) {
        $pic_folder = array_diff($pic_folder, $suppr);
        //while(false !== ($fichier=readdir($pic_folder))) {
        foreach($pic_folder as $fichier) {
            if(!preg_match("#.md#",$fichier) AND !preg_match("#.md#",$fichier)) {
                $link=$dir_img."/".$fichier;
                if(file_exists($link)) {
                                        
                    if(!empty($dir2)) {$dir2_url="dir2=".$dir2."&amp;";} else {$dir2_url="";}
                                        
                    if(preg_match("#video#",$fichier)) { //check if the file is a video or a picture
                        if(!isset($bck_name)) { //if it's a new video
                            display_video($dir_img, $fichier);
                            $bck_name=no_extension($fichier); //create a bck var to remember the name of the video and don't include the other version (webm, mp4...)                            
                        } elseif($bck_name!=no_extension($fichier)) { //check if the file is a new video, despite of the bck var
                            display_video($dir_img, $fichier);
                        }
                    } else {
                        echo "<a href=\"index.php?dir=".$dir."&amp;".$dir2_url.$folder_number_url."img=".$fichier."\"><img src=\"" . $link . "\" alt=\"" . $link . "\"/><br /></a>";            
                    }
                    
                    if(comment_img_exist($link)==1) { //if there is a single-image comment
                        //echo $before;
                            show_img_comment($link, $fichier);
                        //echo $after;
                    } else { //else, create one
                        //echo $before;
                            create_img_comment($dir."&amp;".$dir2_url.$folder_number_url, $link);
                        //echo $after;
                    }
                }
            }
        }
        //closedir($pic_folder);
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
            echo "<a href=\"".$link_img."\"><img src=\"" . $link_img . "\" alt=\"" . $link_img . "\"/><br /></a>";

            if(!empty($dir2)) {$dir2_url="&amp;dir2=".$dir2."&amp;";} else {$dir2_url="";}
            
            if(comment_img_exist($link_img)==1) {
                //echo $before;
                show_img_comment($link_img, $img);
                //echo $after;
            }
            if($show_exif_data==1) {
                echo "<div class=\"exif_display\">";
                $exif_data_tab = exif_img($link_img);
            
                foreach($exif_data_tab as $exif_data) {
                    echo $exif_data . "<br />";
                }
                echo "</div>";
            }
            echo "<div class=\"single_img_retour\">";
            echo "<br/><br/><a href=\"index.php?dir=".$dir.$dir2_url.$folder_number_url."\">Retour aux images</a>";
            echo "</div>";
        }
    }
}

//Display a video from an other website or not

function display_video($link, $fichier) {
    if(!preg_match("#.webm#",$fichier) AND !preg_match("#.mp4#",$fichier) AND !preg_match("#.ogv#",$fichier)) {
        $video_link = file_get_contents($link."/".$fichier);
        echo $video_link;
    } else {
        echo "<video controls=\"controls\">";
        $noex_fichier = no_extension($fichier);
        if(file_exists($link."/".$noex_fichier.".mp4")) { echo "<source src=\"".$link."/".$noex_fichier.".mp4\" type=\"video/mp4\" />"; }
        if(file_exists($link."/".$noex_fichier.".webm")) { echo "<source src=\"".$link."/".$noex_fichier.".webm\" type=\"video/webm\" />"; }
        if(file_exists($link."/".$noex_fichier.".ogv")) { echo "<source src=\"".$link."/".$noex_fichier.".ogv\" type=\"video/ogg\" />"; }
        echo "</video>";
    }
}

//Showing a static page

function display_page($page) {
    
    require("config.php");
    require("default_config.php");    
    require($rep_lang.$lang.".php");
    require_once($rep_resources."lib/Markdown.php");
    
    $suppr=array(".","..");
    if(!in_array($page, $suppr) AND !preg_match("#../#",$page)) {
		if(file_exists($rep_pages.$page)) { //On vérifie si le fichier correspondant à la page existe
            $page_file=Markdown(file_get_contents($rep_pages.$page));
            echo $page_file;
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
}

//Show the body code

function show_body() {
    
    require("config.php");   
    require("default_config.php");
    require_once($rep_resources."lib/Markdown.php");
    require($rep_lang.$lang.".php");

    if(isset($_GET['dir']) OR isset($_GET['dir2'])) { //Display pictures ?...
    
        $dir=htmlspecialchars(($_GET['dir']));
		if(isset($_GET['dir2'])) { $dir2=htmlspecialchars(($_GET['dir2'])); } else { $dir2=''; }
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
            $page=Markdown(file_get_contents($rep_pages.$page));
            echo $page;
        } else {
            echo $erreur;
        }
    }
}

//Listing the categories and sub-categories (folder "contenu/")

function show_categories($f_ul, $f_li_sr, $f_li, $s_ul, $s_li, $folder_number) { //You can set the : first_ul class, first_li_class when there are sub-folders, first_li class when there are no sub-folders, second_ul class and second_li class
	
    require("default_config.php");
    require("config.php");
    require($rep_lang."/".$lang.".php");
     
    $suppr=array(".","..","comment.md");
    if($folder_number==1){$folder_number="";}
    echo "<ul class=\"".$f_ul."\">";
    if($dir=scandir($folder_number.$rep_content)) { //If you have more than one "content/" folder, it will open <folder number (1,2,3...)>content/
    $dir = array_diff($dir, $suppr);
    foreach($dir as $dir_link) {   //One reads the content folder
        if(is_dir($folder_number.$rep_content.$dir_link)) {
            $sub_rep = $folder_number.$rep_content.$dir_link."/";
            if($sub_dir = scandir($sub_rep)) {
                $i = ""; //One initializes the variable i ← NULL. Like that, the folders will be displayed only once.
                $sub_dir =  array_diff($sub_dir, $suppr);
                foreach($sub_dir as $sub_dir_link) {
                    
                    if(preg_match("#^[a-z]+_#", $dir_link)) { //if the name begin w/ [a-z]_, we remove this part of the name (it allows to sort the folders)
                        //$dir_name = substr($dir_link,2);
                        list($null,$dir_name) = explode('_',$dir_link);
                    } else {$dir_name=$dir_link;}
                    
                    if(is_dir($sub_rep.$sub_dir_link) AND $i==NULL) { //One checks if the parent-folder countains sub-categories. If i not null, one doesn't re-run the condition to not display the same folder multiple times.
                        echo "<li class=\"".$f_li_sr."\"><a href=\"#\">\n".trim($dir_name)."</a>";
                        echo "\n <ul class=\"".$s_ul."\">\n";
                        
                        if(isset($open)==isset($_GET['open'])){unset($open);}
                        
                        $sub_rep2 = $folder_number.$rep_content.$dir_link."/";
                        
                        if($LastDir = scandir($sub_rep2)) {
                                $LastDir =  array_diff($LastDir, $suppr);
                                foreach($LastDir as $LastDir_link) {
                                    if($folder_number!=""){$folder_number_url="&amp;content=".$folder_number;} else {$folder_number_url="";} //If the content folder is not the first one, one send the number in the url
                                    if(preg_match("#^[a-z]+_#", $LastDir_link)) { //if the name begin w/ [a-z]_, we remove this part of the name (it allows to sort the folders)
                                        //$LastDir_name = substr($LastDir_link,2);
                                        list($null,$LastDir_name) = explode('_',$LastDir_link);
                                    } else {$LastDir_name=$LastDir_link;}
                                    echo "<li class=\"".$s_li."\"><a href=\"index.php?dir=".$dir_link."&amp;dir2=".$LastDir_link.$folder_number_url."\">".trim($LastDir_name)."</a></li>";
                                    $i=1;
                                }
                            
                        } else {
                           echo $erreur;
                        }
                        echo "</ul>\n";
                        echo "</li>\n";
                    } elseif(is_file($sub_rep.$sub_dir_link) AND $i==NULL) { //If instead of subfolder, they are files in the parent folder, one shows a direct link
                        if($folder_number!=""){$folder_number_url="&amp;content=".$folder_number;} else {$folder_number_url="";}
                        echo "<li class=\"".$f_li."\"><a href=\"index.php?dir=".$dir_link."".$folder_number_url."\">".trim($dir_name)."</a></li>\n"; 
                        $i=1;
                    }
                }
            } else {
                echo $erreur;
            }
        }
    }
    echo "</ul>";
    } else {
        echo $erreur;
    }
}

//checks if there is a comment

function comment_exist() {

    require("config.php");  
    require("default_config.php");
    
    if(isset($_GET['dir']) OR isset($_GET['dir2'])) {
        if(isset($_GET['content'])){$folder_number=htmlspecialchars(($_GET['content']));} else { $folder_number=''; }
        if(isset($_GET['dir2'])) { $dir2=$_GET['dir2']; } else { $dir2=''; }
        
        $rep_comment = $folder_number.$rep_content.htmlspecialchars(($_GET['dir']))."/".htmlspecialchars($dir2);
        if(file_exists($rep_comment."/comment.md")) {
            return 1;
        } else {
            return 2;
        }
    } elseif(isset($_GET['page'])) {
        return 0;
    }

}

//Creation of a comment for a picture list

function create_comment() {
    
    require("config.php");  
    require("default_config.php");
    require($rep_lang."/".$lang.".php");
    
    if(isset($_GET['comment']) AND isset($_SESSION['connection']) AND $_SESSION['connection']==1) {
        if(isset($_GET['dir']) OR isset($_GET['dir2'])){
            if(isset($_GET['content'])){$folder_number=htmlspecialchars(($_GET['content']));} else { $folder_number=''; }
            if(isset($_GET['dir2'])) { $dir2=$_GET['dir2']; } else { $dir2=''; }
            $rep_comment = $folder_number.$rep_content.htmlspecialchars($_GET['dir'])."/".htmlspecialchars($dir2);
            
            if($_GET['comment']=="create") { //if we want to show the textarea to create the comment
                echo "<form action=\"index.php?dir=".$_GET['dir']."&amp;dir2=".$dir2."&amp;".$folder_number."&amp;comment=creation_done\" method=\"post\">";
                echo "<textarea name=\"comment\" id=\"comment\" cols=\"40\" class=\"ed\"></textarea><br/>";
                echo "<input type=\"submit\" value=\"".$modif."\" />";
                echo "</p></form>";
            } elseif($_GET['comment']=="creation_done") { //creation of the comment
                if($comment = fopen($rep_comment."/comment.md", "a+")) {
                        fputs($comment, $_POST['comment']);
                        fclose($comment);
                        echo $add_comment_done."<br/>";   
                }
            }
        }
    } elseif(isset($_SESSION['connection']) AND $_SESSION['connection']==1) {
        echo "<br/><a href=\"".$_SERVER['REQUEST_URI']."&amp;comment=create\" class=\"ajax\">[Create]</a>";
    }
}

//Showing and editing the comments for a picture list, if they exits

function show_comment() {
    
    require("config.php");  
    require("default_config.php");
    require($rep_lang."/".$lang.".php");
    require_once($rep_resources."lib/Markdown.php");
    
    if(isset($_GET['dir']) OR isset($_GET['dir2'])) {
        if(isset($_GET['content'])){$folder_number=htmlspecialchars(($_GET['content']));} else { $folder_number=''; }
        if(isset($_GET['dir2'])) { $dir2=$_GET['dir2']; } else { $dir2=''; }
        
        $rep_comment = $folder_number.$rep_content.htmlspecialchars(($_GET['dir']))."/".htmlspecialchars($dir2);
            
        if(isset($_GET['comment']) AND $_GET['comment']=="edit" AND isset($_SESSION['connection']) AND $_SESSION['connection']==1) {  //edition of the comment            
            echo "<form action=\"index.php?dir=".$_GET['dir']."&amp;dir2=".$dir2."&amp;".$folder_number."&amp;comment=done\" method=\"post\">";
            echo "<textarea name=\"comment\" id=\"comment\" cols=\"40\" class=\"ed\">".file_get_contents($rep_comment."/comment.md")."</textarea><br/>";
            echo "<input type=\"submit\" value=\"".$modif."\" />";
            echo "</p></form>";
        } elseif(isset($_GET['comment']) AND $_GET['comment']=="done" AND isset($_SESSION['connection']) AND $_SESSION['connection']==1) { // if one wanna delete or change the comment
            if(file_exists($rep_comment."/comment.md")) {
                if($_POST['comment']!='') {
                    if($comment = fopen($rep_comment."/comment.md", "w+")) {
                        fputs($comment, $_POST['comment']);
                        fclose($comment);
                        echo $modif_comment_done."<br/>";   
                    }
                } else {
                    unlink($rep_comment."/comment.md");
                    echo $suppr_comment_done."<br/>";
                }
            }
        } else {
	
        echo Markdown(file_get_contents($rep_comment."/comment.md"));
            
        if (isset($_SESSION['connection']) AND $_SESSION['connection']==1) {echo "<br/><a href=\"".$_SERVER['REQUEST_URI']."&amp;comment=edit\" class=\"ajax\">[Edit]</a>";}
        }
    }
}

//Check if a comment exist for a single picture

function comment_img_exist($img_link) { //Take the link of the picture in arg
    
    if(file_exists($img_link.".md")) {
        return 1;
    } else {
        return 0;
    }

}

//Creation of a comment for a single picture

function create_img_comment($link, $img) {
    
    require("config.php");  
    require("default_config.php");
    require($rep_lang."/".$lang.".php");
    
    if(isset($_GET['comment']) AND isset($_SESSION['connection']) AND $_SESSION['connection']==1) {
        if(isset($_GET['dir']) OR isset($_GET['dir2'])){
            if(isset($_GET['content'])){$folder_number=htmlspecialchars(($_GET['content']));} else { $folder_number=''; }
            if(isset($_GET['dir2'])) { $dir2=$_GET['dir2']; } else { $dir2=''; }
            
            if($_GET['comment']=="create_img") { //if we want to show the textarea to create the comment
                echo "<form action=\"index.php?dir=".$_GET['dir']."&amp;dir2=".$dir2."&amp;".$folder_number."&amp;comment=creation_img_done\" method=\"post\">";
                echo "<textarea name=\"comment\" id=\"comment\" cols=\"40\" class=\"ed\"></textarea><br/>";
                echo "<input type=\"submit\" value=\"".$modif."\" />";
                echo "</p></form>";
            } elseif($_GET['comment']=="creation_img_done") { //creation of the comment
                if($comment = fopen($img.".md", "a+")) {
                        fputs($comment, $_POST['comment']);
                        fclose($comment);
                        echo $add_comment_done."<br/>";   
                }
            }
        }
    } elseif(isset($_SESSION['connection']) AND $_SESSION['connection']==1) {
        echo "<br/><a href=\"".$_SERVER['REQUEST_URI']."&amp;comment=create_img\" class=\"ajax\">[Create]</a>";
    }
}


//Showing and editing the comments for one picture, if it exits

function show_img_comment($img_link, $img_name) { //Take the link and the name of the picture in arg
    
    require("config.php");  
    require("default_config.php");
    require($rep_lang."/".$lang.".php");
    require_once($rep_resources."lib/Markdown.php");
    
    if(isset($_GET['dir']) OR isset($_GET['dir2'])) {
        if(isset($_GET['content'])){$folder_number=htmlspecialchars(($_GET['content']));} else { $folder_number=''; }
        if(isset($_GET['dir2'])) { $dir2=$_GET['dir2']; } else { $dir2=''; }
    
        if(isset($_GET['single_comment']) AND isset($_GET['img_name']) AND $_GET['single_comment']=="edit" AND isset($_SESSION['connection']) AND $_SESSION['connection']==1) {  //edition of the comment            
            echo "<form action=\"index.php?dir=".$_GET['dir']."&amp;dir2=".$dir2."&amp;".$folder_number."&amp;single_comment=done&amp;img_name=".$_GET['img_name']."\" method=\"post\">";
            echo "<textarea name=\"comment\" id=\"comment\" cols=\"40\" class=\"ed\">".file_get_contents($img_link.".md")."</textarea><br/>";
            echo "<input type=\"submit\" value=\"".$modif."\" />";
            echo "</p></form>";
        } elseif(isset($_GET['single_comment']) AND isset($_GET['img_name']) AND $_GET['single_comment']=="done" AND isset($_SESSION['connection']) AND $_SESSION['connection']==1) { // if one wanna delete or change the comment
            if(file_exists($img_link.".md")) {
                if($_POST['comment']!='') {
                    if($single_comment = fopen($img_link.".md", "w+")) {
                        fputs($single_comment, $_POST['comment']);
                        fclose($single_comment);
                        echo $modif_comment_done."<br/>";   
                    }
                } else {
                    unlink($img_link.".md");
                    echo $suppr_comment_done."<br/>";
                }
            }
        } else {
    echo Markdown(file_get_contents($img_link.".md"));
        
    if (isset($_SESSION['connection']) AND $_SESSION['connection']==1) {echo "<br/><a href=\"".$_SERVER['REQUEST_URI']."&amp;img_name=".$img_name."&amp;single_comment=edit\" class=\"ajax\">[Edit]</a>";}    
    }
    }
}

//Exif DATA

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

//

##########################
########## Body ##########
##########################

$path_style = $rep_resources."template/".$style."/";

// Showing the pages

$suppr=array(".","..","comment.md");
    
if($dir_pages=scandir($rep_pages)) {
    foreach($dir_pages as $key=>$page_url) {
        if(preg_match("#^[a-z]+_#", $page_url)) { //if the name begin w/ [a-z]_, we remove this part of the name (it allows to sort the pages)
            list($null,$page_name) = explode('_',$page_url);
            $dir_pages[$key]=$page_name;
        }
    }
    $dir_pages = array_diff($dir_pages, $suppr);
    $tpl->assign("pages",$dir_pages); //assign array pages for the template
} else {
	echo $erreur;
}

// Showing the categories




$tpl->draw( 'index' );

?>


		

