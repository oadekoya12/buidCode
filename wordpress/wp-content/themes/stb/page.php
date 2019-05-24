<?php get_header(); ?>
<div class="row">
   <div class="page-format">
      <div class="col-sm-12">
         <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/" style="padding-left: 1.5em; padding-bottom: 1em;">
            <?php if(function_exists('bcn_display'))
               {
               	bcn_display();
               }?>
         </div>
         <?php ob_start(); do_shortcode("[iFormPrePage]"); ?>
         <?php
            if ( have_posts() ) : while ( have_posts() ) : the_post();

            	get_template_part( 'content', get_post_format() );

            endwhile; endif;

            $postname = array(
               "correspondence",
               "elibrary",
               "environmental-matters",
               "industry-data",
               "information-center",
               "quicklinks",
               "resources",
            );

            global $post;
            // var_dump($post);

            if(in_array($post->post_name, $postname)){ ?>

               <div class="remove-ul">
                  <?php echo wp_list_pages(array('child_of' => $post->ID, 'title_li' => "" )); ?>
               </div>

               <?php
            }
            ?>
      </div>
      <!-- /.col -->
      <div>
         <?php //get_sidebar(); ?>
      </div>
   </div>
</div>
<!-- /.row -->
<?php get_footer(); ?>
