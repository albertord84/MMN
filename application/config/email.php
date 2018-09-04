<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
  | -------------------------------------------------------------------
  | Email Settings
  | -------------------------------------------------------------------
  | Configuration of outgoing mail server.
  | */

$config['protocol'] = 'smtp';
$config['smtp_host'] = '127.0.0.1';
$config['smtp_port'] = '25';
$config['smtp_timeout'] = '30';
$config['smtp_user'] = 'admin@gmail.com';
$config['smtp_pass'] = 'admin';
$config['charset'] = 'utf-8';
$config['mailtype'] = 'html';
$config['wordwrap'] = TRUE;
$config['newline'] = "\r\n";
