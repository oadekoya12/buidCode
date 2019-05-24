<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>
<div class="row">
   <div class="page-format">
      <div class="col-sm-9">
         <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/" style="padding-left: 1.5em; padding-bottom: 1em;">
            <?php if(function_exists('bcn_display'))
               {
                  bcn_display();
               }?>
         </div>
         <?php 
            if ( have_posts() ) : while ( have_posts() ) : the_post();
            
               get_template_part( 'content', get_post_format() );
            
            endwhile; endif; 
            
            ?>

        <?php 
        	global $post;
        	echo "$post->guid";
        	var_dump(parse_url("$post->guid"));
        	var_dump(parse_url("$post->guid")['path']);
        	var_dump(explode('/', trim(parse_url("$post->guid")['path'])));
        	var_dump(array_filter(explode('/', trim(parse_url("$post->guid")['path'])), 'strlen'));
        	var_dump($post);

        ?>
      </div>
      <!-- /.col
      <!-- <div> -->
         <?php get_sidebar(); ?>
         
      </div>
   </div>
</div>

<!-- <div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php
		// if ( have_posts() ) : while ( have_posts() ) : the_post();
               
  //      		get_template_part( 'content', get_post_format() );
				
               
  //      		endwhile; endif; 
		 ?>

</div> -->
<!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
