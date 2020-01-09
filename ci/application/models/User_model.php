<?php

if (!defined('BASEPATH'))
    exit('no direct scriptp access allowed');

/**
 * Description of produitModel
 * Model concernant la table user de la base jarditou
 * 
 * @author ced27
 */
class User_model extends CI_model {

    /**
     * inscription
     */
    public function new_user($data)
    {
        $file = $this->upload->data();
        $data['password_user'] = password_hash($data['password_user'], PASSWORD_DEFAULT);
        if ($this->upload->do_upload('extension'))
        {
            $data['extension'] = substr($file['file_ext'], 1);
        }
        $this->db->insert('user', $data);
    }

    /**
     * affiche user par id
     */
    public function get_user_by_id($id)
    {
        $query = 'SELECT * FROM `user` WHERE `id_user` = ?';
        $result = $this->db->query($query, array($id));
        $user = $result->row();
        return $user;
    }

    /**
     * recherche utilisateur selon login
     */
    public function get_user_log($log)
    {
        $query = 'SELECT * FROM `user` WHERE `login_user` = ?';
        $result = $this->db->query($query, array($log));
        return $result;
    }

    /**
     * modification info utilisateur
     */
    public function update_user_info($id)
    {
        $file = $this->upload->data();
        $data = $this->input->post();
// récupération de l'extensio du fichier en vue de son insertion en base de données et extraction du '.' (codeigniter garde le point avant l'extension)
        if ($this->upload->do_upload('extension'))
        {
            $data['extension'] = substr($file['file_ext'], 1);
        }
        $this->db->where('id_user', $id);
        $this->db->update('user', $data);
    }

    /**
     * affichege de la liste des utilisateurs
     */
    public function get_all_users()
    {
        $query = 'SELECT *, DATE_FORMAT(`inscript_user`, \'%d/%m/%Y\') as `inscript_user` FROM `user`'
                . 'INNER JOIN `role` '
                . 'ON `user`.`role_user` = `role`.`id_role`';
        $result = $this->db->query($query);
        return $result;
    }

    /**
     * suppression d'un utilisateur
     */
    public function delete($id)
    {
        $this->db->where('id_user', $id);
        $this->db->delete('user');
    }

}
