<div class="uk-container">
    <h1 class="white-text">Formulaire d'inscription</h1>
    <?= form_open_multipart('Client/check_userform'); ?>
    <fieldset>
        <legend class="white-text">Vos informations :</legend>

        <div class="uk-child-width-1-2" uk-grid>
            <div class="uk-margin mt-2">
                <label class="uk-form-label white-text" for="firstname">Prénom :</label>
                <div class="uk-form-controls uk-form-controls-text">
                    <input type="text" class="uk-input" id="firstname" name="firstname_user"
                           value="<?= set_value('firstname_user') != NULL ? set_value('firstname_user') : '' ?>">
                </div>
                <span id="missingFirstname"
                      class="error"><?= form_error('firstname_user') != null ? form_error('firstname_user') : '' ?></span>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label white-text" for="lastname">Nom :</label>
                <div class="uk-form-controls uk-form-controls-text">
                    <input type="text" class="uk-input" id="lastname" name="lastname_user"
                           value="<?= set_value('lastname_user') != NULL ? set_value('lastname_user') : '' ?>">
                </div>
                <span id="missingLastname"
                      class="error"><?= form_error('lastname_user') != null ? form_error('lastname_user') : '' ?></span>
            </div>
        </div>

        <div class="uk-child-width-expand@s" uk-grid>
            <div class="uk-margin mt-2">
                <label class="uk-form-label white-text" for="login">Pseudo :</label>
                <div class="uk-form-controls uk-form-controls-text">
                    <input type="text" class="uk-input" id="login" name="login_user"
                           value="<?= set_value('login_user') != NULL ? set_value('login_user') : '' ?>">
                </div>
                <span id="missingLogin"
                      class="error"><?= form_error('login_user') != null ? form_error('login_user') : '' ?></span>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label white-text" for="email">Email :</label>
                <div class="uk-form-controls uk-form-controls-text">
                    <input type="email" class="uk-input" id="email" name="mail_user"
                           value="<?= set_value('mail_user') != NULL ? set_value('mail_user') : '' ?>">
                </div>
                <span id="missingMail"
                      class="error"><?= form_error('mail_user') != null ? form_error('mail_user') : '' ?></span>
            </div>
        </div>

        <div class="uk-child-width-expand@s" uk-grid>
            <div class="uk-margin mt-2">
                <label class="uk-form-label white-text" for="password">Mot de passe :</label>
                <div class="uk-form-controls uk-form-controls-text">
                    <input type="password" class="uk-input" id="password" name="password_user"
                           value="<?= set_value('password_user') != NULL ? set_value('password_user') : '' ?>">
                </div>
                <span id="missingPassword1"
                      class="error"><?= form_error('password_user') != null ? form_error('password_user') : '' ?></span>
            </div>
            <div class="uk-margin">
                <label class="uk-form-label white-text" for="passwordVerif">Vérification du mot de passe :</label>
                <div class="uk-form-controls uk-form-controls-text">
                    <input type="password" class="uk-input" id="passwordVerif" name="password_user"
                           value="<?= set_value('passwordVerif_user') != NULL ? set_value('passwordVerif_user') : '' ?>">
                </div>
                <span id="missingPassword1"
                      class="error"><?= form_error('passwordVerif_user') != null ? form_error('passwordVerif_user') : '' ?></span>
            </div>
        </div>
        <span id="errorPassword"
              class="error"><?= form_error('passwordVerif_user') != null ? form_error('passwordVerif_user') : '' ?></span>

        <div class="ml-0" uk-grid>
            <div class="js-upload uk-placeholder uk-text-center">
                <span class="white-text" uk-icon="icon: cloud-upload"></span>
                <span class="uk-text-middle white-text">Ajouter une photo de profil en la glissant ici ou</span>
                <div uk-form-custom>
                    <input type="file">
                    <a href="" class="uk-link" title="Sélectionnez une photo de profil">sélectionnez en une en cliquant ici</a>
                </div>
            </div>
            <progress id="js-progressbar" class="uk-progress" value="0" max="100" hidden></progress>
        </div>

    </fieldset>
    <a href="<?= site_url('Produits/index') ?>" class="uk-button uk-button-secondary" type="button">Retour</a>
    <input type="submit" class="uk-button uk-button-success" value="S'inscrire">
    <?= form_close(); ?>
</div>
