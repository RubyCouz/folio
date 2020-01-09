<?php

// application/controllers/Produits.php	
//instruction de sécurité empéchant l'accès direct au fichier
defined('BASEPATH') OR exit('No direct script access allowed');

// création de la classe Produits héritant des propriétés de la classe CI_Controller (important : nom de la classe avec première lettre en majuscule, tout comme le fichier)
class Produits extends CI_Controller {

    /**
     * affichage de la liste de produits
     */
    public function liste()
    {
        // appel de l'helper pour la gestion des urls
        $this->load->helper('url');
        /**
         * méthode pour affichage de la liste de produit
         */
        //------------------- sans model -----------------
//        //appel de la methode database -> permet la connexion à la base de données.
//        $this->load->database();
//        // stockage de la requète dans une variable
//        $query = 'SELECT * from `produits`';
//        // exécution de la requète
//        $result = $this->db->query($query);
//        // récupération des résultats
//        $productList = $result->result();
        // ajout des résultats de la requète dans le tableau des variables à transmettre à la vue
        //-------------------- avec model -----------------
        // chargement du model "produitModel"
        $this->load->model('produitModel');
        // appel de la méthode "liste()" du model précédemment chargé
        $productList = $this->produitModel->liste();
        $listView['productList'] = $productList;
        /**
         *  chargement des fichiers vue
         */
        $this->load->view('header');
        $this->load->view('liste', $listView);
        $this->load->view('footer');
    }

    /**
     * Ajout d'un produit
     */
    public function addProduct()
    {
        $this->output->enable_profiler(TRUE);
        // appel de l'helper pour la gestion des urls
        $this->load->helper('url');
        // appel du helper form
        $this->load->helper('form');
        // chargement de la librairie validation du formulaire
        $this->load->library('form_validation');
        // ATTENTION Au FORMULAIRE : IL FAUT QUE LES NAMES DES INPUT SOIENT IDENTIQUES AUX NOMS DES CHAMPS DE LA TABLE, ET SUPPRIMER LE POST['SUBMIT']
        if ($this->input->post())
        {
            $this->form_validation->set_rules(
                    'pro_cat_id', 'Catégories', 'required|regex_match[/^[\d]+$/]', array('required' => 'Le champs catégorie n\'est pas renseigné', 'regex_match' => 'Champs catégorie non valide'));
            $this->form_validation->set_rules(
                    'pro_ref', 'Référence', 'required|regex_match[/^[a-zA-Z\d]+$/]', array('required' => 'Le champs référence n\'est pas renseigné', 'regex_match' => 'Champs référence non valide'));
            $this->form_validation->set_rules(
                    'pro_couleur', 'Couleur', 'required|regex_match[/^[a-zA-Z]+$/]', array('required' => 'Le champs couleur n\'est pas renseigné', 'regex_match' => 'Champs couleur non valide'));
            $this->form_validation->set_rules(
                    'pro_libelle', 'Libellé', 'required|regex_match[/^[a-zA-Z\d ]+$/]', array('required' => 'Le champs libellé n\'est pas renseigné', 'regex_match' => 'Champs libellé non valide'));
            $this->form_validation->set_rules(
                    'pro_prix', 'Prix', 'required|regex_match[/^[\d]+[.]?[\d]{1,2}$/]', array('required' => 'Le champs prix n\'est pas renseigné', 'regex_match' => 'Champs prix non valide'));
            $this->form_validation->set_rules(
                    'pro_stock', 'Stock', 'required|regex_match[/^[\d]+$/]', array('required' => 'Le champs stock n\'est pas renseigné', 'regex_match' => 'Champs stock non valide'));
            $this->form_validation->set_rules(
                    'pro_description', 'Description', 'required|regex_match[/^[a-zA-Z\d\|\_ êëùüûîïàäâöô\,\.\:\;\!\?]+$/]', array('required' => 'Le champs description n\'est pas renseigné', 'regex_match' => 'Champs description non valide'));
            if ($this->form_validation->run() == FALSE)
            {
                /**
                 * Affichage des categories de produits dans la liste déroulante
                 */
                //------------------------ sans model ---------------
//                $this->load->database();
//                // stockage de la requète dans une variable
//                $query = 'SELECT * from `categories`';
//                // exécution de la requète
//                $result = $this->db->query($query);
//                // récupération des résultats
//                $categoriesList = $result->result();
//                // ajout des résultats de la requète dans le tableau des variables à transmettre à la vue
                //----------------------- avec model ----------------
                // chargement du model "produitModel"
                $this->load->model('produitModel');
                // appel de la méthode "liste()" du model précédemment chargé
                $categoriesList = $this->produitModel->categoriesList();
                $catView['categoriesList'] = $categoriesList;
                /**
                 * Affichage du formulaire d'ajout
                 */
                $this->load->view('header');
                $this->load->view('addProduct', $catView);
                $this->load->view('footer');
            }
            else
            {
                // configuration du chemin ou le fichier sera enregistré
                $config['upload_path'] = realpath('assets/img/');
                //type de fichier autorisés
                $config['allowed_types'] = 'gif|jpg|png';
                // chargement du helper pour l'upload
                $this->load->library('upload', $config);
                // upload du fichier
                $this->upload->do_upload("pro_photo");
                //gestion des erreurs pour l'upload
                $error = $this->upload->display_errors();
                $file = $this->upload->data();
                //----------------------- sans model --------------------
//                // chargement/connexion à la base de données
//                $this->load->database();
//                // récupération des données du formulaire
//                $data = $this->input->post();
                $this->load->model('produitModel');
                $this->produitModel->addProduct();

//                // récupération et formatage de la date (date courante) d'ajout du produit
//                $data["pro_d_ajout"] = date("Y-m-d");
//                // récupération de l'extensio du fichier en vue de son insertion en base de données
//                $data["pro_photo"] = substr($file["file_ext"], 1);
//                // insertion des données du formulaire en base de données ($data -> données du formulaire)
//                $this->db->insert("produits", $data);
                // récupération du dernier id inséré dans la base de données
                $id = $this->db->insert_id();
                // renommage du final
                rename($file["full_path"], realpath('assets/img/') . "/" . $id . $file["file_ext"]);


                //à utiliser si les classes sont autochargées
                //$this->upload->initialize($config);
//            redirect('produits/liste');
            }
        }
        else
        {

            /**
             * Affichage des categories de produits dans la liste déroulante
             */
            // -------------------------- sans model ---------------------------
//            $this->load->database();
//            // stockage de la requète dans une variable
//            $query = 'SELECT * from `categories`';
//            // exécution de la requète
//            $result = $this->db->query($query);
//            // récupération des résultats
//            $categoriesList = $result->result();
//            // ------------------------- avec model --------------------------
            // appel de la classe catégoriesModel
            $this->load->model('categoriesModel');
            // appel de la méthode "liste()" du model précédemment chargé
            $categoriesList = $this->categoriesModel->categoriesList();
            // ajout des résultats de la requète dans le tableau des variables à transmettre à la vue
            $catView['categoriesList'] = $categoriesList;
            /**
             * Affichage du formulaire d'ajout
             */
            $this->load->view('header');
            $this->load->view('addProduct', $catView);
            $this->load->view('footer');
        }
    }

    /**
     * modification d'un produit
     */
    public function update()
    {
        //affichage du détail de l'action (-> debbuger, à retenir)
        $this->output->enable_profiler(TRUE);
//        // chargement/connexion à la BDD
//        $this->load->database();
        // chargement des helpers d'url
        $this->load->helper('url');
        // chargement du helper de formulaire
        $this->load->helper('form');
//        // chargement du helper de validation du formulaire
        $this->load->library('form_validation');

        if ($this->input->post())
        {
            $this->form_validation->set_rules(
                    'pro_cat_id', 'Catégories', 'required|regex_match[/^[\d]+$/]', array('required' => 'Le champs catégorie n\'est pas renseigné', 'regex_match' => 'Champs catégorie non valide'));
            $this->form_validation->set_rules(
                    'pro_ref', 'Référence', 'required|regex_match[/^[a-zA-Z\d]+$/]', array('required' => 'Le champs référence n\'est pas renseigné', 'regex_match' => 'Champs référence non valide'));
            $this->form_validation->set_rules(
                    'pro_couleur', 'Couleur', 'required|regex_match[/^[a-zA-Z]+$/]', array('required' => 'Le champs couleur n\'est pas renseigné', 'regex_match' => 'Champs couleur non valide'));
            $this->form_validation->set_rules(
                    'pro_libelle', 'Libellé', 'required|regex_match[/^[a-zA-Z\d ]+$/]', array('required' => 'Le champs libellé n\'est pas renseigné', 'regex_match' => 'Champs libellé non valide'));
            $this->form_validation->set_rules(
                    'pro_prix', 'Prix', 'required|regex_match[/^[\d]+[.]?[\d]{1,2}$/]', array('required' => 'Le champs prix n\'est pas renseigné', 'regex_match' => 'Champs prix non valide'));
            $this->form_validation->set_rules(
                    'pro_stock', 'Stock', 'required|regex_match[/^[\d]+$/]', array('required' => 'Le champs stock n\'est pas renseigné', 'regex_match' => 'Champs stock non valide'));
            $this->form_validation->set_rules(
                    'pro_description', 'Description', 'required|regex_match[/^[a-zA-Z\d\|\_ êëùüûîïàäâöô\,\.\:\;\!\?]+$/]', array('required' => 'Le champs description n\'est pas renseigné', 'regex_match' => 'Champs description non valide'));
            if ($this->form_validation->run() == FALSE)
            {
                //---------------------------- sans model ----------------------------
//                // stockage de la requète pour afficher un produit dans une variable
//                $query = 'SELECT * FROM `produits` WHERE `pro_id` = ?';
//                // lancement de la requète
//                $productById = $this->db->query($query, array($id));
//                
                //---------------------------- avec model ----------------------------
                // appel de la classe catégoriesModel
                $this->load->model('produitModel');
                // appel de la méthode "liste()" du model précédemment chargé
                $productById = $this->produitModel->productById();
                // récupération du résultat (première ligne)
                $productByIdView['produits'] = $productById->row();

                //------------------------- sans model -------------------------------
//                $query = 'SELECT * from `categories`';
//                // exécution de la requète
//                $result = $this->db->query($query);
//                // récupération des résultats
//                $productById = $result->result();
//                
//               --------------------------- avec model ------------------------------
//                 // appel de la classe catégoriesModel
                $this->load->model('categoriesModel');
                // appel de la méthode "liste()" du model précédemment chargé
                $categoriesList = $this->categoriesModel->categoriesList();

                // ajout d$productByIdes résultats de la requète dans le tableau des variables à transmettre à la vue
                $productByIdView['categoriesList'] = $categoriesList;
                // chargement des vues
                $this->load->view('header');
                $this->load->view('updateProduct', $productByIdView);
                $this->load->view('footer');
            }
            else
            {
                $data = $this->input->post();
                $id = $this->input->post('pro_id');
                // configuration du chemin ou le fichier sera enregistré
                $config['upload_path'] = realpath('assets/img/');
                //type de fichier autorisés
                $config['allowed_types'] = 'gif|jpg|png';
                // chargement du helper pour l'upload
                $this->load->library('upload', $config);
                // condition s'il n'y a pas de photo ajoutée
                if ($this->upload->do_upload("pro_photo"))
                {
                    // upload du fichier
                    //$this->upload->do_upload("pro_photo");
                    //gestion des erreurs pour l'upload
                    $error = $this->upload->display_errors();
                    $file = $this->upload->data();
                    // récupération de l'extensio du fichier en vue de son insertion en base de données et extraction du '.' (codeigniter garde le point avant l'extension)
                    $data["pro_photo"] = substr($file["file_ext"], 1);
                    // renommage du fichier final
                    rename($file["full_path"], realpath('assets/img/') . "/" . $id . $file["file_ext"]);
                }
                // appel de la classe produitModel
                $this->load->model('produitModel');
                // appel de la méthode modifiant un produit selon son id
                $this->produitModel->update();

//                // récupération et formatage de la date (date courante) d'ajout du produit
//                $data["pro_d_modif"] = date("Y-m-d");
//
//                $this->db->where('pro_id', $id);
//                $this->db->update('produits', $data);
                redirect('produits/liste');
            }
        }
        else
        {
            // appel de la classe catégoriesModel
            $this->load->model('produitModel');
            // appel de la méthode "liste()" du model précédemment chargé
            $productById = $this->produitModel->productById();
            // récupération du résultat (première ligne)
            $productByIdView['produits'] = $productById->row();
            // appel de la classe catégoriesModel
            $this->load->model('categoriesModel');
            // appel de la méthode "liste()" du model précédemment chargé
            $categoriesList = $this->categoriesModel->categoriesList();

            // ajout d$productByIdes résultats de la requète dans le tableau des variables à transmettre à la vue

            $productByIdView['categoriesList'] = $categoriesList;
            // chargement des vues
            $this->load->view('header');
            $this->load->view('updateProduct', $productByIdView);
            $this->load->view('footer');
        }
    }

    /**
     * Suppression d'un produit
     */
    public function delete()
    {
        // appel de l'helper pour la gestion des urls
        $this->load->helper('url');
//        $this->output->enable_profiler(TRUE);
        $this->load->model('produitModel');
        $this->produitModel->delete();
        // redirection vers la liste de produit
        redirect('produits/liste');
    }

}

/**
 * Affichage de la vue :
 */
// dans url => http://localhost/ci/index.php/produits/liste.
//produit -> nom du controlleur
// liste -> nom de la methode affichant les vues.
