<?php

get_header();

//parcourt tous les articles existants sinan affiche pas 
if (have_posts()) :
	while (have_posts()) : the_post(); ?>
	

	<article class="post">
	<div class="wall">
<div class="wall-item">
<a href="<?php the_permalink(); ?>">	<?php	the_post_thumbnail(); ?></a>
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<p>	<?php the_excerpt() ?></p>
</div>
</div>
	
	</article>
	
	<?php endwhile;
	
	else :
		echo '<p>IL n\'y as pas de contenue sur cette partie</p>';
	
	endif;
	
get_footer();

?>