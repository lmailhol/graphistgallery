<?php session_start(); 

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
 

if(isset($_SESSION['name']) AND isset($_SESSION['psw'])) {
    $_SESSION['connection']=1;
} else {
    $_SESSION['connection']=0;
}

require("default_config.php");
require("config.php");
require($rep_lang.$lang.".php");
require_once($rep_resources."lib/Markdown.php");

include $rep_resources."lib/rain.tpl.class.php"; //include Rain TPL
raintpl::$tpl_dir = $rep_resources."template/".$style."/"; // template directory
raintpl::$cache_dir = "cache/"; // cache directory
raintpl::configure( 'path_replace', false );

$tpl = new raintpl(); //include Rain TPL

// Hello world

// Some assign
$tpl->assign( 'serv_url', $_SERVER['REQUEST_URI'] );

$tpl->assign( 'title', $title );
$tpl->assign( 'footer_text', $footer_text );
$tpl->assign( 'site_url', $site );
$tpl->assign( 'path_style', $rep_resources."template/".$style );

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

function logged() {
    if(isset($_SESSION['connection']) AND $_SESSION['connection']==1) {return 1;}
    else {return 0;}
}

function no_extension($file) {
    $dot = strpos($file, '.');
    $noex_file = substr($file, 0, $dot);
    return $noex_file;
}

//Return an array with the medias

function display_media($dir_media) { // The first dir and the second (if it exist) 

    require("default_config.php"); 
    require("config.php");
    require($rep_lang.$lang.".php");
    	
    $suppr=array(".","..","comment.md","config.php");
    
    if($media_folder=scandir($dir_media)) {
        $media_folder = array_diff($media_folder, $suppr);
        foreach($media_folder as $key=>$fichier) {
            $media_folder[$key]=$dir_media.$fichier;
        }
        return $media_folder;
    } else {
        echo $erreur;
    }

}

function is_img($var) { //check if the link ($var) is an image or a comment
    if(preg_match("#.md#", $var) OR preg_match("#video#",$var) OR empty($var)) {
        return 0;
    } else {return 1;}
}

function is_vid($var) { //check if the link ($var) is an image or a comment
    if(preg_match("#video#",$var) AND !preg_match("#.md$#",$var)) {
        return 1;
    } else {return 0;}
}

//Display a video from an other website or not

function display_video($link) {
    if(!preg_match("#.webm$#",$link) AND !preg_match("#.mp4$#",$link) AND !preg_match("#.ogv$#",$link)) {
        $video_link = file_get_contents($link);
        echo $video_link;
    } else {
        if(file_exists(no_extension($link).".mp4")) { echo "<source src=\"".no_extension($link).".mp4\" type=\"video/mp4\" />"; }
        if(file_exists(no_extension($link).".webm")) { echo "<source src=\"".no_extension($link).".webm\" type=\"video/webm\" />"; }
        if(file_exists(no_extension($link).".ogv")) { echo "<source src=\"".no_extension($link).".ogv\" type=\"video/ogg\" />"; }
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

//checks if there is a comment

function comment_exist() {

    require("config.php");  
    require("default_config.php");
    
    if(isset($_GET['path'])) {        
        $rep_comment = htmlspecialchars($_GET['path']);
        if(file_exists($rep_comment."/comment.md")) {
            return 1;
        } else {
            return 2;
        }
    } elseif(isset($_GET['page'])) {
        return 0;
    }

}

//Showing and editing the comments for a picture list, if they exits

function show_comment() {
    
    require("config.php");  
    require("default_config.php");
    require_once($rep_resources."lib/Markdown.php");
    
    if(isset($_GET['path'])) {        
        $rep_comment = ($_GET['path']);
        echo Markdown(file_get_contents($rep_comment."/comment.md"));        
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

function create_comment($img_link) {
    
    require("config.php");  
    require("default_config.php");
    require($rep_lang."/".$lang.".php");
    
    //creation of the image-comment
    if(isset($_GET['single_comment']) AND $_GET['single_comment']=="add" AND !isset($_POST['comment'])) {
        
        echo '<form action="index.php?path='.$img_link.'&amp;single_comment=done" method="post">
        <textarea name="comment" id="comment" cols="40"></textarea><br/>
        <input type="hidden" name="path" value="'.$img_link.'" />
        <input type="submit" value="'.$add.'" />';
    
    //modification of the image-comment
    } elseif(isset($_GET['single_comment']) AND $_GET['single_comment']=="edit" AND !isset($_POST['comment'])) {
    
        echo '<form action="index.php?path='.$img_link.'&amp;single_comment=done" method="post">
        <textarea name="comment" id="comment" cols="40">'.file_get_contents($img_link.".md").'</textarea><br/>
        <input type="hidden" name="path" value="'.$img_link.'" />
        <input type="submit" value="'.$modif.'" />';
    
    //creation of the list-comment
    } elseif(isset($_GET['comment']) AND $_GET['comment']=="add" AND !isset($_POST['comment'])) {
        
        echo '<form action="index.php?path='.$img_link.'&amp;comment=done" method="post">
        <textarea name="comment" id="comment" cols="40"></textarea><br/>
        <input type="hidden" name="path" value="'.$img_link.'" />
        <input type="submit" value="'.$add.'" />';
    
    //modification of the list-comment
    } elseif(isset($_GET['comment']) AND $_GET['comment']=="edit" AND !isset($_POST['comment'])) {
        
        echo '<form action="index.php?path='.$img_link.'&amp;comment=done" method="post">
        <textarea name="comment" id="comment" cols="40">'.file_get_contents($img_link."/comment.md").'</textarea><br/>
        <input type="hidden" name="path" value="'.$img_link.'" />
        <input type="submit" value="'.$add.'" />';
    
    //file operations
    } elseif(isset($_POST['comment']) AND !empty($_POST['comment']) AND isset($_GET['comment']) AND isset($_POST['path'])) {
        if($comment = fopen($img_link."/comment.md", "w+")) {
            fputs($comment, $_POST['comment']);
            fclose($comment);
            echo $add_comment_done;
            echo '<br/><a href="index.php?path='.$_POST['path'].'">'.$retour.'</a>';
        }
    } elseif(isset($_POST['comment']) AND !empty($_POST['comment']) AND isset($_GET['single_comment']) AND isset($_POST['path'])) {    
        if($comment = fopen($img_link.".md", "w+")) {
            fputs($comment, $_POST['comment']);
            fclose($comment);
            echo $add_comment_done;
            echo '<br/><a href="index.php?path='.$_POST['path'].'&amp;single">'.$retour.'</a>';
        }
    //suppression of the image-comment
    } elseif(isset($_POST['comment']) AND empty($_POST['comment']) AND isset($_GET['single_comment']) AND isset($_POST['path'])) {
        unlink($img_link.".md");
        echo $suppr_comment_done;
        echo '<br/><a href="index.php?path='.$_POST['path'].'&amp;single">'.$retour.'</a>';
    } elseif(isset($_POST['comment']) AND empty($_POST['comment']) AND isset($_GET['comment']) AND isset($_POST['path'])) {
        unlink($img_link."/comment.md");
        echo $suppr_comment_done;
        echo '<br/><a href="index.php?path='.$_POST['path'].'">'.$retour.'</a>';
    }
}


//Showing and editing the comments for one picture, if it exits

function show_img_comment($img_link) { //Take the link and the name of the picture in arg
    
    require("config.php");  
    require("default_config.php");
    require_once($rep_resources."lib/Markdown.php");
    
    echo Markdown(file_get_contents($img_link.".md"));
}

//Exif DATA

function exif_img($img_link) {
        
    require("config.php");  
    require("default_config.php");
    require($rep_lang."/".$lang.".php");
        
      if($exif_ifd0 = read_exif_data($img_link ,'IFD0' ,0) AND $exif_exif = read_exif_data($img_link ,'EXIF' ,0)) {    
           
      $notFound = "Unavailable";
     
      if (@array_key_exists('Make', $exif_ifd0)) {
        $camMake = $exif_ifd0['Make'];
      } else { $camMake = $notFound; }
     
      // Model
      if (@array_key_exists('Model', $exif_ifd0)) {
        $camModel = $exif_ifd0['Model'];
      } else { $camModel = $notFound; }
     
      // Exposure
      if (@array_key_exists('ExposureTime', $exif_ifd0)) {
        $camExposure = $exif_ifd0['ExposureTime'];
      } else { $camExposure = $notFound; }

      // Aperture
      if (@array_key_exists('ApertureFNumber', $exif_ifd0['COMPUTED'])) {
        $camAperture = $exif_ifd0['COMPUTED']['ApertureFNumber'];
      } else { $camAperture = $notFound; }
     
      // Date
      if (@array_key_exists('DateTime', $exif_ifd0)) {
        $camDate = $exif_ifd0['DateTime'];
      } else { $camDate = $notFound; }
     
      // ISO
      if (@array_key_exists('ISOSpeedRatings',$exif_exif)) {
        $camIso = $exif_exif['ISOSpeedRatings'];
      } else { $camIso = $notFound; }
          
      $return = array();
      $return['make'] = $camMake;
      $return['model'] = $camModel;
      $return['exposure'] = $camExposure;
      $return['aperture'] = $camAperture;
      $return['date'] = $camDate;
      $return['iso'] = $camIso;
      return $return;
          
          
      } else {return 0;}
}

##########################
########## Body ##########
##########################

function name($var) {
    if(preg_match("#/#", $var)) {
            list($null,$var_name) = explode('/',$var);
            
            if(preg_match("#^[a-z]*[_]#", $var_name)) {
                list($null,$var_name) = explode('_',$var_name);
            }
        
            return $var_name;
    } else {
        if(preg_match("#^[a-z]*\_#", $var)) { //if the name begin w/ [a-z]_, we remove this part of the name (it allows to sort the pages)
            list($null,$var_name) = explode('_',$var);
            return $var_name;
    } else {return $var;}
    }
}

function is_sub_dir($var) { //look if there is at least one folder in the folder $var
    require("config.php");  
    require("default_config.php");
    $suppr=array(".","..");
    
    if($dir=scandir($rep_content.$var)){ //basically content/categorie/->
        $dir = array_diff($dir, $suppr);
        foreach($dir as $content) {
            if(is_dir($rep_content.$var."/".$content)) {
                return 1;
            } else {return 0;}
        }
    }
}

function dir_name($var) { //$var : "something/something"
    list($var_name,$null) = explode('/',$var);  
    return $var_name; //$var_name : "something"
    
}

#####################
# Showing the pages #
#####################

$suppr=array(".","..","comment.md");
    
if($dir_pages=scandir($rep_pages)) {
    $dir_pages = array_diff($dir_pages, $suppr);
    $tpl->assign("pages",$dir_pages); //assign array pages for the template
} else {
	echo $erreur;
}

##########################
# Showing the categories #
##########################

$LastDir=array();

if(isset($folder_number) AND $folder_number==1 OR !isset($folder_number)){$folder_number="";}
if($dir=scandir($folder_number.$rep_content)) { //If you have more than one "content/" folder, it will open <folder number (1,2,3...)>content/
        
    $dir = array_diff($dir, $suppr);
        
    foreach($dir as $key=>$dir_link) {

        $sub_rep = $folder_number.$rep_content.$dir_link."/";
        if(is_dir($sub_rep)) {
            if($sub_dir = scandir($sub_rep)) {
                $sub_dir =  array_diff($sub_dir, $suppr);
                
                foreach($sub_dir as $sub_dir_link) {
                    if(is_dir($sub_rep.$sub_dir_link)) {
                        $sub_dir_isset=1;                        
                        array_push($LastDir,$dir_link."/".$sub_dir_link);
                    }
                }
            }
        }
    }
}

$tpl->assign("categories",$dir); //first array of categories   
if(isset($sub_dir_isset) AND $sub_dir_isset==1) {$tpl->assign("categories2",$LastDir);}

#########################
# Showing the main code #
#########################

if(isset($_GET['path']) OR isset($_GET['path']) OR isset($_GET['single'])) { //Display pictures ?...
    if(isset($_GET['path'])) {$tpl->assign("comment_path", htmlspecialchars($_GET['path']));}
    
    if(isset($_GET['path']) AND isset($_GET['single']) AND !isset($_GET['single_comment']) AND !isset($_GET['comment'])) {
        $img_path=htmlspecialchars($_GET['path']);
        $tpl->assign("one_pic",$img_path); //array of image
        if($show_exif_data==1) {
            $exif = exif_img($img_path);
            $tpl->assign("exif",$exif); //array of exifs data
        }
    } elseif(isset($_GET['path']) AND isset($_GET['single_comment']) OR isset($_GET['comment'])) {
        $tpl->assign("add_comment",$_GET['path']); //array of exifs data
    } elseif(isset($_GET['path'])) {
        $path=htmlspecialchars($_GET['path'])."/";
        $medias = display_media($path);
        $tpl->assign("medias",$medias); //array of image
        if(file_exists($path."/config.php")) {include($path."/config.php");}
    } 
} elseif(isset($_GET['page'])) { //... a static page ?...
        $page=htmlspecialchars(($_GET['page']));
        $tpl->assign("page",$page);
} else { //... or the index page ?
    $page=$index;
    $tpl->assign("page",$page);
}

$tpl->draw( 'index' );

?>