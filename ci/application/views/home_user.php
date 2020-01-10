<div class="uk-container">
    <?php
    if ($this->session->userdata('role') != 1) {
        ?>
        <h1>Nos produits</h1>
        <div class="uk-width-1-3@m uk-text-center uk-flex-center" uk-grid>
            <?php
            foreach ($productList as $element) {
                ?>
                <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>
                    <div class="uk-card-media-left uk-cover-container">
                        <img src="<?= base_url('assets/img/' . $element->pro_id . '.' . $element->pro_photo) ?>"
                             alt="Photo d'illustration" title="Photo de <?= $element->pro_libelle ?>" uk-cover>
                        <canvas width="600" height="400"></canvas>
                    </div>
                    <div>
                        <div class="uk-card-body">
                            <h3 class="uk-card-title"><?= $element->pro_libelle ?></h3>
                            <p><?= $element->pro_description ?></p>
                            <p><?= $element->pro_prix ?> €</p>
                            <?php echo form_open(); ?>
                            <input type="hidden" name="pro_qte" id="pro_qte<?= $element->pro_id ?>" value="1">
                            <input type="hidden" name="pro_prix" id="pro_prix<?= $element->pro_id ?>"
                                   value="<?= $element->pro_prix ?>">
                            <input type="hidden" name="pro_id" id="pro_id<?= $element->pro_id ?>"
                                   value="<?= $element->pro_id ?>">
                            <input type="hidden" name="pro_libelle" id="pro_libelle<?= $element->pro_id ?>"
                                   value="<?= $element->pro_libelle ?>">
                            <input type="hidden" name="pro_photo" id="pro_photo<?= $element->pro_id ?>"
                                   value="<?= $element->pro_photo ?>">
                            <div class="right-align">
                                <button class="uk-icon-button" uk-icon="cart" type="button"
                                        value="<?= $element->pro_id ?>">
                                    <span></span>

                                </button>

                            </div>
                            <?= form_close() ?>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <div class="row">
            <div class="col s12 center-align">
                <!-- pagination -->

                <?php echo $this->pagination->create_links(); ?>
            </div>
        </div>
        <?php
    } else {
        ?>
        <h1>Liste des produits</h1>
        <a href="<?= site_url('Produits/addProduct') ?>" class="waves-effect waves-light btn"
           title="Lien vers ajout d'un produit">Ajouter un produit</a>

        <table class="stripped highlight centered responsive-table table">
            <thead>
            <th>Photo</th>
            <th>Id</th>
            <th>Catégorie</th>
            <th>Référence</th>
            <th>Libellé</th>
            <th>Couleur</th>
            <th>Description</th>
            <th>Prix</th>
            <th>Stock</th>
            <th>Ajout</th>
            <th>Modif</th>
            <th>Bloqué</th>
            </thead>
            <tbody>
            <?php
            foreach ($productList as $row) {
                ?>
                <tr>
                    <td>
                        <img src="<?= base_url('assets/img/' . $row->pro_id . '.' . $row->pro_photo) ?>"
                             alt="Photo d'illustration" title="Photo de <?= $row->pro_libelle ?>" class="pic">
                    </td>
                    <td><?= $row->pro_id ?></td>
                    <td><?= $row->pro_cat_id ?></td>
                    <td><?= $row->pro_ref ?></td>
                    <td><?= $row->pro_libelle ?></td>
                    <td><?= $row->pro_couleur ?></td>
                    <td><?= $row->pro_description ?></td>
                    <td><?= $row->pro_prix ?></td>
                    <td><?= $row->pro_stock ?></td>
                    <td><?= $row->add_date ?></td>
                    <td><?= $row->update_date ?></td>
                    <td><?= $row->pro_bloque == 1 ? 'Oui' : 'Non' ?></td>
                    <td><a href="<?= site_url('Produits/update') . '/' . $row->pro_id ?>"
                           title="Lien vers la fiche produit" class="waves-effect waves-light btn">Fiche Produit</a>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <div class="row">
            <div class="col s12 center-align">
                <!-- pagination -->
                <?php echo $this->pagination->create_links(); ?>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <a href="<?= site_url('Produits/addProduct') ?>" class="waves-effect waves-light btn"
                   title="Lien vers ajout d'un produit">Ajouter un produit</a>
            </div>
        </div>
        <?php
    }
    ?>
</div>
