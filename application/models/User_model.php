<?php
class User_model extends CI_Model
{
  private $table = 'users';
  private $table_details = 'user_details';
  
  public function login_check()
  {
    $data = [
      'email' => $this->input->post('email')
    ];
    
    $user = $this->db->get_where($this->table, $data)->row();

    if ($user && password_verify($this->input->post('password'), $user->password)) {
      return $user;
    } else {
      return false;
    }
  }

  //--------------//
  //     Users    //
  //--------------//
  
  public function create()
  {
    $data = [
      'first_name' => $this->input->post('first_name'),
      'last_name' => $this->input->post('last_name'),
      'email' => $this->input->post('email'),
      'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
      'avatar' => $this->input->post('avatar')
    ];

    return $this->db->insert($this->table, $data);
  }

  public function read($id = false)
  {
    if ($id === false) {
      $query = $this->db->get($this->table);
      return $query->result();
    }

    $query = $this->db->get_where($this->table, compact('id'));
    return $query->row();
  }

  public function user_details($id)
  {
    $this->db->select('*');
    $this->db->join($this->table_details, $this->table_details.'.id='.$this->table.'.id');
    $query = $this->db->get_where($this->table, [$this->table.'.id' => $id]);
    return $query->row();
  }

  public function update($id)
  {
    $data = [
      'first_name' => $this->input->post('first_name'),
      'last_name' => $this->input->post('last_name'),
      'email' => $this->input->post('email'),
      'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
      'avatar' => $this->input->post('avatar')
    ];

    return $this->db->update($this->table, $data, compact($id));
  }

  public function delete($id)
  {
    return $this->db->delete($this->table, compact($id));
  }



  //--------------//
  // user_details //
  //--------------//

  public function create_details()
  {
    $data = [
      'description' => $this->input->post('description'),
      'about' => $this->input->post('about'),
    ];

    return $this->db->insert($this->table_details, $data);
  }

  public function read_details($id = false)
  {
    if ($id === false) {
      $query = $this->db->get($this->table_details);
      return $query->result();
    }

    $query = $this->db->get_where($this->table_details, compact($id));
    return $query->row();
  }

  public function update_details()
  {
    $data = [
      'description' => $this->input->post('description'),
      'about' => $this->input->post('about'),
    ];

    return $this->db->update($this->table_details, $data, compact($id));
  }

  public function delete_details($id)
  {
    return $this->db->delete($this->table_details, compact($id));
  }

}
