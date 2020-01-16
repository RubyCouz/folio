<?php
if (isset($_POST['delete'])) {
    ?>
    <p class="white-text">
        Produit supprimé !!
    </p>
    <a href="<?= site_url('Produits/liste') ?>" title="Retour à la liste de produit"
       class="waves-effect waves-light btn">Retour à la liste de produit</a>
    <?php
} else {
?>
<div class="uk-container">
    <h1 class="title">Détail du produit <?= $produits->pro_libelle ?></h1>
</div>
<div class="detail-card">
    <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>
        <div class="uk-card-media-left uk-cover-container" id="prev">
            <img src="<?= base_url('assets/img/' . $produits->pro_id . '.' . $produits->pro_photo) ?>"
                 alt="image de <?= $produits->pro_libelle ?>" class="detail-pic" uk-cover>
            <canvas width="600" height="400"></canvas>
        </div>
        <div>
            <div class="uk-card-body">
                <h3 class="uk-card-title"><?= $produits->pro_libelle ?></h3>
                <?= form_open_multipart() ?>
                <div class="uk-margin">
                    <label for="id">ID : </label>
                    <input id="id" type="text" name="id" class="uk-input" readonly value="<?= $produits->pro_id ?>">
                </div>
                <div class="uk-margin">
                    <label for="categories">Catégorie :</label>
                    <select name="pro_cat_id" id="categories" class="uk-select">
                        <option value="" disabled selected>Choisissez une catégorie</option>
                        <?php
                        foreach ($categoriesList as $cat) {
                            ?>
                            <option value="<?= $cat->cat_id ?>"
                                    <?= isset($_POST['pro_cat_id']) && $_POST['pro_cat_id'] == $cat->cat_id || ($cat->cat_id == $produits->pro_cat_id) ? 'selected' : '' ?>><?= $cat->cat_nom ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <?php
                if (form_error('pro_cat_id') != NULL) {
                    ?>
                    <span class="new badge"><?= form_error('pro_cat_id') ?></span>
                    <?php
                }
                ?>
                <div class="uk-margin">
                    <label for="addRef">Référence :</label>
                    <input id="addRef" type="text" name="pro_ref" class="uk-input"
                           value="<?= set_value('pro_ref') != NULL ? set_value('pro_ref') : $produits->pro_ref ?>">
                    <span class="error" id="errorRef"></span>
                    <?php
                    if (form_error('pro_ref') != NULL) {
                        ?>
                        <span class="new badge"><?= form_error('pro_ref') ?></span>
                        <?php
                    }
                    ?>
                </div>
                <div class="uk-margin">
                    <label for="addLabel">Libellé :</label>
                    <input id="addLabel" type="text" name="pro_libelle" class="uk-input"
                           value="<?= set_value('pro_libelle') != NULL ? set_value('pro_libelle') : $produits->pro_libelle ?>">
                    <span class="error" id="errorLabel"></span>
                    <?php
                    if (form_error('pro_libelle') != NULL) {
                        ?>
                        <span class="new badge"><?= form_error('pro_libelle') ?></span>
                        <?php
                    }
                    ?>
                </div>
                <div class="uk-margin">
                    <label for="addColor">Couleur :</label>
                    <input id="addColor" type="text" name="pro_couleur" class="uk-input"
                           value="<?= set_value('pro_couleur') != NULL ? set_value('pro_couleur') : $produits->pro_couleur ?>">
                    <span class="error" id="errorColor"></span>
                    <?php
                    if (form_error('pro_couleur') != NULL) {
                        ?>
                        <span class="new badge"><?= form_error('pro_couleur') ?></span>
                        <?php
                    }
                    ?>
                </div>
                <div class="uk-margin">
                    <label for="addStock">Stock</label>
                    <input id="addStock" type="text" name="pro_stock" class="uk-input"
                           value="<?= set_value('pro_stock') != NULL ? set_value('pro_stock') : $produits->pro_stock ?>">
                    <span class="error" id="errorStock"></span>
                    <?php
                    if (form_error('pro_stock') != NULL) {
                        ?>
                        <span class="new badge"><?= form_error('pro_stock') ?></span>
                        <?php
                    }
                    ?>
                </div>
                <div class="uk-margin">
                    <label for="addPrice">Prix</label>
                    <input id="addPrice" type="text" name="pro_prix" class="uk-input"
                           value="<?= set_value('pro_prix') != NULL ? set_value('pro_prix') : $produits->pro_prix ?>">
                    <span class="error" id="errorPrice"></span>
                    <?php
                    if (form_error('pro_prix') != NULL) {
                        ?>
                        <span class="new badge"><?= form_error('pro_prix') ?></span>
                        <?php
                    }
                    ?>
                </div>
                <div class="uk-margin">
                    <label for="addDescription">Description</label>
                    <textarea id="addDescription" class="uk-textarea"
                              name="pro_description"><?= set_value('pro_description') != NULL ? set_value('pro_description') : $produits->pro_description ?></textarea>
                    <span class="error" id="errorDesc"></span>
                    <?php
                    if (form_error('pro_description') != NULL) {
                        ?>
                        <span class="new badge"><?= form_error('pro_description') ?></span>
                        <?php
                    }
                    ?>
                </div>
                <div class="uk-chil-width-expand@s uk-text-center" uk-grid>
                    <div>
                        <p>Produit bloqué :</p>
                    </div>
                    <div>
                        <label>
                            <input name="pro_bloque" class="uk-radio" type="radio" value="1"
                                   <?= $produits->pro_bloque == 1 ? 'checked' : '' ?>>
                            <span>Oui</span>
                        </label>
                    </div>
                    <div>
                        <label>
                            <input name="pro_bloque" type="radio" class="uk-radio" value="2"
                                   <?= ($produits->pro_bloque == NULL) || ($produits->pro_bloque == 2) ? 'checked' : '' ?>>
                            <span>Non</span>
                        </label>
                    </div>
                </div>
                <div class="uk-chil-width-expand@s uk-text-center">
                    <div>
                        <p>Date d'ajout : <?= $produits->pro_d_ajout ?></p>
                    </div>
                    <div>
                        <p>Date de modification
                            : <?= $produits->pro_d_modif == NULL ? 'Pas de modification enregistrée' : $produits->pro_d_modif ?></p>
                    </div>
                </div>
                <input type="submit" value="Modifier le produit" class="uk-button uk-button-default">
                <a type="submit" id="delete" href="#modal-sections"
                   class="uk-button uk-button-danger" uk-toggle>Effacer le produit</a>
                <a href="<?= site_url('Produits/index') ?>" title="Lien vers le catalogue"
                   class="uk-button uk-button-secondary">Retour au catalogue</a>
                <?= form_close() ?>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
</div>

<!-- Modal Structure -->
<div id="modal-sections" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Suppression de <?= $produits->pro_libelle ?></h2>
        </div>
        <div class="uk-modal-body">
            <p>Etes-vous sûr de bien vouloir supprimer le produit <?= $produits->pro_libelle ?> ?</p>
            <p>Cette suppression sera irréversible et vous pourrez plus retrouver ce produit.</p>
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Annuler</button>
            <a href="<?= site_url('Produits/delete/' . $produits->pro_id) ?>"
               class="uk-modal-close uk-button uk-button-danger">Confirmer</a>
        </div>
    </div>
</div>


