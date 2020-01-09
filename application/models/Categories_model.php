<?php

class Categories_model extends CI_Model
{
    private $table = 'categories';

    public function create()
    {
        $data = [
            'name' => $this->input->post('name')
          ];
      
          return $this->db->insert($this->table, $data);
    }

    public function read()
    {
        if ($id === false) {
        $query = $this->db->get($this->table);
        return $query->result();
        }

        $query = $this->db->get_where($this->table, compact($id));
        return $query->row();
    }

    public function update($id)
    {
        $data = [
            'name' => $this->input->post('name')
          ];
        return $this->db->update($this->table, $data, compact($id));
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, compact($id));
    }



}