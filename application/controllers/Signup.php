<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home page
 */
class Signup extends MY_Controller
{

    public function index($parent_invitation_code = '')
    {
        $this->load->library('form_builder');
        $form = $this->form_builder->create_form();

        $by = array(
            'invitation_code' => $parent_invitation_code
        );

        $this->load->model('user_model');
        $parent = $this->user_model->get_by($by);

        if (!empty($parent))
        {
            set_cookie('parent_invitation_code', $parent_invitation_code, time() + 3600 * 24 * 7);
        }

        if ($this->input->post())
        {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $identity = $email;

            $activation_code = md5($email . time());
            $invitation_code = md5($email . time());

            $additional_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'phone' => $this->input->post('phone'),
                'activation_code' => $activation_code,
                'invitation_code' => $invitation_code,
            );

            // Chequear si ha sido invitado a SMM
            if (!empty($_COOKIE['parent_invitation_code']))
            {
                $saved_invitation_code = $_COOKIE['parent_invitation_code'];

                $by = array(
                    'invitation_code' => $saved_invitation_code
                );

                // obtener datos de usuario
                $this->load->model('user_model');
                $user = $this->user_model->get_by($by);

                if (!empty($user) && $user->id != id_raiz())
                {
                    $additional_data['id_parent'] = $user->id;
                }
            }

            $groups = array(id_rol_vendedor());

            // [IMPORTANT] override database tables to update Frontend Users instead of Admin Users
            $this->ion_auth_model->tables = array(
                'users' => 'users',
                'groups' => 'groups',
                'users_groups' => 'users_groups',
                'login_attempts' => 'login_attempts',
            );

            // proceed to create user
            $user_id = $this->ion_auth->register($identity, $password, $email, $additional_data, $groups);
            if ($user_id)
            {
                // enviar correo si no es del tercer nivel
                $subject = 'Activar cuenta SMM';
                $view = 'activation';
                $view_data = array(
                    'activation_link' => site_url('user/activation/' . $activation_code)
                );

                $this->email->send_email_template($email, '', $subject, $view, $view_data);

                if (isset($additional_data['id_parent']))
                {
                    // notificar al padre
                    $subject = 'Nuevo usuario cadastrado';
                    $view = 'new_registration';
                    $view_data = array(
                        'email' => $email,
                        'first_name' => $additional_data['first_name'],
                        'last_name' => $additional_data['last_name'],
                        'phone' => $additional_data['phone'],
                    );
                    $this->email->send_email_template($user->email, '', $subject, $view, $view_data);
                    
                    // Eliminar Cookie
                    unset($_COOKIE['parent_invitation_code']);
                }

                // cambiar estado de la invitacion
                $by = array(
                    'to' => $email
                );

                $update = array(
                    'status' => 3,
                    'approved_at' => date('Y-m-d H:i:s')
                );

                $this->load->model('invitation_model');
                $this->invitation_model->update_by($by, $update);

                redirect('signup/success_signup');
            }
            else
            {
                die('error al crear usuario');
                // error al crear usuario
            }
        }

        $this->add_stylesheet('src/css/frontend.css');

        $this->mViewData['form'] = $form;
        $this->mBodyClass = 'login-page';
        $this->render('signup', 'full_width');
    }

    public function success_signup()
    {
        $this->render('success_signup', 'full_width');
    }

}
