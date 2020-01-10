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
                                <div class="uk-navbar-dropdown"
                                     uk-dropdown="animation: uk-animation-slide-top-small; duration: 1000">
                                    <img src="<?= base_url('assets/img/profil_pic/' . $this->session->userdata('id') . '.' . $this->session->userdata('extension')) ?>"
                                         title="photo de profil de <?= $this->session->userdata('login') ?>"
                                         alt="photo de profil"
                                         class="tiny_pic">
                                    <ul class="uk-nav uk-navbar-dropdown-nav">
                                        <?php
                                        if ($this->session->userdata('role') == 1) {
                                            //dropdown menu admin
                                            ?>
                                            <li><a href="<?= site_url('Produits/index') ?>">Liste des produits</a></li>
                                            <li><a href="<?= site_url('Produits/addProduct') ?>">Ajouter un produit</a>
                                            </li>
                                            <li><a href="<?= site_url('Client/list_user') ?>">Liste des utilisateurs</a>
                                            </li>
                                            <li><a href="<?= site_url('Client/check_userform') ?>">Ajouter un
                                                    utilisateurs</a></li>
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
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Connexion</h2>
        </div>
        <!-- Formulaire de connexion -->
        <?php
        echo form_open('Client/user_check');
        ?>
        <div class="uk-modal-body">
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
                    <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: lock"></span>
                    <label for="password"></label>
                    <input class="uk-input" id="password" type="password" name="password_user"
                           value="<?= set_value('password_user') != NULL ? set_value('password_user') : '' ?>">
                    <span id="missingPassword"
                          class="error"><?= form_error('password_user') != null ? form_error('password_user') : '' ?></span>
                </div>
            </div>
            <a href="#modal-group-2" class="" uk-toggle>Vous n'êtes pas encore inscrit? Venez par ici !!!</a>
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Annuler</button>
            <button class="uk-button uk-button-default uk-modal-close" type="submit">Se connecter</button>
        </div>
        <?php
        echo form_close()
        ?>
    </div>
</div>
<div id="modal-group-2" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Formulaire d'inscription</h2>
        </div>
        <?= form_open_multipart('Client/check_userform', $form_attributes); ?>
        <div class="uk-modal-body">
            <fieldset>
                <legend>Vos informations :</legend>
                <div class="uk-margin">
                    <label class="uk-form-label" for="firstname">Prénom :</label>
                    <div class="uk-form-controls uk-form-controls-text">
                        <input type="text" class="uk-input" id="firstname" name="firstname_user"
                               value="<?= set_value('firstname_user') != NULL ? set_value('firstname_user') : '' ?>">
                    </div>
                    <span id="missingFirstname"
                          class="error"><?= form_error('firstname_user') != null ? form_error('firstname_user') : '' ?></span>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="lastname">Nom :</label>
                    <div class="uk-form-controls uk-form-controls-text">
                        <input type="text" class="uk-input" id="lastname" name="lastname_user"
                               value="<?= set_value('lastname_user') != NULL ? set_value('lastname_user') : '' ?>">
                    </div>
                    <span id="missingLastname"
                          class="error"><?= form_error('lastname_user') != null ? form_error('lastname_user') : '' ?></span>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="login">Pseudo :</label>
                    <div class="uk-form-controls uk-form-controls-text">
                        <input type="text" class="uk-input" id="login" name="login_user"
                               value="<?= set_value('login_user') != NULL ? set_value('login_user') : '' ?>">
                    </div>
                    <span id="missingLogin"
                          class="error"><?= form_error('login_user') != null ? form_error('login_user') : '' ?></span>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="email">Email :</label>
                    <div class="uk-form-controls uk-form-controls-text">
                        <input type="email" class="uk-input" id="email" name="mail_user"
                               value="<?= set_value('mail_user') != NULL ? set_value('mail_user') : '' ?>">
                    </div>
                    <span id="missingMail"
                          class="error"><?= form_error('mail_user') != null ? form_error('mail_user') : '' ?></span>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="password">Mot de passe :</label>
                    <div class="uk-form-controls uk-form-controls-text">
                        <input type="password" class="uk-input" id="password" name="password_user"
                               value="<?= set_value('password_user') != NULL ? set_value('password_user') : '' ?>">
                    </div>
                    <span id="missingPassword1"
                          class="error"><?= form_error('password_user') != null ? form_error('password_user') : '' ?></span>
                </div>
                <div class="uk-margin">
                    <label class="uk-form-label" for="passwordVerif">Vérification du mot de passe :</label>
                    <div class="uk-form-controls uk-form-controls-text">
                        <input type="password" class="uk-input" id="passwordVerif" name="password_user"
                               value="<?= set_value('passwordVerif_user') != NULL ? set_value('passwordVerif_user') : '' ?>">
                    </div>
                    <span id="missingPassword1"
                          class="error"><?= form_error('passwordVerif_user') != null ? form_error('passwordVerif_user') : '' ?></span>
                </div>
                <div class="uk-margin">
                    <span id="errorPassword" class="error"><?= form_error('passwordVerif_user') != null ? form_error('passwordVerif_user') : '' ?></span>
                </div>
                <div class="uk-margin" uk-margin>
                    <span class="info">Au format .gif, .jpg, .jpeg, .pjpeg ou .png</span>
                    <div uk-form-custom="target: true">
                        <input type="file" name="extension" id="upload">
                        <input class="uk-input uk-form-width-medium" type="text" placeholder="Select file" readonly id="addFile">
                    </div>

                    <span class="error" id="errorFile"><?= form_error('extension') != null ? form_error('extension') : '' ?></span>
                </div>
            </fieldset>
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
            <input type="submit" class="uk-button uk-button-primary" value="S'inscrire">
        </div>
        <?= form_close(); ?>
    </div>
</div>

