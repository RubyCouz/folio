<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.2.6/dist/css/uikit.min.css"/>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="uk-container home">
    <hr class="uk-divider-icon">
    <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slideshow="animation: push">
        <ul class="uk-slideshow-items">
            <li>
                <div class="uk-position-cover uk-animation-kenburns uk-animation-reverse uk-transform-origin-center-left">
<!--                    <a href="correction/index.php">-->
                        <img src="assets/img/accueil/correction.jpg" alt="Corrections"
                             title="Screenshot accueil des corrections"
                             uk-cover>
<!--                    </a>-->
                </div>
                <div class="uk-overlay uk-overlay-primary uk-position-bottom uk-text-center uk-transition-slide-bottom">
                    <h3 class="uk-margin-remove">Corrections des exercices AFPA</h3>
                    <p class="uk-margin-remove">HTML, CSS, JS, PHP, Codeigniter, Jquery, AJAX, Vue.js</p>
                    <p class="uk-margin-remove">Correction avec explications et démos</p>
                    <a href="correction/index.php" class="uk-icon-link" uk-icon="icon: forward; ratio: 2" title="Lien vers les correction AFPA" target="_blank"></a>
                </div>
            </li>
            <li>
                <div class="uk-position-cover uk-animation-kenburns uk-animation-reverse uk-transform-origin-top-right">
                    <img src="assets/img/accueil/ci.jpg" alt="" uk-cover>
                </div>
                <div class="uk-overlay uk-overlay-primary uk-position-bottom uk-text-center uk-transition-slide-bottom">
                    <h3 class="uk-margin-remove">Démo projet E-commerce avec CodeIgniter</h3>
                    <p class="uk-margin-remove">Utilisation de CodeIgniter, gestion du panier avec AJAX, identification , interface client et administrateur</p>
                    <a href="ci/index.php" class="uk-icon-link" uk-icon="icon: forward; ratio: 2" title="Lien vers les correction AFPA" target="_blank"></a>
                </div>
            </li>
            <li>
                <div class="uk-position-cover uk-animation-kenburns uk-animation-reverse uk-transform-origin-bottom-left">
                    <img src="assets/img/icons/wallhaven-0jy6pw.jpg" alt="" uk-cover>
                    <div class="uk-position-center uk-position-small uk-text-center">
                        <h2 uk-slideshow-parallax="y: -50,0,0">Heading</h2>
                        <p uk-slideshow-parallax="y: 50,0,0">Lorem ipsum dolor sit amet.</p>
                    </div>
                </div>
            </li>
            <li>
                <div class="uk-position-cover uk-animation-kenburns uk-animation-reverse uk-transform-origin-bottom-left">
                    <img src="assets/img/icons/wallhaven-45dwp5.jpg" alt="" uk-cover>
                    <div class="uk-position-center uk-position-small uk-text-center">
                        <h2 uk-slideshow-parallax="x: 100,-100">Heading</h2>
                        <p uk-slideshow-parallax="x: 200,-200">Lorem ipsum dolor sit amet.</p>
                    </div>
                </div>
            </li>
            <li>
                <div class="uk-position-cover uk-animation-kenburns uk-animation-reverse uk-transform-origin-bottom-left">
                    <img src="assets/img/icons/wallhaven-n6qoe7.jpg" alt="" uk-cover>
                    <div class="uk-position-center uk-position-small uk-text-center">
                        <h2 uk-slideshow-parallax="x: 100,-100">Heading</h2>
                        <p uk-slideshow-parallax="x: 200,-200">Lorem ipsum dolor sit amet.</p>
                    </div>
                </div>
            </li>
            <li>
                <div class="uk-position-cover uk-animation-kenburns uk-animation-reverse uk-transform-origin-bottom-left">
                    <img src="assets/img/icons/wallhaven-nrjj71.png" alt="" uk-cover>
                    <div class="uk-position-center uk-position-small uk-text-center">
                        <h2 uk-slideshow-parallax="y: -50,0,0">Heading</h2>
                        <p uk-slideshow-parallax="y: 50,0,0">Lorem ipsum dolor sit amet.</p>
                    </div>
                </div>
            </li>
        </ul>
        <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous
           uk-slideshow-item="previous"></a>
        <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next
           uk-slideshow-item="next"></a>
        <ul class="uk-slideshow-nav uk-dotnav uk-flex-center uk-margin"></ul>
    </div>
    <hr class="uk-divider-icon">
    <nav class="footer">
        <div class="uk-child-width-expand@s uk-text-center" uk-grid>
            <div>
                <a href="https://github.com/rubycouzcedric" title="Lien vers mon github" target="_blank">
                    <img src="assets/img/icons/icons8-github-64.png" alt="Icône github"
                         title="Lien vers mon repo Github">
                </a>
            </div>
            <div>
                <a href="https://rubycouzcedric.github.io/" title="Lien vers mon C.V numérique" target="_blank">
                    <img src="assets/img/icons/icons8-resume-64.png" alt="Icône C.V" title="Lien vers mon C.V">
                </a>
            </div>
            <div>
                <a href="https://www.linkedin.com/in/cedric-cousin-359307124/" title="Lien vers mon profil LinkedIn" target="_blank">
                    <img src="assets/img/icons/icons8-linkedin-64.png" alt="Icône LinkedIn"
                         title="Lien vers mon profil LinkedIn">
                </a>
            </div>
        </div>
    </nav>
</div>


<script src="https://cdn.jsdelivr.net/npm/uikit@3.2.6/dist/js/uikit.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/uikit@3.2.6/dist/js/uikit-icons.min.js"></script>
<script src="assets/js/script.js"></script>
</body>
</html>