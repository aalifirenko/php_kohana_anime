<?php defined('SYSPATH') or die('No direct access allowed.');

return array(

    'driver'       => 'orm',
    'hash_method'  => 'sha256',
    'hash_key'     => '1, 3, 5, 9, 13, 18, 21, 22, 28, 30',
    'lifetime'     => 1209600,
    'session_type' => Session::$default,
    'session_key'  => 'auth_user',

);
