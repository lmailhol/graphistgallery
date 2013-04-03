Documentation sur : http://codingteam.net/project/gallery/doc

#### Installation ####

La première chose à faire avant d'installer Graphist Gallery est de télécharger les sources. Pour se faire, rendez vous dans l'onglet téléchargement et téléchargez la dernière version de Graphist Gallery.

Une fois le téléchargement terminé, nous allons détailler son installation via FTP. Pour se faire, il vous faut un hébergement Web PHP. Pour l'exemple qui va suivre, le logiciel utilisé sera le très connu File Zilla. Je ne détaillerai pas son interface ni son utilisation.

À partir de là, deux choix s'offrent à vous, soit vous configurez maintenant Graphist Gallery (rendez vous sur la page appropriée), soit vous le configurerez par la suite. À vous de voir.

Une fois que vous vous êtes connecté à votre FTP, il vous suffit d'y envoyer l'ensemble des sources de Graphist Gallery, soit à la racine de votre hébergement, soit dans un dossier spécifique.

#### Utilisation ####

Catégories et Sous Catégories

Pour ajouter des catégories, c'est simple. Il suffit d'envoyer un dossier parent sur votre espace FTP. Ce dossier peut s’appeler "Dessins", par exemple. C'est votre catégorie. Vous pouvez, si vous le souhaitez, mettre directement des images à l'intérieur. Votre catégorie "Dessin" est alors une catégorie seule. (attention, une catégorie seule ne contenant pas d'images n'est pas affichée par le menu)

Mais vous pouvez aussi créer des sous-catégories. Il vous suffit de créer des sous-dossiers dans un dossier catégorie-seule précédemment crée.

Le menu est donc créé automatiquement, à partir de l'arborescence de votre dossier "contenu".

Envoyer des images

Rien de plus simple, à partir du moment ou vous avez créé vos catégories et/ou vos sous-catégories. Il vous suffit de transférer votre (ou vos) images dans une de vos catégories ou sous-catégorie. Elle sera affichée automatiquement.

Vous pouvez afficher un commentaire au dessus d'une liste de photo.
Pour ce faire, il vous suffit de créer un fichier comment.txt dans le sous_dossier voulu. Le commentaire s'affichera automatiquement.
Vous devez composer votre commentaire en xHTML. Ces commentaires pourront êtres écrits via formulaire dans une prochaine version.

Créer une page statique

Vous pouvez à présent éditer vos pages via une interface de gestion. Pour cela rendez vous sur la page "votre_galerie/admin" après changé votre couple pseudonyme/mot de passe dans le fichier de configuration. L'interface est simpliste mais efficace. Dans un premier temps, logguez vous. Cliquez ensuite sur : "Administrer vos pages". Vous voici maintenant en mesure d'ajouter des pages, de les modifier ou de les supprimer. Notez que la page "accueil" ne peux se supprimer.

Pour ajouter une page, il vous suffit de cliquer sur "Ajouter une page". À partir de là, vous allez devoir renseigner le contenu de votre page et le titre du fichier. Rentrez le titre du fichier en minuscule et remplacez les espaces par des underscores ("_"). Le contenu des pages est à composer en HTML (sauf pour le retour à la ligne, qui est automatique).

Pour modifier une page, cliquez sur "modifier" à coté de la page correspondante. Vous n'aurez qu'à changer le contenu de la page, pas besoin de renseigner une nouvelle fois le nom du fichier.

Pour supprimer une page, cliquez sur "supprimer" à coté de la page correspondante. Sur la page suivante, on vous demandera si vous êtes bien sur de votre action. Si oui, cochez la case, sinon, ne la cochez pas.

Dans le cas ou vous souhaitez vous déconnecter, cliquez sur "Déconnexion". De toute façon, la Session se détruit automatiquement au bout d'un moment.

Les vues :

Le concept de vue est une nouveauté dans Graphist Gallery, insérée dans la version 0.101. Ces vues régissent en fait l'affichage de vos images. Ce concept est tiré d'un constat simple : L'utilisateur doit pouvoir choisir la vue qu'il souhaite et ce avec n'importe quel thème. Ça parrait difficile ? Il n'en ai rien. En effet, les vues fonctionnent comme des pluggins : vous les téléchargez et les copiez dans le dossier prévus à cet effet (par defaut resources/views). Ceci fait, vous n'avez plus qu'à renseigner la vue que vous souhaitez utiliser dans votre fichier de configuration.


