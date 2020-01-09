<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Correction AFPA</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?= base_url('assets/css/uikit.min.css') ?>" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.6/styles/monokai.min.css" />
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>" />
</head>

<body>
    <nav class="uk-navbar-container uk-margin" uk-navbar>
        <div class="uk-navbar-center">
            <div class="uk-navbar-center-left">
                <div>
                    <ul class="uk-navbar-nav">
                        <li><a href="jarditou_html.php" title="Lien vers correction des exercices HTML">HTML</a></li>
                        <li><a href="css.php" title="Lien vers correction des exercices HTML">CSS</a></li>
                        <li><a href="bootstrap.php" title="Lien vers correction des exercices HTML">Bootstrap</a></li>
                    </ul>
                </div>
            </div>
            <a class="uk-navbar-item uk-logo" href="../index.php" title="Lien vers accueil">Correction</a>
            <div class="uk-navbar-center-right">
                <div>
                    <ul class="uk-navbar-nav">
                        <li>
                            <a href="#" title="Lien vers correction javascript">Javascript</a>
                            <div class="uk-navbar-dropdown">
                                <ul class="uk-nav-default uk-nav-parent-icon" uk-nav>
                                    <li><a href="text.php" title="Lien l'affichage de texte en Javascript">Afficher du texte</a></li>
                                    <li class="uk-parent">
                                        <a href="#">Les conditions</a>
                                        <ul class="uk-nav-sub">
                                            <li><a href="pair.php" title="Lien vers l'exercice pair ou impair">Pair ou impair</a></li>
                                            <li><a href="age.php" title="Lien vers l'exercice sur l'age">Age</a></li>
                                            <li><a href="calcul.php" title="Lien vers l'exercice sur la calculatrice">Calculatrice</a></li>
                                            <li><a href="participation.php" title="Lien vers l'exercice sur la calculatrice">Participation</a></li>
                                        </ul>
                                    </li>
                                    <li class="uk-parent">
                                        <a href="#">Les boucles</a>
                                        <ul class="uk-nav-sub">
                                            <li><a href="saisie.php" title="Lien vers l'exercice Saisie">Saisie</a></li>
                                            <li><a href="integer.php" title="Lien vers l'exercice Entier inférieur à N">Entiers inférieurs à N</a></li>
                                            <li><a href="sum.php" title="Lien vers l'exercice Somme d'un intervalle">Somme d'un intervalle</a></li>
                                            <li><a href="average.php" title="Lien vers l'exercice Moyenne">Moyenne</a></li>
                                            <li><a href="multiple.php" title="Lien vers l'exercice Multiple">Multiples</a></li>
                                            <li><a href="voyelle.php" title="Lien vers l'exercice Nombre de voyelle">Nombre de voyelles</a></li>
                                            <li><a href="primary.php" title="Lien vers l'exercice Nombre premier">Nombre premier</a></li>
                                            <li><a href="magic.php" title="Lien vers l'exercice Nombre magique">Nombre magique</a></li>
                                        </ul>
                                    </li>
                                    <li class="uk-parent">
                                        <a href="#">Les fonctions</a>
                                        <ul class="uk-nav-sub">
                                            <li><a href="picture.php" title="Lien vers l'exercice Afficher du texte et une image">Afficher du texte et une image</a></li>
                                            <li><a href="letter.php" title="Lien vers l'exercice Compter le nombre de lettre">Compter le nombre de lettre</a></li>
                                            <li><a href="menu.php" title="Lien vers la création d'un menu">Menu</a></li>
                                            <li><a href="stringtoken.php" title="Lien vers l'exercice String Token">String Token</a></li>
                                        </ul>
                                    </li>
                                    <li class="uk-parent">
                                        <a href="#">Les tableaux</a>
                                        <ul class="uk-nav-sub">
                                            <li><a href="create.php" title="Lien vers Création d'un tableau">Création d'un tableau</a></li>
                                            <li><a href="array.php" title="Lien vers Parcours d'un tableau">Parcours d'un tableau</a></li>
                                            <li><a href="sort.php" title="Lien vers Tri d'un tableau">Tri d'un tableau</a></li>
                                        </ul>
                                    </li>
                                    <li class="uk-parent">
                                        <a href="#">Les événements</a>
                                        <ul class="uk-nav-sub">
                                            <li><a href="event1.php">Evénement sur un bouton</a></li>
                                            <li><a href="magicEvent.php">Nombre magique</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="regex.php" title="">Les expressions régulière</a></li>
                                    <li><a href="formJavascript.php" title="">Les formulaires</a></li>
                                    <li><a href="formJquery" title="">Jquery</a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="#" title="Lien vers correction PHP">PHP</a>
                            <div class="uk-navbar-dropdown">
                                <ul class="uk-nav-default uk-nav-parent-icon" uk-nav>
                                    <li><a href="initiation.php" title="Lien vers L'initiation PHP">Initiation</a></li>
                                    <li class="uk-parent">
                                        <a href="#">Les conditions et boucles</a>
                                        <ul class="uk-nav-sub">
                                            <li><a href="impair.php" title="Lien vers l'exercice pnombre impair">Afficher les nombres impairs entre 0 et 150</a></li>
                                            <li><a href="punishment.php" title="Lien vers l'exercice 500 lignes">500 X</a></li>
                                            <li><a href="multiplication.php" title="Lien vers l'exercice sur la table de multiplication">Table de multiplication</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="form.php" title="Lien vers la vérification du formulaire en php">Serveur et formulaires</a></li>
                                    <li class="uk-parent">
                                        <a href="#">Manipulations les fichiers</a>
                                        <ul class="uk-nav-sub">
                                            <li><a href="link.php" title="Lien vers l'exercice Saisie">Affiche une liste de liens</a></li>
                                            <li><a href="upload.php" title="Lien vers l'exercice Entier inférieur à N">Upload</a></li>
                                        </ul>
                                    </li>
                                    <li class="uk-parent">
                                        <a href="#">Connexion aux bases de données avec PDO</a>
                                        <ul class="uk-nav-sub">
                                        <li><a href="atelier1.php" title="Lien vers l'exercice Saisie">Atelier 1</a></li>
                                            <li><a href="connectionBdd.php" title="Lien vers l'exercice Entier inférieur à N">Atelier 3 : connexion à la BDD, affichage d'une liste de produit et détail d'un produit</a></li>
                                            <li><a href="updateProduct.php" title="Lien vers l'exercice Saisie">Atelier 3 : Modification d'un produit</a></li>
                                            <li><a href="delProduct.php" title="Lien vers l'exercice Saisie">Atelier 3 : Suppression d'un produit</a></li>
                                            <li><a href="addProduct.php" title="Lien vers l'exercice Saisie">Atelier 3 : Ajout d'un produit</a></li>
                                        </ul>
                                    </li>
                                     <li><a href="session.php" title="Lien vers les sessions">Les sessions</a></li>
                                     <li><a href="connexion.php" title="Lien vers les mots de passe">Les mots de passe</a></li>
                                     <li><a href="MVC_POO.php" title="Lien vers POO - MVC">POO - MVC</a></li>
                                </ul>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </nav>