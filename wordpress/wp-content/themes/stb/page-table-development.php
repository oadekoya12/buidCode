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

         // echo do_shortcode('[tabs title="" disabled="false" collapsible="false" active="0" event="click"]');
         // echo do_shortcode('[/tabs]');

         // do_shortcode('[accordions title="" disabled="false" active="0" autoheight="false" collapsible="false"]');
         //   do_shortcode('[accordion title="Pane 0"]'); echo 'Accordion pane 0 content'; do_shortcode('[/accordion]');
         //   do_shortcode('[accordion title="Pane 1"]'); echo 'Accordion pane 1 content'; do_shortcode('[/accordion]');
         //   do_shortcode('[accordion title="Pane 2"]'); echo 'Accordion pane 2 content'; do_shortcode('[/accordion]');
         // do_shortcode('[/accordions]');



        if ( have_posts() ) : while ( have_posts() ) : the_post();

        	get_template_part( 'content', get_post_format() );

        endwhile; endif;
        // $args = array(
        //   'post_type' =>
        //     array (
        //       'rail_service_issues_' => 'rail_service_issues_',
        //     ),
        //   'post_status'     => 'publish',
        //   'posts_per_page'  => 15,
        //   'orderby' => 'meta_value',
        //   'order' => 'ASC',
        // );
        // $rail_service_issues = new WP_Query( $args );
        // $all_rails = pods('rail_service_issues_');
        // echo '<pre>';
        //   print_r($all_rails);
        //   // print_r(func_get_args($rail_service_issues));
        // echo '</pre>';

        // $args = array(
        //   'post_type' => 'rail_service_issues_',
        //   'posts_per_page'   => -1,
        // );
        // $loop = new WP_Query( $args );
        // while ( $loop->have_posts() ) : $loop->the_post();
        //   $ids[] = get_the_ID();
        // endwhile;
        //
        // foreach ($ids as $idvalue) {
        //   $idfields[$idvalue]['rsir_date'] = pods('rail_service_issues_', $idvalue)->field('rsir_date');
        //   $idfields[$idvalue]['year'] = date('Y', strtotime(pods('rail_service_issues_', $idvalue)->field('rsir_date')));
        //   $idfields[$idvalue]['month'] = date('F', strtotime(pods('rail_service_issues_', $idvalue)->field('rsir_date')));
        //   $idfields[$idvalue]['rsirc'] = pods('rail_service_issues_', $idvalue)->field('rail_service_issues_reports_category')['slug'];
        //   $idfields[$idvalue]['permalink'] = get_permalink($idvalue);
        // }
        //
        // $idfieldsgrouped = array_group_by($idfields, 'rsirc', 'year', 'month');

        // [subtabs title="MIDDLE TABS"]
        //     [subtab title="Middle tab"]
        //         [subsubtabs title="INNER TABS"]
        //             [subsubtab title="Inner tab"]
        //             [/subsubtab]
        //         [/subsubtabs]
        //     [/subtab]
        // [/subtabs]
        // $menu_items = wp_get_nav_menu_items('stb');

        // echo '<pre>';
        //   // print_r($menu_items);
        // echo '<pre>';

        ob_start();
        echo do_shortcode('[ep_724_tabs]');

        $cont = ob_get_contents();
        ob_end_clean();

        // echo ($cont);
        echo do_shortcode($cont);
        // $replaced = preg_replace_callback("~([a-z]+)\(\)~",
        // function ($m){
        //     return $m[1]();
        // }, $replaced);
        // echo('Here ==' . $replaced);
        // echo '<br>';
        // echo($GLOBALS['ep_724']);
        // print_r($GLOBALS['ep_724']);
        // echo($ep_724);
        // $code = sprintf($ep_724);
        // echo '<br>';
        // echo "$code";
        // echo do_shortcode("'". print_r($ep_724). "'");
        // echo do_shortcode(do_shortcode('[ep_724_tabs]'));
        // foreach ($idfieldsgrouped as $idfieldsgroupedkey => $idfieldsgroupedvalue) {
        //   if(isset($idfieldsgroupedkey) && null !== $idfieldsgroupedkey){
        //
        //   }
        //   echo '<pre>';
        //   foreach ($idfieldsgroupedvalue as $idfieldsgvkey => $idfieldsgvvalue) {
        //     echo "<br>";
        //     // print_r($idfieldsgvkey);
        //   }
        //   echo '<pre>';
        // }

        //grouping variables by rsirc, year and month


        // echo '<pre>';
        //   echo "<br>";
        //   // print_r($idfields);
        //   // print_r($idfieldsgrouped);
        //   // pods('rail_service_issues_', $idvalue)->fields();
        //   echo '<br>';
        //   // print_r($rails_issue->id('4866'));
        //   // print_r(pods_data('rail_service_issues_'));
        //   echo '<br>';
        //   // print_r($rails_issues);
        //   echo '<br>';
        //   // print_r($rails_issue->api->pod_data['fields']);
        //   echo '<br>';
        //   // print_r($rails_issue->api->pod_data['fields']['rsir_date']);
        //   echo '<br>';
        //   // print_r($rails_issue->api->pod_data['fields']['rail_service_issues_reports_category']);
        //   echo '<br>';
        //   // print_r($rails_issue->api->pod_data['id']);
        //   echo '<br>';
        //   // print_r(get_post(get_the_ID()));
        // echo '</pre>';

        // while( $rail_service_issues->have_posts() ) : $rail_service_issues->the_post();
        //   echo '<pre>';
        //     // print_r(get_post(get_the_ID()));
        //     // print_r($rail_service_issues->the_post());
        //   echo '</pre>';
        // endwhile;

        wp_reset_postdata();
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
