<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home page
 */
class Invitaciones extends MY_Controller
{

    public function index()
    {
        $this->load->model('invitation_model');

        // obtener id se usuario logueado
        $user = $this->ion_auth->user()->row();
        $id_user = $user->id;

        $by = array(
            'id_user' => $id_user
        );
        $invitaciones = $this->invitation_model->get_many_by($by);

        $this->mViewData['invitationes'] = $invitaciones;
        $this->render('invitaciones', 'full_width');
    }

    public function create()
    {
        $this->load->library('form_builder');
        $form = $this->form_builder->create_form();

        if ($this->input->post())
        {
            // passed validation
            $invitados = $this->input->post('invitados');
            $mensaje = $this->input->post('message');

            // convertir invitados a arreglo
            $invitados = explode(',', $invitados);

            // obtener id se usuario logueado
            $user = $this->ion_auth->user()->row();
            $id_user = $user->id;

            // registrar invitaciones 
            $this->load->model('invitation_model');
            $this->invitation_model->register_invitation($id_user, $invitados, $mensaje);

            $invitation_code = $user->invitation_code;
            $subject = 'Invitacion SMM';
            $view = 'invitation';
            $this->load->library('email');

            $view_data = array(
                'invitation_link' => site_url('signup/index') . '/' . $invitation_code,
                'message' => $mensaje,
            );

            // cargar libreria email
            foreach ($invitados as $invitado)
            {
                $this->email->send_email_template($invitado, '', $subject, $view, $view_data);
            }

            redirect('invitaciones');
        }

        $this->mPageTitle = 'Crear Invitacion';

        $this->mViewData['form'] = $form;
        $this->render('crear_invitacion', 'full_width');
    }

}
