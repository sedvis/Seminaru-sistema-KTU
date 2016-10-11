<?php

/**
 * Created by PhpStorm.
 * User: Sedvis
 * Date: 9/30/2016
 * Time: 6:06 PM
 */
class Seminar extends CI_Model
{

    public $id;
    public $title;
    public $date;
    public $seats;
    public $description;
    public $cost;
    public $emailTemplateID;
    public $dateCreated;
    public $dateLastModified;
    public $assignedID;

    public function __construct()
    {
        $this->load->database();
        parent::__construct();
    }


    public function insert()
    {
        $this->dateCreated = time();
        $this->dateLastModified = time();
        $this->assignedID = $this->input->post('assignedID');
        $this->date = $this->input->post('date');
        $this->title = $this->input->post('title');
        $this->seats = $this->input->post('seats');
        $this->description = $this->input->post('description');
        $this->cost = $this->input->post('cost');
        $this->emailTemplateID = $this->input->post('emailTemplateID');
        $this->db->insert('seminar_entries', $this);
    }

    public function update()
    {
        $this->id = $this->input->post('id');
        $this->dateLastModified = time();
        $this->date = $this->input->post('date');
        $this->title = $this->input->post('title');
        $this->seats = $this->input->post('seats');
        $this->description = $this->input->post('description');
        $this->cost = $this->input->post('cost');
        $this->emailTemplateID = $this->input->post('emailTemplateID');

        $this->db->update('seminar_entries', $this, array('id' => $this->id));
    }

    public function delete()
    {
        $this->id = $this->input->post('id');
        $this->db->delete('seminar_entries', array('id' => $this->id));
    }
}