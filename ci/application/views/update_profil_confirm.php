<div class="container">
    <p class="white-text">
        Votre modification a bien été prise en charge !!!
    </p>
    <?php
    if ($this->session->userdata('role') == 1)
    {
        ?>
        <a href="<?= site_url('Client/list_user') ?>" title="Retour à la liste des utilisateurs" class="waves-effect waves-light btn">Retour à la liste d'utilisateur</a>
        <?php
    }
    else
    {
        ?>
        <a href="<?= site_url('Produits/home_user') ?>" title="Retour à la liste de produit" class="waves-effect waves-light btn">Retour à la liste de produit</a>
    <?php
}
?>
</div>