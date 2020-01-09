<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('User_model');
  }

  public function index()
  {
    $this->load->view('auth/login');
  }

  public function check_login()
  {
    $validation = [
      [
        'field' => 'email',
        'label' => 'E-mail',
        'rules' => 'required|valid_email'
      ],
      [
        'field' => 'password',
        'label' => 'Password',
        'rules' => 'required'
      ]
    ];

    $this->form_validation->set_rules($validation);

    if ($this->form_validation->run()) {
      $user = $this->User_model->login_check();

      if ($user) {
        $data = [
          'name' => $user->first_name,
          'is_login' => true
        ];

        $this->session->set_userdata($data);

        redirect(site_url('home'));
      }
    } else {
      redirect(site_url('login'));
    }
  }
}
