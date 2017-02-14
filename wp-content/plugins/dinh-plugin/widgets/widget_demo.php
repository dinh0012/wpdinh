<?php

class Widget_Demo extends WP_Widget
{

    public function __construct()
    {
        $id_base = 'widget-1';
        $name = 'Widget 1';
        $widget_options = array(
            //'classname' => 'kenshin-wg-css-simple',
            'description' => 'Đây là Widget 1'
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
        } ?>
        <div class="ks-ads-css">
            <ul>
                <?php if (!empty($instance['ads-banner1'])): ?>
                    <li class="adleft"><a href="<?php echo $instance['ads-url1']; ?>"><img
                                src="<?php echo $instance['ads-banner1']; ?>" alt=""/></a></li>
                <?php endif; ?>
            </ul>
        </div>
        <?php
        echo $after_widget;
    }

    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        $instance['title'] = strip_tags($new_instance['title']);
        $instance['ads-url1'] = strip_tags($new_instance['ads-url1']);
        $instance['ads-banner1'] = strip_tags($new_instance['ads-banner1']);
        return $instance;
    }

    public function form($instance)
    {
        $inputID = $this->get_field_id('title');
        $inputName = $this->get_field_name('title');
        $inputValue = @$instance['title'];

        $html = '';
        $html .= '<p>';
        $html .= '<label for=' . $inputID . '>Title :</label>';
        $html .= '<input class="widefat" type="text" name= "' . $inputName . '" id="' . $inputID . '" value = "' . $inputValue . '" size="25" />';
        $html .= '</p>';
        echo $html;
        // Phần tử form Ads url 1
        $inputID = $this->get_field_id('ads-url1');
        $inputName = $this->get_field_name('ads-url1');
        $inputValue = @$instance['ads-url1'];

        $html = '';
        $html .= '<p>';
        $html .= '<label for=' . $inputID . '>Ad1 Link URL :</label>';
        $html .= '<input class="widefat" type="text" name= "' . $inputName . '" id="' . $inputID . '" value = "' . $inputValue . '" size="25" />';
        $html .= '</p>';
        echo $html;
        // Phần tử form Ads Banner url 1
        $inputID = $this->get_field_id('ads-banner1');
        $inputName = $this->get_field_name('ads-banner1');
        $inputValue = @$instance['ads-banner1'];

        $html = '';
        $html .= '<p>';
        $html .= '<label for=' . $inputID . '>Ad1 Banner URL :</label>';
        $html .= '<input class="widefat" type="text" name= "' . $inputName . '" id="' . $inputID . '" value = "' . $inputValue . '" size="25" />';
        $html .= '</p>';
        echo $html;
    }

}