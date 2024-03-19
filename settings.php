<?php

require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/include/classes/MeeetOptionHandler.php';

const meeetOptionHandler = new MeeetOptionHandler();

add_action('admin_menu', '_meeet_admin_menu');
add_action('admin_enqueue_scripts', '_meeet_admin_scripts');