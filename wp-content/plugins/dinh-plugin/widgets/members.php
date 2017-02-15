<?php
class Members extends WP_Widget {
 
    public function __construct() {
        $id_base = 'members';
        $name = 'Thống kê members';
        $widget_options = array(
            //'classname' => 'kenshin-wg-css-simple',
            'description' => 'Thống kê members'
        );
        parent::__construct($id_base, $name, $widget_options);
    }
    
    public function widget( $args, $instance ) {
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        echo $before_widget;
        if (!empty($title)){
            echo $before_title. $title . $after_title;
        }
       global $wpdb;
        $prefix = $wpdb->prefix;
        $table = $prefix. 'users';
        $result_total = $wpdb->get_results("SELECT * FROM $table",OBJECT);
        $result_new_mem = $wpdb->get_row("SELECT * FROM $table ORDER BY ID DESC",OBJECT);
        $total_mem = count($result_total);
        
        ?>

<div class="members">
    <ul>
    	
        <li class="adleft"><strong>Tổng số thành viên: </strong><?php echo $total_mem ?></li>
        <li class="adleft"><strong>Thành viên mới nhất: </strong><?php echo $result_new_mem->user_login ?></li>
       
    </ul>
</div>
        <?php
        
      
        echo $after_widget;
      
    }
    
    public function update( $new_instance, $old_instance ) {
       $instance = $old_instance;
    
        $instance['title'] = strip_tags($new_instance['title']);
    
        return $instance;
    }
    
    public function form( $instance ) {
        $inputID    = $this->get_field_id('title');
        $inputName  = $this->get_field_name('title');
        $inputValue = @$instance['title'];
        
        $html  = '';
        $html .= '<p>';
        $html .= '<label for='.$inputID.'>Title :</label>';
        $html .= '<input class="widefat" type="text" name= "'.$inputName.'" id="'.$inputID.'" value = "'.$inputValue.'" size="25" />';
        $html .= '</p>';
        echo $html;
  
    }
   
}