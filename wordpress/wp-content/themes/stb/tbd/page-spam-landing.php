<?php
  // if(isset($_POST['from_url'])){
  //   $from_url=$_POST['from_url'];
  // }if(isset($_POST['g-recaptcha-response'])){
  //   $captcha=$_POST['g-recaptcha-response'];
  // }
  // if(!$captcha){
  //   get_header('page');
  //   echo '<br />';echo '<br />';echo '<br />';
  //   echo '<h2>Please check the the captcha form.</h2>';
  //   echo '<br />';echo '<br />';echo '<br />';
  //   get_footer();
  //   exit;
  // }
  // $secretKey = "6Lf6fm8UAAAAAA-ndCFQWG4XjNGKeM64LxsZpRCh";
  // $ip = $_SERVER['REMOTE_ADDR'];
  // $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
  // $responseKeys = json_decode($response,true);
  // if(intval($responseKeys["success"]) !== 1) {
  //   get_header('page');
  //   echo '<br />';echo '<br />';echo '<br />';
  //   echo '<h2>You are spammer !</h2>';
  //   echo '<br />';echo '<br />';echo '<br />';
  //   get_footer();
  // } else {
  //   get_header('page');
  //   echo '<br />';echo '<br />';echo '<br />';
  //   echo '<h2>Thanks for posting comment.</h2>';
  //   echo '<br />';echo '<br />';echo '<br />';
  //   var_dump($_SERVER);
  //   echo '<br />';echo '<br />';echo '<br />';
  //   get_footer();
  //   // if ( wp_redirect("$from_url") ) {
  //   //   exit;
  //   // }
  // }
get_header('page');
var_dump($_SERVER);

if ( have_posts() ) : while ( have_posts() ) : the_post();
            
  get_template_part( 'content', get_post_format() );

endwhile; endif; 
get_footer();