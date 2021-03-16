<?php 

class Welcome_mod extends CI_Model
{
    public function modify_new_login($members_id)
    {
        $this->load->library('session');
        $sessions_log = $this->session->session_id;
        $this->db->where('members_session_logs',$sessions_log);
        $this->db->where('members_id',$members_id);
        $this->db->where('members_log_status',1); //set login now
        $trx_account = $this->db->count_all_results('members_log');

        if($trx_account == 0)
        {
            //insert new
            $data = array(
                "members_id" => $members_id,
                "members_session_logs" => $sessions_log,
                "members_log_time" => date('Y-m-d H:i:s'),
                "members_log_status" => 1
            );

            $this->db->insert("members_log",$data);
            return $this->db->insert_id();


        }else
        {
            //update new datetime log
            $data = array(
                "members_log_time" => date('Y-m-d H:i:s'),
                "members_log_status" => 1
            );
            $this->db->where('members_id',$members_id);
            $this->db->update('members_log',$data);
            return $members_id;

        }


    }
    /**
     * Member Login Model Functions 
     * ------------
     */
    public function p_member_login($member_username,$member_password)
    {
        //encrypt the password
        //$encrypt_password = $this->my_function->log_encrypt_string($member_password);

        $this->db->where('members_username',$member_username);
        $this->db->where('members_password_salt',$member_password);
        $trx_account = $this->db->count_all_results('members');

       // echo $trx_account;
        //echo $member_password;

       
        if($trx_account == 1)
        {
            $this->db->where('members_username',$member_username);
            $this->db->where('members_password_salt',$member_password);
            $member = $this->db->get('members')->row_array();
    
            $val = $this->modify_new_login($member['members_id']);

            return $member['members_id'];
        }else
        {
            return 0;

        }

    }

    /**
     * Member Register Model Functions 
     * ---------------
     */
    public function p_member_register($member_username,$member_password)
    {
        //encrypt the password
        
        //$encrypt_password = $this->my_function->log_encrypt_string($member_password);
 
        $this->db->where('members_username',$member_username);
        $trx_username_only = $this->db->count_all_results('members');
        $ast_no = rand(1000,9999);

       
        if($trx_username_only > 0)
        {
           return 0; //Please try again new username 

        }else
        {
            $data = array(
                "members_username" => $member_username,
                "ast_no" => $ast_no,
                "members_password_salt" => $member_password,
                "members_created_date" => date('Y-m-d H:i:s'),
                "members_status" => 1
            );

            $this->db->insert("members",$data);

            $this->db->where('members_username',$member_username);
            $this->db->where('members_password_salt',$member_password);
            $members = $this->db->get('members')->row_array();



            return $members['members_id'];

        }

    }

    /**
     * Admin Login Model Functions 
     * -----------
     */
    public function p_admin_login($admin_username,$admin_password)
    {
        //encrypt the password
        $encrypt_password = $this->my_function->log_encrypt_string($admin_password);
 
        $this->db->where('admins_username',$admin_username);
        $this->db->where('admins_password_salt',$encrypt_password);
        $trx_account = $this->db->count_all_results('admins');

        if($trx_account > 0)
        {
            return $trx_account;
        }else
        {
            return 0; //invalid admin credential
        }

        return $trx_account;
    }

    public function testing()
    {
        $test = $this->db->get('test')->row_array();
        return $test['name_tt'];
    }

    public function add_posts($msg,$planet,$memberid)
    {
        //encrypt the password
        
        
            $data = array(
                "posts_msg" => $msg,
                "posts_created_date" => date('Y-m-d H:i:s'),
                "planets_id" => $planet,
                "members_id" => $memberid,
                "likes" => 0,

            );

            $this->db->insert("posts",$data);
            return $this->db->insert_id();

        

    }

    public function all_posts()
    {
        $this->db->select('*');
       $this->db->from('posts');
       $this->db->join('members', 'posts.members_id = members.members_id');
       return $this->db->get()->result_array();
    }

    public function get_user($members_id)
    {
        $this->db->select('*');
       $this->db->from('members');
       $this->db->where('members_id', $members_id);

       return $this->db->get()->result_array();
    }

    public function like_post($count,$pid)
    {
        $data = [
            'likes' => $count,
        ];
        $this->db->where('posts_id', $pid);
        $this->db->update('posts', $data);
        return "yes";
    }

   
}









?>