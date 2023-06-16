<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_multileveldata extends CI_Model
{

    public function get_induk($induk='0'){
        
        $data = array();
        $result = $this->db->query('SELECT
            	g.Group_id,
            	g.Menu_id,
            	m.Order_Menu,
            	m.Nama_Menu,
            	m.Induk_Menu,
            	m.URL,
            	m.Icon
            FROM
            	tb_app_tr_group_menu g
            INNER JOIN tb_app_rf_menus m ON g.Menu_id = m.Menu_id
            WHERE
            	g.Group_id = "'.$this->session->userdata('role').'"
                AND m.Induk_Menu = "'.$induk.'"
            ORDER BY
            	Order_Menu ASC');
	
		foreach($result->result() as $row)
		{
			$data[] = array(
					'Menu_id'	=>$row->Menu_id,
					'Nama_Menu'	=>$row->Nama_Menu,
                    'Icon'  =>$row->Icon,
                    'URL'   =>$row->URL,
                    'child'	=>$this->get_child($row->Menu_id)										
				);
		}
		return $data;
    }
    
	public function get_child($id)
	{
		$data = array();
		$result = $this->db->query('SELECT
            	g.Group_id,
            	g.Menu_id,
            	m.Order_Menu,
            	m.Nama_Menu,
            	m.Induk_Menu,
            	m.URL,
            	m.Icon
            FROM
            	tb_app_tr_group_menu g
            INNER JOIN tb_app_rf_menus m ON g.Menu_id = m.Menu_id
            WHERE
            	g.Group_id = "'.$this->session->userdata('role').'"
                AND m.Induk_Menu = "'.$id.'"
            ORDER BY
            	Order_Menu ASC');

		foreach($result->result() as $row)
		{
	       $data[] = array(
					'Menu_id'	=>$row->Menu_id,
					'Nama_Menu'	=>$row->Nama_Menu,
                    'Icon'  =>$row->Icon,
                    'URL'   =>$row->URL,
					'child'	=>$this->get_child($row->Menu_id)
				);
		}
		return $data;
	}
}