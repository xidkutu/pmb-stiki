<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function generateMenu($namaUser){
    $model = get_instance();
    $model->load->model('system_model');

    $strHTML='';
    $strHTMLMenu='';
    
	$dataInduk = $model->system_model->get_induk(); 
    foreach($dataInduk as $indukList){
        if (count($indukList['child'])==0){
            //untuk yg tidak ada child
            if($indukList['URL']==''){
                $baseurl='#';
            }else
            {
                $baseurl=base_url();
                $baseurl=substr($baseurl,0,strlen($baseurl)-1);
                $baseurl.=$indukList['URL'];
            }
            
            $strHTMLMenu.="<li id='".$indukList['Classname']."'>
					<a href='".$baseurl."'>
					<i class='".$indukList['Icon']."'></i>
					<span class='title'>".$indukList['Nama_Menu']."</span>
					</a>
				</li>";
        }else{
            $strHTMLMenu.="<li class='has-child'>
					<a href='javascript:;'>
					<i class='".$indukList['Icon']."'></i>
					<span class='title'>".$indukList['Nama_Menu']."</span>
					<span class='arrow' id='arrw_".$indukList['Menu_id']."'></span>
					</a>
                    <ul class='sub-menu'>
                    ";
                        
            $strHTMLMenu .= generateSubMenu($indukList['Menu_id']);
            $strHTMLMenu .= '</ul></li>';
            
        }
        
    }
 
    return $strHTMLMenu;
}

function generateSubMenu($induk){
    $model = get_instance();
    $model->load->model('system_model');
    $dataChild = $model->system_model->get_child($induk);
        
    $str='';
    foreach($dataChild as $listChild){
        if($listChild['URL']==''){
                $baseurl='#';
            }else
            {
                $baseurl=base_url();
                $baseurl=substr($baseurl,0,strlen($baseurl)-1);
                $baseurl.=$listChild['URL'];
            }
        if(count($listChild['child'])!= 0){     
            $str.="<li class='has-child has-parent'>
							<a href='javascript:;'>
							<i class='".$listChild['Icon']."'></i> ".$listChild['Nama_Menu']." 
                            <span class='arrow' id='arrw_".$listChild['Menu_id']."'></span>
							</a>
							<ul class='sub-menu'>";
            $str .= generateSubMenu($listChild['Menu_id']);
            $str .= '</ul></li>';
        }else{
            $str.='<li class="has-parent" id="'.$listChild['Classname'].'">
							<a href="'.$baseurl.'">
							<i class="'.$listChild['Icon'].'"></i>
							'.$listChild['Nama_Menu'].' </a>
						</li>';
        }
    }
    return $str;
}
