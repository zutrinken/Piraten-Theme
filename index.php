		<?php get_header(); ?>

		<div id="container">

			<?php get_sidebar(); ?>
			
			<div id="content">
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<section class="post <?php sticky_class(); ?>" id="post-<?php the_ID(); ?>">
				
				<header class="header">
					<h2 class="post-title"><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				</header>

				<aside class="meta">
					<?php the_time('j. M Y'); ?> - <?php the_author_posts_link(); ?> - <?php comments_popup_link(__('0 Kommentare','piraten'),__('1 Kommentar','piraten'),__('% Kommentare','piraten'),__('','piraten'),__('','piraten'));?>
				</aside>

				<article class="article">
					<?php postimage(''); ?>
					<?php the_excerpt(); ?>
				</article>

				<footer class="footer">
					<p><?php _e('abgelegt in','piraten'); ?>: <?php the_category(', '); ?></p>
					<p><?php the_tags(__('getaggt mit: ','piraten'),', ',''); ?></p>
				</footer>
				
			</section>
			
			<?php endwhile; ?>
			
				<nav id="postnav">
					<?php if( function_exists('wp_pagination_navi') ) {wp_pagination_navi();} ?>
				</nav>

			<?php endif; ?>
			</div>

		</div>

		<?php get_footer(); ?>