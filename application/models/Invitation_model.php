<?php

class Invitation_model extends MY_Model
{

    public function register_invitation($id_user, $invitados, $mensaje)
    {
        foreach ($invitados as $invitado)
        {
            $data = array(
                'id_user' => $id_user,
                'to' => trim($invitado),
                'message' => $mensaje,
                'sent_at' => date('Y-m-d H:i:s'),
            );
            $this->_database->insert('invitations', $data);
            $this->_database->insert_id();
        }
    }

}
