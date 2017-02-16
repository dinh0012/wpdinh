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
                                <script type="text/javascript">
                                    jQuery(function ($) {
                                        var search_loader_url = js_venedor_vars.ajax_loader_url;

                                        $('#yith-s_1').yithautocomplete({
                                            minChars: 3,
                                            appendTo: '.yith-ajaxsearchform-container_1',
                                            serviceUrl: '/wordpress/venedor/default/wp-admin/admin-ajax.php?action=yith_ajax_search_products',
                                            onSearchStart: function () {
                                                $(this).css({
                                                    'background-image': 'url(' + search_loader_url + ')',
                                                    'background-repeat': 'no-repeat'
                                                });
                                            },
                                            onSearchComplete: function () {
                                                $(this).css({
                                                    'background-image': 'none',
                                                    'background-repeat': 'no-repeat'
                                                });
                                            },
                                            onSelect: function (suggestion) {
                                                if (suggestion.id != -1) {
                                                    window.location.href = suggestion.url;
                                                }
                                            },
                                            formatResult: function (suggestion, currentValue) {
                                                var pattern = '(' + $.YithAutocomplete.utils.escapeRegExChars(currentValue) + ')';
                                                var html = '';

                                                if (typeof suggestion.img !== 'undefined') {
                                                    html += suggestion.img;
                                                }

                                                html += '<div class="yith_wcas_result_content"><div class="title">';
                                                html += suggestion.value.replace(new RegExp(pattern, 'gi'), '<strong>$1<\/strong>');
                                                html += '</div>';

                                                if (typeof suggestion.div_badge_open !== 'undefined') {
                                                    html += suggestion.div_badge_open;
                                                }

                                                if (typeof suggestion.on_sale !== 'undefined') {
                                                    html += suggestion.on_sale;
                                                }

                                                if (typeof suggestion.featured !== 'undefined') {
                                                    html += suggestion.featured;
                                                }

                                                if (typeof suggestion.div_badge_close !== 'undefined') {
                                                    html += suggestion.div_badge_close;
                                                }

                                                if (typeof suggestion.price !== 'undefined' && suggestion.price != '') {
                                                    html += ' ' + suggestion.price;
                                                }

                                                if (typeof suggestion.excerpt !== 'undefined') {
                                                    html += ' ' + suggestion.excerpt.replace(new RegExp(pattern, 'gi'), '<strong>$1<\/strong>');
                                                }

                                                html += '</div>';


                                                return html;
                                            }
                                        });
                                    });
                                </script>
                            </div>
                            <!-- end search form -->
                        </div>
                    </div>
                </div>
                <!-- header right -->
                <div class="col-sm-4 right">
                    <!-- header contact -->
                    <div class="header-contact right clearfix">
                        <div class="well header-block ">
                            <i class="ionicon icon-person" style=""></i> +(404) 158 14 25 78
                            <br>
                            <i class="ionicon icon-phone" style=""></i> +(404) 158 14 25 78
                            <br>
                            <i class="ionicon icon-phone" style=""></i> +(404) 851 21 48 15
                        </div>
                        <div class="well header-block right ">
                            <i class="ionicon icon-fb" style=""></i> venedor_support
                            <br>
                            <i class="ionicon icon-youtube" style=""></i> venedor_support
                            <br>
                            <i class="ionicon icon-skype" style=""></i> support@venedor.com
                        </div>
                    </div>
                    <!-- end header contact -->
                </div>
                <!-- header right -->
            </div>
        </div>
    </div>
</div>