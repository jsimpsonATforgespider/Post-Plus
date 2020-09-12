<?php

/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Post_Plus_Category_Button extends \Elementor\Widget_Base {

	public function get_name() {
		return 'pp-cat-btn';
	}

	public function get_title() {
		return __( 'CATegory Button', 'post-plus' );
	}

	public function get_icon() {
		return 'fas fa-cat';
	}

	public function get_categories() {
		return [ 'general' ];
	}

	protected function _register_controls() {
    $mine = array();
    $categories = get_categories(array(
        'orderby'   => 'name',
        'order'     => 'ASC'
    ));
    foreach ($categories as $category ) {
      $mine[$category->name] = $category->name;
    }

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'post-plus' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'category',
			[
				'label' => __( 'Select Category', 'post-plus' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'none',
        'options'=> $mine,
			]
		);

		$this->end_controls_section();

    $this->start_controls_section(
      'style_name_section',
      [
        'label' => __('Category Name', 'post-plus'),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'label' => __( 'Typography', 'post-plus' ),
				//'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .name',
			]
    );

    $this->add_control(
      'name_widget_color',
			[
				'label' => __( 'Text Color', 'post-plus' ),
        'type'  => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
          '{{WRAPPER}} .name'    => 'color: {{VALUE}}',
        ],
			]
    );

		$this->add_control(
			'name_text_align',
			[
				'label' => __( 'Alignment', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'plugin-domain' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'plugin-domain' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'plugin-domain' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
			]
		);

    $this->end_controls_section();

    $this->start_controls_section(
      'style_count_section',
      [
        'label' => __('Category Count', 'post-plus'),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'count_content_typography',
				'label' => __( 'Typography', 'post-plus' ),
				//'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .count',
			]
    );

    $this->add_control(
      'count_widget_color',
			[
				'label' => __( 'Text Color', 'post-plus' ),
        'type'  => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
          '{{WRAPPER}} .count'    => 'color: {{VALUE}}',
        ],
			]
    );

		$this->add_control(
			'count_text_align',
			[
				'label' => __( 'Alignment', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'plugin-domain' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'plugin-domain' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'plugin-domain' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
			]
		);

    $this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();
    $category_ID = get_cat_ID($settings['category']);
    $category_link = get_category_link($category_ID);
    $theCategory = get_category($category_ID);
    $PostCount = $theCategory->category_count;

		echo '<div class="wrapper"><div style="text-align: ' . $settings['name_text_align'] . '" class="name"><a style="text-align: ' . $settings['name_text_align'] . ';color: ' . $settings['name_widget_color'] . '" href="' . $category_link . '">' . $settings['category'] . '</a></div>';
		echo '<div class="count" style="margin:0;text-align: ' . $settings['count_text_align'] .';color: ' . $settings['count_widget_color'] . '">' . $PostCount . '</div></div>';

	}

}

?>
