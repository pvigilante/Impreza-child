<?php
get_header();

?>
<main id="page-content" class="l-main">
		<section class="l-section">
			<div class="l-section-h i-cf">
                <div class="row">
<?php
if(have_posts()): // if array of posts returned based on current query
    while(have_posts()): // while there are posts in the query, loop through each
        the_post(); // load all post data from current item in loop
        ?>

        <div class="col-12 p-4 text-center">
            <h1 class="page-title">
                <?php 
                the_title();
                ?>
            </h1>
        </div>
        <div class="col-12 p-4 m-auto" style="max-width: 400px">
            <?php
            the_post_thumbnail();
            ?>
        </div>
        <div class="col-12 p-4 m-auto" style="max-width: 400px">
            <?php
            the_content();
            ?>
        </div>

        <div class="col-12 p-4">
            <h3>More Sponsors</h3>
            <div class="row">
            <?php
            $more_sponsors = new WP_Query(array(
                'post_type' => 'sponsor'
            ));
            if($more_sponsors->have_posts()):
                while($more_sponsors->have_posts()):
                    $more_sponsors->the_post();
                    ?>
                    <div class="col-md-4 text-center sponsor-item">
                        <figure class="sponsor-img">
                            <a href="<?=get_permalink();?>"><?=get_the_post_thumbnail( get_the_ID() ,'thumbnail');?></a>
                        </figure>
                        <a href="<?=get_permalink();?>"><?=get_the_title();?></a>
                    </div>
                    <?php
                endwhile;
            endif;
            ?>
            </div>
        </div>
        <?php
    endwhile;
else: 

endif;

?>
                </div>
        </div>
    </section>
</main>
<?php

get_footer();
