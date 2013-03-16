<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * User Auth Class
 * :: Handles user authentication and verification
 * @todo Add methods for user addition and deletion
 */
class Auth {

    private $CI;
    private $salt = '';
    private $auth_levels = array(
        "cms_edit" => "90",
        "cms_toolbar" => "50"
    );

    function __construct()
    {
        $this->CI = & get_instance();
    }
    /**
     * Connects to the database and validates the user name and password
     *
     * @access	public
     * @param	string, string
     * @return	bool
     */
    public function validate_login($user, $pass) {
        // create query
        $this->CI->db->select('id, auth, username');
        $query = $this->CI->db->get_where('tek_users', array('username' => $user, 'password' => md5($pass)));
        
        if ($query->num_rows() > 0)
        {
            foreach ($query->row_array() as $key => $var)
            {
                $userdata[$key] = $var;
            }
            $userdata['logged_in'] = TRUE;
            $this->CI->session->set_userdata($userdata);
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    
    public function validate_password($pass)
    {
        $this->CI->db->select('id');
        $query = $this->CI->db->get_where('tek_users', array('username' => $this->get_current_username(), 'password' => md5($pass)));
        
        return ($query->num_rows() > 0) ? TRUE : FALSE;
    }
    
    public function set_password($pass)
    {
        $this->CI->db->where('username', $this->get_current_username());
        $this->CI->db->update('tek_users', array('password' => md5($pass)));
    }
    
    /**
     * Runs a challenge against the stored session auth and pre-defined access levels
     * @param str $challenge
     * @return boolean
     */
    public function check_auth_level($challenge) {
        if ($this->CI->session->userdata('logged_in')) {
            if (array_key_exists(strtolower($challenge), $this->auth_levels)) {
                return ($this->CI->session->userdata('auth') >= $this->auth_levels[strtolower($challenge)]) ? TRUE : FALSE;
            }
        }
        return FALSE;
    }

    /**
     * Returns the users auth level based on their user name
     * @param string $username
     * @return int
     */
    public function get_auth($username = NULL) {
        $username = (is_null($username)) ? $this->session->userdata('username') : $username;

        if ($stmt = $this->CI->db->prepare("SELECT auth FROM tek_users WHERE username = :username")) {
            $stmt->bindParam(":username", $username, PDO::PARAM_STR);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($auth);
            $stmt->fetch();

            $stmt->close();
            return $auth;
        } else {
            $stmt->close();
            return 0;
        }
    }

    /**
     * Checks login status and loads an error method if not.
     */
    public function check_authorization() {
        return ($this->CI->session->userdata('logged_in')) ? TRUE : $this->Renderer->error('Unauthorized');
    }
    
    public function logged_in() {
        return ($this->CI->session->userdata('logged_in')) ? TRUE : FALSE;
    }

    /**
     * Grabs an array from the DB containing all users
     * @return array
     */
    public function get_all_users() {
        if ($results = $this->CI->db->query("SELECT `id`, `first_name`, `last_name`, `email` FROM `tek_users`
            "))
            return($results->fetchAll());
    }

    /**
     * Gets username from the session cookie
     * @return string
     */
    public function get_current_username() {
        return ($this->CI->session->userdata('username'));
    }

    /**
     * Gets the user id from the database and returns it
     * @return boolean or int
     */
    public function get_current_uid() {
        
        $this->CI->db->select('id');
        $query = $this->CI->db->get_where('tek_users', array('username'=>$this->get_current_username()));
        
        if ($query->num_rows > 0)
        {
            $row = $query->row_array();
            return $row['id'];
        }
        return FALSE;
    }

    public function log_out()
    {
        $this->CI->session->sess_destroy();
    }
}