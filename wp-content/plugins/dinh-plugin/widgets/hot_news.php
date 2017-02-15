<?php

class Hot_News extends WP_Widget
{

    public function __construct()
    {
        $id_base = 'hot_news';
        $name = 'Hot News';
        $widget_options = array(
            //'classname' => 'kenshin-wg-css-simple',
            'description' => 'Hot News Slider'
        );
        parent::__construct($id_base, $name, $widget_options);
    }

    public function widget($args, $instance)
    {
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        echo $before_widget;
        if (!empty($title)) {
            echo $before_title . $title . $after_title;
        }
        if (!empty($instance['num_post'])) {
            require WIDGET_VIEWS_DIR . '/hot_news_view.php';

        }

        echo $after_widget;

    }

    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['num_post'] = strip_tags($new_instance['num_post']);
        $instance['interval'] = strip_tags($new_instance['interval']);
        $cat = implode(',', $new_instance['cat']);

        $instance['cat'] = $cat;
        return $instance;

    }

    public function form($instance)
    {
        $taxonomies = get_taxonomies(['name' => 'loai-san-pham'], 'object');
        $loai_sp = get_terms($taxonomies['loai-san-pham']->name);
        //var_dump($loai_sp);
        $inputID = $this->get_field_id('title');
        $inputName = $this->get_field_name('title');
        $inputValue = @$instance['title'];
        $html = '';
        $html .= '<p>';
        $html .= '<label for=' . $inputID . '>Title :</label>';
        $html .= '<input class="widefat" type="text" name= "' . $inputName . '" id="' . $inputID . '" value = "' . $inputValue . '" size="25" />';
        $html .= '</p>';
        echo $html;

        $inputID = $this->get_field_id('num_post');
        $inputName = $this->get_field_name('num_post');
        $inputValue = @$instance['num_post'];
        $html = '';
        $html .= '<p>';
        $html .= '<label for=' . $inputID . '>Number Post :</label>';
        $html .= '<input class="widefat" type="number" step="1" min="1" name= "' . $inputName . '" id="' . $inputID . '" value = "' . $inputValue . '" size="25" />';
        $html .= '</p>';
        echo $html;

        $inputID = $this->get_field_id('interval');
        $inputName = $this->get_field_name('interval');
        $inputValue = @$instance['interval'];
        $html = '';
        $html .= '<p>';
        $html .= '<label for=' . $inputID . '>Time to delay (sec) :</label>';
        $html .= '<input class="widefat" type="number" step="1" min="1" name= "' . $inputName . '" id="' . $inputID . '" value = "' . $inputValue . '" size="25" />';
        $html .= '</p>';
        echo $html;

        $inputID = $this->get_field_id('cat');
        $inputName = $this->get_field_name('cat');
        $cat = @$instance['cat'];
        $cat_arr = explode(',', $cat);
        $html = '';
        $html .= '<p>';
        $html .= '<label for=' . $inputID . '>Choose Categgory :</label>';
        foreach ($loai_sp as $sp) {
            $html .= '<br>';
            $check = '';
            if ($check_cat = in_array ($sp->term_id, $cat_arr))
                $check = 'checked';
            $html .= '<input class="checkbox" type="checkbox" ' . $check . ' name= "' . $inputName . '[]" value="' . $sp->term_id . '"/>';
            $html .= "<label>" . $sp->name . "</label>";
        }
        //$html .= '<input class="widefat" type="hidden" name= "' . $inputName . '" id="' . $inputID . '" value = "' . $inputValue . '" size="25" />';
        $html .= '</p>';
        echo $html;

    }

}