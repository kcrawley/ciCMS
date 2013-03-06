<?php

class News_model extends CI_Model {
    
    public function get_news($slug = FALSE) {
        if ($slug === FALSE)
        {
            $query = $this->db->query('SELECT * FROM news');
            return $query->fetchAll();
        }
        
        $stmt = $this->db->prepare('SELECT * FROM news WHERE slug = :slug');
        $stmt->bindParam(':slug', $slug, PDO::PARAM_STR);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function set_news()
    {
        $this->load->helper('url');
        
        $slug = url_title($this->input->post('title'), 'dash', TRUE);
        
        $data = array(
            'title' =>  $this->input->post('title'),
            'slug'  =>  $slug,
            'text'  =>  $this->input->post('text')
        );
        
        $set = '';
        $val = '';
        
        foreach ($data as $key => $value)
        {
            $set .= $key . ",";
            $val .= "'" . $value . "',";
        }
        
        $set = trim(',', $set);
        $val = trim(',', $val);
        
        $stmt = "INSERT INTO news ({$set}) VALUES ({$val})";
        
        $stmt = $this->db->prepare($stmt);
        
        return $stmt->execute();
    }
}