<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('User_model');
    $this->output->set_content_type('application/json');
    $this->output->set_header('Access-Control-Allow-Origin: http://localhost:3000');
    $this->output->set_header('Access-Control-Allow-Methods: POST, OPTIONS');
    $this->output->set_header('Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding');

    // if ( "OPTIONS" === $_SERVER['REQUEST_METHOD'] ) {
    //   die();
    // }
  }

  public function index()
  {
    $this->load->view('auth/login');
  }

  public function login()
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
        unset($user->password);
        $this->output->set_status_header(200);
        $this->output->set_output(json_encode($user));
      } else {
        $this->output->set_status_header(400);
      }
    } else {
      $this->output->set_status_header(400);
    }
  }
}
