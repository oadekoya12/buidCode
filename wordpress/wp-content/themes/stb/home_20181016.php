<?php get_header(); ?>
<div class="row">
	<div id="content">
      <div class="searchbar">
         <!-- <div class="button">
            <form accept-charset="US-ASCII" action="https://search.usa.gov/search" id="search_form" method="get">   
               <input id="affiliate" name="affiliate" type="hidden" value="stb">       
               <input autocomplete="off" class="usagov-search-autocomplete ui-autocomplete-input" id="query" name="query" type="text" role="textbox" aria-autocomplete="list" aria-haspopup="true">
               <input name="commit" type="submit" value="Search" id="button">
            </form>
			</div> -->
         <?php get_template_part( 'search', 'stb' ); ?>
   </div>
	</div>
   <div class="splash" style="" role="banner">
      <h1><span id="medium-italic">Keeping America moving</span><br>
         <span id="small-normal">through fair and efficient regulation.</span>
      </h1>
      <img class="wallpaper" src="<?php bloginfo('template_url'); ?>/images/two-trains-southwest.jpg" alt="Tank Cars at Dusk">
   </div>
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
               <h2>Recent Cases</h2>
               <?php
                  get_decisions ();
                  ?>
               <a class="stb-button" href="#">View all Cases</a>					 	
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
               <a class="stb-button" href="#">View all Filings</a>	
            </div>
         </li>
      </ul>
	  </fieldset>
	   <script src="<?php bloginfo('template_url'); ?>/js/tab-highlight.js"></script>
	  </div>
   <!-- /.stb-main -->
   <div>
      <div class="col-sm-4 stb-sidebar">
         <a href="/rail-customer-and-public-assistance/">
            <div class="need-asssitance-box">
               <h2>Need Assistance?</h2>
               <h3>Contact our Experts</h3>
            </div>
         </a>
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
<div class="row">
   <div class="index-divider">
      <div class="col-sm-4">
         <div class="data-central">
            <div class="data-central-container">
               <h2>Data Central</h2>
               <h3>Access a wide range of industry data from railroad financials to rates.</h3>
               <ul>
                  <li><a href="<?php echo get_permalink('56') ?>">Economic Data</a></li>
                  <li><a href="<?php echo get_permalink('3790') ?>">Rail Service Data</a></li>
                  <li><a href="<?php echo get_permalink('3895') ?>">Decisions</a></li>
                  <li><a href="<?php echo get_permalink('3860') ?>">Filings</a></li>
                  <li><a href="#">Cases</a></li>
                  <li><a href="<?php echo get_permalink('3893') ?>">Recordations</a></li>
               </ul>
            </div>
         </div>
      </div>
      <div class="col-sm-4">
         <div class="news">
            <h1>Latest News</h1>
			
            <?php 
               if ( have_posts() ) : while ( have_posts() ) : the_post();
               
               	get_template_part( 'content', get_post_format() );
				
               
               endwhile; endif; 
               ?>

            <a class="stb-button indent-2rem" href="/news/">View all News</a>
         </div>
      </div>
      <div class="col-sm-4">
         <div class="twitter-box">
            <h1>Tweets</h1>
            <div class="text-align">by <a href="https://twitter.com/STBDOT">@STBDOT</a></div>
            <a class="twitter-timeline"  href="https://twitter.com/STBDOT" data-widget-id="732991333070163968" data-chrome="noheader nofooter noborders transparent" data-height="450">Tweets by @STBDOT</a>
         </div>
         <p>
            <a class="stb-button indent-2rem" href="https://twitter.com/STBDOT">View on Twitter</a>
         </p>
      </div>
   </div>
</div>
<!-- /.row -->
<?php get_footer(); ?>