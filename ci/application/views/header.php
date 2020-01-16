<?php
$url = "http://" . $_SERVER['HTTP_HOST'] . "." . $_SERVER['REQUEST_URI'];
$form_attributes = array('class' => 'uk-form-horizontal');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Sandbox</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.6/styles/monokai.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.2.6/dist/css/uikit.min.css"/>
    <link rel="stylesheet" href="<?= base_url('../assets/css/style.css') ?>">
    <script src="<?= base_url('/assets/js/jquery-3.3.1.js') ?>"></script>
</head>

<body>
<div class="uk-section-primary uk-preserve-color">
    <div uk-sticky="animation: uk-animation-slide-top; sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky; cls-inactive: uk-navbar-transparent; top: 200">
        <nav class="uk-navbar-container">
            <div class="uk-container uk-container-expand" uk-navbar>
                <div uk-navbar class="uk-navbar-left">
                    <ul class="uk-navbar-nav">
                        <li class="uk-active">
                            <a href="<?= site_url('Produits/home') ?>">
                                <img src="<?= base_url('/assets/img/sandbox_logo.png') ?>" title="Logo de la SandBox"
                                     alt="image d'un bac à sable" class="logo">
                            </a>
                        </li>
                        <li>
                            <a href="<?= site_url('Produits/index') ?>">Catalogue</a>
                            <div class="uk-navbar-dropdown"
                                 uk-dropdown="animation: uk-animation-slide-top-small; duration: 1000">
                                <ul class="uk-nav uk-navbar-dropdown-nav">
                                    <li class="uk-active"><a href="<?= site_url('Produits/index') ?>">Catalogue</a></li>
                                    <li><a href="<?= site_url('Produits/sendMail') ?>">Contact</a></li>
                                    <li><a href="#">Item</a></li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="<?= site_url('Produits/sendMail') ?>">Contact</a></li>
                    </ul>
                </div>
                <div uk-navbar class="uk-navbar-right">
                    <ul class="uk-navbar-nav">
                        <?php
                        if ($this->session->userdata('id') !== null) {
                            ?>
                            <li>
                                <img src="<?= base_url('assets/img/profil_pic/' . $this->session->userdata('id') . '.' . $this->session->userdata('extension')) ?>"
                                     title="photo de profil de <?= $this->session->userdata('login') ?>"
                                     alt="photo de profil"
                                     class="uk-border-circle thumbnail">
                                <div class="uk-navbar-dropdown"
                                     uk-dropdown="animation: uk-animation-slide-top-small; duration: 1000">

                                    <ul class="uk-nav uk-navbar-dropdown-nav">
                                        <?php
                                        if ($this->session->userdata('role') == 1) {
                                            //dropdown menu admin
                                            ?>
                                            <li><a href="<?= site_url('Produits/index') ?>">Liste des produits</a></li>
                                            <li>
                                                <a href="<?= site_url('Produits/addProduct') ?>">Ajouter un produit</a>
                                            </li>
                                            <li><a href="<?= site_url('Client/list_user') ?>">Liste des utilisateurs</a>
                                            </li>
                                            <li>
                                                <a href="<?= site_url('Client/check_userform') ?>">Ajouter un
                                                    utilisateurs</a>
                                            </li>
                                            <li class="divider" tabindex="-1"></li>
                                            <li>
                                                <a href="<?= site_url('Client/update_profil/' . $this->session->userdata('id')) ?>">Mon
                                                    profil</a></li>
                                            <li><a href="<?= site_url('Client/sign_out') ?>"
                                                   class="waves-effect waves-light btn">Se déconnecter</a></li>
                                            <?php
                                        } else {
                                            //dropdown menu client
                                            ?>
                                            <li>
                                                <a href="<?= site_url('Client/update_profil/' . $this->session->userdata('id')) ?>">Mon
                                                    profil</a></li>
                                            <li><a href="<?= site_url('Produits/cart') ?>">Mon pannier</a></li>
                                            <li class="divider" tabindex="-1"></li>
                                            <li><a href="<?= site_url('Client/sign_out') ?>"
                                                   class="waves-effect waves-light btn">Se déconnecter</a></li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </li>
                            <?php
                        } else {
                            ?>
                            <li><a class="" href="#signin" uk-toggle>Inscription/Connexion</a></li>
                            <?php
                        }
                        if ($url != 'http://localhost./ci/index.php/Produits/cart') {
                            ?>
                            <li>
                                <a href="<?= site_url('Produits/cart') ?>" class="uk-icon-link"
                                   uk-icon="icon: cart; ratio: 2" title="Lien vers le panier" target="_blank"></a>
                                <div class="uk-navbar-dropdown"
                                     uk-dropdown="animation: uk-animation-slide-top-small; duration: 1000">
                                    <ul class="uk-nav uk-navbar-dropdown-nav">
                                        <?php
                                        $this->load->view('cart')
                                        ?>
                                    </ul>
                                </div>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>

<!-- Modal de connexion et inscription -->

<div id="signin" uk-modal>
    <div class="uk-modal-dialog connect_modal">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Connexion</h2>
        </div>
        <!-- Formulaire de connexion -->
        <?php
        echo form_open('Client/user_check');
        ?>
        <div class="uk-modal-body">
            <div class="uk-align-center connection-align">
                <div class="uk-margin">
                    <div class="uk-inline">
                        <span class="uk-form-icon" uk-icon="icon: user"></span>
                        <label for="login_user"></label>
                        <input class="uk-input" id="login_user" type="text" name="login_user"
                               value="<?= set_value('login_user') != NULL ? set_value('login_user') : '' ?>">
                        <span id="missingLogin"
                              class="error"><?= form_error('login_user') != null ? form_error('login_user') : '' ?></span>
                    </div>
                </div>
                <div class="uk-margin">
                    <div class="uk-inline">
                        <span class="uk-form-icon" uk-icon="icon: lock"></span>
                        <label for="password"></label>
                        <input class="uk-input" id="password" type="password" name="password_user"
                               value="<?= set_value('password_user') != NULL ? set_value('password_user') : '' ?>">
                        <span id="missingPassword"
                              class="error"><?= form_error('password_user') != null ? form_error('password_user') : '' ?></span>
                    </div>
                </div>
            </div>
            <a href="<?= site_url('Client/signin_form') ?>" class="uk-link" title="Liens vers le formulaire d'inscription">Vous n'êtes pas encore inscrit? Venez par ici !!!</a>
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Annuler</button>
            <input class="uk-button uk-button-default" type="submit" value="Se connecter">
        </div>
        <?php
        echo form_close()
        ?>
    </div>
</div>


