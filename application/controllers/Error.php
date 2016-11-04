<?php
/**
 * Created by PhpStorm.
 * User: Sedvis
 * Date: 10/16/2016
 * Time: 11:02
 */
class Error extends MY_Controller
{
    public function index()
    {
        $data['title'] = 'Klaida';
        $data['headTitle'] = 'Klaida';
        $data['page'] = 'error';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/flashmessage', $data);
        $this->load->view('templates/error', $data);
        $this->load->view('templates/footer', $data);
    }
}
