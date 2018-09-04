<?php

class Payment_model extends MY_Model
{

    public function register_payment($data)
    {
        $this->_database->insert('payment', $data);
        return $this->_database->insert_id();
    }

    public function is_paid($id_user, $year, $month)
    {
        $this->_database->select('id_payment');
        $this->_database->from('payment');
        $this->_database->where('id_user', $id_user);
        $this->_database->where('YEAR(paid_at)', $year);
        $this->_database->where('MONTH(paid_at)', $month);

        return $this->_database->get()->num_rows() > 0;
    }

}
