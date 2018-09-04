<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Invitation extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_builder');

        $this->load->model('invitation_model');
    }

    // Frontend User CRUD
    public function index()
    {
        $crud = $this->generate_crud('invitations');
        $crud->columns('id_user', 'to', 'status', 'sent_at');

        // only webmaster and admin can change member groups
        if ($crud->getState() == 'list' || $this->ion_auth->in_group(array('webmaster', 'admin')))
        {
            $crud->set_relation('id_user', 'users', 'first_name');
        }

        // disable direct create / delete Frontend User
        $crud->unset_add();
        $crud->unset_delete();

        $this->mPageTitle = 'Invitaciones';
        $this->render_crud();
    }

    // Create Frontend User
    public function create()
    {
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
            $this->invitation_model->register_invitation($id_user, $invitados, $mensaje);

            // obtener datos de usuario
            $this->load->model('user_model');
            $user = $this->user_model->get($id_user);

            $invitation_code = $user->invitation_code;

            // cargar libreria email
            $this->load->library('email');

            foreach ($invitados as $invitado)
            {
                $dumbu_url = site_url('invitation/dumbu_invitation');
                $subject = 'Invitacion SMM';
                $view = 'invitation';
                $view_data = array(
                    'invitation_link' => $dumbu_url . '/' . $invitation_code,
                    'message' => $mensaje,
                );

                $this->email->send_email_template($invitado, '', $subject, $view, $view_data);
            }

            //refresh();
        }

        $this->mPageTitle = 'Crear Invitacion';

        $this->mViewData['form'] = $form;
        $this->render('invitation/create');
    }

}
