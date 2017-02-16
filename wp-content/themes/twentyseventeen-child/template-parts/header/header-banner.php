<?php
/**
 * Displays header media
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>
<!--<div class="custom-header">

	<div class="custom-header-media">
		<?php /*the_custom_header_markup(); */ ?>
	</div>

</div>--><!-- .custom-header -->
<div class="banner">
    <div class="header">
        <div class="container">
            <div class="row">
                <!-- header left -->
                <div class="col-sm-4 left">
                    <!-- logo -->
                    <h1 class="logo">
                        <a href="<?php echo esc_url(home_url('/')); ?>"
                           title="Venedor Default - Venedor Wordpress Demos" rel="home">
                            <img
                                src="http://www.newsmartwave.net/wordpress/venedor/default/wp-content/themes/venedor/images/logo/logo.png">
                        </a>
                    </h1>
                    <!-- end logo -->
                </div>
                <!-- end header left -->
                <div class="col-sm-4">
                    <div class="wrap">
                        <div class="quick-access">
                            <!-- search form -->
                            <div id="search-form" class="bottom">
                                <div class="yith-ajaxsearchform-container_1">
                                    <form role="search" method="get" id="yith-ajaxsearchform"
                                          action="http://wp.dev/"
                                          class="searchform">
                                    <span class="text"><input type="search" value="" name="s" id="yith-s_1"
                                                              placeholder="Search here" autocomplete="off"></span>
                                        <span class="button-wrap"><button id="yith-searchsubmit" class="btn btn-special"
                                                                          title="Search" type="submit"><span
                                                    class="fa fa-search"></span></button></span>
                                        <input type="hidden" name="post_type" value="product"
                                               style="display: inline-block; width: 200px; left: -200px;">
                                    </form>
                                    <div class="autocomplete-suggestions"
                                         style="position: absolute; display: none; max-height: 300px; z-index: 9999;"></div>
                                </div>
                               
                            </div>
                            <!-- end search form -->
                        </div>
                    </div>
                </div>
                <!-- header right -->
                <?php if ( is_active_sidebar( 'sidebar-header' )):
                ?>
                    <?php dynamic_sidebar( 'sidebar-header' ); ?>

                <?php endif; ?>

                <!-- header right -->
            </div>
        </div>
    </div>
</div>