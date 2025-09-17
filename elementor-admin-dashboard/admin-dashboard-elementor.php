<?php
/**
 * Plugin Name: Elementor Admin Dashboard
 * Description: Provides an Elementor-ready admin dashboard template with WordPress statistics, shortcuts, and integrations.
 * Version: 1.0.0
 * Author: elguide.nu
 * Text Domain: elementor-admin-dashboard
 * Requires Plugins: elementor
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Elementor_Admin_Dashboard_Plugin' ) ) {
    require_once __DIR__ . '/includes/class-admin-dashboard-plugin.php';
}

Elementor_Admin_Dashboard_Plugin::instance();
