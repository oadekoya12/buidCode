<?php 
get_header('page'); 
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
         <?php
            if ( have_posts() ) : while ( have_posts() ) : the_post();
            
               get_template_part( 'content', get_post_format() );
            
            endwhile; endif; 
         ?>
         <?php
         if (isset($_GET['redirect']) && !isset(wp_get_current_user()->user_login) ):  ?>
            <div class="spam">
               <form  action="/spam-checker" id="search_form" method="post">   
                  <input id="from_url" name="from_url" type="hidden" value=<?php echo isset($_GET['redirect']) ? $_GET['redirect'] :  '' ?>>
                  <div class="g-recaptcha" data-sitekey="6Lf6fm8UAAAAANWr9Tr6pKwhsLvqnjujMRtnxWrl"> </div>
                  <input name="submit" type="submit" value="Redirect" id="submit">
               </form>
            </div>
         <?php else: 
            wp_redirect($_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$_GET['redirect']);
      endif; ?>
            
      </div>
   </div>
</div>
<!-- /.row -->
<script src='https://www.google.com/recaptcha/api.js'></script>
<?php get_footer(); ?>
