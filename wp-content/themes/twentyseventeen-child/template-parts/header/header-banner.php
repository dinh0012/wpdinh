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
                                          action="<?php echo esc_url(home_url('/')); ?>"
                                          class="searchform">
                                    <span class="text"><input type="search" value="" name="s" id="yith-s_1"
                                                              placeholder="Search here" autocomplete="off"></span>
                                        <span class="button-wrap"><button id="yith-searchsubmit" class="btn btn-special"
                                                                          title="Search" type="submit"><span
                                                    class="fa fa-search"></span></button></span>
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
                <?php if (is_active_sidebar('sidebar-header')):
                    ?>
                    <?php dynamic_sidebar('sidebar-header'); ?>

                <?php endif; ?>

                <!-- header right -->
            </div>
        </div>
    </div>
</div>
<style>
    .banner {
        margin-bottom: 0 !important;
    }

    .admin-bar .site-navigation-fixed.navigation-top {
        box-shadow: 0 4px 8px rgba(0, 0, 0, .34);
    }

    input#yith-s_1 {
        height: 50px;
        width: 280px;
    }
    .header {
        color: #494940;
        font-size: 14px;
        font-family: Arial, Helvetica, sans-serif;
        font-weight: 400;
        padding: 57px 0px 57px 0px;
        padding: 57px 0px 57px 0px;
        padding: 57px 0px 57px 0px;
    }

    .header {
        background-image: url(http://www.newsmartwave.net/wordpress/venedor/default/wp-content/uploads/sites/2/layerslider/Home-Slider-Green-1/slider_bg_07.jpg) ;
    }

    .header-block.well {
        float: left;
        line-height: 1.5;
        padding: 5px 11px;
        margin-left: 10px;
        border-radius: 5px;
    }

    .header .container {
        margin-left: auto;
        margin-right: auto;
        width: 100%;
        padding-left: 3em;
        padding-right: 3em;
    }

    #site-navigation .site-branding {
        padding: 0;
        margin: 0;
        display: inline-block;
        width: auto;
        position: absolute;
        bottom: 0;
        display: block;
        left: 0;
        height: auto;
        padding-top: 0;
        position: absolute;
        /* width: 100%; */
    }

    p.site-description {
        display: none;
    }

    #site-navigation h1.site-title a {
        padding: 0;
        color: #000;
    }

    .site-branding h1.site-title {
        color: #000;
    }

    .menu-main-menu-container {
        /* display: none; */
    }

    .site-branding .wrap {
        max-width: none;
        display: inline-block;
    }

    .menu-main-menu-container {
        display: block;
        float: right;
    }

    img.custom-logo {
        width: 50px;
    }

    a.custom-logo-link {
        display: inline-block;
        padding: 0;
    }

    .navigation-top {
        position: relative;
    }

    .quick-access {
        margin-top: 8px;
        margin-bottom: 5px;
    }

    .searchform .text, .searchform .button {
        display: inline-block;
        float: left;
    }

    .searchform button {
        padding: 0;
        border-radius: 0;
        border-width: 0;
        font-size: 18px;
        width: 50px;
        height: 50px;
        margin-left: 1px;
        -webkit-box-shadow: none;
        box-shadow: none;
    }

    .btn-special {
        border-style: solid;
        border-color: #7bae23;
        border-top-width: 1px;
        border-right-width: 1px;
        border-bottom-width: 1px;
        border-left-width: 1px;
        background: #7bae23;
        color: #ffffff;
    }
</style>