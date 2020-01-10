<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Course extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Course_model');
    $this->output->set_content_type('application/json');
    $this->output->set_header('Access-Control-Allow-Origin: http://localhost:3000');

  }

  public function index()
  {
    $this->load->view('courses');
  }

  //create
  public function create()
  {
    $validation = [
      [
        'field' => 'title',
        'label' => 'Judul',
        'rules' => 'required'
      ],
      [
        'field' => 'level',
        'label' => 'Level',
        'rules' => 'required'
      ]
    ];

    $this->form_validation->set_rules($validation);

    if ($this->form_validation->run()) {
      if ($this->Course_model->create()) {
        $this->output->set_status_header(200);
        $this->output->set_output(json_encode(['message' => 'Course berhasil dibuat!']));
      } else {
        $this->output->set_status_header(500);
        $this->output->set_output(json_encode(['message' => 'Tidak dapat membuat course!']));
      }
    } else {
      $this->output->set_status_header(400);
      $this->output->set_output(json_encode(['message' => 'Data input tidak valid!']));
    }

  }


  //read
  public function read($id = false)
  {
    $courses = $this->Course_model->read($id);

    $this->output->set_status_header(200);
    $this->output->set_output(json_encode($users));
  }


  //update
  public function update($id)
  {
    $validation = [
      [
        'field' => 'title',
        'label' => 'Judul',
        'rules' => 'required'
      ],
      [
        'field' => 'level',
        'label' => 'Level',
        'rules' => 'required'
      ]
    ];

    if ($this->form_validation->run()) {
      if ($this->Course_model->update($id)) {
        $this->output->set_status_header(200);
        $this->output->set_output(json_encode(['message' => 'Data course berhasil diubah!']));
      } else {
        $this->output->set_status_header(500);
        $this->output->set_output(json_encode(['message' => 'Tidak dapat mengubah data course!']));
      }
    } else {
      $this->output->set_status_header(400);
      $this->output->set_output(json_encode(['message' => 'Data input tidak valid!']));
    }
  }


  //delete
  public function delete($id)
  {
    if ($this->Course_model->delete($id)) {
      $this->output->set_status_header(200);
      $this->output->set_output(json_encode(['message' => 'Course berhasil dihapus!']));
    } else {
      $this->output->set_status_header(500);
      $this->output->set_output(json_encode(['message' => 'Tidak dapat menghapus course!']));
    }
  }

  public function search()
  {
    $validation = [
      [
        'field' => 'keywords',
        'label' => 'Kata kunci',
        'rules' => 'required'
      ]
    ];

    $this->form_validation->set_rules($validation);

    if ($this->form_validation->run()) {
      if ($this->Course_model->search()) {
        $this->output->set_status_header(200);
        $this->output->set_output(json_encode($users));
      } 
    }

  }
  
  public function has_categories($id)
  {
    $categories = $this->Course_model->categories($id);

    $this->output->set_status_header(200);
    $this->output->set_output(json_encode($categories));
  }

  public function has_users($id)
  {
    $users = $this->Course_model->users($id);

    $this->output->set_status_header(200);
    $this->output->set_output(json_encode($users));
  }

  






}
