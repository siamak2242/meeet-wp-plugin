<?php

require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/include/classes/MeeetOptionHandler.php';

const meeetOptionHandler = new MeeetOptionHandler();

add_action('admin_menu', '_meeet_admin_menu');
add_action('admin_enqueue_scripts', '_meeet_admin_scripts');

// ajax actions
add_action('wp_ajax_meeet_fetch_primary_option', '_meeet_ajax_fetch_primary_option');
