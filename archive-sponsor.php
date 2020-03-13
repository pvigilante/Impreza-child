<?php
get_header();

?>
<main id="page-content" class="l-main">
		<section class="l-section">
			<div class="l-section-h i-cf">
<?php
if(have_posts()): // if array of posts returned based on current query
    ?>
    <div class="row">
    <?php
    while(have_posts()): // while there are posts in the query, loop through each
        the_post(); // load all post data from current item in loop
        ?>
        <div class="col-md-4 text-center sponsor-item">
            <figure class="sponsor-img">
                <a title="<?=get_the_title();?>" href="<?=get_permalink();?>"><?=get_the_post_thumbnail( get_the_ID() ,'thumbnail');?></a>
            </figure>
            <a href="<?=get_permalink();?>"><?=get_the_title();?></a>
        </div>
        <?php
    endwhile;
    ?>
    </div>
    <?php
else: 

endif;

?>
        </div>
    </section>
</main>
<?php

get_footer();
