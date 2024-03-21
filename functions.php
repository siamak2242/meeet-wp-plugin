<?php

const _test_version = '1.0.12';

function _meeet_admin_menu()
{
    add_menu_page('MEEET', 'Meeet', 'manage_options', 'meeet', function () {
        include __DIR__ . '/templates/admin-page.php';
    });
}

function _meeet_admin_scripts()
{
    wp_enqueue_style(
        'meeet-admin-page-style',
        plugins_url('/assets/admin/css/admin-menu-page.css?v=' . _test_version, __FILE__)
    );

    wp_enqueue_script(
        'meeet-admin-page-script',
        plugins_url('/assets/admin/js/admin-menu-page.js?v=' . _test_version, __FILE__)
    );

}

function _meeet_ajax_fetch_primary_option()
{
    $p = $_POST;
    if ($p['method'] === 'get') {
        $value = meeetOptionHandler->get_option($p['token']);
        wp_send_json($value);
    } elseif ($p['method'] === 'set') {
        $value = $p['value'];
        if ($p['type'] === 'checkbox') {
            $value = $value === 'true';
        }
        try {
            meeetOptionHandler->set_option($p['token'], $value);
        } catch (Exception $e) {
            wp_send_json([false, 'invalid token']);
        }
    } else {
        wp_send_json([false, 'invalid method']);
    }
}