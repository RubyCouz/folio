<div class="container">
    <div class="row">
        <div class="col s12">

        </div>
    </div>
    <table class="stripped highlight centered responsive-table table">
        <thead>
            <tr>
                <th>Photo de profil</th>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Login</th>
                <th>Email</th>
                <th>Date d'inscription</th>
                <th>Rôle</th>
                <th></th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <?php
            foreach ($list as $user)
            {
                ?>
                <tr>
                    <td>
                        <img src="<?= base_url('assets/img/profil_pic/' . $user->id_user . '.' . $user->extension) ?>" title="photo de profil de <?= $user->login_user ?>" alt="photo de profil" class="circle responsive-img pic_profil">
                    </td>
                    <td><?= $user->id_user ?></td>
                    <td><?= $user->lastname_user ?></td>
                    <td><?= $user->firstname_user ?></td>
                    <td><?= $user->login_user ?></td>
                    <td><?= $user->mail_user ?></td>
                    <td><?= $user->inscript_user ?></td>
                    <td><?= $user->user_role ?></td>
                    <th><a class="modal-trigger del-confirm" href="<?= site_url('Client/user_detail/' . $user->id_user) ?>"><i class="material-icons update">import_contacts</i></a></th>
                    <?php
                    if ($user->user_role != 'admin')
                    {
                        ?>
                        <th><a class="modal-trigger del-confirm" href="#modal1"><i class="material-icons">delete_forever</i></a></th>
                        <?php
                    }
                }
                ?>                    
            </tr>
        </tbody>
    </table>
</div>
<div id="modal1" class="modal modal_sup">
    <div class="modal-content">
        <h4>Attention !!!</h4>
        <p>Voulez-vous supprimer cet utilisateur ?</p>
        <p>L'utilisateur sera définitivement supprimer de la base de données, cette action sera irréversible</p>
    </div>
    <div class="modal-footer">
        <a href="<?= site_url('Client/delete/' . $user->id_user) ?>" class="modal-close waves-effect waves-red btn-flat del-confirm">OK</a>
    </div>
</div>
