<?php
add_post_type_support( 'page', 'excerpt' );

function register_my_menus()
{
    register_nav_menus(array(
        'STB' => __('STB')
    ));
	
	    register_nav_menus(array(
        'STB' => __('STB Responsive')
    ));
}

add_action('init', 'register_my_menus');

function wpb_list_child_pages()
{
    
    global $post;
    
    if (is_page() && $post->post_parent)
        $childpages = wp_list_pages('sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0');
    else
        $childpages = wp_list_pages('sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0');
    
    if ($childpages) {
        
        $string = '<ul>' . $childpages . '</ul>';
    }
    
    return $string;
    
}

add_shortcode('wpb_childpages', 'wpb_list_child_pages');


function wpb_list_child_pages_current_parent()
{
    
    global $post;


    if ( is_page() && $post->post_parent ){ 
        $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0&depth=1' );
    }else{
        $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0&depth=1' );
    }

    if ( $childpages ) {    
        $string = '<ul>' . $childpages . '</ul>';
    }

    return $string;
}

add_shortcode('wpb_currentchildpages', 'wpb_list_child_pages_current_parent');


//get Pods related taxonomy
function wpd_list_child_related_taxonomy(){
    
}
add_shortcode('wpd_child_taxonomy', 'wpd_list_child_related_taxonomy');

function get_decisions()
{
    // Get the root and the domain to build the URL string later. This is only applicable if Domino and Wordpress share the same domain name. Otherwise change this to the Domino root and domain.
    $rootdomain = $_SERVER['HTTPS'] == '' ? 'http://' : 'https://' . $_SERVER['SERVER_NAME'];
    
    // Uncomment to output the root and domain URL for testing.
    //echo 'Root:'.$root;
    
    // Add the port number to the domain. Make sure the port matches the port Domino is listening on. Comment this out if Domino is listening on default ports 80 or 443.
    //$oldsiterootdomain = $rootdomain.":8443";
    //remove the this comment and the line below, and uncomment the line above when moving into production
    $oldsiterootdomain = "https://www.stb.gov";
    
    // Assign the URL to a variable
    $url = '/decisions/readingroom.nsf/restView_decisions-by-date?ReadViewEntries&Count=3%22,%22restView_decisions-by-date&outputformat=json';
    
    // build the final URL that points to the Domino JSON view
    $url = $oldsiterootdomain . $url;
    
    // get the contents from the URL and assign it to a variable
    $json = file_get_contents($url);
    
    // decode the JSON data to turn it in to an array
    $data = json_decode($json, true);
    
    // Set the variable to 0 for use with the for loop interation
    $i = 0;
    ;
    // Cycle through the array		
    foreach ($data as $dataitem) {
        //Set the variable to the unique id for each record.	
        $caselink = $data['viewentry'][$i]['@unid'];
        //set the variable to the entrydata element. Use the loop iteration variable to iterate through the array elements
        $casedata = $data['viewentry'][$i]['entrydata'];
        echo '<p><div class="case-filing">';
        // use the array positions to get the relevent data and output it to the page. Build the link
        if ($casedata[2]['text'][0] == "") {
            echo '<div class="notes-link"><a href="https://stagingweb.stb.gov/decision-information/?UID=' . $caselink . '">' . $casedata[1]['text'][0] . '</a></div>';
        } else {
            echo '<div class="notes-link"><a href="' . 'https://stagingweb.stb.gov/decision-information/?UID=' . $caselink . '">' . $casedata[2]['text'][0] . ' - ' . $casedata[1]['text'][0] . '</a></div>';
        }
        
        //The 
        $servicetime = strtotime($casedata[0]['datetime'][0]);
        $servicedate = date('M d', $servicetime) . ', ' . date('Y', $servicetime);
        echo '<div class="small-date">' . $servicedate . '</div>';
        //echo $casedata[3]['text'][0].'<br />';
        echo $casedata[4]['text'][0] . '<br /><br />';
        if ($casedata[6]['text'][0] == "") {
            echo 'Attachment(s): None';

        } else {
            echo 'Attachment(s): ' . $casedata[6]['text'][0];
        }
        
        echo "</div></p>";
        //iterate the variable
        $i = $i + 1;
    }
}

add_shortcode('get_decisions', 'get_decisions');

function get_filings()
{
    // Get the root and the domain to build the URL string later. This is only applicable if Domino and Wordpress share the same domain name. Otherwise change this to the Domino root and domain.
    $rootdomain = $_SERVER['HTTPS'] == '' ? 'http://' : 'https://' . $_SERVER['SERVER_NAME'];
    
    // Uncomment to output the root and domain URL for testing.
    //echo 'Root:'.$root;
    
    // Add the port number to the domain. Make sure the port matches the port Domino is listening on. Comment this out if Domino is listening on default ports 80 or 443.
    //$oldsiterootdomain = $rootdomain.":8443";
    //remove the this comment and the line below, and uncomment the line above when moving into production
    $oldsiterootdomain = "https://www.stb.gov";
    
    // Assign the URL to a variable
    $url = '/filings/all.nsf/restView_filings-by-date?readviewentries&Count=3","restView_filings-by-date&outputformat=json';
    
    // build the final URL that points to the Domino JSON view
    $url = $oldsiterootdomain . $url;
    
    // get the contents from the URL and assign it to a variable
    $json = file_get_contents($url);
    
    // decode the JSON data to turn it in to an array
    $data = json_decode($json, true);
    
    // Set the variable to 0 for use with the for loop interation
    $i = 0;
    ;
    // Cycle through the array		
    foreach ($data as $dataitem) {
        //Set the variable to the unique id for each record.	
        $filinglink = $data['viewentry'][$i]['@unid'];
        //set the variable to the entrydata element. Use the loop iteration variable to iterate through the array elements
        $filingdata = $data['viewentry'][$i]['entrydata'];
        echo '<p><div class="case-filing">';
        // use the array positions to get the relevent data and output it to the page
        echo '<div class="notes-link"><a href="https://stagingweb.stb.gov/filing-information/?UID=' . $filinglink . '">' . $filingdata[9]['text'][0] . ' - ' . $filingdata[1]['text'][0] . '</a></div>';
        $servicetime = strtotime($filingdata[0]['datetime'][0]);
        $servicedate = date('M d', $servicetime) . ', ' . date('Y', $servicetime);
        echo '<div class="small-date">' . $servicedate . '</div>';
        echo $filingdata[6]['text'][0] . '<br /><br />';
        
        if ($filingdata[12]['text'][0] == "") {
            echo 'Attachment(s): None';
        } else {
            echo 'Attachment(s): ' . $filingdata[12]['text'][0];
        }
        echo "</div></p>";
        //iterate the variable
        $i = $i + 1;
    }
    
}

add_shortcode('get_filings', 'get_filings');

function show_decision()
{
    // Get the root and the domain to build the URL string later. This is only applicable if Domino and Wordpress share the same domain name. Otherwise change this to the Domino root and domain.
    $rootdomain = $_SERVER['HTTPS'] == '' ? 'http://' : 'https://' . $_SERVER['SERVER_NAME'];
    
    // Uncomment to output the root and domain URL for testing.
    //echo 'Root:'.$root;
    
    // Add the port number to the domain. Make sure the port matches the port Domino is listening on. Comment this out if Domino is listening on default ports 80 or 443.
    //$oldsiterootdomain = $rootdomain.":8443";
    //remove the this comment and the line below, and uncomment the line above when moving into production
    $oldsiterootdomain = "https://www.stb.gov";
    
    $url = $rootdomain . "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    
    list(, $uid) = explode('?UID=', $url);
    
    // Assign the URL to a variable
    $url = '/decisions/readingroom.nsf/restViewdecisions-details?readviewentries&PreFormat&StartKey=' . $uid . '&count=2&outputformat=json';
    
    // build the final URL that points to the Domino JSON view
    $url = $oldsiterootdomain . $url;
    
    // get the contents from the URL and assign it to a variable
    $json = file_get_contents($url);
    
    // decode the JSON data to turn it in to an array
    $data = json_decode($json, true);
    
    //set the variable to the entrydata element. Use the loop iteration variable to iterate through the array elements
    $decisiondata = $data['viewentry'][1]['entrydata'];
    
    echo '<p><strong>Docket Number: </strong><br /><span class="black">' . $decisiondata[1]['text'][0] . '</span></p>';
    echo '<strong>Case Title: </strong><br /><span class="black">' . $decisiondata[4]['text'][0] . '</span></p>';
    echo '<strong>Decision Type: </strong><br /><span class="black">' . $decisiondata[2]['text'][0] . '</span></p>';
    echo '<strong>Deciding Body: </strong><br /><span class="black">' . $decisiondata[3]['text'][0] . '</span></p><br />';
    echo '<h4><strong>Decision Summary</strong></h4>';
    echo '<strong>Decision Notes: </strong><br /><span class="black">' . $decisiondata[5]['text'][0] . '</span></p><br />';
    echo '<h4><strong>Decision Attachments</strong></h4>';
    if ($decisiondata[7]['text'][0] == "") {
        echo '<p><strong>Attachment(s): </strong><span class="black">None</span></p>';
    } else {
        echo '<p><strong>Attachment(s): </strong><span class="black">' . $decisiondata[7]['text'][0] . '</span></p>';
    }
    
}

add_shortcode('show_decision', 'show_decision');


function show_filing()
{
    // Get the root and the domain to build the URL string later. This is only applicable if Domino and Wordpress share the same domain name. Otherwise change this to the Domino root and domain.
    $rootdomain = $_SERVER['HTTPS'] == '' ? 'http://' : 'https://' . $_SERVER['SERVER_NAME'];
    
    // Uncomment to output the root and domain URL for testing.
    //echo 'Root:'.$root;
    
    // Add the port number to the domain. Make sure the port matches the port Domino is listening on. Comment this out if Domino is listening on default ports 80 or 443.
    //$oldsiterootdomain = $rootdomain.":8443";
    //remove the this comment and the line below, and uncomment the line above when moving into production
    $oldsiterootdomain = "https://www.stb.gov";
    
    $url = $rootdomain . "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    
    list(, $uid) = explode('?UID=', $url);
    
    // Assign the URL to a variable
    $url = '/filings/all.nsf/restView_filings-by-date-categorized?readviewentries&PreFormat&StartKey=' . $uid . '&count=2&outputformat=json';
    
    // build the final URL that points to the Domino JSON view
    $url = $oldsiterootdomain . $url;
    
    // get the contents from the URL and assign it to a variable
    $json = file_get_contents($url);
    
    // decode the JSON data to turn it in to an array
    $data = json_decode($json, true);
    
    //set the variable to the entrydata element. Use the loop iteration variable to iterate through the array elements
    $filingdata = $data['viewentry'][1]['entrydata'];
    
    echo '<p><strong>Docket Number: </strong><br /><span class="black">' . $filingdata[1]['text'][0] . '</span></p>';
    echo '<strong>Case Title: </strong><br /><span class="black">' . $filingdata[6]['text'][0] . '</span></p>';
    echo '<strong>General Filing Type: </strong><br /><span class="black">' . $filingdata[10]['text'][0] . '</span></p>';
    echo '<strong>Filed For: </strong><br /><span class="black">' . $filingdata[7]['text'][0] . '</span></p>';
    if ($filingdata[12]['text'][0] == "") {
        echo '<p><strong>Attachment(s): </strong><span class="black">None</span></p>';
    } else {
        echo '<p><strong>Attachment(s): </strong><span class="black">' . $filingdata[12]['text'][0] . '</span></p>';
    }
    
}

add_shortcode('show_filing', 'show_filing');

function load_custom_scripts() {
    wp_enqueue_script('jquery-ui-core');// enqueue jQuery UI Core
    wp_enqueue_script('jquery-ui-tabs');// enqueue jQuery UI Tabs
}
 
add_action( 'wp_enqueue_scripts', 'load_custom_scripts' );


function get_all_decisions($view)
{
    // Get the root and the domain to build the URL string later. This is only applicable if Domino and Wordpress share the same domain name. Otherwise change this to the Domino root and domain.
    $rootdomain = $_SERVER['HTTPS'] == '' ? 'http://' : 'https://' . $_SERVER['SERVER_NAME'];
    
    // Uncomment to output the root and domain URL for testing.
    //echo 'Root:'.$root;
    
    // Add the port number to the domain. Make sure the port matches the port Domino is listening on. Comment this out if Domino is listening on default ports 80 or 443.
    //$oldsiterootdomain = $rootdomain.":8443";
    //remove the this comment and the line below, and uncomment the line above when moving into production
    $oldsiterootdomain = "https://www.stb.gov";
    		
    // Assign the URL to a variable
    $url = '/decisions/readingroom.nsf/WebServiceDate?readviewentries&preformat&count=-1&outputformat=json';
    
    // build the final URL that points to the Domino JSON view
    $url = $oldsiterootdomain . $url;
    
    // get the contents from the URL and assign it to a variable
    $json = file_get_contents($url);
    
    // decode the JSON data to turn it in to an array
    $data = json_decode($json, true);
    
    // Set the variable to 0 for use with the for loop interation
    $i = 0;
    ;
    // Cycle through the array		
    foreach ($data as $dataitem) {
        //Set the variable to the unique id for each record.	
        $caselink = $data['viewentry'][$i]['@unid'];
        //set the variable to the entrydata element. Use the loop iteration variable to iterate through the array elements
        $casedata = $data['viewentry'][$i]['entrydata'];
        echo '<p><div class="case-filing">';
        // use the array positions to get the relevent data and output it to the page. Build the link
        if ($casedata[2]['text'][0] == "") {
            echo '<div class="notes-link"><a href="https://stagingweb.stb.gov/decision-information/?UID=' . $caselink . '">' . $casedata[1]['text'][0] . '</a></div>';
        } else {
            echo '<div class="notes-link"><a href="' . 'https://stagingweb.stb.gov/decision-information/?UID=' . $caselink . '">' . $casedata[2]['text'][0] . ' - ' . $casedata[1]['text'][0] . '</a></div>';
        }
        
        //The 
        $servicetime = strtotime($casedata[0]['datetime'][0]);
        $servicedate = date('M d', $servicetime) . ', ' . date('Y', $servicetime);
        echo '<div class="small-date">' . $servicedate . '</div>';
        //echo $casedata[3]['text'][0].'<br />';
        echo $casedata[4]['text'][0] . '<br /><br />';
        if ($casedata[6]['text'][0] == "") {
            echo 'Attachment(s): None';
        } else {
            echo 'Attachment(s): ' . $casedata[6]['text'][0];
        }
        
        echo "</div></p>";
        //iterate the variable
        $i = $i + 1;
    }
}

//allow redirection, even if my theme starts to send output to the browser
add_action('init', 'do_output_buffer');
function do_output_buffer() {
    ob_start();
}

// this redirection
function iframe_form_prePage(){
    global $post ;
    
    if (strpos(get_post($post->ID)->post_content, 'advanced_iframe') !== false) {
        
        if(parse_url($_SERVER['HTTP_REFERER'])['path'] != "/spam-proof/"){
            if ( wp_redirect( "/spam-proof" .'?redirect='.$_SERVER['REQUEST_URI']) ) {
                 exit;
            }
        }
    }
}
add_shortcode('iFormPrePage', 'iframe_form_prePage');
