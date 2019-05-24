<?php  /* Template Name: Search Page */
get_header();
?>

<div class="row">
   <div class="page-format">
      <div class="col-sm-9">
        <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/" style="padding-left: 1.5em; padding-bottom: 1em;">
        	<?php if(function_exists('bcn_display'))
            {
                  bcn_display();
            }?>
        </div>
        <div style=" margin: 0 0 0 20px; padding: 0px; width: 602px;">

        	<?php
                // if($_GET){
                //     d($_GET);
                // }
                get_template_part( 'search', 'stb' );
                // switch ($_GET['post_type']) {
                // case 'economic_data':
                //     get_template_part( 'search', 'stbsidebar-posttype' );
                // break;
                // default:
                //     get_template_part( 'search', 'stb' );
                // break;
                // }
                //get_template_part( 'search', 'stb' );
            ?>
    	</div>
    		<?php /* Start the Loop */ ?>
            <?php while ( have_posts() ) : the_post(); ?>
            	<div style=" margin: 0 0 0 20px; padding: 0px;">
            		<H3 class="search-post-title"><?php the_title(); ?></H3>
            		<span class="search-post-excerpt"><?php the_excerpt(); ?></span>
            		<span class="search-post-link"><a href="<?php the_permalink(); ?>"><?php the_permalink(); ?></a></span>
            	</div>

            <?php endwhile; ?>

			<br />
			<br />
      </div>
    </div>
</div>
<?php get_footer(); ?>
