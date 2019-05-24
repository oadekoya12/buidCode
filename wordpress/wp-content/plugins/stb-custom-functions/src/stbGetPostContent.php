<?php
function stbgetpostcontent(string $permalink){
  if(isset(get_post(url_to_postid($permalink))->post_content)){
    $content = get_post(url_to_postid($permalink))->post_content;
  }
  if(isset($content)){
    $content = $content;
  }else{
    $content = '';
  }
  return $content;
}
