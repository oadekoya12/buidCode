<?php
        $email;$comment;$captcha;
        if(isset($_POST['from_url'])){
          $from_url=$_POST['from_url'];
          var_dump($from_url);
        }if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
        }
        if(!$captcha){
          get_header('page');
          echo '<br />';
          echo '<h2>Please check the the captcha form.</h2>';
          echo '<br />';
          get_footer();
          exit;
        }
        $secretKey = "6Lf6fm8UAAAAAA-ndCFQWG4XjNGKeM64LxsZpRCh";
        $ip = $_SERVER['REMOTE_ADDR'];
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
        $responseKeys = json_decode($response,true);
        if(intval($responseKeys["success"]) !== 1) {
          get_header('page');
          echo '<h2>You are spammer !</h2>';
          get_footer();
        } else {
          get_header('page');
          echo '<h2>Thanks for posting comment.</h2>';
          get_footer();
        }