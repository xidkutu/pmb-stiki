<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function generateBreadcrumb($activePage){
    $model = get_instance();
    $model->load->model('system_model');
    
    $breadcrumb='<ul class="page-breadcrumb">';    
	$lastPage = $model->system_model->getBreadCrumb($activePage);
    $url=base_url().'index.php'.$lastPage['URL'];
    if($lastPage['Induk_Menu']=='' || $lastPage['Induk_Menu']=='0'){
        $breadcrumb.='<li class="active">
					<a href="'.$url.'">'.$lastPage['Nama_Menu'].'</a>
				</li>';
    }else{
        $breadcrumb.=generateParent($lastPage['Induk_Menu']);
        $breadcrumb.='<li>
					<a href="'.$url.'">'.$lastPage['Nama_Menu'].'</a>
                    <i class="fa fa-circle"></i>
				</li>';
    }
    
    $breadcrumb.='</ul>';
    
    return $breadcrumb;
     
}

function generateParent($id){
    $model = get_instance();
    $model->load->model('system_model');
    
    $breadcrumb='';    
	$lastPage = $model->system_model->getBreadCrumb($id);
    $url=base_url().'index.php'.$lastPage['URL'];
    if($lastPage['Induk_Menu']=='' || $lastPage['Induk_Menu']=='0'){
        $breadcrumb.='<li>
					<a href="'.$url.'">'.$lastPage['Nama_Menu'].'</a>
                    <i class="fa-circle"></i>
				</li>';
    }else{
        $breadcrumb.=generateParent($lastPage['Induk_Menu']);
        $breadcrumb.='<li>
					<a href="'.$url.'">'.$lastPage['Nama_Menu'].'</a>
                    <i class="fa-circle"></i>
				</li>';
    }
    
    return $breadcrumb;
     
}

function genBCByClassName($className){
    $model = get_instance();
    $model->load->model('system_model');
    $lastBc = $model->system_model->getBreadCrumb($className);
    if(count($lastBc)>0){
        if($lastBc['URL']=='') $link='#';else $link=base_url().'index.php'.$lastBc['URL'];
        $bc[0]=array(
            'caption'=>$lastBc['Nama_Menu'],
            'link'=>$link,
        );
        if(!$lastBc['Induk_Menu']=='')
            $bc=genChildBCBYClassName($bc,$lastBc['Induk_Menu']);
        $bc=array_reverse($bc);
        return genBreadCrumbByArray($bc);    
    }return false;
}

function genChildBCBYClassName($bc,$className){
    $model = get_instance();
    $model->load->model('system_model');
    $lastBc = $model->system_model->getBreadCrumbByMenuId($className);
    if($lastBc['URL']=='') $link='#';else $link=base_url().'index.php'.$lastBc['URL'];
    $childBc=array(
        'caption'=>$lastBc['Nama_Menu'],
        'link'=>$link,
    );
    array_push($bc,$childBc);
    if(!$lastBc['Induk_Menu']=='')
        $bc=genChildBCBYClassName($bc,$lastBc['Induk_Menu']);
    return $bc;
}

function genBreadCrumbByArray($bcs){
/*
    array structure
    $bcs=array(
        0=>array(
            'caption'=>'Camaba',
            'link'=>'http://localhost/pmb/index.php/rf_pmb_camaba'
        ),
        1=>array(
            'caption'=>'Data Master',
            'link'=>'#'
        ),
    );
*/
    $breadcrumb='';
    foreach($bcs as $i=>$bc){
        if($i==(count($bcs)-1))
        $breadcrumb.='<li>
					<a href="'.$bc['link'].'">'.$bc['caption'].'</a>
				</li>';
        else
        $breadcrumb.='<li>
					<a href="'.$bc['link'].'">'.$bc['caption'].'</a>
                    <i class="fa fa-circle"></i>
				</li>';
    }
    return $breadcrumb;
}