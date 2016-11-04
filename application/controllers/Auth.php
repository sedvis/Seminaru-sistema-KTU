<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Sedvis
 * Date: 10/12/2016
 * Time: 15:23
 */
class Auth extends MY_Controller
{
    protected $data = array();

    function __construct()
    {
        parent::__construct();
        $this->data['title'] = 'Autentifikavimas';
        $this->data['headTitle'] = 'Autentifikavimas';
        $this->data['page'] = 'auth';
    }

    public function index()
    {
        redirect('error', 'refresh');
    }

    public function register()
    {

        $this->data['page_title'] = $this->lang->line('create_user_heading');
        if ($this->ion_auth->logged_in()) {
            redirect('seminars', 'refresh');
        }
        if ($this->input->post()) {
            $tables = $this->config->item('tables', 'ion_auth');
            $config = array(

                array(
                    'field' => 'first_name',
                    'label' => 'Vardas',
                    'rules' => 'required|alpha',
                    'errors' => array(
                        'required' => '%s yra privalomas',
                        'alpha' => '%s turi būti sudaryta tik iš raidžių.',
                    )
                ),
                array(
                    'field' => 'last_name',
                    'label' => 'Pavardė',
//                    'rules' => 'alpha',
//                    'errors' => array(
//                        'alpha' => '%s turi būti sudaryta tik iš raidžių.',
//                    )
                ),
                array(
                    'field' => 'email',
                    'label' => 'E-paštas',
                    'rules' => 'required|valid_email|is_unique[' . $tables['users'] . '.email]',
                    'errors' => array(
                        'required' => '%s yra privalomas',
                        'valid_email' => '%s neteisingas.',
                        'is_unique' => '%s jau naudojamas.',
                    )
                ),
                array(
                    'field' => 'password',
                    'label' => 'Slaptažodis',
                    'rules' => 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[confirmPassword]',
                    'errors' => array(
                        'required' => '%s yra privalomas',
                        'min_length' => '%s yra per trumpas',
                        'max_length' => '%s yra per ilgas',
                        'matches' => 'Slaptažodžiai nesutampa.',
                    )
                ),
                array(
                    'field' => 'confirmPassword',
                    'label' => 'Slaptažodis',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => '%s yra privalomas',
                    )
                ),
                array(
                    'field' => 'newsletter',
                    'label' => 'Naujienlaiškis',
                    'rules' => 'integer',
                    'errors' => array(
                        'integer' => 'Neteisinga reikšmė',
                    )
                ),
            );
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == true) {
                $email = strtolower($this->input->post('email'));
                $identity = $email;
                $password = $this->input->post('password');

                $additional_data = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'newsletter' => $this->input->post('newsletter'),
                );
                if ($this->ion_auth->register($identity, $password, $email, $additional_data)) {
                    // check to see if we are creating the user
                    // redirect them back to the admin page
                    $this->session->set_flashdata('message_success', 'Sėkmingai sukurta vartotojo paskyra. Galite prisijungti.');
                    redirect("seminar", 'refresh');
                } else {
                    $this->session->set_flashdata('message_error', 'Nepavyko sukurti vartotojo paskyros.');
                    redirect("auth/register", 'refresh');

                }
            }
        }
        $this->load->view('templates/header', $this->data);
        $this->load->view('templates/navbar', $this->data);
        $this->load->view('templates/flashmessage', $this->data);
        $this->load->view('pages/register', $this->data);
        $this->load->view('templates/footer', $this->data);
    }

    public function login()
    {
        if($this->ion_auth->logged_in())
            $this->logout();

        $this->data['page_title'] = 'Prisijungimas';
        if ($this->input->post()) {
            $this->form_validation->set_rules('identity', 'E-paštas', 'required');
            $this->form_validation->set_rules('password', 'Slaptažodis', 'required');
            $this->form_validation->set_rules('remember', 'Prisiminti mane', 'integer');
            if ($this->form_validation->run() === TRUE) {
                $remember = (bool)$this->input->post('remember');
                if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)) {
                    if ($this->input->post('redirect') !== NULL && !empty($this->input->post('redirect')) && $this->input->post('redirect') !== "auth/login") {
                        redirect($this->input->post('redirect'), 'refresh');
                    } else {
                        redirect('seminar', 'refresh');
                    }
                } else {
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                    if ($this->input->post('redirect') !== NULL && !empty($this->input->post('redirect'))) {
                        redirect($this->input->post('redirect'), 'refresh');
                    }

                }
            }
        }
        $this->load->view('templates/header', $this->data);
        $this->load->view('templates/navbar', $this->data);
        $this->load->view('templates/flashmessage', $this->data);
        $this->load->view('pages/login', $this->data);
        $this->load->view('templates/footer', $this->data);
    }

    public function logout()
    {
        $this->ion_auth->logout();

        redirect('', 'refresh');
    }

    // edit a user
    public function edit_user($id)
    {
        $this->data['title'] = $this->lang->line('edit_user_heading');

        if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id))) {
            redirect('error', 'refresh');
        }

        $user = $this->ion_auth->user($id)->row();
        $groups = $this->ion_auth->groups()->result_array();
        $currentGroups = $this->ion_auth->get_users_groups($id)->result();

        // validate form input
        $config = array(

            array(
                'field' => 'first_name',
                'label' => 'Vardas',
                'rules' => 'required|alpha',
                'errors' => array(
                    'required' => '%s yra privalomas',
                    'alpha' => '%s turi būti sudaryta tik iš raidžių.',
                )
            ),
            array(
                'field' => 'last_name',
                'label' => 'Pavardė',
            ),
        );
        $this->form_validation->set_rules($config);
        if (isset($_POST) && !empty($_POST)) {

            // update the password if it was posted
            if ($this->input->post('password')) {
                $config = array(
                    array(
                        'field' => 'password',
                        'label' => 'Slaptažodis',
                        'rules' => 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[confirmPassword]',
                        'errors' => array(
                            'required' => '%s yra privalomas',
                            'min_length' => '%s yra per trumpas',
                            'max_length' => '%s yra per ilgas',
                            'matches' => 'Slaptažodžiai nesutampa.',
                        )
                    ),
                    array(
                        'field' => 'confirmPassword',
                        'label' => 'Slaptažodis',
                        'rules' => 'required',
                        'errors' => array(
                            'required' => '%s yra privalomas',
                        )
                    ),
                );
                $this->form_validation->set_rules($config);
            }

            if ($this->form_validation->run() === TRUE) {
                $data = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                );

                // update the password if it was posted
                if ($this->input->post('password')) {
                    $data['password'] = $this->input->post('password');
                }


                // Only allow updating groups if user is admin
                if ($this->ion_auth->is_admin()) {
                    //Update the groups user belongs to
                    $groupData = $this->input->post('groups');

                    if (isset($groupData) && !empty($groupData)) {

                        $this->ion_auth->remove_from_group('', $id);

                        foreach ($groupData as $grp) {
                            $this->ion_auth->add_to_group($grp, $id);
                        }

                    }
                }

                // check to see if we are updating the user
                if ($this->ion_auth->update($user->id, $data)) {
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('message_success', $this->ion_auth->messages());
                    if ($this->ion_auth->is_admin()) {
                        redirect('auth/users', 'refresh');
                    } else {
                        redirect('seminars', 'refresh');
                    }

                } else {
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('message_error', $this->ion_auth->errors());
                    if ($this->ion_auth->is_admin()) {
                        redirect('auth/users', 'refresh');
                    } else {
                        redirect('seminars', 'refresh');
                    }
                }
            }
        }

        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        // pass the user to the view
        $this->data['user'] = $user;
        $this->data['groups'] = $groups;
        $this->data['currentGroups'] = $currentGroups;

        $this->data['first_name'] = array(
            'name' => 'first_name',
            'id' => 'first_name',
            'type' => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('first_name', $user->first_name),
        );
        $this->data['last_name'] = array(
            'name' => 'last_name',
            'id' => 'last_name',
            'type' => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('last_name', $user->last_name),
        );
        $this->data['password'] = array(
            'name' => 'password',
            'id' => 'password',
            'class' => 'form-control',
            'type' => 'password'
        );
        $this->data['confirmPassword'] = array(
            'name' => 'confirmPassword',
            'id' => 'confirmPassword',
            'type' => 'password',
            'class' => 'form-control',
        );

        $this->load->view('templates/header', $this->data);
        $this->load->view('templates/navbar', $this->data);
        $this->load->view('templates/flashmessage', $this->data);
        $this->load->view('pages/admin/edit_user', $this->data);
        $this->load->view('templates/footer', $this->data);
    }

    public function users()
    {
        if ($this->ion_auth->is_admin()) {
            $this->data['headTitle'] = 'Sistemos vartotojai';
            $this->data['page'] = 'auth/users';
            $this->data['users'] = array();

            foreach ($this->ion_auth->users()->result_array() as $user) {
                $this->data['users'][] = $user;
            }
            $this->load->view('templates/header', $this->data);
            $this->load->view('templates/navbar', $this->data);
			$this->load->view('templates/flashmessage', $this->data);
            $this->load->view('pages/admin/users', $this->data);
            $this->load->view('templates/footer', $this->data);
        } else {
            redirect('error', 'refresh');
        }
    }

    public function delete($id)
    {
        if ($this->ion_auth->is_admin() && isset($id)) {
            $this->db->delete('users_groups', array('user_id' => $id));
            $this->db->delete('users', array('id' => $id));
            if ($this->ion_auth->user($id) == false) {
                $this->session->set_flashdata('message_success', "Sėkmingai pašalintas vartotojas");
            } else {
                $this->session->set_flashdata('message_error', "Klaida. Nepavyko pašalinti vartotojo");
            }
            redirect('auth/users','refresh');
        } else
            redirect('error', 'refresh');
    }
}