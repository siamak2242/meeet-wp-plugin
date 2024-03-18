<?php

require_once __DIR__ . '/functions.php';

add_action('admin_menu', '_meeet_admin_menu');
add_action('admin_enqueue_scripts', '_meeet_admin_scripts');