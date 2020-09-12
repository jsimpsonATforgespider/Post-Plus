<?php

class Post_Plus_Cat_Selector extends \Elementor\Base_Control {

  public function get_type(){
    return 'post-plus-category-selector';
  }

  public function content_template(){
    $siteCategories = get_categories(array(
      'orderby'   => 'name',
      'order'     => 'ASC'
    ));
    echo '<select>';
    foreach ($siteCategories as $category ) {
      echo '<option>' . $category->name . '</option>';
    }
    echo '</select>';
  }

}

?>
