<?php /* Template Name: Landing Page */get_header(); ?>

<div class="row">
<div class="page-format">
   <div class="col-sm-12">
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
   </div>
   <!-- /.col -->
   </div>
</div>
<!-- /.row -->
<?php get_footer(); ?>
