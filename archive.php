		<?php get_header(); ?>

		<div id="container">

			<?php get_sidebar(); ?>
			
			<div id="content">
			
				<header class="heading">
					<h1 class="title"><?php _e('Archiv f&uuml;r','piraten'); ?>
						<?php if (is_day()) : ?>
							"<?php the_time(''); ?>"
						<?php elseif (is_month()) : ?>
							"<?php the_time('F'); ?>"
						<?php elseif (is_year()) : ?>
							"<?php the_time('Y'); ?>"
						<?php elseif (is_tag()) : ?>
							"<?php single_tag_title(); ?>"
						<?php elseif (is_category()) : ?>
							"<?php single_cat_title(); ?>"
						<?php else : ?>
							<?php _e('Archiv','piraten'); ?>
						<?php endif; ?>
					</h1>
					<aside class="sub-title">
						<?php echo category_description(); ?>
					</aside>
				</header>

			<?php if (have_posts()) : ?>

			<div id="archive">			

			<?php while (have_posts()) : the_post(); ?>
			<section class="post">

				<header class="header">
					<h2 class="post-title"><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				</header>

				<article class="article">
					<?php postimage(''); ?>
					<?php the_excerpt(); ?>
				</article>
				
			</section>
			
			<?php endwhile; ?>

			</div>
			
				<nav id="postnav">
					<?php if( function_exists('wp_pagination_navi') ) {wp_pagination_navi();} ?>
				</nav>

			<?php endif; ?>
			</div>

		</div>

		<?php get_footer(); ?>