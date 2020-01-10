<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('User_model');
    $this->output->set_content_type('application/json');
    $this->output->set_header('Access-Control-Allow-Origin: http://localhost:3000');
  }

  public function index()
  {
    $this->load->view('welcome_message');
  }

  public function create()
  {
    $validation = [
      [
        'field' => 'first_name',
        'label' => 'Nama depan',
        'rules' => 'required|alpha'
      ],
      [
        'field' => 'last_name',
        'label' => 'Nama belakang',
        'rules' => 'alpha'
      ],
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
      if ($this->User_model->create()) {
        $this->output->set_status_header(200);
        $this->output->set_output(json_encode(['message' => 'User berhasil dibuat!']));
      } else {
        $this->output->set_status_header(500);
        $this->output->set_output(json_encode(['message' => 'Tidak dapat membuat user!']));
      }
    } else {
      $this->output->set_status_header(400);
      $this->output->set_output(json_encode(['message' => 'Data input tidak valid!']));
    }
  }

  public function read($id = false)
  {
    $users = $this->User_model->read($id);

    $this->output->set_status_header(200);
    $this->output->set_output(json_encode($users));
  }

  public function has_details($id)
  {
    $users = $this->User_model->user_details($id);

    $this->output->set_status_header(200);
    $this->output->set_output(json_encode($users));
  }

  public function update($id)
  {
    $validation = [
      [
        'field' => 'first_name',
        'label' => 'Nama depan',
        'rules' => 'required|alpha'
      ],
      [
        'field' => 'last_name',
        'label' => 'Nama belakang',
        'rules' => 'alpha'
      ],
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

    if ($this->form_validation->run()) {
      if ($this->User_model->update($id)) {
        $this->output->set_status_header(200);
        $this->output->set_output(json_encode(['message' => 'Data user berhasil diubah!']));
      } else {
        $this->output->set_status_header(500);
        $this->output->set_output(json_encode(['message' => 'Tidak dapat mengubah data user!']));
      }
    } else {
      $this->output->set_status_header(400);
      $this->output->set_output(json_encode(['message' => 'Data input tidak valid!']));
    }
  }

  public function delete($id)
  {
    if ($this->User_model->delete($id)) {
      $this->output->set_status_header(200);
      $this->output->set_output(json_encode(['message' => 'User berhasil dihapus!']));
    } else {
      $this->output->set_status_header(500);
      $this->output->set_output(json_encode(['message' => 'Tidak dapat menghapus user!']));
    }
  }

  

}
