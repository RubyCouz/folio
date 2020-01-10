<?php

// application/controllers/Produits.php	
//instruction de sécurité empéchant l'accÃ¨s direct au fichier
defined('BASEPATH') OR exit('No direct script access allowed');

// création de la classe Produits héritant des propriétés de la classe CI_Controller (important : nom de la classe avec premiÃ¨re lettre en majuscule, tout comme le fichier)
class Produits extends CI_Controller
{
    /**
     * Affichage de la page d'accueil
     */
    public function header()
    {
        $this->load->model('model');
        $view = $this->model->methode();
        $this->load->view('header', $view);
    }

    public function view()
    {
        site_url('Controller/header');
        $this->load->view('body');
        $this->load->view('footer');
    }

    public function home()
    {
        $this->load->view('header');
        $this->load->view('home');
        $this->load->view('footer');
    }

    /**
     * affichage vue catalogue
     */
    public function index()
    {
// pagination
        // récupération du numéro de la page passé en paramêtre
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        // limit d'affichage de produit par page
        $limit = 12;


        // chargement du model "Prod_model"
        $this->load->model('Prod_model');
        // appel de la méthode "liste()" du model précédemment chargé
        $productList = $this->Prod_model->liste($page, $limit);
//        var_dump($productList);

        $count_item = $this->Prod_model->count_items();
        $listView['count'] = $count_item;
        $listView['productList'] = $productList;

        // formatage de la pagination
        $config['base_url'] = 'http://localhost/devAmorce/ci/index.php/Produits/index';
        $config['total_rows'] = $count_item;
        $config['per_page'] = $limit;
        $config['num_links'] = 5;
        $config['cur_tag_open'] = ' <li class="uk-active">';
        $config['cur_tag_close'] = '</li>';
        $config['full_tag_open'] = '<ul class="uk-pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = FALSE;
        $config['first_tag_open'] = FALSE;
        $config['first_tag_close'] = FALSE;
        $config['last_link'] = FALSE;
        $config['last_tag_open'] = FALSE;
        $config['last_tag_close'] = FALSE;
        $config['next_link'] = '<span uk-pagination-next></span>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '<span uk-pagination-previous></span>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['num_tag_open'] = ' <li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
// chargemnt des vues
        $this->load->view('header');
        $this->load->view('home_user', $listView);
        $this->load->view('footer');
    }

    /**
     * Ajout d'un produit
     */
    public function addProduct()
    {

//$this->output->enable_profiler(TRUE);
// ATTENTION Au FORMULAIRE : IL FAUT QUE LES NAMES DES INPUT SOIENT IDENTIQUES AUX NOMS DES CHAMPS DE LA TABLE, ET SUPPRIMER LE POST['SUBMIT']
        if ($this->input->post()) {
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
                'pro_description', 'Description', 'required|regex_match[/^[a-zA-Z\d\|\_ ÃªÃ«Ã¹Ã¼Ã»Ã®Ã¯Ã Ã¤Ã¢Ã¶Ã´\,\.\:\;\!\?]+$/]', array('required' => 'Le champs description n\'est pas renseigné', 'regex_match' => 'Champs description non valide'));
            if ($this->form_validation->run() == FALSE) {
                /**
                 * Affichage des categories de produits dans la liste déroulante
                 */
                // chargement du model "Prod_model"
                $this->load->model('Cat_model');
                // appel de la méthode "liste()" du model précédemment chargé
                $categoriesList = $this->Cat_model->categoriesList();
                $catView['categoriesList'] = $categoriesList;
                /**
                 * Affichage du formulaire d'ajout
                 */
                $this->load->view('header');
                $this->load->view('addProduct', $catView);
                $this->load->view('footer');
            } else {
                // configuration du chemin ou le fichier sera enregistré
                $config['upload_path'] = realpath('assets/img/');
                //type de fichier autorisés
                $config['allowed_types'] = 'gif|jpg|png';
                // chargement du helper pour l'upload
                $this->load->library('upload', $config);
                // upload du fichier
                $this->upload->do_upload('pro_photo');
                //gestion des erreurs pour l'upload
                $error = $this->upload->display_errors();
                if ($error == '') {
                    $file = $this->upload->data();
                    $this->load->model('Prod_model');
                    $this->Prod_model->addProduct();
                    $id = $this->db->insert_id();
                    // renommage du final
                    rename($file["full_path"], realpath('assets/img/') . "/" . $id . $file["file_ext"]);
                    $this->load->view('header');
                    $this->load->view('confirmAdd');
                    $this->load->view('footer');
                } else {
                    /**
                     * Affichage des categories de produits dans la liste déroulante
                     */
                    // appel de la classe catégoriesModel
                    $this->load->model('Cat_model');
                    // appel de la méthode "liste()" du model précédemment chargé
                    $categoriesList = $this->Cat_model->categoriesList();
                    // ajout des résultats de la requÃ¨te dans le tableau des variables Ã  transmettre Ã  la vue
                    $catView['categoriesList'] = $categoriesList;
                    $catView['error'] = $error;
                    /**
                     * Affichage du formulaire d'ajout
                     */
                    $this->load->view('header');
                    $this->load->view('addProduct', $catView);
                    $this->load->view('footer');
                }
            }
        } else {

            /**
             * Affichage des categories de produits dans la liste déroulante
             */
            // appel de la classe catégoriesModel
            $this->load->model('Cat_model');
            // appel de la méthode "liste()" du model précédemment chargé
            $categoriesList = $this->Cat_model->categoriesList();
            // ajout des résultats de la requÃ¨te dans le tableau des variables Ã  transmettre Ã  la vue
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
    public function update($id)
    {
//affichage du détail de l'action (-> debbuger, Ã  retenir)
//$this->output->enable_profiler(TRUE);
// chargement des helpers d'url
        $this->load->helper('url');
// chargement du helper de formulaire
        $this->load->helper('form');
// chargement du helper de validation du formulaire
        $this->load->library('form_validation');

        if ($this->input->post()) {
            // définition des règles de validation
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
                'pro_description', 'Description', 'required|regex_match[/^[a-zA-Z\d\|\_ éèàùöïüëäçîôûêâ\,\.\:\;\!\?]+$/]', array('required' => 'Le champs description n\'est pas renseigné', 'regex_match' => 'Champs description non valide'));
            if ($this->form_validation->run() == FALSE) // si la validation du formulaire retourne FALSE
            {
                // appel de la classe catégoriesModel
                $this->load->model('Prod_model');
                // appel de la méthode "liste()" du model précédemment chargé
                $productById = $this->Prod_model->productById($id);
                // récupération du résultat (premiÃ¨re ligne)
                $productByIdView['produits'] = $productById->row();
                // appel de la classe catégoriesModel
                $this->load->model('Cat_model');
                // appel de la méthode "liste()" du model précédemment chargé
                $categoriesList = $this->Cat_model->categoriesList();
                // ajout des résultats de la requÃ¨te dans le tableau des variables Ã  transmettre Ã  la vue
                $productByIdView['categoriesList'] = $categoriesList;
                // chargement des vues
                $this->load->view('header');
                $this->load->view('updateProduct', $productByIdView);
                $this->load->view('footer');
            } else {
                $data = $this->input->post();
                // configuration du chemin ou le fichier sera enregistré
                $config['upload_path'] = realpath('assets/img/');
                //type de fichier autorisés
                $config['allowed_types'] = 'gif|jpg|png';
                // chargement du helper pour l'upload
                $this->load->library('upload', $config);
                // condition s'il n'y a pas de photo ajoutée
                if ($this->upload->do_upload('pro_photo')) {
                    //gestion des erreurs pour l'upload
                    $error = $this->upload->display_errors();
                    $file = $this->upload->data();
                    // renommage du fichier final
                    rename($file['full_path'], realpath('assets/img/') . '/' . $id . $file['file_ext']);
                }
                // appel de la classe Prod_model
                $this->load->model('Prod_model');
                // appel de la méthode modifiant un produit selon son id
                $this->Prod_model->update($id);
                $this->load->view('header');
                $this->load->view('confirm');
                $this->load->view('footer');
                //redirect('produits/liste');
            }
        } else {
            // appel de la classe catégoriesModel
            $this->load->model('Prod_model');
            // appel de la méthode "liste()" du model précédemment chargé
            $productById = $this->Prod_model->productById($id);
            // récupération du résultat (premiÃ¨re ligne)
            $productByIdView['produits'] = $productById->row();
            // appel de la classe catégoriesModel
            $this->load->model('Cat_model');
            // appel de la méthode "liste()" du model précédemment chargé
            $categoriesList = $this->Cat_model->categoriesList();

            // ajout des résultats de la requÃ¨te dans le tableau des variables Ã  transmettre Ã  la vue

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
    public function delete($id)
    {
        $this->output->enable_profiler(TRUE);
// appel de l'helper pour la gestion des urls
        $this->load->helper('url');
// chargement du model Prod_model
        $this->load->model('Prod_model');
// appel de la méthode delete
        $this->Prod_model->delete($id);
// redirection vers la liste de produit
//redirect('produits/liste');
    }

    public function sendMail()
    {
// chargement de la librairie email
        $this->load->library('email');
        if ($this->input->post()) {
            $this->form_validation->set_rules(
                'mail', 'Adresse mail', 'required|regex_match[/^[a-zA-Z0-9.!#$%&’*?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*/]', array('required' => 'Le champs "Adresse mail" n\'est pas renseigné', 'regex_match' => 'Champs "Adresse mail" non valide'));
            $this->form_validation->set_rules(
                'subject', 'Sujet', 'required|regex_match[/^[a-zA-Z\d\|\_ éèàùöïüëäçîôûêâ\,\.\:\;\!\?]+$/]', array('required' => 'Le champs "Sujet" n\'est pas renseigné', 'regex_match' => 'Champs "Sujet" non valide'));
            $this->form_validation->set_rules(
                'content', 'Message', 'required|regex_match[/^[a-zA-Z\d\|\_ éèàùöïüëäçîôûêâ\,\.\:\;\!\?]+$/]', array('required' => 'Le champs "Message" n\'est pas renseigné', 'regex_match' => 'Champs "Message" non valide'));
            if ($this->form_validation->run() == FALSE) {
                // si la validation du formulaire retourne FALSE , on affiche les vues
                $this->load->view('header');
                $this->load->view('contact');
                $this->load->view('footer');
            } else {
                // définition, formatge du mail
                $this->email->from($this->input->post('mail'));
                $this->email->to('ced270784@gmail.com');
                $this->email->subject($this->input->post('subject'));
                $this->email->message($this->input->post('content'));
                // si l'email s'envoie
                if ($this->email->send()) {
                    // affichage d'un message de confirmation
                    $data['result_class'] = "alert-success";
                    $data['result_message'] = "Merci de nous avoir envoyé ce mail. Nous y répondrons dans les meilleurs délais.";
                } else {
                    // affichage d'un message d'erreur
                    $data['result_class'] = "alert-danger";
                    $data['result_message'] = "Votre message n'a pas pu être envoyé. Nous mettons tout en oeuvre pour résoudre le problème.";
                    // Ne faites jamais ceci dans le "vrai monde"
                    $data['result_message'] .= "<pre>\n";
                    $data['result_message'] .= $this->email->print_debugger();
                    $data['result_message'] .= "</pre>\n";
                    $this->email->clear();
                }
                // chargement des vues
                $this->load->view('header');
                $this->load->view('result', $data);
                $this->load->view('footer');
            }
        } else {
            // chargement des vues
            $this->load->view('header');
            $this->load->view('contact');
            $this->load->view('footer');
        }
    }

    /**
     * Panier
     */
    public function cart()
    {
        $this->load->view('header');
        $this->load->view('order');
        $this->load->view('footer');
    }

    /**
     * Ajout de produit dans le panier (utilisation de la méthode AJAX)
     */
    public function add_product_in_cart()
    {
// stockage des données (du formulaire caché contenant les données du produit) dans une variable
        $data = $this->input->post();
        // stockage de l'id dans une variable en vue de définir la clé associative qui stockera les données du post
        $key = $this->input->post('pro_id');
        if ($this->session->cart == null) // création du panier s'il n'existe pas	
        {
            //stockage des données produits vers la clé associative => id du produit
            $tab = array($key => $data);
            // assignation du tableau a la variable de session
            $this->session->cart = $tab;
            // chargement de la vue du panier
            $this->load->view('cart');
        } else //si le panier existe
        {
            // stockage de la varible de session dans un tableau
            $tab = $this->session->cart;
            // définition d'un boolean (définira si un produit est déja dans le panier ou non
            $sortie = false;
            foreach ($tab as $produit) //on cherche si le produit existe déjà dans le panier
            {
                if ($produit['pro_id'] == $this->input->post('pro_id')) {
                    $sortie = true;
                }
            }
            if ($sortie) //si le produit existe déjà, on incrémente la quantité du produit déjà présent dans le panier
            {
                $tab = $this->session->cart;
                $tab[$key]['pro_qte'] += 1;
                $this->session->cart = $tab;


            } else { //sinon le produit est ajouté dans le panier
                $tab[$key] = $data;
                $this->session->cart = $tab;
                $this->load->view('cart');
            }
        }
    }

    /**
     * suppression d'un produit du panier dans le dropdown
     */
    public function del_product_in_cart()
    {
        // défintion d'une variable servant de point de repère
        $data = false;
        // si envoie de formulaire
        if ($this->input->post()) {
            // récupération du post del
            $id = $this->input->post('del');
            // stockage des variables de sessions dans un tableau
            $tab = $this->session->cart;
            // suppression du produit
            unset($tab[$id]);
            // si le panier est vide
            if (empty($tab)) {
                // définition des variables de sessions à NuLL => destruction
                $this->session->cart = null;
            } else {
                // défintion des variables de sessions
                $this->session->cart = $tab;
            }
            // chargement du panier
            $this->load->view('cart');
        } else {

            echo $data;
        }
    }

    /**
     * suppression d'un produit dans le panier en affichage complet
     */
    public function del_product_in_full_cart()
    {
        $data = false;
        if ($this->input->post()) {
            $id = $this->input->post('del');
            $tab = $this->session->cart;
            unset($tab[$id]);
            if (empty($tab)) {
                $this->session->cart = null;
            } else {
                $this->session->cart = $tab;
            }
            $this->load->view('full_cart');
        } else {
            echo $data;
        }
    }

    /**
     * incrémentation de la quantité d'un produit
     */
    public function increase_product()
    {
        // récupération du post add
        $key = $this->input->post('add');
        // stokage des variables de sessions dans un tableau
        $tab = $this->session->cart;
        // augmentation de la quantité
        $tab[$key]['pro_qte'] += 1;
        // défintion des variables de session
        $this->session->cart = $tab;
        // chargement de la vue
        $this->load->view('cart');
    }

    /**
     * décrémentation de la quantité d'un produit
     */
    public function decrease_product()
    {
        // récupération du post remove
        $key = $this->input->post('remove');
        // stockage des variables de sessions dans un tableau
        $tab = $this->session->cart;
        // décrémentation de la quantité
        $tab[$key]['pro_qte'] -= 1;
// si la quantité est égale à 0
        if ($tab[$key]['pro_qte'] === 0) {
            // on efface l'entrée correspondante
            unset($tab[$key]);
        }
        // si le tableau est vide
        if (empty($tab)) {
            // destruction des variables de session
            $this->session->cart = null;
        } else {
            $this->session->cart = $tab;
        }
        $this->session->cart = $tab;
        $this->load->view('cart');
    }

    /**
     * incrémentation de la quantité d'un produit sur la vue résumé
     */
    public function increase_product_full_cart()
    {
        $key = $this->input->post('add');
        $tab = $this->session->cart;
        $tab[$key]['pro_qte'] += 1;
        $this->session->cart = $tab;
        $this->load->view('full_cart');
    }

    /**
     * décrémentation de la quantité d'un produit sur la vue résumé
     */
    public function decrease_product_full_cart()
    {
        $key = $this->input->post('remove');
        $tab = $this->session->cart;
        $tab[$key]['pro_qte'] -= 1;
        if ($tab[$key]['pro_qte'] === 0) {
            unset($tab[$key]);
        }
        if (empty($tab)) {
            $this->session->cart = null;
        } else {
            $this->session->cart = $tab;
        }
        $this->session->cart = $tab;
        $this->load->view('full_cart');
    }

}




    