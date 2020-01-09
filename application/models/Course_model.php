<?php
class Course_model extends CI_Model
{
  private $table = 'courses';

  public function create()
  {
    $data = [
      'title' => $this->input->post('title'),
      'level' => $this->input->post('level'),
      'thumbnail' => $this->input->post('thumbnail'),
      'category_id' => $this->input->post('category_id'),
      'user_id' => $this->session->userdata('user_id')
    ];

    return $this->db->insert($this->table, $data);
  }

  public function read($id = false)
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
      'title' => $this->input->post('title'),
      'level' => $this->input->post('level'),
      'category_id' => $this->input->post('category_id')
    ];

    return $this->db->update($this->table, $data, compact($id));
  }

  public function delete($id)
  {
    return $this->db->delete($this->table, compact($id));
  }
}
