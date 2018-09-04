<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home page
 */
class Login extends MY_Controller
{

    public function index()
    {
        $this->load->library('form_builder');
        $form = $this->form_builder->create_form();

        if ($this->input->post())
        {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            if ($this->ion_auth->login($email, $password))
            {
                // login succeed
                $messages = $this->ion_auth->messages();
                $this->system_message->set_success($messages);
                redirect($this->mModule);
            }
            else
            {
                // login failed
                $errors = $this->ion_auth->errors();
                $this->system_message->set_error($errors);
                refresh();
            }

//            $this->load->model('user_model');
//            if ($this->user_model->frontend_login($email, $password))
//            {
//                $by = array(
//                    'email' => $email
//                );
//                $user = $this->user_model->get_by($by);
//               // crear sesiones
//                $user_data = array(
//                    'id' => $user->id,
//                    'email' => $user->email,
//                    'first_name' => $user->first_name,
//                    'last_name' => $user->last_name,
//                    'level' => empty($user->id_parent) ? 1 : 2
//                );
//
//                $this->session->set_userdata($user_data);
//                
//                redirect('invitaciones');
//            }
        }

        $this->add_stylesheet('src/css/frontend.css');

        $this->mViewData['form'] = $form;
        $this->mBodyClass = 'login-page';
        $this->render('login', 'full_width');
    }

}
