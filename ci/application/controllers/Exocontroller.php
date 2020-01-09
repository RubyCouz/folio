<?php

// application/controllers/Produits.php	
//instruction de sécurité empéchant l'accès direct au fichier
defined('BASEPATH') OR exit('No direct script access allowed');

// création de la classe Produits héritant des propriétés de la classe CI_Controller (important : nom de la classe avec première lettre en majuscule, tout comme le fichier)
class ExoController extends CI_Controller {

    /**
     * exo 1
     */
    public function firstExo() {
        // Déclaration du tableau associatif à transmettre à la vue	
//        $aView = array();
//        // Dans le tableau, on créé une donnée 'prénom' qui a pour valeur 'Dave'    
//        $aView["prenom"] = "Dave";
        $aProduits = array();
        $this->load->helper('array');
        $aProduits = ["Aramis", "Athos", "Clatronic", "Camping", "Green"];
        var_dump($aProduits);
        // On passe le tableau en second argument de la méthode 

        $this->load->view('header');
//        $this->load->view('exo', $aView);
        $this->load->view('exo', $aProduits);
        $this->load->view('footer');
    }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

