<?php
defined('BASEPATH') or exit('No direcet script access allowed');
 
class User_details extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->output->set_content_type('application/json');
        $this->output->set_header('Access-Control-Allow-Origin: http://localhost:3000');

    }

    public function create()
    {
        $validation = [
            [
                'field' => 'description',
                'label' => 'Deskripsi',
                'rules' => 'required'
            ],
            [
                'field' => 'about',
                'label' => 'Tentang',
                'rules' => 'required'
            ]
        ];

        $this->form_validation->set_rules($validation);

        if ($this->form_validation->run()) {
            if ($this->User_model->create_details()) {
                $this->output->set_status_header(200);
                $this->output->set_output(json_encode(['message' => 'Detail user berhasil ditambahkan!']));
            } else {
                $this->output->set_status_header(500);
                $this->output->set_output(json_encode(['message' => 'Detail user gagal ditambahkan!']));
            }
        } else {
            $this->output->set_status_header(400);
            $this->output->set_output(json_encode(['message' => 'Data input tidak valid!']));
        }
    }

    public function read($id)
    {
        $user_details = $this->User_model->read_details($id);

        $this->output->set_status_header(200);
        $this->output->set_output(json_encode($user_details));
    }

    public function update($id)
    {
        $validation = [
            [
                'field' => 'description',
                'label' => 'Deskripsi',
                'rules' => 'required'
            ],
            [
                'field' => 'about',
                'label' => 'Tentang',
                'rules' => 'required'
            ]
        ];

        $this->form_validation->set_rules($validation);

        if ($this->form_validation->run()) {
            if ($this->User_model->update_details()) {
                $this->output->set_status_header(200);
                $this->output->set_output(json_encode(['message' => 'Detail user berhasil diubah!']));
            } else {
                $this->output->set_status_header(500);
                $this->output->set_output(json_encode(['message' => 'Detail user gagal diubah!']));
            }
        } else {
            $this->output->set_status_header(400);
            $this->output->set_output(json_encode(['message' => 'Data input tidak valid!']));
        }
        
    }

    public function delete($id)
    {
        if ($this->User_model->delete_details($id)) {
            $this->output->set_status_header(200);
            $this->output->set_output(json_encode(['message' => 'Detail user berhasil dihapus!']));
          } else {
            $this->output->set_status_header(500);
            $this->output->set_output(json_encode(['message' => 'Tidak dapat menghapus detail user!']));
          }
    }
}