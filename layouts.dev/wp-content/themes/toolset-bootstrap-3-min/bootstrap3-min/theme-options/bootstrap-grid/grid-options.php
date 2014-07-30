<?php

class WPBT_theme {

    function __construct() {

        // theme activation massage
        add_action("after_switch_theme", array($this, 'wpbootstrap_theme_activation'), 1);
    }

    public static function wpbootstrap_cpt_support() {	// return list supported CPT
        $post_type_all = get_post_types();
        unset(
				$post_type_all['attachment'],
				$post_type_all['media'],
				$post_type_all['revision'],
				$post_type_all['nav_menu_item'],
				$post_type_all['acf'],
				$post_type_all['optionsframework'],
				$post_type_all['view'],
				$post_type_all['view-template'],
				$post_type_all['dd_layouts'],
				$post_type_all['wp-types-group'],
				$post_type_all['cred-form'],
				$post_type_all['wp-types-user-group'],
				$post_type_all['product_variation'],
				$post_type_all['shop_order'],
				$post_type_all['shop_coupon']);

		return $post_type_all;
    }


    function wpbootstrap_theme_activation() {	// theme activation
        add_action('admin_notices', array($this, 'wpbootstrap_theme_activation_notice'), 1);
    }

    function wpbootstrap_theme_activation_notice() {	// theme activation massage
        ?>

        <script>
            jQuery(function($){
                $.ajax({
                    url: "themes.php?page=options-framework"
                });
                $('.updated').css('display','none');
                $('<div id="wpbootstrap-activation" class="alert alert-success">'+
                    '<button type="button" class="close" data-dismiss="alert">x</button>'+
                    '<img class="alert-icon" src="<?php bloginfo('template_directory') ?>/theme-options/img/icon-bootstrap-57.png" alt="Toolset Bootstrap logo">'+
                    '<h4>Toolset Bootstrap</h4>'+
                    '<p><?php echo esc_js(__('Thank you for using Toolset Bootstrap. Learn how to create Bootstrap layouts, edit content with accurate HTML and much more, in the','wpbootstrap'));?> <a href="http://wp-types.com/home/toolset-bootstrap/"><?php echo esc_js(__('Toolset Bootstrap Documentation','wpbootstrap'));?></a>.</p>'+
                    '</div>').insertAfter('.nav-tab-wrapper');
                $('.close').on("click", function(){
                    $('#wpbootstrap-activation').hide();
                });
            });
        </script>
        <?php
    }

}