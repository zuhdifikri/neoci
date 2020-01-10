<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Categories extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Categories_model');
        $this->output->set_content_type('application/json');
    }

    public function create()
    {
        $validation = [
            [
                'field' => 'name',
                'label' => 'Nama kategori',
                'rules' => 'required|alpha'
            ]
        ];

        $this->form_validation->set_rules($validation);

        if ($this->form_validation->run()) {
            if ($this->Categories_model->create()) {
                $this->output->set_status_header(200);
                $this->output->set_output(json_encode(['message' => 'Kategori berhasil disimpan!']));
            } else {
                $this->output->set_status_header(500);
                $this->output->set_output(json_encode(['message' => 'Maaf kategori gagal disimpan']));
            }
        } else {
            $this->output->set_status_header(400);
            $this->output->set_output(json_encode(['message' => 'Data input tidak valid']));
        }
    }

    public function read($id = false)
    {
        $categories = $this->Categories_model->read($id);

        $this->output->set_status_header(200);
        $this->output->set_output(json_encode($categories));

    }

    public function update($id)
    {
        $validation = [
            [
                'field' => 'name',
                'label' => 'Nama kategori',
                'rules' => 'required'
            ]
        ];

        $this->form_validation->set_rules($validation);

        if ($this->form_validation->run()) {
            if ($this->Categories_model->update($id)) {
                $this->output->set_status_header(200);
                $this->output->set_output(json_encode(['message' => 'Kategori berhasil diubah!']));
            } else {
                $this->output->set_status_header(500);
                $this->output->set_output(json_encode(['message' => 'Maaf kategori gagal diubah']));
            }
        } else {
            $this->output->set_status_header(400);
            $this->output->set_output(json_encode(['message' => 'Data input tidak valid']));
        }
    }

    public function delete($id)
    {
        if ($this->Categories_model->delete($id)) {
        $this->output->set_status_header(200);
        $this->output->set_output(json_encode(['message' => 'Kategori berhasil dihapus!']));
        } else {
        $this->output->set_status_header(500);
        $this->output->set_output(json_encode(['message' => 'Tidak dapat menghapus kategori!']));
        }
    }





}