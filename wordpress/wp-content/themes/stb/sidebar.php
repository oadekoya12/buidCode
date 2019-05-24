<?php


?>
<div class="col-sm-3 stb-sidebar">
   <div class="button">
      <!-- <form accept-charset="US-ASCII" action="https://search.usa.gov/search" id="search_form" method="get">
         <input name="commit" type="submit" value="Search" id="button">
         <div id="page-search-box">
            <input id="page-affiliate" name="affiliate" type="hidden" value="stb">
            <label for="page-query">Search box</label>
            <input autocomplete="off" class="usagov-search-autocomplete ui-autocomplete-input" id="page-query" name="query" type="text" role="textbox" aria-autocomplete="list" aria-haspopup="true" >
         </div> -->
		 <!-- /.page-search-box -->
      <!-- </form> -->
      <?php
         // global $post;
         // switch ($post->post_type) {
         //       case 'economic_data':?>
                <!-- <h3><?php //echo get_post_type_object(get_post_type($post))->label." "."Search";?></h3> -->
                <?php
         //       get_template_part( 'search', 'stbsidebar-posttype' );
         //
         //       break;
         //
         //    default:
         //      get_template_part( 'search', 'stbsidebar' );
         //       break;
         // }

      ?>
   </div>
   <!-- /.button -->
   <br />
   <?php
   $postname_sidebar = array(
      "elibrary",
      "environmental-matters",
      "industry-data",
      "information-center",
      "quicklinks",
      "resources",
   );
   // if($post->post_name=="latest-news" || $post->post_name=="previous-press-releases" || $post->post_name=="previous-items-of-interest" ){
   //    wp_nav_menu( array('menu' => 'news-archive'));
   // }

   // if($post->post_name=="board-members" || $post->post_name=="board" || $post->ppost_parent=='4293'){
   //    wp_nav_menu( array('menu' => 'past-board'));
   // }

   // if(!in_array($post->post_name, $postname_sidebar)){
   //    //echo do_shortcode('[wpb_childpages]');
   //    echo do_shortcode('[wpb_currentchildpages]');
   // }

   if(is_page($post->ID) && !empty($post->post_parent)){
      $sibls = get_pages(array('child_of' => $post->post_parent, 'parent' => $post->post_parent));
      $childn = get_pages(array('child_of' => $post->ID, 'parent' => $post->ID));
      foreach ($sibls as $sibl) {
         ?>
         <div>
         <ul>
            <li class="page_item page-item-<?php echo $sibl->ID ?>"><a href="<?php echo get_permalink($sibl->ID) ?>"><?php  echo $sibl->post_title ?></a></li>
            <?php
            if($sibl->ID == $post->ID){
               ?>
               <div>
                  <ul style="list-style-type: disc; padding-left: 40px;">
               <?php
                  foreach ($childn as $child){
                  ?>
                     <li class="page_item page-item-<?php echo $child->ID ?>"><a href="<?php echo get_permalink($child->ID) ?>"><?php  echo $child->post_title ?></a></li>
                  <?php
                  }
               ?>
               </ul>
            </ul>
            <?php
            ?>

            <?php
         }
         ?> </div> <?php
      }
   }else {
      $childn = get_pages(array('child_of' => $post->ID, 'parent' => $post->ID));
      foreach ($childn as $child){
         ?>
         <div>
            <ul style="list-style-type: disc; padding-left: 40px;">
               <li class="page_item page-item-<?php echo $child->ID ?>"><a href="<?php echo get_permalink($child->ID) ?>"><?php  echo $child->post_title ?></a></li>
            </ul>
         </div>
         <?php
      }
   }
   //echo do_shortcode('[wpb_childpages]');
   ?>
   <br />



</div>
<!-- /.stb-sidebar -->
