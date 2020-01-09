<div class="container white-text">
    <div class="card">
        <?= form_open_multipart('Client/update_profil/' . $user->id_user) ?>
        <div class="card-content black-text info_user">
            <span class="card-title">Informations de <?= $user->login_user ?></span>
            <div class="row">
                <div class="col s6" id="prev">
                    <img src="<?= base_url('assets/img/profil_pic/' . $user->id_user . '.' . $user->extension) ?>" alt="image" title="preview de l'image du produit" class="circle responsive-img profile_pic pic2">
                </div>
                <div class="col s6">
                    <div class="row center-align">
                        <div class="input-field col s12">
                            <input type="text" name="lastname_user" id="lastname_user" value="<?= set_value('lastname_user') != NULL ? set_value('lastname_user') : $user->lastname_user ?>">
                            <label for="lastname_user">Nom : </label>
                            <?php
                            if (form_error('lastname_user') != NULL)
                            {
                                ?>
                                <span class="new badge"><?= form_error('lastname_user') ?></span>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="text" name="firstname_user" id="firstname_user" value="<?= set_value('firstname_user') != NULL ? set_value('firstname_user') : $user->firstname_user ?>">
                            <label for="firstname_user">Prénom : </label>
                            <?php
                            if (form_error('firstname_user') != NULL)
                            {
                                ?>
                                <span class="new badge"><?= form_error('firstname_user') ?></span>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="text" name="login_user" id="login_user" value="<?= set_value('login_user') != NULL ? set_value('login_user') : $user->login_user ?>">
                            <label for="login_user">Pseudo : </label>
                            <?php
                            if (form_error('login_user') != NULL)
                            {
                                ?>
                                <span class="new badge"><?= form_error('login_user') ?></span>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="text" name="mail_user" id="mail_user" value="<?= set_value('mail_user') != NULL ? set_value('mail_user') : $user->mail_user ?>">
                            <label for="mail_user">Email : </label>
                            <?php
                            if (form_error('mail_user') != NULL)
                            {
                                ?>
                                <span class="new badge"><?= form_error('mail_user') ?></span>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s6">
                    <div class="file-field input-field">
                        <div class="btn">
                            <span><i class="large material-icons">add_a_photo</i></span>
                            <input type="file" name="extension" id="upload">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" id="addFile">
                        </div>
                        <span class="info">Au format .gif, .jpg, .jpeg, .pjpeg ou .png</span>
                        <span class="error" id="errorFile"></span>
                    </div>
                </div>
            </div>
            <div class="row center-align">
                <div class="col s6">
                    <input type="submit" class="waves-effect waves-light btn" value="Modifier les informations">
                </div>
                <div class="col s6">
                    <a href="<?= site_url('Produits/home_user') ?>" class="waves-effect waves-light btn red" title="Modifier le profil">Retour</a>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
