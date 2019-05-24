<?php
if(isset($_GET['act']) && $_GET['act'] == 's'){ $action = '/';}
foreach($_GET as $getKey => $getvalue){
  if(isset($_GET['s']) && $getKey == 's'){
    $s = $getKey;
  }
}
?>
  <div class="button">
      <form accept-charset="US-ASCII" action="<?php echo isset($action) ? $action : '""';?>" id="search_form" method="get">
        <input id="affiliate" name="affiliate" type="hidden" value="www.stb.gov">
    		<input autocomplete="off" class="usagov-search-autocomplete ui-autocomplete-input" id="query" name="<?php echo $s ?? 'query'; ?>" type="text" role="textbox" aria-autocomplete="list" aria-haspopup="true" value="<?php //echo isset($_GET['s']) ? $_GET['s'] :  $_GET['query'];
        echo $_GET['s'] ??  $_GET['query'] ?? '';
        ?>">
  		<select style="height: 38px; margin-right: 6px;" name = "act" id="search-select" onchange="getOption(this)" selected="<?php echo isset($_GET['act']) ??  '' ?>">
      		<option value="">choose one</option>
      		<!-- <option value="query">Search.gov</option>
     			<option value="s">Local Search</option> -->
     			<option value="query"<?php	if(isset($_GET ['act']) && $_GET ['act'] == 'query') { echo 'selected="selected"';}	?>>Search.gov</option>
     			<option value="s"<?php if(isset($_GET ['act']) && $_GET ['act'] == 's') { echo 'selected="selected"';	} ?>><?php //echo ucfirst($_SERVER['SERVER_NAME']) ?>Search STB Website</option>

    		</select>
    		<input name="commit" type="submit" value="Search" id="button">
      </form>
  </div>
