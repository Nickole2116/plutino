<?php 

class Welcome_mod extends CI_Model
{
    public function all()
    {
        $test = $this->db->get('test')->row_array();
        return $test;
    }

   
}









?>