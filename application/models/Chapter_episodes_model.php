<?php

Class Chapter_episodes_model extends CI_Model
{
    private $table = 'chapter_episodes';
    private $table_chapters = 'course_chapters';


    public function chapters($id)
    {
        $this->db->select('*');
        $this->db->join($this->table_chapters, $this->table_chapters.'.id='.$this->table.'.id');
        $query = $this->db->get_where($this->table, [$this->table.'.id' => $id]);
        return $query->row();
    }

    public function create()
    {
        $data = [
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'video' => $this->input->post('video'),
            'item_order' => $this->input->post('item_order'),
            'chapter_id' => $this->input->post('chapter_id')
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
        return $query->row();
    }

    public function update($id)
    {
        $data = [
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'video' => $this->input->post('video'),
            'item_order' => $this->input->post('item_order')
        ];

        return $this->db->update($this->table, $data, compact($id));
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, compact($id));
    }
}