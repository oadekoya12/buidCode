<?php get_header('page'); ?>
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
          wp_nav_menu( array(
           'menu'     => 'STB Responsive',
           'sub_menu' => true,
           'show_parent' => true,
          ) );

          // $menu = array('container' => false, 'menu_class' => false, 'items_wrap' => '%3$s');
          // wp_nav_menu($menu);

          // $nav_menu = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
          // echo '<pre>';
          //   print_r($nav_menu);
          // echo '</pre>';
          // foreach ($nav_menu as $nav_menu_value) {
          //   if(isset($nav_menu_value->name) && $nav_menu_value->name === 'STB'){
          //     $obj = wp_get_nav_menu_items($nav_menu_value->name);
          //     foreach ($obj as $obj_value) {
          //       if($obj_value->post_parent != 0){
          //         echo '<pre>';
          //           echo "$nav_menu_value->name". PHP_EOL;
          //           // print_r(wp_get_nav_menu_items($nav_menu_value->name));
          //           print_r($obj_value);
          //           // print_r(wp_get_list_pages( $args ));
          //         echo '</pre>';
          //       }
          //     }
          //
          //   }
          //
          // }
          // print_r(glob(__DIR__."/*.php"));

         //  foreach (glob(__DIR__."/*.php") as $filename) {
         //     include $filename;
         //     echo $filename.PHP_EOL;
         // }

         // if(function_exists('stb_auto_menu_fxn_tree')){
         //
         //   // $tree = stb_auto_menu_fxn_tree('STB');
         //   $items = wp_get_nav_menu_items( 'STB' );
         //   $w = new STB_Auto_Menu_Nav_Menu_Tree;
         //   $args = (object) [ 'items_wrap' => '', 'depth' => 0, 'walker' => $w ];
         //   walk_nav_menu_tree( $items, $args->depth, $args );
         // }

         $nav_menu_items = wp_get_nav_menu_items( 'STB' );
         $items = stb_auto_menu_nav_menu_object_tree( $nav_menu_items );

         // The menu items, sorted by each menu item's menu order.
        // $items = array();

        // Depth of the item in reference to parents.
        $depth = 2;

        // An object containing wp_nav_menu() arguments.
        $r = null;

        // NOTICE! Understand what this does before running.
        // $result = walk_nav_menu_tree($items, $depth, $r);

        //All navigation menu list
        $nav_menu = get_terms('nav_menu', array( 'hide_empty' => true ));
        $names = [];
        foreach ($nav_menu as $nav_menu_value) {
          $names[] = $nav_menu_value->name;
        }
        echo '<pre>';
          print_r($names);
          echo PHP_EOL;
        echo '</pre>';
        foreach ($nav_menu_items as $item_keys => $item_values) {
        // foreach ($items as $item_keys => $item_values) {

          //Remove HTML menu from the array object
          if ( $item_values->title == strip_tags($item_values->title) ){
            echo '<pre>';
              // print_r($item_values->title);
              // echo PHP_EOL;

              if($item_values->menu_item_parent == 0){
                if($item_values->title == 'Proceedings and Actions'){
                  // print_r($item_values);
                  // echo PHP_EOL;
                  foreach ($item_values as $item_values_k => $item_values_v) {
                    if($item_values_k == 'children'){
                      foreach ($item_values_v as $item_values_vk => $item_values_vv) {
                        echo 'CHILDREN';
                        echo PHP_EOL;
                        // print_r($item_values_vv);
                        // echo PHP_EOL;
                        if(!empty($item_values_vv->children)){
                          echo 'Not Empty';
                          echo PHP_EOL;
                        }
                      }

                      //Check if 1st Generation children have any children
                      // if(!empty($item_values_v->children)){
                      //   echo 'Not Empty';
                      //   echo PHP_EOL;
                      // }
                    }


                  }
                }

              }

            //Check if parent have any children
            if(!empty($item_values->children)){
              foreach ($item_values as $item_values_key => $item_values_value) {


                // print_r($item_values_key);
                // echo PHP_EOL;

                // print_r($item_values_key);
                // echo PHP_EOL;
                // print_r($item_values_value);
                // echo PHP_EOL;

                // if($item_values_key == 'title'){
                //   // echo $item_values_value;
                //   // echo PHP_EOL;
                //   // if(in_array($item_values_value, $names)){
                //   //   // echo 'in Array';
                //   //   // echo PHP_EOL;
                //   // }
                // }

                // print_r($item_values_key);
                echo PHP_EOL;
              }
            }

            $items_arr[] = $item_values;
            echo '</pre>';
          }
          // if (strpos($item_values->title, '<form>') == false) {
          //   echo 'true';
          // }

        }
          // echo '<pre>';
          //   echo PHP_EOL;
          //   print_r($items_arr);
          //   // echo();
          // echo '</pre>';
       ?>
      </div>
      <!-- /.col -->
      <!-- <div> -->
         <?php //get_sidebar(); ?>
      <!-- </div> -->
   </div>
</div>
<!-- /.row -->
<?php get_footer(); ?>
