<?php
defined("BASEPATH")or exit('No script access allowed');

class Chapter_episodes extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Chapter_episodes_model');
        $this->output->set_content_type('application/json');
    }

    public function index()
    {

    }

    public function create()
    {
        $validation = [
            [
                'field' => 'title',
                'label' => 'Judul',
                'rules' => 'required'
            ],
            [
                'field' => 'description',
                'label' => 'Deskripsi',
                'rules' => 'required'
            ],
            [
                'field' => 'item_order',
                'label' => 'Urutan',
                'rules' => 'required'
            ]
        ];

        $this->form_validation->set_rules($validation);

        if ($this->form_validation->run()) {
            if ($this->Chapter_episodes_model->create()) {
                $this->output->set_status_header(200);
                $this->output->set_output(json_encode(['message' => 'Course episode berhasil ditambahkan!']));
            } else {
                $this->output->set_status_header(500);
                $this->output->set_output(json_encode(['message' => 'Gagal menambahkan course episode']));
            }
        } else {
            $this->output->set_status_header(400);
            $this->output->set_output(json_encode(['message' => 'Data input tidak valid!']));
        }
    }

    public function read($id = false)
    {
        $chapter_episodes = $this->Chapter_episodes_model->read();

        $this->output->set_status_header(200);
        $this->output->set_output(json_encode($chapter_episodes));
    }

    public function update($id)
    {
        $validation = [
            [
                'field' => 'title',
                'label' => 'Judul',
                'rules' => 'required'
            ],
            [
                'field' => 'description',
                'label' => 'Deskripsi',
                'rules' => 'required'
            ],
            [
                'field' => 'item_order',
                'label' => 'Urutan',
                'rules' => 'required'
            ]
        ];

        $this->form_validation->set_rules($validation);

        if ($this->form_validation->run()) {
            if ($this->Chapter_episodes_model->update($id)) {
                $this->output->set_status_header(200);
                $this->output->set_output(json_encode(['message' => 'Course episode berhasil diubah!']));
            } else {
                $this->output->set_status_header(500);
                $this->output->set_output(json_encode(['message' => 'Gagal mengubah course episode']));
            }
        } else {
            $this->output->set_status_header(400);
            $this->output->set_output(json_encode(['message' => 'Data input tidak valid!']));
        }   
    }

    public function delete($id)
    {
        if ($this->Chapter_episodes_model->delete($id)) {
            $this->output->set_status_header(200);
            $this->output->set_output(json_encode(['message' => 'Course episode berhasil dihapus!']));
        } else {
            $this->output->set_status_header(500);
            $this->output->set_output(json_encode(['message' => 'Gagal menghapus course episode!']));
        }
    }
}