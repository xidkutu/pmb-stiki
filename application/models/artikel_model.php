<?php
    class Artikel_Model extends CI_Model{
        function search($keyword){
            $this->load->database();
            $query = $this->db->select('*')
                ->from('artikel')
                ->like('judul',$keyword) 
                ->or_like('konten',$keyword)
                ->get();
                
            return $query->result();
        }
        
    }
?>