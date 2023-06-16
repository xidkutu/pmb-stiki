<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function getNewNoTes($kodeProdi,$kodeJalur,$idCamaba){
    $model = get_instance();
    $model->load->model('app_model');
    
    $tahun=$model->app_model->getConfigItem('tahun_penerimaan');
    $prodi=$model->app_model->getConfigItem($kodeProdi);
    if(strlen($kodeJalur)==1) $kodeJalur='0'.$kodeJalur;
    
    $res=substr($tahun,2,2).$prodi.$kodeJalur;
    $res=$model->app_model->getNewNoTes($res,$idCamaba);
    return $res;
}

function getNewNrp($kodeProdi,$kelasMhs,$masuk,$idCamaba){
    $model = get_instance();
    $model->load->model('app_model');
    
    $tahun=$model->app_model->getConfigItem('tahun_penerimaan');
    $prodi=$model->app_model->getDetailProdi($kodeProdi);
    $fakultas=$prodi['Kode_Fakultas'];
    $jnjang=$model->app_model->getConfigItem($prodi['Jenjang']);
    $noProdi=$model->app_model->getConfigItem("nrp_".$kodeProdi);
    
    if(strtoupper($kelasMhs)=='R' && strtoupper($masuk)=='BARU')
        $kodeJalur='1';
    else if(strtoupper($kelasMhs)=='R' && strtoupper($masuk)=='PINDAHAN')
        $kodeJalur='2';
    else if(strtoupper($kelasMhs)=='N' && strtoupper($masuk)=='BARU')
        $kodeJalur='3';
    else if(strtoupper($kelasMhs)=='N' && strtoupper($masuk)=='PINDAHAN')
        $kodeJalur='4';
    
    $res=substr($tahun,2,2).$fakultas.$jnjang.$noProdi.$kodeJalur;
    $res=$model->app_model->getNewNrp($res,$idCamaba);
    return $res;
}
?>