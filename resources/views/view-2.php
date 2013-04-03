<?php

echo "<div id=\"galerie\">";
echo "<ul id=\"thumbs\">"; 
while(false !== ($file=readdir($pic_folder))) {
    if(!in_array($file,$suppr) AND !preg_match("#.txt#",$file) AND !preg_match("#.txt#",$file)) {
            $link=$dir_img."/".$file;
        if(file_exists($link)) {
            echo"<li>";
            echo"<a href=\"" . $link . "\"><img src=\"" . $link . "\" alt=\"" . $link . "\" height=\"". $thumbnail_size ."\"\"/></a>";
            echo"</li>";
        }
    }
}       
echo "</ul> ";

?>
