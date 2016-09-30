<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    public function index()
    {
        //$this->load->view('seminar');
        if ( ! file_exists(APPPATH.'views/pages/register.php'))
        {
            // Whoops, we don't have a page for that!
            show_404();
        }

        $data['headTitle'] = 'Vartotojo registracija';
        $data['page'] = 'register';
        $data['is_admin']=true;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('pages/register', $data);
        $this->load->view('templates/footer', $data);
    }
}
