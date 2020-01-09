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
                    <img src="assets/img/accueil/correction.jpg" alt="Corrections"
                         title="Screenshot accueil des corrections"
                         uk-cover>
                    <div class="uk-position-center uk-position-small uk-text-center">
                        <h2 uk-slideshow-parallax="y: -50,0,0">Corrections des exercices AFPA</h2>
                        <p uk-slideshow-parallax="y: 50,0,0">HTML, CSS, JS, PHP, Codeigniter, Jquery, AJAX, Vue.js</p>
                        <p uk-slideshow-parallax="x: 200,-200">Correction avec explications et démos</p>
                    </div>
                </div>
            </li>
            <li>
                <div class="uk-position-cover uk-animation-kenburns uk-animation-reverse uk-transform-origin-top-right">
                    <img src="assets/img/icons/1366979294_85989.jpg" alt="" uk-cover>
                    <div class="uk-position-center uk-position-small uk-text-center">
                        <h2 uk-slideshow-parallax="x: 100,-100">Heading</h2>
                        <p uk-slideshow-parallax="x: 200,-200">Lorem ipsum dolor sit amet.</p>
                    </div>
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
                <a href="">
                    <img src="assets/img/icons/icons8-github-64.png" alt="Icône github"
                         title="Lien vers mon repo Github">
                </a>
            </div>
            <div>
                <a href="">
                    <img src="assets/img/icons/icons8-resume-64.png" alt="Icône C.V" title="Lien vers mon C.V">
                </a>
            </div>
            <div>
                <a href="">
                    <img src="assets/img/icons/icons8-linkedin-64.png" alt="Icôn LinkedIn"
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