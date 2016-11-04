<?php

/**
 * Created by PhpStorm.
 * User: Sedvis
 * Date: 10/12/2016
 * Time: 17:16
 */
class MY_Controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('ion_auth','form_validation'));
        $this->load->helper(array('url','language','form'));
        $this->lang->load('auth','lithuanian');
        $this->lang->load('ion_auth','lithuanian');
    }
}