		<?php get_header(); ?>

		<div id="container">

			<?php get_sidebar(); ?>
			
			<div id="content">
				<header class="heading">
					<h1 class="title"><?php _e('Suche nach','piraten'); ?> "<?php the_search_query(); ?>"</h1>
				</header>

			<?php if (have_posts()) : ?>

			<div id="categories">			

			<?php while (have_posts()) : the_post(); ?>
			<section class="post">

				<hgroup class="header">
					<h2 class="post-title"><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				</hgroup>

				<article class="article">
					<?php the_excerpt(); ?>
				</article>
				
			</section>
			
			<?php endwhile; ?>

			</div>
			
				<nav id="postnav">
					<?php if( function_exists('wp_pagination_navi') ) {wp_pagination_navi();} ?>
				</nav>

			<?php else : ?>

			<section class="post">
				<hgroup class="header">
						<h2 class="post-title"><?php _e('Such mal sch&ouml;n weiter...','piraten'); ?></h2>
				</hgroup>
				<article class="article">
					<?php get_search_form(); ?> 
				</article>
				
			</section>

			<?php endif; ?>
			</div>

		</div>

		<?php get_footer(); ?>