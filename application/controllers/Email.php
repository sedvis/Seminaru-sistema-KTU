<?php

/**
 * Created by PhpStorm.
 * User: Sedvis
 * Date: 10/31/2016
 * Time: 16:15
 */
class Email extends MY_Controller
{

    /**
     * Email constructor.
     */

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('email');
        $this->load->model('newsletter_model');
        $this->email->set_newline("\r\n");
    }

    public function index()
    {
        $data['headTitle'] = 'Naujienlaiškių sąrašas';
        $data['page'] = 'email';

        if ($this->ion_auth->in_group('mod') || $this->ion_auth->is_admin()) {
            $data['emails'] = $this->newsletter_model->select();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/flashmessage', $data);
            $this->load->view('pages/email/emails', $data);
            $this->load->view('templates/footer', $data);
        } else {
            redirect('error', 'refresh');
        }

    }

    public function reminder($id, $userid = null)
    {
        if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('mod')) {
            $this->load->model('seminar_model');
            $seminar = $this->seminar_model->select($id);
            $users = array();
            if ($userid != null && is_numeric($userid)) {
                $users[] = $this->ion_auth->user($userid)->row();
            } else {
                $users = $this->seminar_model->get_joined_users($id);
            }
            foreach ($users as $user) {
                $this->email->from('seminarusistema@gmail.com');
                $this->email->to($user->email);

                $this->email->subject('Seminaro priminimas');

                $this->email->message('
Sveiki , primename, kad esate užsiregistravęs seminarui - "' . $seminar['title'] . '"
Vieta: ' . $seminar['location'] . '
Data ir laikas: ' . $seminar['date'] . ' ' . $seminar['time'] . '
Laukiame jūsų atvykstant.
                             
Jei atvykti negalite, prašome atšaukti savo registraciją sistemoje.
        ');
                if ($this->email->send()) {
                    $this->session->set_flashdata('message_success', "Laiškai išsiųsti sėkmingai");
                    redirect('seminar/detailview/' . $id, 'refresh');
                } else {
                    $this->session->set_flashdata('message_error', "Nepavyko išsiųsti bent vieno laiško");
                    redirect('seminar/detailview/' . $id, 'refresh');
                }
            }
        }

    }

    public function newsletter($id = null)
    {

        if ($id == null) {
            $data['headTitle'] = 'Naujienlaiškio kūrimas';
        } else {
            $data['headTitle'] = 'Naujienlaiškio redagavimas';
            $data['email'] = $this->newsletter_model->select($id);
        }
        $data['page'] = 'email/newsletter';
        if ($this->ion_auth->in_group('mod') || $this->ion_auth->is_admin()) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/flashmessage', $data);
            if ($this->input->post()) {
                $config = array(
                    array(
                        'field' => 'title',
                        'label' => 'Pavadinimas',
                        'rules' => 'required',
                        'errors' => array(
                            'required' => '%s yra privalomas',
                        )
                    ),
                    array(
                        'field' => 'newsletter',
                        'label' => 'Naujienlaiškio tekstas',
                        'rules' => 'required',
                        'errors' => array(
                            'required' => '%s yra privalomas',
                        )
                    ),
                );
                $this->form_validation->set_rules($config);

                if ($this->form_validation->run() === TRUE) {
                    if ($id == null) {
                        $this->newsletter_model->insert();
                    } else {
                        $this->newsletter_model->update($id);
                    }
                    $this->session->set_flashdata('message_success', "Naujienlaiškis išsaugotas");
                    redirect($data['page'], 'refresh');
                }

            }

            $this->load->view('pages/email/newsletter', $data);
            $this->load->view('templates/footer', $data);
        } else {
            redirect('error', 'refresh');
        }
    }

    public function send($id)
    {
        if ($this->ion_auth->is_admin() || $this->ion_auth->in_group('mod')) {
            $allUsers = $this->ion_auth->users()->result();
            $news = $this->newsletter_model->select($id);

            foreach ($allUsers as $user) {
                $this->email->from('seminarusistema@gmail.com');
                $this->email->to($user->email);

                $this->email->subject($news['title']);

                $this->email->message($news['newsletter']);
                if (!$this->email->send()) {
                    $this->session->set_flashdata('message_error', "Nepavyko išsiųsti bent vieno laiško");
                    redirect('email/', 'refresh');
                }
            }
            $this->session->set_flashdata('message_success', "Laiškai išsiųsti sėkmingai");
            redirect('email/', 'refresh');
        }
        else
            redirect('error','refresh');
    }
}