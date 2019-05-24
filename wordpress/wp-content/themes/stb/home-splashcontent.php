<?php
// if(isset(get_post(url_to_postid('home-page-overlay'))->post_content)){
//   $content = get_post(url_to_postid('home-page-overlay'))->post_content;
// }
// if(isset($content)){
//   $content = $content;
// }else{
//   $content = '';
// }
//call function from plugins/stb-custom-functions/src/stbGetPostContent.php
if (function_exists('stbgetpostcontent') == TRUE){
  $content = stbgetpostcontent('home-page-overlay');
}
?>
<div class = "splashhomecontentbody">
  <?=$content ?>
</div>
<div class="padtopbottom splashhomecontentbottom">
  <a class="stb-button splash-button" href="/proceedings-actions/enhanced-search/">Enhanced Search Action</a>
  <!-- <a class="stb-button splashhomecontentmerginleft" href="/?s">Search STB Website</a> -->
</div>
