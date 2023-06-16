<?php

class datatable {
	
	/**
	 * Library datatable untuk Codeigniter
	 *
	 *  @param  array 					$columns 			Kolom yang ditampilkan di datatable, harus urut, untuk pilihan / option gunakan "options-no-db"
	 *  @param  string|db class $table   			Nama tabel, bisa berupa string atau object dari db, contoh: $table = $this->db->from('namatebel');
	 *  @param 	string          $primary_key 	Primary key untuk tiap-tiap row, terletak pada index terakhir pada data (biasanya untuk kolom action)
	 *  @param  boolean 				$output_raw 	Jika true maka akan memberikan output data berupa data mentah
	 *  @return object												Output berupa object yang siap untuk dijadikan json
	 */
	 
	function render($columns = array(), $table = false, $primary_key = 'id', $output_raw = false, $custom_query=false)
	{
		error_reporting(E_ALL);
		
		if (!is_array($columns) || count($columns) < 1 || !$table) return false;
		$CI = & get_instance();
		$length = $_GET['length'];
		$start = $_GET['start'];
		$keyword = $_GET['search']['value'];
		$sort = $_GET['order'];
		$attr = $_GET['columns'];
		$draw = $_GET['draw'];
		
		

		if (!$custom_query)
		{
			$table = (is_object($table)) ? $table : $CI->db->from($table);
			$sort = (count($sort) > 0) ? $sort[0] : false;
			$query_before_filter = $table->_compile_select();
		} 
		else
		{
			$sql = $table;
			$table =  $CI->db;
		}
		
		//search in all column
		if (!$custom_query)
		{
			$where = array();
			if ($sort) $table->order_by($columns[$sort['column']], $sort['dir']);
			if ($keyword) foreach ($columns as $col) if ($col != 'options-no-db') array_push($where, "$col like \"%$keyword%\"");
		}
		else
		{
			$where = array();
			if ($sort) $sort = 'Order by asas.'.$columns[$sort[0]['column']].' '.$sort[0]['dir'];
			if ($keyword) foreach ($columns as $col) if ($col != 'options-no-db') array_push($where, "asas.$col like \"%$keyword%\"");
		}
		
		if (!$custom_query)
		{
			if (count($where) > 0)
			{		
				$where = implode(' or ', $where);
				$table->where("($where)");
			}
		} else {
			if (count($where) > 0)
			{		
				
				$where = implode(' or ', $where);
				$where = "($where) ";
				
			} 
			else $where = '';
			
		}
		
		
		if (!$custom_query)
		{
			//search by per column
			foreach ($attr as $key=>$col) if ($col['search']['value']) $table->like($columns[$key], $col['search']['value']);			
		}
		else 
		{
			$search_pc = array();
			foreach ($attr as $key=>$col) if ($col['search']['value']) array_push($search_pc, 'asas.'.$columns[$key] .' like \'%'. $col['search']['value'].'%\'');
			if (count($search_pc) > 0) $search_pc = implode(' and ', $search_pc);			
			else $search_pc = '';
		}
		
        $query = ($custom_query) ? $sql :  $table->_compile_select();
		
        if ($custom_query)
		{
			
			$where_c = '';
			if ($where && $search_pc) $where_c = " where $where and $search_pc ";
			else if ($where)  $where_c = " where $where ";
			else if ($search_pc)  $where_c = " where $search_pc "; 
			
			$query = "Select * From ($query) as asas $where_c";
		}
        
        $total_before = ($custom_query) ?  $table->query($query)->num_rows() : $table->query($query_before_filter)->num_rows();
		$total_after = $table->query($query)->num_rows();
		
        if($length>0) $limit="LIMIT $start,$length"; else $limit="";
        if ($custom_query)
		{
			
			$where_c = '';
			if ($where && $search_pc) $where_c = " where $where and $search_pc ";
			else if ($where)  $where_c = " where $where ";
			else if ($search_pc)  $where_c = " where $search_pc "; 
			
			$query = "Select * From ($query) as asas $where_c $sort $limit;";
		}
		else
		{
			$query = "$query $limit;";
		}
		$data = $table->query($query)->result();
		
		
		
		if (!$output_raw) 
		{
			$data_fix = array();
			foreach ($data as $row)
			{
				$data_row = array();
				foreach($columns as $key=>$val) 
				{
					if ($val == 'options-no-db')
					{
						$data_row[$key] =
						"<div class='btn-group'><a href='#' data-toggle='dropdown' class='dropdown-toggle'><i class='fa fa-cog'></i></a>
							 <ul class='dropdown-menu pull-right text-left'>
									<li><a class='clickable' onclick='detail_data(\"".$row->$primary_key."\")'>Lihat Detail</a></li>
									<li><a class='clickable' onclick='edit_data(\"".$row->$primary_key."\")'>Ubah</a></li>
									<li><a class='clickable' onclick='delete_data(\"".$row->$primary_key."\")'>Hapus</a></li>
							 </ul>
						</div>";
					}
					else $data_row[$key] = $row->$val;
				}
				array_push($data_fix, $data_row);		
			}
		} 
		else $data_fix = $data;
		
		$output = (object)array(
			"draw" => $draw,
			"recordsTotal" => $total_before,
			"recordsFiltered" => $total_after,
			"data" => $data_fix
		);
		
		return $output;
		
	}
	
}

