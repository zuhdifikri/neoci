<?php
defined('BASEPATH')or exit('No script access allowed');

class Course_chapters extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Course_chapters_model');
        $this->output->set_content_type('application/json');
        $this->output->set_header('Access-Control-Allow-Origin: http://localhost:3000');

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
                'field' => 'item_order',
                'label' => 'Urutan',
                'rules' => 'required'
            ]
        ];

        $this->form_validation->set_rules($validation);

        if ($this->form_validation->run()) {
            if ($this->Course_chapter_model->create()) {
                $this->output->set_status_header(200);
                $this->output->set_output(json_encode(['message' => 'Chapter berhasil dibuat!']));
            } else {
                $this->output->set_status_header(500);
                $this->output->set_output(json_encode(['message' => 'Gagal menambahkan chapter!']));
            }
        } else {
            $this->output->set_status_header(400);
            $this->output->set_output(json_encode(['message' => 'Data input tidak valid!']));
        }
    }

    public function read($id = false)
    {
        $course_chapters = $this->Course_chapters_model->read();
        
        $this->output->set_status_header(200);
        $this->output->set_output(json_encode($course_chapters));
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
                'field' => 'item_order',
                'label' => 'Urutan',
                'rules' => 'required'
            ]
        ];

        $this->form_validation->set_rules($validation);

        if ($this->form_validation->run()) {
            if ($this->Course_chapter_model->update($id)) {
                $this->output->set_status_header(200);
                $this->output->set_output(json_encode(['message' => 'Chapter berhasil diubah!']));
            } else {
                $this->output->set_status_header(500);
                $this->output->set_output(json_encode(['message' => 'Gagal mengubah chapter!']));
            }
        } else {
            $this->output->set_status_header(400);
            $this->output->set_output(json_encode(['message' => 'Data input tidak valid!']));
        }
    }

    public function delete($id)
    {
        if ($this->Course_chapters_model->delete($id)) {
            $this->output->set_status_header(200);
            $this->output->set_output(json_encode(['message' => 'Chapter berhasil dihapus']));
        } else {
            $this->output->set_status_header(500);
            $this->output->set_output(json_encode(['message' => 'Tidak dapat menghapus chapter']));
        }
    }

    public function has_courses($id)
    {
        $courses = $this->Course_chapters_model->courses($id);

        $this->output->set_status_header(200);
        $this->output->set_output(json_encode($courses));
    }
}