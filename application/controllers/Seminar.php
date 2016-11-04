<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seminar extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('seminar_model');
    }

    public function index()
    {
        $this->if_exists('seminar');

        $data['title'] = 'Seminarų sąrašas';
        $data['headTitle'] = 'Seminarų sąrašas';
        $data['page'] = 'seminar';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/flashmessage', $data);
        $data['seminars'] = $this->seminar_model->select();
        foreach ($data['seminars'] as $key => $seminar) {
            if (strtotime($seminar['date'] . ' ' . $seminar['date']) < time()) {
                $data['seminars'][$key]['joined_count'] = $this->seminar_model->joined_count($seminar['id']);
                if (empty($data['seminars'][$key]['joined_count'])) {
                    $data['seminars'][$key]['joined_count'] = 0;
                }
            } else {
                array_splice($data['seminars'], $key, 1);

            }

        }
        $this->load->view('pages/seminar/seminar', $data);
        $this->load->view('templates/footer', $data);

    }

    public function users($id, $action = FALSE, $userID = FALSE)
    {

        $this->if_exists('users');
        $data['headTitle'] = 'Seminaro dalyviai';
        $data['page'] = 'seminar/users';
        $data['seminarID'] = $id;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/flashmessage', $data);
        if ($action && $action == 'kick' && $userID > 0) {
            $this->kickUser($id, $userID);
            redirect('seminar/users/' . $id, 'refresh');
        }
        $data['users'] = $this->seminar_model->get_joined_users($id);
        $this->load->view('pages/seminar/users', $data);
        $this->load->view('templates/footer', $data);
    }

    public function create()
    {

        $this->if_exists('users');
        $data['headTitle'] = 'Užregistruoti seminarą';
        $data['page'] = 'seminar/create';
        $data['js'] = array('/assets/js/custom.js', '/assets/js/moment-with-locales.min.js', '/assets/js/bootstrap-datetimepicker.min.js');
        $data['css'] = array('/assets/css/bootstrap-datetimepicker.min.css');


        if ($this->ion_auth->is_admin()) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/flashmessage', $data);
            if ($this->input->post()) {
                $config = array(
                    array(
                        'field' => 'title',
                        'label' => 'Pavadinimas',
                        'rules' => 'required|min_length[4]|max_length[50]',
                        'errors' => array(
                            'required' => '%s yra privalomas',
                        )
                    ),
                    array(
                        'field' => 'datetime',
                        'label' => 'Data ir laikas',
                        'rules' => 'required',
                        'errors' => array(
                            'required' => '%s yra privalomas',
                        )
                    ),
                    array(
                        'field' => 'seats',
                        'label' => 'Vietų skaičius',
                        'rules' => 'required|numeric',
                        'errors' => array(
                            'required' => '%s yra privalomas',
                            'numeric' => '%s turi būti skaičius',
                        )
                    ),
                    array(
                        'field' => 'cost',
                        'label' => 'Kaina',
                        'rules' => 'required|numeric',
                        'errors' => array(
                            'required' => '%s yra privaloma',
                            'numeric' => '%s turi būti skaičius',
                        )
                    ),
                    array(
                        'field' => 'contact',
                        'label' => 'Kontaktinė informacija',
                        'rules' => 'required',
                        'errors' => array(
                            'required' => '%s yra privaloma',
                        )
                    ),
                    array(
                        'field' => 'description',
                        'label' => 'Aprašymas',
                        'rules' => 'required',
                        'errors' => array(
                            'required' => '%s yra privalomas',
                        )
                    ),
                    array(
                        'field' => 'location',
                        'label' => 'Vieta',
                        'rules' => 'required',
                        'errors' => array(
                            'required' => '%s yra privaloma',
                        )
                    ),
                );
                $this->form_validation->set_rules($config);
                //TODO: email template validation missing

                if ($this->form_validation->run() === TRUE) {
                    $this->seminar_model->insert();

                    $this->session->set_flashdata('message_success', "Naujas seminaras užregistruotas");
                    redirect('seminar', 'refresh');
                }
            }

            $this->load->view('pages/seminar/create', $data);
            $this->load->view('templates/footer', $data);
        } else {
            redirect('error', 'refresh');
        }
    }

    public function detailview($id)
    {
        $this->if_exists('detailview');

        $data['headTitle'] = 'Seminaro peržiūra';
        $data['page'] = 'seminar/detailview';
        $data['is_admin'] = true;
        $data['seminar'] = $this->seminar_model->select($id);

        $data['joined'] = $this->seminar_model->is_joined($id);
        $data['seminar']['joined_count'] = $this->seminar_model->joined_count($id);
        if (empty($data['seminars']['joined_count'])) {
            $data['seminars']['joined_count'] = 0;
        }
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/flashmessage', $data);
        $this->load->view('pages/seminar/detailview', $data);
        $this->load->view('templates/footer', $data);
    }

    public function edit($id)
    {
        $this->if_exists('create');
        $data['headTitle'] = 'Seminaro redagavimas';
        $data['page'] = 'seminar/edit';
        $data['js'] = array('/assets/js/custom.js', '/assets/js/moment-with-locales.min.js', '/assets/js/bootstrap-datetimepicker.min.js');
        $data['css'] = array('/assets/css/bootstrap-datetimepicker.min.css');
        $data['id'] = $id;

        if (($this->ion_auth->in_group('mod') || $this->ion_auth->is_admin()) && $this->seminar_model->exists($id)) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/flashmessage', $data);
            $data['seminar'] = $this->seminar_model->select($id);
            $data['seminar']['joined_count'] = $this->seminar_model->joined_count($id);
            if (empty($data['seminar']['joined_count'])) {
                $data['seminar']['joined_count'] = 0;
            }
            if ($this->input->post()) {
                $config = array(
                    array(
                        'field' => 'title',
                        'label' => 'Pavadinimas',
                        'rules' => 'required|min_length[4]|max_length[50]',
                        'errors' => array(
                            'required' => '%s yra privalomas',
                        )
                    ),
                    array(
                        'field' => 'datetime',
                        'label' => 'Data ir laikas',
                        'rules' => 'required',
                        'errors' => array(
                            'required' => '%s yra privalomas',
                        )
                    ),
                    array(
                        'field' => 'seats',
                        'label' => 'Vietų skaičius',
                        'rules' => 'required|numeric|greater_than['.$data['seminar']['joined_count'].']',
                        'errors' => array(
                            'required' => '%s yra privalomas',
                            'numeric' => '%s turi būti skaičius',
                            'greater_than' => 'Yra prisijungusių narių, negalima sumažinti vietų mažiau nei '.$data['seminar']['joined_count'],
                        )
                    ),
                    array(
                        'field' => 'cost',
                        'label' => 'Kaina',
                        'rules' => 'required|numeric',
                        'errors' => array(
                            'required' => '%s yra privaloma',
                            'numeric' => '%s turi būti skaičius',
                        )
                    ),
                    array(
                        'field' => 'contact',
                        'label' => 'Kontaktinė informacija',
                        'rules' => 'required',
                        'errors' => array(
                            'required' => '%s yra privaloma',
                        )
                    ),
                    array(
                        'field' => 'description',
                        'label' => 'Aprašymas',
                        'rules' => 'required',
                        'errors' => array(
                            'required' => '%s yra privaloma',
                        )
                    ),
                    array(
                        'field' => 'location',
                        'label' => 'Vieta',
                        'rules' => 'required',
                        'errors' => array(
                            'required' => '%s yra privaloma',
                        )
                    ),
                );
                $this->form_validation->set_rules($config);

                if ($this->form_validation->run() === TRUE) {
                    $this->seminar_model->update($id);

                    $this->session->set_flashdata('message_success', "Seminaras išsaugotas");
                    redirect('seminar/edit/' . $id, 'refresh');
                }

            }

            $this->load->view('pages/seminar/create', $data);
            $this->load->view('templates/footer', $data);
        } else {
            redirect('error', 'refresh');
        }
    }

    public function delete($id)
    {
        if (($this->ion_auth->in_group('mod') || $this->ion_auth->is_admin()) && $this->seminar_model->exists($id)) {
            $this->kickAll($id, true);
            $this->seminar_model->delete($id);
            if ($this->seminar_model->exists($id)) {
                $this->session->set_flashdata('message_error', "Klaida. Pašalinti seminaro nepavyko.");
            } else {
                $this->session->set_flashdata('message_success', "Sėkmingai pašalinote seminarą.");
            }
            redirect('seminar', 'refresh');
        } else {
            redirect('error', 'refresh');
        }
    }

    public function join($id)
    {
        if ($this->ion_auth->logged_in() && $this->seminar_model->exists($id)) {
            $users_groups = array(
                'user_id' => $this->ion_auth->user()->row()->id,
                'seminar_id' => $id,
            );
            if ($this->db->get_where('users_seminars', array('user_id' => $this->ion_auth->user()->row()->id, 'seminar_id' => $id))->num_rows() > 0) {

                $this->session->set_flashdata('message_error', "Klaida. Jau esate užsiregistravęs šiam seminarui.");
                redirect('seminar', 'refresh');
            }
            if ($this->seminar_model->joined_count($id) >= $this->seminar_model->select($id)['seats']) {
                $this->session->set_flashdata('message_error', "Klaida. Seminare laisvų vietų nėra.");
                redirect('seminar', 'refresh');
            }

            $this->db->insert('users_seminars', $users_groups);
            $insert_id = $this->db->insert_id();
            if ($insert_id) {
                $this->session->set_flashdata('message_success', "Sėkmingai užsiregistravote seminarui");
            } else {
                $this->session->set_flashdata('message_error', "Klaida. Užsiregistruoti nepavyko");
            }
            redirect('seminar', 'refresh');
        } else {
            redirect('error', 'refresh');
        }
    }

    public function leave($id)
    {
        if ($this->ion_auth->logged_in() && $this->seminar_model->exists($id)) {
            if ($this->db->get_where('users_seminars', array('user_id' => $this->ion_auth->user()->row()->id, 'seminar_id' => $id))->num_rows() == 0) {
                $this->session->set_flashdata('message_error', "Klaida. Jūs nesate užsiregistravęs šiam seminarui.");
                redirect('seminar', 'refresh');
            }
            $this->db->delete('users_seminars', array('user_id' => $this->ion_auth->user()->row()->id, 'seminar_id' => $id));
            $this->session->set_flashdata('message_success', "Sėkmingai atšaukėte registraciją į seminarą");
            redirect('seminar', 'refresh');
        } else {
            redirect('error', 'refresh');
        }
    }

    protected function kick($id, $userID, $mute = FALSE, $redirect = FALSE)
    {
        if (($this->ion_auth->in_group('mod') || $this->ion_auth->is_admin()) && $this->seminar_model->exists($id)) {
            if ($this->db->get_where('users_seminars', array('user_id' => $userID, 'seminar_id' => $id))->num_rows() == 0) {
                !$mute && $this->session->set_flashdata('message_error', "Klaida. Vartotojas neužregistruotas šiam seminarui.");
                $redirect && redirect('seminar', 'refresh');
            }
            $this->db->delete('users_seminars', array('user_id' => $userID, 'seminar_id' => $id));
            !$mute && $this->session->set_flashdata('message_success', "Sėkmingai pašalinote vartotojo registraciją.");
            $redirect && redirect('seminar', 'refresh');
        } else {
            redirect('error', 'refresh');
        }
    }

    protected function kickUser($id, $userID)
    {
        if (($this->ion_auth->in_group('mod') || $this->ion_auth->is_admin()) && $this->seminar_model->exists($id)) {
            if ($this->db->get_where('users_seminars', array('user_id' => $userID, 'seminar_id' => $id))->num_rows() == 0) {
                $this->session->set_flashdata('message_error', "Klaida. Vartotojas neužregistruotas šiam seminarui.");
            }
            $this->db->delete('users_seminars', array('user_id' => $userID, 'seminar_id' => $id));
            $this->session->set_flashdata('message_success', "Sėkmingai pašalinote vartotojo registraciją.");
        } else {
            redirect('error', 'refresh');
        }
    }

    protected function kickAll($id, $mute = FALSE, $redirect = FALSE)
    {
        if (($this->ion_auth->in_group('mod') || $this->ion_auth->is_admin()) && $this->seminar_model->exists($id)) {
            if ($this->db->get_where('users_seminars', array('seminar_id' => $id))->num_rows() == 0) {
                !$mute && $this->session->set_flashdata('message_error', "Klaida. Vartotoj7 užregistruot7 šiam seminarui nėra.");
                $redirect && redirect('seminar', 'refresh');
            }
            $this->db->delete('users_seminars', array('seminar_id' => $id));
            !$mute && $this->session->set_flashdata('message_success', "Sėkmingai pašalinote visus vartotojus iš seminaro.");
            $redirect && redirect('seminar', 'refresh');
        }
    }

    private function if_exists($page)
    {
        if (!file_exists(APPPATH . 'views/pages/seminar/' . $page . '.php')) {
            show_404();
        }
    }
}
