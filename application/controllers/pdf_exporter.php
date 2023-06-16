<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pdf_exporter extends CI_Controller {

	/**
	 * @author : Omar Hamdani
	 * @web : 
	 * @keterangan : pdf exporter
	 **/
     
         
    public function generateHTML(){
        $content=file_get_contents('php://input');
        //$content=$this->input->post("data");
        $sess_filter['content']=$content;
        //echo $content;
        $this->session->set_userdata($sess_filter);
        
        $d['Status']='OK';
        echo json_encode($d);
    }
    
    public function eksporPdf(){
         // load the library
        $this->load->library('html2pdf_lib');
    
        /********
         * $content = the html content to be converted
         * you can use file_get_content() to get the html from other location
         *
         * $filename = filename of the pdf file, make sure you put the extension as .pdf
         * $save_to = location where you want to save the file,
         *            set it to null will not save the file but display the file directly after converted
         * ******/
        $content = $this->session->userdata('content');
        //echo $content;
        $filename = 'testing.pdf';
        $save_to = $this->config->item('upload_root');
    
        if ($this->html2pdf_lib->converHtml2pdf($content,$filename,$save_to)) {
          echo $save_to.'/'.$filename;
        } else {
          echo 'failed';
        }
    }

    public function eksporPdfLandscape(){
         // load the library
        $this->load->library('html2pdf_lib');
    
        /********
         * $content = the html content to be converted
         * you can use file_get_content() to get the html from other location
         *
         * $filename = filename of the pdf file, make sure you put the extension as .pdf
         * $save_to = location where you want to save the file,
         *            set it to null will not save the file but display the file directly after converted
         * ******/
        $content = $this->session->userdata('content');

        $filename = 'testing.pdf';
        $save_to = $this->config->item('upload_root');
    
        if ($this->html2pdf_lib->converHtml2pdfLanscape($content,$filename,$save_to)) {
          echo $save_to.'/'.$filename;
        } else {
          echo 'failed';
        }
    }

 }