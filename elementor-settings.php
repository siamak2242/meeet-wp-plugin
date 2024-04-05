<?php

require_once __DIR__ . '/elementor/functions.php';

add_action('elementor/elements/categories_registered', '_meeet_elementor_register_category');
add_action('wp_enqueue_scripts', '_meeet_elementor_register_scripts');
add_action('elementor/widgets/register', '_meeet_elementor_register_widgets');