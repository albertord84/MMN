<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home page
 */
class Logout extends MY_Controller
{

    public function index()
    {
        $this->ion_auth->logout();
        redirect('login');
    }

}
