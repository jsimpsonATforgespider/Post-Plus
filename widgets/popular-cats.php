<?php

/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Post_Plus_Popular_Categories extends \Elementor\Widget_Base {

	public function get_name() {
		return 'pp-pop-cats';
	}

	public function get_title() {
		return __( 'Popular Cats', 'post-plus' );
	}

	public function get_icon() {
		return 'fas fa-fire';
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
				'label' => __( 'Select Category 1', 'post-plus' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'none',
        'options'=> $mine,
			]
		);

		$this->add_control(
			'category2',
			[
				'label' => __( 'Select Category 2', 'post-plus' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'none',
        'options'=> $mine,
			]
		);

		$this->add_control(
			'category3',
			[
				'label' => __( 'Select Category 3', 'post-plus' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'none',
        'options'=> $mine,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
      'pop_cats_text_style',
      [
        'label' => __('Text Style', 'post-plus'),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'pop_cats_typography',
				'label' => __( 'Typography', 'post-plus' ),
				//'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .pctext',
			]
    );

    $this->add_control(
      'pop_cats_color',
			[
				'label' => __( 'Text Color', 'post-plus' ),
        'type'  => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
          '{{WRAPPER}} .pctext'    => 'color: {{VALUE}}',
        ],
			]
    );

    $this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();
    $category_ID = get_cat_ID($settings['category']);
    $category_ID2 = get_cat_ID($settings['category2']);
    $category_ID3 = get_cat_ID($settings['category3']);
    $category_link = get_category_link($category_ID);
    $category_link2 = get_category_link($category_ID2);
    $category_link3 = get_category_link($category_ID3);
    $theCategory = get_category($category_ID);
    $PostCount = $theCategory->category_count;

		echo '<div class="pctext">Popular Categories: <a class="pctext" href="'.$category_link.'">' . $settings['category'] . '</a>, <a class="pctext" href="'.$category_link2.'">' . $settings['category2'] . '</a> ,<a class="pctext" href="'.$category_link3.'">' . $settings['category3'] . '</a></div>';

	}

}

?>
