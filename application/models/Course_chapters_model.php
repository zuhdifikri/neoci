<?php

class Course_chapters_model extends CI_Model
{
    private $table = 'course_chapters';
    private $table_courses = 'courses';

    public function courses($id)
    {
        $this->db->select('*');
        $this->db->join($this->table_courses, $this->table_courses.'.id='.$this->table.'.id');
        $query = $this->db->get_where($this->table, [$this->table.'.id' => $id]);
        return $query->row();
    }

    public function create()
    {
        $data = [
            'title' => $this->input->post('title'),
            'item_order' => $this->input->post('item_order'),
            'course_id' => $this->input->post('course_id')
        ];

        return $this->db->insert($this->table, $data);
    }

    public function read($id = false)
    {
        if ($id === false) {
            $this->db->order_by('item_order', 'ASC');
            $query = $this->db->get($this->table);
            return $query->result();
        }

        $query = $this->db->get_where($this->table, compact($id));
        return $query->result();
    }

    public function update($id)
    {
        $data = [
          'title' => $this->input->post('title'),
          'level' => $this->input->post('level'),
          'thumbnail' => $this->input->post('thumbnail'),
          'category_id' => $this->input->post('category_id'),
          'user_id' => $this->session->userdata('user_id')
        ];
    
        return $this->db->update($this->table, $data, compact($id));
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, compact($id));
    }

}