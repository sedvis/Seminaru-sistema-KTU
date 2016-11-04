<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Sedvis
 * Date: 9/30/2016
 * Time: 6:06 PM
 */
class Newsletter_model extends CI_Model
{
    public $title;
    public $newsletter;
    public $dateCreated;
    public $dateLastModified;

    public function __construct()
    {
        $this->load->database();
        parent::__construct();
    }


    public function insert()
    {
        $this->dateCreated = time();
        $this->dateLastModified = time();
        $this->title = $this->input->post('title');
        $this->newsletter = $this->input->post('newsletter');
        $this->db->insert('email', $this);
    }

    public function update($id = FALSE)
    {
        if ($id !== FALSE && $id >= 0) {

            $this->dateLastModified = time();
            $this->title = $this->input->post('title');
            $this->newsletter = $this->input->post('newsletter');

            $this->db->update('email', $this, array('id' => $id));
        }
    }

    public function delete($id = FALSE)
    {
        if ($id != FALSE) {
            $this->db->delete('email', array('id' => $id));
        }
    }
    public function select($id = FALSE)
    {
        if ($id === FALSE) {
            $query = $this->db->get('email');
            return $query->result_array();
        }
        $query = $this->db->get_where('email', array('id' => $id));
        return $query->row_array();
    }
}