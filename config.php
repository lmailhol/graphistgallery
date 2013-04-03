<?php

// If you don't understand this file, read the documentation : http://codingteam.net/project/gallery/doc
// Si vous ne comprenez pas ce fichier, référez vous à la documentation : http://codingteam.net/project/gallery/doc

###########
## Views ##-(Ajust to suit your needs)
###########

$pictures_view      =0; //0 : List view, 2 : Dynamic display with pictures, 1 : Dynamic display with numbers, Other : Personnal view (warning, currently, the views 1 and 2 don't allow comment per image and don't display exif data)
$thumbnail_size     ="50px"; //Defined the size of your thumbnails (if you use the JavaScript display photos (n°2 only (eventually some personnal views))
$style              ="bleu"; //Choose your template. (In the folder : "ressources/template/theme/theme.css")
$include_jquery     =1; //The most of template or views require jquery. But, if you know what you do, you can turn this value to 0 (no jquery)

###################
## Mains folders ##-(Don't change these values (Unless you appoint a different folder))
###################
//Don't forget the "/" if you change the values

$rep_content        ="content/"; //The path to the content directory (from the site root)
$rep_pages          ="pages/"; //The path to the static pages directory (from the site root)
$rep_lang           ="lang/"; //The path to the langs directory (from the site root)
$rep_img            ="img/"; //The path to the images directory (from the site root)
$rep_resources      ="resources/"; //The path to the resources directory (from the site root)

###########
## Other ##-(Adapt)
###########

$lang               ="FR_fr"; //FR_fr, EN_us

#######################
## Site informations ##-(You should change this)
#######################

$index              ="accueil"; //Name of your index page. You can change it by the name of a page who exist (folder pages/)
$title              ="Nouvelle utilisation de Graphist Gallery"; //Website's title
$footer_text        ="Bonjour, je suis un footer, remplacez moi par le texte de votre choix<br/>Propulsé par <a href=\"http://gallery.radek411.org\">Graphist Gallery</a>"; //Website's footer
$site               ="http://gallery.radek411.org"; //Website's URL

####################
## Administration ##-(You have to change this)
####################

$user               ="admin"; //Your admin username
$psw                ="admin"; //Your admin password

##########
## Exif ##-(Ajust to suit your needs)
##########

$show_exif_data     =1; #1 - Show the exif data, 0 - Don't show
$show_exif_make    =1; #1 - Show the make, 0 - Don't
$show_exif_model   =1; #1 - Show the model, 0 - Don't
$show_exif_aperture =1; #1 - Show the aperture, 0 - Don't
$show_exif_exposure =1; #1 - Show the exposure, 0 - Don't
$show_exif_iso     =1; #1 - Show the iso, 0 - Don't
$show_exif_date    =1; #1 - Show the date, 0 - Don't

?>
