<?php

class User_model extends MY_Model
{

    public function get_hijos($id_user, $all = TRUE)
    {
        $this->_database->select('*');
        $this->_database->from('users');
        $this->_database->where('id_parent', $id_user);
        $this->_database->where('active', 1);

        if (!$all)
        {
            $this->_database->where('deleted <>', 1);
            $this->_database->where('dumbu_id IS NOT NULL');
        }

        return $this->_database->get()->result();
    }

    public function get_raices()
    {
        $this->_database->select('*');
        $this->_database->from('users');
        $this->_database->where('id_parent IS NULL');
        $this->_database->where('active', 1);

        return $this->_database->get()->result();
    }

}
