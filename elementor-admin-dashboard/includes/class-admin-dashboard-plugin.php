<?php
/**
 * Core loader for the Elementor Admin Dashboard plugin.
 *
 * @package Elementor_Admin_Dashboard
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Elementor_Admin_Dashboard_Plugin' ) ) {
    /**
     * Elementor Admin Dashboard bootstrapper.
     */
    class Elementor_Admin_Dashboard_Plugin {
        const VERSION                   = '1.0.0';
        const MINIMUM_ELEMENTOR_VERSION = '3.0.0';
        const MINIMUM_PHP_VERSION       = '7.4';

        /**
         * Singleton instance.
         *
         * @var Elementor_Admin_Dashboard_Plugin
         */
        private static $instance;

        /**
         * Retrieve the singleton instance.
         *
         * @return Elementor_Admin_Dashboard_Plugin
         */
        public static function instance() {
            if ( null === self::$instance ) {
                self::$instance = new self();
            }

            return self::$instance;
        }

        /**
         * Elementor_Admin_Dashboard_Plugin constructor.
         */
        private function __construct() {
            add_action( 'init', array( $this, 'register_post_type' ) );
            add_action( 'plugins_loaded', array( $this, 'on_plugins_loaded' ) );
            add_action( 'elementor/frontend/after_register_styles', array( $this, 'register_styles' ) );
            add_action( 'wp_enqueue_scripts', array( $this, 'register_styles' ) );
            add_action( 'admin_enqueue_scripts', array( $this, 'register_styles' ) );
            add_action( 'elementor/frontend/after_enqueue_styles', array( $this, 'enqueue_frontend_assets' ) );
        }

        /**
         * Run checks after all plugins have loaded.
         */
        public function on_plugins_loaded() {
            if ( ! did_action( 'elementor/loaded' ) ) {
                add_action( 'admin_notices', array( $this, 'elementor_missing_notice' ) );
                return;
            }

            if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
                add_action( 'admin_notices', array( $this, 'php_version_notice' ) );
                return;
            }

            if ( ! class_exists( '\\Elementor\\Plugin' ) ) {
                return;
            }

            require_once __DIR__ . '/class-elementor-admin-dashboard-widget.php';
            add_action( 'elementor/widgets/register', array( $this, 'register_widget' ) );
            add_action( 'elementor/editor/after_enqueue_scripts', array( $this, 'enqueue_editor_assets' ) );
        }

        /**
         * Register scripts and styles needed for the widget.
         */
        public function register_styles() {
            wp_register_style(
                'elementor-admin-dashboard',
                plugins_url( '../assets/css/admin-dashboard.css', __FILE__ ),
                array(),
                self::VERSION
            );
        }

        /**
         * Enqueue assets in the Elementor editor to preview styling.
         */
        public function enqueue_editor_assets() {
            wp_enqueue_style( 'elementor-admin-dashboard' );
        }

        /**
         * Register the custom Elementor widget.
         *
         * @param \Elementor\Widgets_Manager $widgets_manager Widgets manager instance.
         */
        public function register_widget( $widgets_manager ) {
            $widgets_manager->register( new Elementor_Admin_Dashboard_Widget() );
        }

        /**
         * Register a custom post type used to store admin dashboard layouts.
         */
        public function register_post_type() {
            $labels = array(
                'name'               => __( 'Admin Dashboards', 'elementor-admin-dashboard' ),
                'singular_name'      => __( 'Admin Dashboard', 'elementor-admin-dashboard' ),
                'add_new'            => __( 'Add New', 'elementor-admin-dashboard' ),
                'add_new_item'       => __( 'Add New Admin Dashboard', 'elementor-admin-dashboard' ),
                'edit_item'          => __( 'Edit Admin Dashboard', 'elementor-admin-dashboard' ),
                'new_item'           => __( 'New Admin Dashboard', 'elementor-admin-dashboard' ),
                'view_item'          => __( 'View Admin Dashboard', 'elementor-admin-dashboard' ),
                'search_items'       => __( 'Search Admin Dashboards', 'elementor-admin-dashboard' ),
                'not_found'          => __( 'No admin dashboards found.', 'elementor-admin-dashboard' ),
                'not_found_in_trash' => __( 'No admin dashboards found in Trash.', 'elementor-admin-dashboard' ),
            );

            $args = array(
                'labels'             => $labels,
                'public'             => false,
                'show_ui'            => true,
                'show_in_menu'       => true,
                'menu_icon'          => 'dashicons-analytics',
                'supports'           => array( 'title', 'editor', 'thumbnail' ),
                'show_in_rest'       => true,
            );

            register_post_type( 'elementor_admin_dashboard', $args );
        }

        /**
         * Enqueue assets on the Elementor frontend when required.
         */
        public function enqueue_frontend_assets() {
            wp_enqueue_style( 'elementor-admin-dashboard' );
        }

        /**
         * Display admin notice when Elementor is missing.
         */
        public function elementor_missing_notice() {
            if ( isset( $_GET['activate'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
                unset( $_GET['activate'] ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
            }

            printf(
                '<div class="notice notice-warning is-dismissible"><p>%s</p></div>',
                esc_html__( 'Elementor Admin Dashboard requires Elementor to be installed and activated.', 'elementor-admin-dashboard' )
            );
        }

        /**
         * Display admin notice when PHP version is too low.
         */
        public function php_version_notice() {
            if ( isset( $_GET['activate'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
                unset( $_GET['activate'] ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
            }

            printf(
                '<div class="notice notice-warning is-dismissible"><p>%s</p></div>',
                esc_html__( 'Elementor Admin Dashboard requires PHP version 7.4 or higher.', 'elementor-admin-dashboard' )
            );
        }
    }
}
