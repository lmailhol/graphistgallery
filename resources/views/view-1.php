<?php

echo "<div id=\"galerie\">";
echo "<ul id=\"thumbs\">"; 
$i=1;
while(false !== ($file=readdir($pic_folder))) {
    if(!in_array($file,$suppr) AND !preg_match("#.txt#",$file) AND !preg_match("#.txt#",$file)) {
            $link=$dir_img."/".$file;
        if(file_exists($link)) {
            echo"<li>";
            echo"&nbsp;&nbsp;&nbsp;<a href=\"" . $link . "\">&brvbar;&nbsp;".$i."&nbsp;&brvbar;</a>&nbsp;&nbsp;&nbsp;";
            echo"</li>";
            $i++;
        }
    }
}       
echo "</ul>";
echo "</div>";

?>
