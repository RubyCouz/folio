<?php

// application/controllers/Produits.php	
//instruction de sécurité empéchant l'accÃ¨s direct au fichier
defined('BASEPATH') OR exit('No direct script access allowed');

// création de la classe Produits héritant des propriétés de la classe CI_Controller (important : nom de la classe avec premiÃ¨re lettre en majuscule, tout comme le fichier)
class Client extends CI_Controller {

    /**
     * Affichage formulaire inscription
     */
    public function signin_form()
    {
        // chargement des vue pour le formulaire d'inscription
        $this->load->view('header');
        $this->load->view('signin');
        $this->load->view('footer');
    }

    /**
     * Inscriptions
     */
    public function if_client_exists()
    {
//  $this->output->enable_profiler(TRUE)
        // si il y a présnece du post login_user
        if ($this->input->post('login_user'))
        {
            // définition des règles de validations
            $this->form_validation->set_rules('login_user', 'Pseudo', 'required|regex_match[/^[a-zA-Z\d\- éèêëàâäùüûôöîï#$@]+$/]|is_unique[user.login_user]', array('required' => 'Le champs "Pseudo" n\'est pas renseigné', 'regex_match' => 'Champs "Pseudo" non valide', 'is_unique' => 'Ce pseudo est déjà utilisé.'));
            // si la validation du formualire retourne FALSE
            if ($this->form_validation->run() === FALSE)
            {
                // stockage d'un message d'erreur dans une variable et affichage de cette variable
                $error = form_error('login_user');
                echo $error;
            }
        }
    }

    /**
     * vérification du formulaire d'inscription
     */
    public function check_userform()
    {
//        $this->output->enable_profiler(TRUE);
        // à l'envoie des données
        if ($this->input->post())
        {
            // défnition des règles de validation
            $this->form_validation->set_rules('firstname_user', 'Prénom', 'required|regex_match[/^[a-zA-Z\-éèêëàâäùüûôöîï]+$/]', array('required' => 'Le champs "Prénom" n\'est pas renseigné', 'regex_match' => 'Champs "Prénom" non valide'));
            $this->form_validation->set_rules('lastname_user', 'Nom', 'required|regex_match[/^[a-zA-Z\-éèêëàâäùüûôöîï]+$/]', array('required' => 'Le champs "Nom" n\'est pas renseigné', 'regex_match' => 'Champs "Nom" non valide'));
            $this->form_validation->set_rules('login_user', 'Pseudo', 'required|regex_match[/^[a-zA-Z\d\- éèêëàâäùüûôöîï#$@]+$/]|is_unique[user.login_user]', array('required' => 'Le champs "Pseudo" n\'est pas renseigné', 'regex_match' => 'Champs "Pseudo" non valide', 'is_unique' => 'Ce pseudo est déjà utilisé.'));
            $this->form_validation->set_rules('mail_user', 'Adresse mail', 'required|regex_match[/^[a-zA-Z0-9.!#$%&’*?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/]', array('required' => 'Le champs "Adresse mail" n\'est pas renseigné', 'regex_match' => 'Champs "Adresse mail" non valide'));
            $this->form_validation->set_rules('password_user', 'Mot de passe', 'required|regex_match[/^[a-zA-Z\d\- éèêëàâäùüûôöîï#$@]+$/]', array('required' => 'Le champs "Mot de passe" n\'est pas renseigné', 'regex_match' => 'Champs "Mot de passe" non valide'));
            $this->form_validation->set_rules('passwordVerif_user', 'Confirmer votre mot de passe', 'required|matches[password_user]', array('required' => 'Le champs "Confirmer votre mot de passe" n\'est pas renseigné', 'matches' => 'Champs "Confirmer votre mot de passe" non valide'));

            $this->form_validation->set_rules(
                    'extension', 'Photo', 'regex_match[/^[a-z0-9\_\-]+[.]{1}[a-z]{3,4}$/]', array('regex_match' => 'Champs "Photo" non valide'));
            // si la validation retourne FALSE
            if ($this->form_validation->run() === FALSE)
            {
// chargement du formulaire
                $this->load->view('header');
                $this->load->view('signin');
                $this->load->view('footer');
            }
            else
            {
                //stockage des données dans un tableau associatif
                $data['firstname_user'] = $this->input->post('firstname_user');
                $data['lastname_user'] = $this->input->post('lastname_user');
                $data['login_user'] = $this->input->post('login_user');
                $data['mail_user'] = $this->input->post('mail_user');
                $data['password_user'] = $this->input->post('password_user');
                $data['inscript_user'] = mdate('%Y-%m-%d', time());
                // configuration du chemin ou le fichier sera enregistré
                $config['upload_path'] = realpath('assets/img/profil_pic/');
//type de fichier autorisés
                $config['allowed_types'] = 'gif|jpg|png';
// chargement du helper pour l'upload
                $this->load->library('upload', $config);
// condition s'il n'y a pas de photo ajoutée
                if ($this->upload->do_upload('extension'))
                {
//gestion des erreurs pour l'upload
                    $file = $this->upload->data();
                    $this->load->model('User_model');
                    $this->User_model->new_user($data);
                    $id = $this->db->insert_id();
// renommage du fichier final
                    rename($file['full_path'], realpath('assets/img/profil_pic/') . '/' . $id . $file['file_ext']);
                    // redirection vers la méthode permettant l'envoie d'un mail de confirmation
                    redirect(site_url('Client/send_confirmation_mail/' . $id));
                }
                else
                {
                    // s'il n'y a pas d'upload de fichier, récupération des erreurs et affichage du formulaire
                    $error = $this->upload->display_errors();
                    $this->load->view('header');
                    $this->load->view('signin');
                    $this->load->view('footer');
                }
            }
        }
        else
        {
            // affichage du formulaire lors de la première visite sur la page
            redirect(site_url('Client/signin_form'));
        }
    }

    public function send_confirmation_mail($id)
    {
// $this->output->enable_profiler(TRUE);
// récupération des infos de l'utilisateur
        $this->load->model('User_model');
        $result = $this->User_model->get_user_by_id($id);
// définition des variables de session lors de l'inscription, si des variables de sessions n'ont pas définies au préalable
        if ($this->session->userdata() == NULL)
        {
            $session_user = array(
                'id' => $result->id_user,
                'firstname' => $result->firstname_user,
                'lastname' => $result->lastname_user,
                'login' => $result->login_user,
                'mail' => $result->mail_user,
                'role' => $result->role_user,
            );
            $this->session->set_userdata($session_user);
        }

//envoie de mail de confirmation
        $this->email->from('sandbox@sandbox.com');
        $this->email->to($result->mail_user);
        $this->email->subject('Confirmation d\'inscription');
        $this->email->message('<h1>Bonjour ' . $result->firstname_user . '</h1>'
                . '<p>Votre inscription à bien été prise en compte.<br>'
                . 'Voici vos informations : <br>'
                . 'Prénom : ' . $result->firstname_user . '<br>'
                . 'Nom : ' . $result->lastname_user . '<br>'
                . 'Email : ' . $result->mail_user . '<br>'
                . 'Pseudo : ' . $result->login_user . '</p>'
        );
        if ($this->email->send())
        {
            // redirection vers une page de confirmation si l'envoie est un succès
            redirect(site_url('Client/signin_confirmation'));
        }
        else
        {
            // sinon affichage d'un message d'erreur
            $data['result_class'] = "alert-danger";
            $data['result_message'] = "Votre message n'a pas pu être envoyé. Nous mettons tout en oeuvre pour résoudre le problème.";
// Ne faites jamais ceci dans le "vrai monde"
            $data['result_message'] .= "<pre>\n";
            $data['result_message'] .= $this->email->print_debugger();
            $data['result_message'] .= "</pre>\n";
            $this->email->clear();
        }
    }

    /**
     * Confirmation d'inscription
     */
    public function signin_confirmation()
    {
        $this->load->view('header');
        $this->load->view('signinConfirmation');
        $this->load->view('footer');
    }

    /**
     * Connexion
     */
    public function log_user()
    {
        $this->load->view('header');
        $this->load->view('log');
        $this->load->view('footer');
    }

    /**
     * vérification formulaire connexion
     */
    public function user_check()
    {
        if ($this->input->post())
        {
            //définition des règles de validation
            $this->form_validation->set_rules('login_user', 'Pseudo', 'required|regex_match[/^[a-zA-Z\d\- éèêëàâäùüûôöîï#$@]+$/]', array('required' => 'Le champs "Pseudo" n\'est pas renseigné', 'regex_match' => 'Champs "Pseudo" non valide'));
            $this->form_validation->set_rules('password_user', 'Mot de passe', 'required|regex_match[/^[a-zA-Z\d\- éèêëàâäùüûôöîï#$@]+$/]', array('required' => 'Le champs "Mot de passe" n\'est pas renseigné', 'regex_match' => 'Champs "Mot de passe" non valide'));

            if ($this->form_validation->run() != FALSE)
            {
                // récupération du login de l'utilisateur
                $log = $this->input->post('login_user');
                // instanciation la classe USer_model
                $this->load->model('User_model');
                // appel de la méthode get_user_log, en passant le login en paramêtre
                $result = $this->User_model->get_user_log($log);
                // récupération du résultat de la requète
                $user_info = $result->row();
                // si on a un résultat
                if ($user_info != null)
                {
                    // vérification de la concordance des mots de passe
                    if(password_verify($this->input->post('password_user'), $user_info->password_user)) {
                        // définition des variables de sessions
                        $session_user = array(
                            'id' => $user_info->id_user,
                            'firstname' => $user_info->firstname_user,
                            'lastname' => $user_info->lastname_user,
                            'login' => $user_info->login_user,
                            'mail' => $user_info->mail_user,
                            'role' => $user_info->role_user,
                            'extension' => $user_info->extension,
                        );
                        $this->session->set_userdata($session_user);
                        // redireciton vers l'accueil
                        redirect(site_url('Produits/home_user'));
                    } else {
                        $this->load->view('header');
                        echo "<div class=\"chip\">
                                    Mot de passe érroné !!!
                                    <i class=\"close material-icons\">close</i>
                              </div>";
                        $this->load->view('footer');
                    }
                }
                else
                {
                    // sinon affichage d'un message d'erreur
                    // affichage de la vue de connexion
                    $error['error_log'] = 'Veuillez vous inscrire avant de vous connecter';
                    $this->load->view('header');
                    $this->load->view('signin', $error);
                    $this->load->view('footer');
                }
            }
            else
            {
                // affichage de la vue de connexion
                $this->load->view('header');
                $this->load->view('log');
                $this->load->view('footer');
            }
        }
    }

    /**
     * affichage des infos utilisateurs interfaces client
     */
    public function user_profil($id)
    {
        // instanciation de la classe User_model
        $this->load->model('User_model');
        // appel de la méthode get_user_by_id
        $user = $this->User_model->get_user_by_id($id);
        // stockage des résultats dans un tableau associatif qui sera envoyé dans la vue à afficher
        $user_view['user'] = $user;
        $this->load->view('header.php');
        $this->load->view('update_profil.php', $user_view);
        $this->load->view('footer.php');
    }

    /**
     * Contrôle du formulaire de modification d'info user
     * 
     */
    public function update_profil($id)
    {
//        $this->output->enable_profiler(TRUE);
        if ($this->input->post())
        {
            // définitions des règles de validation
            $this->form_validation->set_rules(
                    'lastname_user', 'Nom', 'required|regex_match[/^[a-zA-Z éèêëïîôöüûàç\-]+$/]', array('required' => 'Le champs "Nom" n\'est pas renseigné', 'regex_match' => 'Champs "Nom" non valide'));
            $this->form_validation->set_rules(
                    'firstname_user', 'Prénom', 'required|regex_match[/^[a-zA-Z éèêëïîôöüûàç\-]+$/]', array('required' => 'Le champs "Prénom" n\'est pas renseigné', 'regex_match' => 'Champs "Prénom" non valide'));
            $this->form_validation->set_rules(
                    'login_user', 'Pseudo', 'required|regex_match[/^[a-zA-Z éèêëïîôöüûàç\-@#$£~&]+$/]', array('required' => 'Le champs "Pseudo" n\'est pas renseigné', 'regex_match' => 'Champs "Pseudo" non valide'));
            $this->form_validation->set_rules(
                    'mail_user', 'Email', 'required|regex_match[/^[a-zA-Z0-9.!#$%&’*?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/]', array('required' => 'Le champs "Email" n\'est pas renseigné', 'regex_match' => 'Champs "Email" non valide'));
            $this->form_validation->set_rules(
                    'extension', 'Photo', 'regex_match[/^[a-z0-9\_\-]+[.]{1}[a-z]{3,4}$/]', array('regex_match' => 'Champs "Photo" non valide'));
            if ($this->form_validation->run() == FALSE)
            {
                $this->load->model('User_model');
                $user = $this->User_model->get_user_by_id($id);
                $user_view['user'] = $user;
                $this->load->view('header.php');
                $this->load->view('update_profil.php', $user_view);
                $this->load->view('footer.php');
            }
            else
            {
                $data = $this->input->post();
// configuration du chemin ou le fichier sera enregistré
                $config['upload_path'] = realpath('assets/img/profil_pic/');
//type de fichier autorisés
                $config['allowed_types'] = 'gif|jpg|png';
// chargement du helper pour l'upload
                $this->load->library('upload', $config);
// condition s'il n'y a pas de photo ajoutée
                if ($this->upload->do_upload('extension'))
                {
//gestion des erreurs pour l'upload
                    $error = $this->upload->display_errors();
                    $file = $this->upload->data();
// renommage du fichier final
                    rename($file['full_path'], realpath('assets/img/profil_pic/') . '/' . $id . $file['file_ext']);
                }
// appel de la classe Prod_model
                $this->load->model('User_model');
// appel de la méthode modifiant un produit selon son id
                $this->User_model->update_user_info($id);
                $this->load->view('header');
                $this->load->view('update_profil_confirm');
                $this->load->view('footer');
//redirect('produits/liste');
            }
        }
        else
        {
            // instanciation de la clsse User_model
            $this->load->model('User_model');
            // appel de la méthode get_user_by_id
            $user = $this->User_model->get_user_by_id($id);
            $user_view['user'] = $user;
            // chargement des vues
            $this->load->view('header.php');
            $this->load->view('update_profil.php', $user_view);
            $this->load->view('footer.php');
        }
    }

    /**
     * affichage de la liste des utilisateurs
     */
    public function list_user()
    {
        // instanciation de l'ojet User_model
        $this->load->model('User_model');
        // appel de la méthode get_all_user
        $result_list = $this->User_model->get_all_users();
        // écupération des résulats de la requète et stockage de ceux-ci dans un tableau
        $list['list'] = $result_list->result();
// chargment des vues
        $this->load->view('header');
        $this->load->view('list_user', $list);
        $this->load->view('footer');
    }

    /**
     * affichage user par id (admin) 
     */
    public function user_detail($id)
    {
        // instanciation de l'objet User_model
        $this->load->model('User_model');
        // appel de la méthode get_user_by_id
        $user = $this->User_model->get_user_by_id($id);
        $user_view['user'] = $user;
        // chargement des vue
        $this->load->view('header.php');
        $this->load->view('update_profile_admin.php', $user_view);
        $this->load->view('footer.php');
    }

    /**
     * deconnection
     */
    public function sign_out()
    {
// récupération des varibles de sessions dans un tableau
        $session_user = array('id', 'firstname', 'lastname', 'login', 'mail', 'role');
// suppresion des variables de session
        $this->session->unset_userdata($session_user);
// redirection vers la page d'accueil du sitem
        redirect(site_url('Produits/home_user'));
    }

    /**
     * méthode de suppression d'utilisateur
     */
    public function delete($id)
    {
        // instanciation de l'objet User_model
        $this->load->model('User_model');
        // appel de la méthode delete
        $this->User_model->delete($id);
        // chargement de la vue de confirmation
        $this->load->view('header');
        $this->load->view('del_confirm');
        $this->load->view('footer');
    }

}
