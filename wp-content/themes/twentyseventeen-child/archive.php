<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

$setting_option = get_option('theme_option');
//get_header($setting_option['header']);
get_template_part('header/header-' . $setting_option['header']);
?>
	<div class="wrap">

		<?php if ( have_posts() ) : ?>
			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->
		<?php endif; ?>

		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

				<?php
				if ( have_posts() ) : ?>
					<?php
					/* Start the Loop */
					$count = 0;
					while ( have_posts() ) : the_post();$count++;

					if ($count == 4) {
						$p3 = 'thrid';
						$count = 0;
					} else { $p3 = ''; }
					?>

				<div class="col-xs-6 col-md-4 " id="product-<?php the_ID(); ?>">
					<?php the_post_thumbnail('medium',array('class' => 'product-thumb') ); ?>
					<a href="<?php the_permalink(); ?>"><h3 class="title-sp"><?php the_title(); ?></h3></a>
					<div class="info">
						<p style="margin-top: 5px;">Giá: <?php echo get_post_meta( $post->ID, 'price', true ); ?></p>
						<p class="product-status">
							<?php
							$product_status = get_post_meta( $post->ID, 'author', true );

							?>
						</p><!--Tình trạng sản phẩm-->
						<a class="order-button" href="<?php the_permalink();?>">Xem chi tiết</a>
					</div>
				</div>

					<?php endwhile;

					the_posts_pagination( array(
						'prev_text' => twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 'twentyseventeen' ) . '</span>',
						'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'twentyseventeen' ) . '</span>' . twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ),
						'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyseventeen' ) . ' </span>',
					) );

				else :

					get_template_part( 'template-parts/post/content', 'none' );

				endif; ?>

			</main><!-- #main -->
		</div><!-- #primary -->
		<?php get_sidebar(); ?>
	</div><!-- .wrap -->
	<style>
		.title-sp{
			font-size: 16px;
			padding-top: 10px !important;
			min-height: 54px;
		}
		#content #primary{
			width: 100%;
		}
		.product-thumb {
			float: left;
		}
		.product-info {
			width: 45%;
			margin-left: 5%;
			float: right;
		}
		.product-info h1 {
			font-size: 1.5em;
			margin-bottom: 0.5em;
		}
		.product-price, .product-status, .product-description {
			margin: 5px 0;
		}
		.order-button {
			color: #fff;
			background: rgb(33, 189, 12);
			text-decoration: none;
			padding: 5px;
			margin: 15px 0;
			display: table;
		}
		.post-info {
			clear: both;
			padding-top: 15px;
		}
	/*	.sanpham {
			width: 30.3333%;
			float: left;
			margin-right: 3%;
		}*/

	</style>
<?php //get_footer();
$setting_option = get_option('theme_option');
//get_header($setting_option['header']);
get_template_part('footer/footer-' . $setting_option['footer'], 'none');
