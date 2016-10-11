<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seminar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        $this->if_exists('seminar');

        $data['title'] = 'Seminarų sąrašas';
        $data['headTitle'] = 'Seminarų sąrašas';
        $data['page'] = 'seminar';
        $data['is_admin'] = $this->is;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('pages/seminar/seminar', $data);
        $this->load->view('templates/footer', $data);
    }

    public function users($id = '1')
    {

        $this->if_exists('users');

        $data['headTitle'] = 'Seminaro dalyviai';
        $data['page'] = '/seminar/users';
        $data['is_admin'] = true;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('pages/seminar/users', $data);
        $this->load->view('templates/footer', $data);
    }

    public function detailview($id = '1', $action)
    {
        $this->if_exists('detailview');

        $data['headTitle'] = 'Seminaro peržiūra';
        $data['page'] = '/seminar/detailview';
        $data['is_admin'] = true;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('pages/seminar/detailview', $data);
        $this->load->view('templates/footer', $data);
    }

    public function edit($id = '1', $action)
    {
        $this->if_exists('edit');

        $data['headTitle'] = 'Seminaro redagavimas';
        $data['page'] = '/seminar/edit';
        $data['is_admin'] = true;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('pages/seminar/edit', $data);
        $this->load->view('templates/footer', $data);
    }

    private function if_exists($page)
    {
        if (!file_exists(APPPATH . 'views/pages/seminar/' . $page . '.php')) {
            show_404();
        }
    }
}
