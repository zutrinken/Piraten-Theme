		<?php get_header(); ?>

		<div id="container">

			<?php get_sidebar(); ?>
			
			<div id="content">
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<section class="post">

				<header class="header">
					<h1 class="post-title"><?php the_title(); ?></h1>
				</header>

				<!--<aside class="meta">
					<?php the_time('j. M Y'); ?> - <?php the_author_posts_link(); ?> - <?php comments_popup_link(__('0 Kommentare','piraten'),__('1 Kommentar','piraten'),__('% Kommentare','piraten'),__('','piraten'),__('','piraten'));?>
				</aside>-->

				<article class="article">
					<?php wp_link_pages(); ?>
					<?php the_content(); ?>
					<?php wp_link_pages(); ?>
				</article>

				<section class="replys">
					<?php comments_template(); ?>
				</section>
				
			</section>
			
			<?php endwhile; ?><?php endif; ?>
			</div>

		</div>

		<?php get_footer(); ?>