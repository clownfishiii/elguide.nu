<?php
/**
 * Elementor widget for rendering the admin dashboard overview.
 *
 * @package Elementor_Admin_Dashboard
 */

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Elementor_Admin_Dashboard_Widget' ) ) {
    /**
     * Admin Dashboard Elementor widget.
     */
    class Elementor_Admin_Dashboard_Widget extends Widget_Base {
        /**
         * Get widget name.
         *
         * @return string
         */
        public function get_name() {
            return 'elementor-admin-dashboard';
        }

        /**
         * Get widget title.
         *
         * @return string
         */
        public function get_title() {
            return __( 'Admin Dashboard', 'elementor-admin-dashboard' );
        }

        /**
         * Get widget icon.
         *
         * @return string
         */
        public function get_icon() {
            return 'eicon-dashboard';
        }

        /**
         * Get widget categories.
         *
         * @return array
         */
        public function get_categories() {
            return array( 'general' );
        }

        /**
         * Get widget keywords.
         *
         * @return array
         */
        public function get_keywords() {
            return array( 'dashboard', 'admin', 'analytics', 'panel', 'statistics' );
        }

        /**
         * Register widget controls.
         */
        protected function register_controls() {
            $this->start_controls_section(
                'section_content',
                array(
                    'label' => __( 'Metrics', 'elementor-admin-dashboard' ),
                )
            );

            $this->add_control(
                'show_posts',
                array(
                    'label'        => __( 'Show Posts Count', 'elementor-admin-dashboard' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'Yes', 'elementor-admin-dashboard' ),
                    'label_off'    => __( 'No', 'elementor-admin-dashboard' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                )
            );

            $this->add_control(
                'show_pages',
                array(
                    'label'        => __( 'Show Pages Count', 'elementor-admin-dashboard' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'Yes', 'elementor-admin-dashboard' ),
                    'label_off'    => __( 'No', 'elementor-admin-dashboard' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                )
            );

            $this->add_control(
                'show_comments',
                array(
                    'label'        => __( 'Show Comments Count', 'elementor-admin-dashboard' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'Yes', 'elementor-admin-dashboard' ),
                    'label_off'    => __( 'No', 'elementor-admin-dashboard' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                )
            );

            $this->add_control(
                'show_users',
                array(
                    'label'        => __( 'Show Users Count', 'elementor-admin-dashboard' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'Yes', 'elementor-admin-dashboard' ),
                    'label_off'    => __( 'No', 'elementor-admin-dashboard' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                )
            );

            $this->add_control(
                'layout_style',
                array(
                    'label'   => __( 'Layout Style', 'elementor-admin-dashboard' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'cards',
                    'options' => array(
                        'cards'   => __( 'Cards', 'elementor-admin-dashboard' ),
                        'minimal' => __( 'Minimal', 'elementor-admin-dashboard' ),
                    ),
                )
            );

            $this->add_control(
                'columns',
                array(
                    'label'   => __( 'Columns', 'elementor-admin-dashboard' ),
                    'type'    => Controls_Manager::NUMBER,
                    'min'     => 1,
                    'max'     => 4,
                    'default' => 2,
                )
            );

            $this->end_controls_section();

            $this->start_controls_section(
                'section_shortcuts',
                array(
                    'label' => __( 'Quick Links', 'elementor-admin-dashboard' ),
                )
            );

            $repeater = new Repeater();

            $repeater->add_control(
                'shortcut_label',
                array(
                    'label'   => __( 'Label', 'elementor-admin-dashboard' ),
                    'type'    => Controls_Manager::TEXT,
                    'default' => __( 'Dashboard', 'elementor-admin-dashboard' ),
                )
            );

            $repeater->add_control(
                'shortcut_url',
                array(
                    'label'       => __( 'URL', 'elementor-admin-dashboard' ),
                    'type'        => Controls_Manager::URL,
                    'placeholder' => __( 'https://example.com', 'elementor-admin-dashboard' ),
                )
            );

            $this->add_control(
                'shortcuts',
                array(
                    'label'       => __( 'Shortcut Links', 'elementor-admin-dashboard' ),
                    'type'        => Controls_Manager::REPEATER,
                    'fields'      => $repeater->get_controls(),
                    'title_field' => '{{{ shortcut_label }}}',
                )
            );

            $this->end_controls_section();

            $this->start_controls_section(
                'section_content_style',
                array(
                    'label' => __( 'Cards', 'elementor-admin-dashboard' ),
                    'tab'   => Controls_Manager::TAB_STYLE,
                )
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                array(
                    'name'     => 'card_typography',
                    'selector' => '{{WRAPPER}} .ade-dashboard-card-title',
                )
            );

            $this->add_control(
                'card_background',
                array(
                    'label'     => __( 'Background Color', 'elementor-admin-dashboard' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => array(
                        '{{WRAPPER}} .ade-dashboard-card' => 'background-color: {{VALUE}};',
                    ),
                )
            );

            $this->add_control(
                'card_text_color',
                array(
                    'label'     => __( 'Text Color', 'elementor-admin-dashboard' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => array(
                        '{{WRAPPER}} .ade-dashboard-card' => 'color: {{VALUE}};',
                    ),
                )
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                array(
                    'name'     => 'card_border',
                    'selector' => '{{WRAPPER}} .ade-dashboard-card',
                )
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                array(
                    'name'     => 'card_shadow',
                    'selector' => '{{WRAPPER}} .ade-dashboard-card',
                )
            );

            $this->add_responsive_control(
                'card_padding',
                array(
                    'label'      => __( 'Padding', 'elementor-admin-dashboard' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => array( 'px', 'em', '%' ),
                    'selectors'  => array(
                        '{{WRAPPER}} .ade-dashboard-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ),
                )
            );

            $this->end_controls_section();

            $this->start_controls_section(
                'section_shortcut_style',
                array(
                    'label' => __( 'Quick Links', 'elementor-admin-dashboard' ),
                    'tab'   => Controls_Manager::TAB_STYLE,
                )
            );

            $this->add_control(
                'shortcut_alignment',
                array(
                    'label'     => __( 'Alignment', 'elementor-admin-dashboard' ),
                    'type'      => Controls_Manager::CHOOSE,
                    'options'   => array(
                        'flex-start' => array(
                            'title' => __( 'Left', 'elementor-admin-dashboard' ),
                            'icon'  => 'eicon-text-align-left',
                        ),
                        'center'     => array(
                            'title' => __( 'Center', 'elementor-admin-dashboard' ),
                            'icon'  => 'eicon-text-align-center',
                        ),
                        'flex-end'   => array(
                            'title' => __( 'Right', 'elementor-admin-dashboard' ),
                            'icon'  => 'eicon-text-align-right',
                        ),
                    ),
                    'default'   => 'flex-start',
                    'selectors' => array(
                        '{{WRAPPER}} .ade-dashboard-shortcuts' => 'justify-content: {{VALUE}};',
                    ),
                )
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                array(
                    'name'     => 'shortcut_typography',
                    'selector' => '{{WRAPPER}} .ade-dashboard-shortcut a',
                )
            );

            $this->add_control(
                'shortcut_color',
                array(
                    'label'     => __( 'Link Color', 'elementor-admin-dashboard' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => array(
                        '{{WRAPPER}} .ade-dashboard-shortcut a' => 'color: {{VALUE}};',
                    ),
                )
            );

            $this->add_control(
                'shortcut_hover_color',
                array(
                    'label'     => __( 'Hover Color', 'elementor-admin-dashboard' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => array(
                        '{{WRAPPER}} .ade-dashboard-shortcut a:hover' => 'color: {{VALUE}};',
                    ),
                )
            );

            $this->end_controls_section();
        }

        /**
         * Render widget output on the frontend.
         */
        protected function render() {
            $settings = $this->get_settings_for_display();
            $metrics  = $this->get_metrics( $settings );

            $layout  = ! empty( $settings['layout_style'] ) ? sanitize_html_class( $settings['layout_style'] ) : 'cards';
            $columns = isset( $settings['columns'] ) ? absint( $settings['columns'] ) : 2;
            $columns = max( 1, min( 4, $columns ) );

            $this->add_render_attribute( 'wrapper', 'class', array( 'ade-dashboard-wrapper', 'ade-layout-' . $layout ) );
            $this->add_render_attribute( 'wrapper', 'data-columns', $columns );

            echo '<div ' . $this->get_render_attribute_string( 'wrapper' ) . '>';

            if ( ! empty( $metrics ) ) {
                echo '<div class="ade-dashboard-metrics">';
                foreach ( $metrics as $metric ) {
                    echo '<div class="ade-dashboard-card">';
                    echo '<div class="ade-dashboard-card-title">' . esc_html( $metric['label'] ) . '</div>';
                    echo '<div class="ade-dashboard-card-value">' . esc_html( $metric['value'] ) . '</div>';
                    echo '</div>';
                }
                echo '</div>';
            }

            if ( ! empty( $settings['shortcuts'] ) ) {
                echo '<div class="ade-dashboard-shortcuts">';
                foreach ( $settings['shortcuts'] as $shortcut ) {
                    if ( empty( $shortcut['shortcut_label'] ) || empty( $shortcut['shortcut_url']['url'] ) ) {
                        continue;
                    }

                    $this->add_link_attributes( 'shortcut_' . $shortcut['_id'], $shortcut['shortcut_url'] );

                    echo '<div class="ade-dashboard-shortcut">';
                    echo '<a ' . $this->get_render_attribute_string( 'shortcut_' . $shortcut['_id'] ) . '>' . esc_html( $shortcut['shortcut_label'] ) . '</a>';
                    echo '</div>';
                }
                echo '</div>';
            }

            echo '</div>';
        }

        /**
         * Get metrics data.
         *
         * @param array $settings Widget settings.
         *
         * @return array
         */
        protected function get_metrics( $settings ) {
            $metrics = array();

            if ( 'yes' === $settings['show_posts'] ) {
                $count_post = wp_count_posts( 'post' );
                $metrics[]  = array(
                    'label' => __( 'Posts', 'elementor-admin-dashboard' ),
                    'value' => isset( $count_post->publish ) ? number_format_i18n( $count_post->publish ) : '0',
                );
            }

            if ( 'yes' === $settings['show_pages'] ) {
                $count_page = wp_count_posts( 'page' );
                $metrics[]  = array(
                    'label' => __( 'Pages', 'elementor-admin-dashboard' ),
                    'value' => isset( $count_page->publish ) ? number_format_i18n( $count_page->publish ) : '0',
                );
            }

            if ( 'yes' === $settings['show_comments'] ) {
                $count_comments = wp_count_comments();
                $metrics[]      = array(
                    'label' => __( 'Comments', 'elementor-admin-dashboard' ),
                    'value' => number_format_i18n( $count_comments->approved ),
                );
            }

            if ( 'yes' === $settings['show_users'] ) {
                $count_users = count_users();
                $metrics[]   = array(
                    'label' => __( 'Users', 'elementor-admin-dashboard' ),
                    'value' => number_format_i18n( $count_users['total_users'] ),
                );
            }

            /**
             * Allow developers to filter the metrics displayed in the dashboard.
             *
             * @param array $metrics  Metrics array.
             * @param array $settings Widget settings.
             */
            return apply_filters( 'elementor_admin_dashboard_metrics', $metrics, $settings );
        }
    }
}
