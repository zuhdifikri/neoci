<?php
class Course_model extends CI_Model
{
  private $table = 'courses';
  private $table_categories = 'categories';
  private $table_users = 'users';


  public function categories($id)
  {
      $this->db->select('*');
      $this->db->join($this->table_categories, $this->table_categories.'.id='.$this->table.'.id');
      $query = $this->db->get_where($this->table, [$this->table.'.id' => $id]);
      return $query->row();
  }
  
  public function users($id)
  {
      $this->db->select('*');
      $this->db->join($this->table_users, $this->table_users.'.id='.$this->table.'.id');
      $query = $this->db->get_where($this->table, [$this->table.'.id' => $id]);
      return $query->row();
  }

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

  public function search($keywords)
  {
    $data = $this->input->post('keywords');
    $this->db->like('title',$keywords);
    $this->db->or_like('description', $keywords);

    $query  =   $this->db->get($this->table);
    return $query->result();
  }
}
