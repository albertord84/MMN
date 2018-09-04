<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home page
 */
class Home extends MY_Controller
{

    public function index()
    {
        // obtener id se usuario logueado
        $user = $this->ion_auth->user()->row();
        $user_dumbu = !empty($user) && $user->user_dumbu == 1 ? TRUE : FALSE;

        $this->mViewData['user_dumbu'] = $user_dumbu;
        if (!$user_dumbu && !empty($user))
        {
            $this->mViewData['dumbu_link'] = 'http://dumbu.br/register?id_user=' . $user->id;
        }
        $this->render('home', 'full_width');
    }

}
