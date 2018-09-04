<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  | -------------------------------------------------------------------------
  | CI Bootstrap 3 Configuration
  | -------------------------------------------------------------------------
  | This file lets you define default values to be passed into views
  | when calling MY_Controller's render() function.
  |
  | See example and detailed explanation from:
  | 	/application/config/ci_bootstrap_example.php
 */

$config['ci_bootstrap'] = array(
    // Site name
    'site_name' => 'SMM',
    // Default page title prefix
    'page_title_prefix' => '',
    // Default page title
    'page_title' => '',
    // Default meta data
    'meta_data' => array(
        'author' => '',
        'description' => '',
        'keywords' => ''
    ),
    // Default scripts to embed at page head or end
    'scripts' => array(
        'head' => array(
        ),
        'foot' => array(
            'assets/dist/frontend/lib.min.js',
            'assets/dist/frontend/app.min.js'
        ),
    ),
    // Default stylesheets to embed at page head
    'stylesheets' => array(
        'screen' => array(
            'assets/dist/frontend/lib.min.css',
            'assets/dist/frontend/app.min.css'
        )
    ),
    // Default CSS class for <body> tag
    'body_class' => '',
    // Multilingual settings
    'languages' => array(
        'default' => 'en',
        'autoload' => array('general'),
        'available' => array(
            'en' => array(
                'label' => 'English',
                'value' => 'english'
            ),
            'es' => array(
                'label' => 'Español',
                'value' => 'spanish'
            )
        )
    ),
    // Google Analytics User ID
    'ga_id' => '',
    // Menu items
    'menu' => array(
        'home' => array(
            'name' => 'Home',
            'url' => '',
        ),
        'invitaciones' => array(
            'name' => 'Invitaciones',
            'url' => 'invitaciones',
        ),
        'pago' => array(
            'name' => 'Pago',
            'url' => 'pago',
        ),
        'login' => array(
            'name' => 'Login',
            'url' => 'login',
        ),
        'signup' => array(
            'name' => 'Signup',
            'url' => 'signup',
        ),
        'logout' => array(
            'name' => 'Sign Out',
            'url' => 'logout',
        )
    ),
    // Login page
    'login_url' => 'login',
    // Restricted pages
    'page_auth' => array(
        'invitaciones' => array('Vendedor', 'Vendedor Consumidor'),
        'invitaciones/create' => array('Vendedor', 'Vendedor Consumidor'),
        'pago' => array('Vendedor', 'Vendedor Consumidor'),
        'login' => array(),
        'logout' => array('Vendedor', 'Vendedor Consumidor'),
    ),
    // Email config
    'email' => array(
        'from_email' => 'admin@gmail.com',
        'from_name' => 'SMM',
        'subject_prefix' => '',
        // Mailgun HTTP API
        'mailgun_api' => array(
            'domain' => '',
            'private_api_key' => ''
        ),
    ),
    // Debug tools
    'debug' => array(
        'view_data' => FALSE,
        'profiler' => FALSE
    ),
);

/*
  | -------------------------------------------------------------------------
  | Override values from /application/config/config.php
  | -------------------------------------------------------------------------
 */
$config['sess_cookie_name'] = 'ci_session_frontend';
