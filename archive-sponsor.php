<?php
get_header();

?>
<main id="page-content" class="l-main">
		<section class="l-section">
			<div class="l-section-h i-cf">
<?php
if(have_posts()): // if array of posts returned based on current query
    while(have_posts()): // while there are posts in the query, loop through each
        the_post(); // load all post data from current item in loop

        echo '<h3>'. get_the_title(). '</h3>';
        echo '<div>'.get_the_content() . '</div>';
        
        echo '<a href="'. get_permalink() .'">';
            the_post_thumbnail();
        echo '</a>';

    endwhile;
else: 

endif;

?>
        </div>
    </section>
</main>
<?php

get_footer();
