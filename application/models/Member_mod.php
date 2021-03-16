<?php 

class Member_mod extends CI_Model
{
    public function all()
    {
        $test = $this->db->get('posts')->row_array();
        return $test;
    }

   
}









?>