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

################
### Messages ###
################

$erreur             ="Une erreur s'est produite. Veuillez recommencer. Si le problème persiste, contactez l'administrateur";

##########
## Exif ##
##########

$exif_make="Marque : ";
$exif_model="Modèle : ";
$exif_aperture="Ouverture : ";
$exif_exposure="Exposition : ";
$exif_iso="ISO : ";

#############
### Admin ###
#############

### Other

$pages_admin       ="Administrez vos écrits";
$config_admin      ="Configurez votre site";
$template_admin    ="Configurer votre th&egrave;me";
$login_name        ="Nom d'utilisateur :";
$login_psw         ="Mot de passe :";
$login             ="Authentifiez vous pour acc&eacute;der &agrave; l'administration";
$login_done        ="Authentification r&eacute;ussie";
$recharger         ="Recharger la page";
$retour_index      ="Index Admin";
$deconnexion       ="Deconnexion";
$deco_done         ="Vous &ecirc;tes maintenant deconnect&eacute;";
$erreur_deco       ="Vous n'êtes pas connect&eacute;";
$retour_site       ="Retour au site";
$retour            ="Retour";
$modif             ="Modifier";
$suppression       ="Supprimer";
$submit            ="Valider";
$publication       ="Publier";
$admin_menu        ="Menu d'administration";
$auth_text         ="Bienvenue sur l'interface d'administration de Graphist Gallery. Vous pouvez dès à présent vous connecter avec vos identifiants pour gérer votre site.";

### Messages

$suppr_sur         ="Êtes vous sur de vouloir supprimer cette page ?";
$ajout_page_done   ="Votre page a &eacute;t&eacute; ajout&eacute;e avec succès";
$add_comment_done  ="Votre commentaire a été ajouté avec succès";
$modif_page_done   ="Votre modification a &eacute;t&eacute; effectu&eacute;e";
$modif_config_done ="La nouvelle configuration est enregistrée";
$modif_template_done="Votre fichier de thème a été modifié";
$modif_comment_done="Votre commentaire a été modifié";
$suppr_page_done   ="Votre supression a &eacute;t&eacute; effectu&eacute;e";
$suppr_comment_done="Vous avez bien supprimé le commentaire";
$non_modif_page    ="Votre page n'a pas &eacute;t&eacute; supprimée.";
$modif_config_done ="La configuration a bien été modifiée.";

### Error

$error_template    ="Aucun thème ne peut être utilisé, veuillez en installer un";
$admin_error_pages ="Un erreur s'est produite lors de la manipulation des pages";
$erreur_ajout_page ="Une erreur s'est produite lors de l'ajout de votre page";
$erreur_modif_page ="Une erreur s'est produite lors de la modification de votre page";
$erreur_modif_config ="Une erreur s'est produite lors de la modification de la configuration";  
$erreur_suppr_page ="Une erreur s'est produite lors de la suppression de votre page";
$erreur_login      ="Mot de passe ou identifiant erron&eacute;";

#### Buttons

$pages_admin_button ="Pages";
$config_admin_button ="Configuration";
$template_admin_button ="Template";

### Page administration

$comment_text="Vous pouvez aussi éditer les divers commentaires attribués à un média ou un dossier entier, il vous suffit de retourner sur votre site et de cliquer sur le boutton \"Edit\" affiché en dessous du commentaire choisi.";
$page_text="Choisissez dans le tableau la page que vous souhaitez éditer ou ajoutez en une puis écrivez le contenu de cette dernière en Markdown.";
$form_name         ="Nom du fichier :";
$form_name_modif   ="Nom du fichier (vous pouvez le modifier) :";
$form_info_content ="Rentrez ici le contenu de votre page en Markdown !";
$form_info_name    ="Rentrez ici le nom du fichier en veillant &agrave; remplacer les espaces par des underscores \"_\"";
$ajout_page        ="Ajouter une page";


### Index administration

$admin_welcome     ="Bienvenue sur l'interface d'administration de Graphist Gallery !";
$admin_features    ="Fonctionnalités de Graphist Gallery";
$admin_features2   ="<li>Afficher des photos et des vidéos classées dans une arborescence de dossier</li><li>Commenter tout un dossier ou un média individuel</li><li>Gérer des pages statiques</li><li>S'adapter très facilement à tout type de thème</li><li><a href=\"help.php\">Et plus encore...</a></li>";
$admin_version     ="Version";
$admin_version2    ="Vous utilisez actuellement la la v1.0 (dev) de Graphist Gallery. N'hésitez pas à vous rendre sur le <a href=\"http://radek411.github.io/graphistgallery\">site du projet</a> pour vérifier l'arrivée de nouveautés.";

### Configuration

$config_text="Vous pouvez configurer les informations principales de votre site grâce à ce formulaire.";
$info_modif_config ="Editez votre <em>config.php</em>";
$admin_config_site ="Vous pouvez configurer certaines fonctions avancées de votre site gr&acirc;ce au fichier <em>config.php</em>. Ne l'éditez qu'en sachant ce que vous comptez faire.";
$site_name ="Nom du site";
$site_url="Url du site";
$site_index="Page d'accueil";
$site_user="Nom de l'utilisateur";
$site_password="Mot de passe";
$site_footer="Footer de votre site";
$site_lang="Langue de l'interface";
$site_template="Thème du site";

### Template

$info_theme        ="Vous utilisez actuellement le thème : ";
$info_config_theme ="Vous pouvez dès que vous le souhaiter modifier les fichiers relatifs au thème : ";
$admin_config_theme="Vous pouvez éditer ici les fichiers de votre thème.";

### Help

$admin_help="Aide";
$admin_help2="Bienvenue dans l'aide de Graphist Gallery. Dans l'état actuel des choses, l'utilisation de Graphist Gallery est très simple mais nécessite un minimum de connaissances. Si vous êtes bloqués sur un quelconque point, vous devriez pouvoir trouver ici le bon endroit à consulter dans la documentation du projet.";

### About

$admin_about="A propos de Graphist Gallery";
$admin_about2="Graphist Gallery est un logiciel libre sous licence Gnu/GPL maintenu par <a href=\"http://lucamailhol.fr\">Luca Mailhol</a>.";
$admin_credits="Crédits";
$admin_credits2="Le logo de Graphist Gallery a été dessiné par <a href=\"http://jeromederieux.fr\">Jérôme Derieux</a>. Le thème de l'administration est basé sur <a href=\"http://purecss.io/\">PureCSS</a>. Les icones de l'éditeur de texte ont été dessinées par Luca Mailhol, les autres proviennent du projet <a href=\"http://fortawesome.github.io/Font-Awesome/\">Font Awesome</a>.";
?>
