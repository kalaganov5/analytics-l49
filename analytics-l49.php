<?php
/*
Plugin Name: Analytics L49
Description: Plugin for Installing Analytics L49. Website: https://analytics.l49.org/dashboard
Version: 1.0
Author: Vladimir Kalaganov
Author URI: http://kalaganov5.com
Text Domain: analytics-l49
Domain Path: /languages
*/

// Функция для добавления скрипта в футер
function analytics_l49() {
    $script_id = get_option('analytics_l49_script_id'); // Получение ID скрипта из настроек
    if (!empty($script_id)) {
        echo '<script data-host="https://analytics.l49.org" data-dnt="false" src="https://analytics.l49.org/js/script.js" id="' . esc_attr($script_id) . '" async defer></script>';
    }
}
add_action('wp_footer', 'analytics_l49');

// Добавление страницы настроек в админ-панель
function analytics_l49_add_admin_menu() {
    add_options_page(
        __('Analytics L49 Settings', 'analytics-l49'),
        'Analytics L49',
        'manage_options',
        'analytics-l49-settings',
        'analytics_l49_settings_page'
    );
}
add_action('admin_menu', 'analytics_l49_add_admin_menu');

// HTML страницы настроек
function analytics_l49_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php _e('Analytics L49 Settings', 'analytics-l49'); ?></h1>
        <p><?php _e('Official Website: <a href="https://analytics.l49.org/" target="_blank">https://analytics.l49.org/</a>', 'analytics-l49'); ?></p>
        <form method="post" action="options.php">
            <?php
            settings_fields('analytics_l49_settings');
            do_settings_sections('analytics-l49-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Регистрация настроек
function analytics_l49_settings_init() {
    register_setting('analytics_l49_settings', 'analytics_l49_script_id');
    add_settings_section(
        'analytics_l49_settings_section',
        __('Script Settings', 'analytics-l49'),
        'analytics_l49_settings_section_callback',
        'analytics-l49-settings'
    );
    add_settings_field(
        'analytics_l49_script_id',
        __('Script ID', 'analytics-l49'),
        'analytics_l49_script_id_render',
        'analytics-l49-settings',
        'analytics_l49_settings_section'
    );
}
add_action('admin_init', 'analytics_l49_settings_init');

// Отрисовка поля ввода
function analytics_l49_script_id_render() {
    $script_id = get_option('analytics_l49_script_id');
    ?>
    <input type='text' name='analytics_l49_script_id' value='<?php echo esc_attr($script_id); ?>'>
    <?php
}

function analytics_l49_settings_section_callback() {
    _e('Enter your Script ID for the Analytics L49.', 'analytics-l49');
}

// Функция для загрузки текстового домена плагина
function analytics_l49_load_textdomain() {
    load_plugin_textdomain('analytics-l49', false, basename(dirname(__FILE__)) . '/languages');
}
add_action('plugins_loaded', 'analytics_l49_load_textdomain');
