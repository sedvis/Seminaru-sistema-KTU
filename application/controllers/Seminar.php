<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seminar extends CI_Controller {

    public function view($page = 'seminar')
    {
        //$this->load->view('seminar');
        if ( ! file_exists(APPPATH.'views/pages/seminar/'.$page.'.php'))
        {
            // Whoops, we don't have a page for that!
            show_404();
        }
        $data['title'] = ucfirst($page);
        $data['headTitle'] = 'Seminarų peržiūra';
        $data['page'] = $page;
        $data['is_admin']=true;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('pages/seminar/'.$page, $data);
        $this->load->view('templates/footer', $data);
    }
}
