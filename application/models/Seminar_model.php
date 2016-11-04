<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Sedvis
 * Date: 9/30/2016
 * Time: 6:06 PM
 */
class Seminar_model extends CI_Model
{
    public $title;
    public $date;
    public $time;
    public $location;
    public $seats;
    public $description;
    public $cost;
    public $contact;
    public $emailTemplateID;
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
        //$this->assignedID = $this->input->post('assignedID');
        $date = date_create($this->input->post('datetime'));
        $this->date = date_format($date, 'Y-m-d');
        $this->time = date_format($date, 'H:i');
        $this->location = $this->input->post('location');
        $this->title = $this->input->post('title');
        $this->seats = $this->input->post('seats');
        $this->description = $this->input->post('description');
        $this->contact = $this->input->post('contact');
        $this->cost = $this->input->post('cost');
        $this->emailTemplateID = $this->input->post('emailTemplateID');
        $this->db->insert('seminars', $this);
    }

    public function update($id = FALSE)
    {
        if ($id !== FALSE && $id >= 0) {
            $this->dateLastModified = time();
            $date = date_create($this->input->post('datetime'));
            $this->date = date_format($date, 'Y-m-d');
            $this->time = date_format($date, 'H:i');
            $this->location = $this->input->post('location');
            $this->title = $this->input->post('title');
            $this->seats = $this->input->post('seats');
            $this->description = $this->input->post('description');
            $this->cost = $this->input->post('cost');
            $this->contact = $this->input->post('contact');
            $this->emailTemplateID = $this->input->post('emailTemplateID');

            $this->db->update('seminars', $this, array('id' => $id));
        }
    }

    public function delete($id = FALSE)
    {
        if ($id != FALSE) {
            $this->db->delete('seminars', array('id' => $id));
        }
    }

    public function select($id = FALSE)
    {
        if ($id === FALSE) {
            $query = $this->db->get('seminars');
            return $query->result_array();
        }
        $query = $this->db->get_where('seminars', array('id' => $id));
        return $query->row_array();
    }

    public function exists($id)
    {
        return (bool)($this->db->get_where('seminars', array('id' => $id))->num_rows());
    }

    public function get_joined_users($id)
    {
        $userIDS = $this->db->select('user_id')->from('users_seminars')->where('seminar_id', $id)->get();
        $result = array();
        $userIDS = $userIDS->result_array();
        foreach ($userIDS as $user) {
            $result[] = $this->ion_auth->user($user['user_id'])->row();
        }
        return $result;
    }

    public function is_joined($id)
    {
        if ($this->ion_auth->logged_in()) {
            if ($this->db->get_where('users_seminars', array('user_id' => $this->ion_auth->user()->row()->id, 'seminar_id' => $id))->num_rows() > 0) {
                return true;
            } else return false;
        } else return false;
    }

    public function joined_count($id)
    {
        return $this->db->get_where('users_seminars', array('seminar_id' => $id))->num_rows();
      
    }
}