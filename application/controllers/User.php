<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home page
 */
class User extends MY_Controller
{

    public function index()
    {
        
    }

    public function activation($activation_code)
    {
        $this->load->library('form_builder');
        $form = $this->form_builder->create_form();

        $by = array(
            'activation_code' => $activation_code
        );

        $this->load->model('user_model');
        $user = $this->user_model->get_by($by);

        if (!empty($user))
        {
            // pass validation
            $data = array(
                'activation_code' => NULL,
                'active' => 1
            );

            $this->ion_auth_model->tables = array(
                'users' => 'users',
                'groups' => 'groups',
                'users_groups' => 'users_groups',
                'login_attempts' => 'login_attempts',
            );

            // proceed to change user password
            if ($this->ion_auth->update($user->id, $data))
            {
                $messages = $this->ion_auth->messages();
                $this->system_message->set_success($messages);
            }
            else
            {
                $errors = $this->ion_auth->errors();
                $this->system_message->set_error($errors);
            }

            redirect('login');
        }
        else
        {
            $errors = 'Usuario no valido';
            $this->system_message->set_error($errors);

            redirect('home');
        }
    }

    public function registration_callback()
    {
        if ($this->input->post())
        {
            $id_user = $this->input->post('id_user');

            // obtener datos de usuario
            $this->load->model('user_model');
            $user = $this->user_model->get($id_user);

            if (!empty($user))
            {
                $additional_data = array(
                    'dumbu_id' => $this->input->post('dumbu_id'),
                    'plan_amount' => $this->input->post('plan_amount'),
                );

                // [IMPORTANT] override database tables to update Frontend Users instead of Admin Users
                $this->ion_auth_model->tables = array(
                    'users' => 'users',
                    'groups' => 'groups',
                    'users_groups' => 'users_groups',
                    'login_attempts' => 'login_attempts',
                );

                // actualizar datos del usuario
                if ($this->ion_auth->update($id_user, $additional_data))
                {
                    $this->ion_auth->remove_from_group(id_rol_vendedor());
                    $this->ion_auth->add_to_group(id_rol_cosumidor());

                    if ($user->id_parent)
                    {
                        $this->load->model('user_model');
                        $parent = $this->user_model->get($user->id_parent);

                        // notificar al padre
                        $subject = 'Nuevo usuario cadastrado';
                        $view = 'new_registration';
                        $view_data = array(
                            'email' => $user->email,
                            'first_name' => $user->first_name,
                            'last_name' => $user->last_name,
                            'phone' => $user->phone,
                        );
                        $this->email->send_email_template($parent->email, '', $subject, $view, $view_data);
                    }
                }
                else
                {
                    // error al crear usuario
                }
            }
            else
            {
                // codigo de invitacion invalido
            }
        }
    }

    public function delete_callback()
    {
        if ($this->input->post())
        {
            $id_dumbu = $this->input->post('id_dumbu');

            $by = array(
                'id_dumbu' => $id_dumbu
            );

            // obtener datos de usuario
            $this->load->model('user_model');
            $user = $this->user_model->get_by($by);

            if (!empty($user))
            {
                // pass validation
                $data = array(
                    'deleted' => 1
                );

                if ($this->user_model->update($user->id, $data))
                {
                    
                }
                else
                {
                    
                }
            }
            else
            {
                // codigo de invitacion invalido
            }
        }
    }

}
