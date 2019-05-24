<?php get_header(); ?>
<div class="row">
	<!-- <div id="content" class='unsetmerginwidth'> -->
	<div>
    <div class="settinginbody searchbar" >
			<div>
       <?php //get_template_part( 'search', 'stb' );
 		  	get_header('settinginbody'); ?>
		  </div>
			<div>
				<?php require_once(dirname(__FILE__) . '/home-splashcontent.php'); ?>
			</div>
 		</div>
		<?php //get_template_part( 'home-page-overlay', 'page' );

		?>
	</div>
   <div class="splash" style="" role="banner">
      <!-- <h1><span id="medium-italic">Keeping America moving</span><br>
         <span id="small-normal">through fair and efficient regulation.</span>
      </h1> -->
      <img class="wallpaper" src="<?php bloginfo('template_url'); ?>/images/stb_image.png" alt="Tank Cars at Dusk">
   </div>

	 <div class="row">
	    <div class="index-divider">
	       <div class="col-sm-4">
	          <div class="data-central">
	             <div class="data-central-container">
	                <h2>Quick Links</h2>

									<table>
										<tr>
										<td><a href="<?php echo get_permalink('6181') ?>">Active Proceedings</a></td>
										<td><a href="<?php echo get_permalink('3860') ?>">E-Filing</a></li></td>
										</tr>
										<tr>
										<td><a href="<?php echo get_permalink('7223') ?>">Key Areas of Regulation </a></td>
										<td><a href="<?php echo get_permalink('9211') ?>">Reform Task Forces</a></td>
										</tr>
										<tr>
										<td><a href="<?php echo get_permalink('56') ?>">Economic Data</a></td>
										<td><a href="<?php echo get_permalink('2886') ?>">Rail Services Data</a></td>
										</tr>
										<tr>
										<td><a href="<?php echo get_permalink('2877') ?>">STB Reauthorization Reports</a></td>
										<td><a href="<?php echo '/budget-requests/' ?>">Budget Request</a></td>
										</tr>
									</table>
	             </div>
	          </div>
	       </div>
	       <div class="col-sm-8">
	          <div class="news">
	             <h1>Latest News</h1>

	             <?php
	             //d(url_to_postid(get_site_url()."/news-events/whats-new/"));
	             //d(get_post_field('post_content', url_to_postid(get_site_url()."/news-events/whats-new/")));
	             //$queried_post = get_post(url_to_postid(get_site_url()."/news-events/whats-new/"));
	             //d($queried_post);
	             //echo get_post(url_to_postid(get_site_url()."/news-events/whats-new/"))->post_content;
	             //get_post(url_to_postid(get_site_url()."/news-events/whats-new/"))->post_content;
	                // if ( have_posts() ) : while ( have_posts() ) : the_post();

	                	// get_template_part( 'content', get_post_format() );

	                // endwhile; endif;
	             echo do_shortcode( '[qw_query slug="latest-news"]' );
	                ?>

	             <a class="stb-button indent-2rem" href="/latest-news/">View all Latest News</a>
	          </div>
	       </div>
	       <!-- <div class="col-sm-4">
	          <div class="twitter-box">
	             <h1>Tweets</h1> -->
	             <!-- <div class="text-align">by <a href="https://twitter.com/STBDOT">@STBDOT</a></div>
	             <a class="twitter-timeline"  href="https://twitter.com/STBDOT" data-widget-id="732991333070163968" data-chrome="noheader nofooter noborders transparent" data-height="450">Tweets by @STBDOT</a>
	          </div> -->
	          <!-- <p>
	             <a class="stb-button indent-2rem" href="https://twitter.com/STBDOT">View on Twitter</a>
	          </p> -->
	      <!--  </div> -->
	    </div>
	 </div>
	 <!-- /.row -->

   <div class="col-sm-8 stb-main">
   <fieldset class="group">
   <legend>Select Group Item - Item One are Recent Decisions and Item two are recent filings</legend>
      <ul class="tabs">
         <li class="labels">
            <label for="tab1" id="label1">Board Decisions</label>
            <label for="tab2" id="label2">Recent Filings</label>
         </li>
         <li>
            <input type="radio" checked name="tabs" id="tab1">
            <div id="tab-content1" class="tab-content">
               <!-- Your Content Here -->
               <h2>Recent Decisions</h2>
               <?php
                  get_decisions ();
                  ?>
               <a class="stb-button" href="/quicklinks/decisions/">View all Decisions</a>
            </div>
         </li>
         <li>
            <input type="radio" name="tabs" id="tab2">
            <div id="tab-content2" class="tab-content">
               <!-- Your Content Here -->
               <h2>Recent Filings</h2>
               <?php
                  get_filings ();
                  ?>
               <a class="stb-button" href="/quicklinks/filings/">View all Filings</a>
            </div>
         </li>
      </ul>
	  </fieldset>
	   <script src="<?php bloginfo('template_url'); ?>/js/tab-highlight.js"></script>
	  </div>
   <!-- /.stb-main -->
   <div>
      <div class="col-sm-4 stb-sidebar">
	        <div class="need-asssitance-box">
	           <a href="/resources/need-assistance/"><h2>Need Assistance?</h2></a>

	        </div>
         <ul class="quick-file-list list-no-style">
            <li>
               <a href="<?php echo get_permalink("3802")?>">
               <img class="quick-file-img" src="/wp-content/uploads/circle-arrow.png" alt="Circle Arrow" />
               <span>File a</span><br />Recordation
               </a>
            </li>
            <li>
               <a href="<?php echo get_permalink("3824")?>">
               <img class="quick-file-img" src="/wp-content/uploads/circle-arrow.png" alt="Circle Arrow" />
               <span>File a</span><br />
               Formal Filing
               </a>
            </li>
            <li>
               <a href="<?php echo get_permalink("")?>">
               <img class="quick-file-img" src="/wp-content/uploads/circle-arrow.png" alt="Circle Arrow" />
               <span>File a</span><br />
               Environmental Comment
               </a>
            </li>
            <li>
               <a href="<?php echo get_permalink("3834")?>">
               <img class="quick-file-img" src="/wp-content/uploads/circle-arrow.png" alt="Circle Arrow" />
               <span>File</span><br />
               Other Submissions
               </a>
            </li>
         </ul>
      </div>
      <!-- /.stb-sidebar -->
   </div>
</div>
<!-- /.row -->

<?php get_footer(); ?>
