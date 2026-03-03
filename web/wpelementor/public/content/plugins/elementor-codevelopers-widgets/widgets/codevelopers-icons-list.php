<?php

namespace Codevelopers\Elementor\Widgets;

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Codevelopers_Icons_List extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'codevelopers_icons_list';
    }

    public function get_title()
    {
        return 'Lista de íconos por codevelopers';
    }

    public function get_icon()
    {
        return 'eicon-editor-list-ul';
    }

    public function get_categories()
    {
        return ['general'];
    }

    public function has_widget_inner_wrapper(): bool
    {
        return true;
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => 'Contenido',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'icon_image',
            [
                'label' => 'Imagen del ícono',
                'type' => \Elementor\Controls_Manager::MEDIA,
                'media_types' => ['image'],
            ]
        );

        $repeater->add_control(
            'item_text',
            [
                'label' => 'Texto',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
            ]
        );

        $repeater->add_control(
            'item_link',
            [
                'label' => 'Enlace',
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => 'https://codevelopers.tech',
                'default' => [
                    'url' => '',
                    'is_external' => false,
                    'nofollow' => false,
                ],
            ]
        );

        $this->add_control(
            'icons_list',
            [
                'label' => 'Lista de íconos',
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [],
                'title_field' => '{{{ item_text }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_section',
            [
                'label' => 'Estilo',
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => 'Color del texto',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .codevelopers-icons-list-item' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'link_hover_color',
            [
                'label' => 'Color del enlace al pasar el mouse',
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .codevelopers-icons-list-item a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'link_transition_easing',
            [
                'label' => 'Tipo de suavizado de transición',
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'ease' => 'Ease',
                    'linear' => 'Linear',
                    'ease-in' => 'Ease-in',
                    'ease-out' => 'Ease-out',
                    'ease-in-out' => 'Ease-in-out',
                ],
                'default' => 'ease',
                'selectors' => [
                    '{{WRAPPER}} .codevelopers-icons-list-item a' => 'transition-timing-function: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'link_transition_duration',
            [
                'label' => 'Duración de la transición (ms)',
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 5000,
                'step' => 10,
                'default' => 300,
                'selectors' => [
                    '{{WRAPPER}} .codevelopers-icons-list-item a' => 'transition-duration: {{VALUE}}ms;',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'label' => 'Tipografía',
                'selector' => '{{WRAPPER}} .codevelopers-icons-list-item',
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => 'Tamaño del ícono',
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 200,
                        'step' => 1,
                    ],
                    'rem' => [
                        'min' => 0.5,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .codevelopers-icons-list-item img' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_spacing',
            [
                'label' => 'Espaciado entre ítems',
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 5,
                ],
                'selectors' => [
                    '{{WRAPPER}} .codevelopers-icons-list-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .codevelopers-icons-list-item:last-child' => 'margin-bottom: 0;',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_text_spacing',
            [
                'label' => 'Espaciado entre ícono y texto',
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 3,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 5,
                ],
                'selectors' => [
                    '{{WRAPPER}} .codevelopers-icons-list-item img' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if (!empty($settings['icons_list'])) {
            echo '<ul class="codevelopers-icons-list">';

            foreach ($settings['icons_list'] as $item) {
                echo '<li class="codevelopers-icons-list-item">';

                $content = '';

                if (!empty($item['icon_image']['url'])) {
                    $content .= '<img src="' . esc_url($item['icon_image']['url']) . '" alt="' . esc_attr($item['item_text']) . '" />';
                }

                $content .= esc_html($item['item_text']);

                if (!empty($item['item_link']['url'])) {
                    $target = $item['item_link']['is_external'] ? ' target="_blank"' : '';
                    $nofollow = $item['item_link']['nofollow'] ? ' rel="nofollow"' : '';
                    echo '<a href="' . esc_url($item['item_link']['url']) . '"' . $target . $nofollow . '>' . $content . '</a>';
                } else {
                    echo $content;
                }

                echo '</li>';
            }

            echo '</ul>';
        }
    }
}
