<?php
class dev_controller {	
	
	public function index()
	{
        echo memory_usage();
	}

	public function stats()
	{
		load::helper('serverstats');
	}

	public function speed($test='')
	{
		echo '<h1>Speed Test</h1>';
		# Stop output from code to be tested
			function output_buffer() { return NULL; }
			ob_start('output_buffer');
			
			$loops = 100;
			$exact_timer = true;
			
			ob_flush();
			flush();
			
/*
Test one
*/
				$start_time1 = microtime($exact_timer); # Start the first timer
				for($int = 0; $int < $loops; $int++):

/* ========================== */



/* ========================== */

				endfor;
				$total_time = microtime($exact_timer) - $start_time1; # Stop the first timer, and figure out the total
				$total_memory = memory_usage();

			ob_flush();
			flush();

/*
Test two
*/
				$start_time2 = microtime($exact_timer); # Start the second timer
				for($int = 0; $int < $loops; $int++):

/* ========================== */


				
/* ========================== */	
	
				endfor;
				$total_time2 = microtime($exact_timer) - $start_time2; # Stop the second timer, and figure out the total
				$total_memory2 = memory_usage();	

			ob_end_flush(); # Enable output again

			# Echo the results for AJAX
			$results = array(
				'total_time1' => $total_time,
				'total_time2' => $total_time2
			);

			if($total_time < $total_time2):
				$res = ( ( $total_time / $total_time2 ) * 100 ) - 100;

				echo '<p>your first test was faster by <strong>'.abs(round($res)).'%</strong>, it took <strong>'.$total_time.'</strong> seconds to execute vs <strong>'.$total_time2.'</strong>.</p>';
				echo '<p>Your first test used <strong>'.$total_memory.'</strong> vs <strong>'.$total_memory2.'</strong></p>';
				
			elseif($total_time > $total_time2):
				$res = ( ( $total_time2 / $total_time ) * 100 ) - 100;

				echo '<p>Your second test was faster by <strong>'.abs(round($res)).'%</strong>, it took <strong>'.$total_time2.'</strong> seconds to execute vs <strong>'.$total_time.'</strong>.</p>';
				echo '<p>Your second test used <strong>'.$total_memory2.'</strong> vs <strong>'.$total_memory.'</strong></p>';
				
			elseif($total_time === $total_time2):
				echo '<p>The code samples scored equal times. Use either.</p>';
			endif;	
	}

	
public function	yaml_test () {
$yaml = '
display: admin
paged: paged
posts_per_page: 2
name:
  name: Name
  input: input
  type: text
  notes: This is a note
password:
  name: Password
  input: input
  type: password
  notes: This is another
country:
  name: Country
  input: option
  notes: Option notes.
  options:
    - Canada
    - USA
    - UK
message:
  name: Message
  input: multiline
  type: text
  notes: Yes, more notes.
button:
  button_name: Button Name
  type: button
  input: input';
		
		$info = YAML::load( $yaml );
		
		var_dump($info);
	}
	
	public function demo_clean()
	{
		$config = config::get('db');
		
		try {
			$pdo = new pdo("{$config['default']['driver']}:dbname={$config['default']['database']};host={$config['default']['host']}",$config['default']['username'],$config['default']['password']);
		} catch(PDOException $e) {
			dingo_error(E_USER_ERROR,'DB Connection Failed. '.$e->getMessage());
		}

		$build = $pdo->exec( "TRUNCATE TABLE  `posts`" );
		
		$build = $pdo->exec( "TRUNCATE TABLE `post_meta`" );
		
		$build = $pdo->exec( "TRUNCATE TABLE `users`" );	
			
		$build = $pdo->exec( "INSERT INTO `users` (`id`, `email`, `username`, `password`, `type`, `data`, `registered`, `status`)
		VALUES
			(1, 'demo@tentaclecms.com', 'demo', '89e495e7941cf9e40e6980d14a16bf023ccd4c91', 'administrator', '{\"first_name\":\"Demo\",\"last_name\":\"User\",\"activity_key\":\"\",\"url\":\"\",\"display_name\":\"Demo User\",\"editor\":\"wysiwyg\"}', 1340063724, 1);" );
			
		$build = $pdo->exec( "INSERT INTO `posts` (`id`, `parent`, `author`, `date`, `modified`, `title`, `content`, `excerpt`, `comment_status`, `ping_status`, `password`, `slug`, `type`, `menu_order`, `uri`, `visible`, `status`, `template`)
			VALUES
				(6, 0, 1, 1322853969, 1328247576, 'Home', '<p><strong>Tentacle is an OpenSource Content Management System, it is free to use.</strong></p>\r\n<p>The goal is to help web professionals and small businesses create fast and flexible websites with the user in mind.</p><p><strong>Username:</strong> demo<br /><strong>Password:</strong> demo<br /><a href=\'http://demo.tentaclecms.com/admin/\'>Admin</a></p>\r\n', '', 'open', 'open', '', 'home', 'page', 1, 'home/', 'public', 'published', 'default'),
				(112, 0, 1, 1328502285, 1328560008, 'Welcome to Tentacle CMS', '<p>This is your first post!</p>\r\n', '', 'open', 'open', '', 'welcome-to-tentacle-cms', 'post', 0, 'welcome-to-tentacle-cms/', 'public', 'published', 'default'),
				(113, 0, 1, 1340070422, 1340070422, 'Blog', '', '', 'open', 'open', '', 'blog', 'page', 2, 'blog/', 'public', 'published', 'template-blog');" );
		
		$build = $pdo->exec( "INSERT INTO `posts_meta` (`id`, `posts_id`, `meta_key`, `meta_value`)
			VALUES
				(7, 6, 'scaffold_data', 'a:5:{s:4:\"save\";s:0:\"\";s:11:\"bread_crumb\";s:0:\"\";s:13:\"meta_keywords\";s:0:\"\";s:16:\"meta_description\";s:0:\"\";s:4:\"tags\";s:0:\"\";}'),
				(58, 112, 'scaffold_data', 'a:6:{s:9:\"post_type\";s:9:\"type-post\";s:13:\"post_category\";a:1:{i:0;s:1:\"1\";}s:11:\"bread_crumb\";s:0:\"\";s:13:\"meta_keywords\";s:0:\"\";s:16:\"meta_description\";s:27:\"Enter your comments here...\";s:4:\"tags\";s:0:\"\";}');" );
	}


    public function module_nav () {
		$module = load::model('module');

		clean_out($module->navigation());
    }

	public function email()
	{
		
		load::helper('email');
		$send_email = load::model( 'email' );

		
	
		$user_name    = 'user_name';
		$password     = 'password';
		$email        = 'adamapatterson@gmail.com';
	
		$first_name   = 'adam';
		$last_name    = 'patterson';

		$hashed_ip = sha1($_SERVER['REMOTE_ADDR'].time());
		$hash_address = BASE_URL.'admin/activate/'.$hashed_ip;


		$message = '<p>Hello '.$first_name.' '.$last_name.'<br /></p>
					<p><strong>Username</strong>: '.$user_name.'<br />
					<strong>Password</strong>: '.$password.'</p>
					<p><strong>Click the link to activate your account.</strong><br />'.$hash_address.'</p>
					<a href="'.BASE_URL.'admin/">'.BASE_URL.'admin/</a>';
					
		$message_two = 'simple message';
		
		$user_email = $send_email->send( 'Tentacle CMS', $message, $email, $email );
	}

	/**
	* pull function
	* 
	* The pull function is triggered by GitHub's Post-Receive URL. 
	* Every time a push to GitHub is done staging.tcms.me will be updated.
	*
	* @return string
	* @author Adam Patterson
	*/
	public function pull()
	{
		load::helper ('git');
		
		echo '<pre>';
		echo pull();
		echo '</pre>';
	}


	public function relations ()
	{
		$categories = load::model( 'tags' );

		clean_out( $categories->get_all_tags( ) );
	}
	

    public function rout_test() {
       var_dump(route::$route);
    }

	public function extensions ()
	{
        $modules = load::model('module');

		//var_dump($modules->get('active'));

        var_dump($modules->get('active'));

		var_dump($modules->get('inactive'));

        //$activate = $modules->activate('test');

		//$deactivate = $modules->deactivate('test');

        //var_dump($deactivate);
	}

	/**
	 * ========================= Google Analytics
	 * http://code.google.com/p/gapi-google-analytics-php-interface/wiki/GAPIDocumentation
	 * http://richardneililagan.com/2010/06/accessing-google-analytics-using-php-via-gapi/
	 */

	
	public function script_cache()
	{
		load::helper('cache');

		cache::css();
		//cache::script();
		
	}

	public function sortable ()
	{			
		load::view ( 'admin/sortable' );
	}
	
	
	public function RecursiveWrite( $pages, $level = 0 ) 
	{
		$page_flat_hiarchy = array();

		// build a multidimensional array of parent > children
		foreach ($pages as $key => $value ):
			$type = is_array($key);

			$page_flat_hiarchy[$key] = /*$level*/$value;
			//$page_flat_hiarchy[$key] = $level;

			if ( array_key_exists( 'children', $value ) )
				RecursiveWrite($value['children'], $level+1);
		endforeach;

		return $page_flat_hiarchy;
	}
	
	
	public function snippet (  )
	{
		echo '<h1>Snippet Test</h1>';
		echo '<p>Page ID <strong>101</strong></p>';
		echo '<p>Snippet slug anything from the site.</p>';
		
		$page = load::model( 'page' );
		$page = $page->get( '101' );
		
		echo '<h2>Page Object</h2>';
		clean_out($page->content);
		
		echo '<h2>Parsing</h2>';

		// loaded from Snippet Helper
		//add_shortcode( 'snippet', 'snippet' );
		
		//echo serialize(array('barnacles','ipsum'));
		
		# Initiate the extensions.
	    init_extensions();
	
		# Prepare the trigger class
		$trigger 		= Trigger::current();

		if($trigger->exists("shortcode"))
			$page->content = $trigger->filter($page->content,"shortcode");
		
		echo $page->content;
		
		echo '<hr />';
		
		//echo get::snippet('footer');
	}
	
	
	public function menu()
	{
		 //example data
		 $items = array(
		    array('id'=>1, 'title'=>'Home', 'parent_id'=>0),
		    array('id'=>2, 'title'=>'News', 'parent_id'=>1),
		    array('id'=>3, 'title'=>'Sub News', 'parent_id'=>2),
		    array('id'=>4, 'title'=>'Articles', 'parent_id'=>0),
		    array('id'=>5, 'title'=>'Article', 'parent_id'=>4),
		    array('id'=>6, 'title'=>'Article2', 'parent_id'=>4)
		 );

		 //create new list grouped by parent id
		 $itemsByParent = array();
		 foreach ($items as $item) {
		    if (!isset($itemsByParent[$item['parent_id']])) {
		        $itemsByParent[$item['parent_id']] = array();
		    }

		    $itemsByParent[$item['parent_id']][] = $item;
		 }

		 //print list recursively 
		 function printList($items, $parentId = 0) {
		    echo '<ul>';
		    foreach ($items[$parentId] as $item) {
		        echo '<li>';
		        echo $item['title'];
		        $curId = $item['id'];
		        //if there are children
		        if (!empty($items[$curId])) {
		            printList($items, $curId);
		        }           
		        echo '</li>';
		    }
		    echo '</ul>';
		 }

		printList($itemsByParent);
	}
	
	
	public function oembed_two()
	{
		?>
		<form name="oembed_form" action="http://localhost/tentacle/dev/oembed_two" method="post">
		<input type="text" name="url" value="<?=$_POST['url']?>" size="50">
		<input type="submit" name="Show" value="Show Video">
		</form>
		<?
		$oembedUrls = array (
		  'www.youtube.com' => 'http://www.youtube.com/oembed?url=$1&format=json',
		  'www.dailymotion.com' => 'http://www.dailymotion.com/api/oembed?url=$1&format=json',
		  'www.vimeo.com' => 'http://vimeo.com/api/oembed.xml?url=$1&format=json',
		  'vimeo.com' => 'http://vimeo.com/api/oembed.xml?url=$1&format=json',
		  'www.blip.tv' => 'http://blip.tv/oembed/?url=$1&format=json',
		  'www.hulu.com' => 'http://www.hulu.com/api/oembed?url=$1&format=json',
		  'www.viddler.com' => 'http://lab.viddler.com/services/oembed/?url=$1&format=json',
		  'www.qik.com' => 'http://qik.com/api/oembed?url=$1&format=json',
		  'www.revision3.com' => 'http://revision3.com/api/oembed/?url=$1&format=json',
		  'www.scribd.com' => 'http://www.scribd.com/services/oembed?url=$1&format=json',
		  'www.wordpress.tv' => 'http://wordpress.tv/oembed/?url=$1&format=json',
		  'www.5min.com' => 'http://www.oohembed.com/oohembed/?url=$1',
		  'www.collegehumor.com' => 'http://www.oohembed.com/oohembed/?url=$1',
		  'www.thedailyshow.com' => 'http://www.oohembed.com/oohembed/?url=$1',
		  'www.funnyordie.com' => 'http://www.oohembed.com/oohembed/?url=$1',
		  'www.livejournal.com' => 'http://www.oohembed.com/oohembed/?url=$1',
		  'www.metacafe.com' => 'http://www.oohembed.com/oohembed/?url=$1',
		  'www.xkcd.com' => 'http://www.oohembed.com/oohembed/?url=$1',
		  'www.yfrog.com' => 'http://www.oohembed.com/oohembed/?url=$1',
		  'yfrog.com' => 'http://www.oohembed.com/oohembed/?url=$1',
		  'www.flickr.com' => 'http://www.flickr.com/services/oembed?url=$1&format=json'
		);

		if (!empty($_POST['url'])){
			$parts = parse_url($_POST['url']);
			
			$host = $parts['host'];
			if (empty($host) || !array_key_exists($host,$oembedUrls)){
				echo 'Unrecognized host';
			} else {
				$oembedContents = @file_get_contents(str_replace('$1',$_POST['url'],$oembedUrls[$host]));
				
				$oembedData = @json_decode( $oembedContents );
				
				  if ( $host == 'www.flickr.com' || $host == 'flickr.com' || $host == 'yfrog.com' ) {
						$embedCode = '<img src="'. $oembedData->url .'" />';
		 			} else {
				 		$embedCode =  $oembedData->html;
					}
				echo "Embed code for <a href='".$_POST['url']."' target='_blank'>".$_POST['url']."</a> :<br>".$embedCode;
			}
		}

	}
	
	public function oembed (  )
	{
		
		echo '<h1>oEmbed</h1>';
		echo '<p>Page ID <strong>117</strong></p>';
		
		$page = load::model( 'page' );
		$page = $page->get( '117' );
		
		//$url = 'http://www.youtube.com/watch?v=TWRzm2c-v4Q';
		$url = 'http://vimeo.com/44185686';
		//$url = 'http://www.flickr.com/photos/brianrbielawa/5534988483/';
		
		echo $url;
		
		load::library('oembed','AutoEmbed.class');

		clean_out( $page->content );
		
		$AE = new AutoEmbed();
		
		//embed_tag_for($page->content);

		
		// load the embed source from a remote url
		if (!$AE->parseUrl($url)) {
		    echo 'it did not work';
		} else {
			echo 'it works <br />';
			//$imageURL = $AE->getImageURL();
			
			$AE->setWidth('1280');
			$AE->setHeight('720');
			
			echo $AE->getEmbedCode();
			echo '<img src="'.$imageURL.'" />';
		}		
	}
	
	public function system ()
	{
		echo '<h3>$_SERVER</h3><hr />';
			var_dump($_SERVER);
		echo '<h3>$GLOBALS</h3><hr />';
			var_dump($GLOBALS);
		echo '<h3>$_GET</h3><hr />';
			var_dump($_GET);
		echo '<h3>$_POST</h3><hr />';
			var_dump($_POST);
		echo '<h3>$_REQUEST</h3><hr />';
			var_dump($_REQUEST);
		echo '<h3>$_SESSION</h3><hr />';
			var_dump($_SESSION);
		echo '<h3>$_ENV</h3><hr />';
			var_dump($_ENV);
		echo '<h3>$HTTP_RAW_POST_DATA</h3><hr />';
			var_dump($HTTP_RAW_POST_DATA);
		echo '<h3>$argv</h3><hr />';
			var_dump($argv);	
	}
	

	/**
	* ajax function
	*
	* @return void
	* @author Adam Patterson
	**/
	public function ajax()
	{
		echo "This content is in the Dev controller under Ajax function.";
	}


	/**
	* jq_load function
	*
	* @return html
	* @author Adam Patterson
	* 
	* The purpose of this function is the provide simple HTML for jQuery to load and append to an element.
	* 
	**/
	public function jq_load ()
	{ ?>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
		<script type="text/javascript">	
		
			$(document).ready(function(){

			
			    function loadVals() {
			      var singleValues = $("#select").val();
					return singleValues;
			    }

			    $("select").change(load_content);
			    
				function load_content() {
				    $.get(loadVals(), function(data) {
				        $('#content').html(data);
				    });
				}
			
				load_content();
			});
		</script>
		
		  <p></p>
		
		<h1>Content</h1>
		<select name="select" id="select" size="1" <!--onchange="location = this.options[this.selectedIndex].value;"-->>
			<option value="<?= BASE_URL ?>dev/jq_html">Page One</option>
			<option value="<?= BASE_URL ?>dev/jq_html_two">Page Two</option>
		</select>
		<div id="content"></div>
<?	}
  

	/**
	* jq_html function
	*
	* @return html
	* @author Adam Patterson
	* 
	* The purpose of this function is the provide simple HTML for jQuery to load and append to an element.
	* 
	**/
	public function jq_html ()
	{
		echo '<h3>This content was loaded with jQuery and appended to #content</h3>';
	}
	
	public function jq_html_two ()
	{
		echo '<h3>This is some new content that has been appended to #content</h3>';
	}


	/**
	 * mobile function
	 *
	 * @return void
	 * @author Adam Patterson
	 **/
	public function mobile ()
	{
		echo '<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0b1/jquery.mobile-1.0b1.min.css" />
		<script src="http://code.jquery.com/jquery-1.6.1.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.0b1/jquery.mobile-1.0b1.min.js"></script>';
	}
	
	
	/**
	 * suggest function
	 *
	 * @return void
	 * @author Adam Patterson
	 **/
	public function suggest ()
	{
		/* Mod for Database use
		if(isset($_POST['queryString'])) {
			$queryString = $db->real_escape_string($_POST['queryString']);

			if(strlen($queryString) >0) {

				$query = $db->query("SELECT country FROM countries WHERE country LIKE '$queryString%' LIMIT 10");
				if($query) {
				echo '<ul>';
					while ($result = $query ->fetch_object()) {
	         			echo '<li onClick="fill(\''.addslashes($result->country).'\');">'.$result->country.'</li>';
	         		}
				echo '</ul>';

				} else {
					echo 'OOPS we had a problem :(';
				}
			} else {
				// do nothing
			}
		} else {
			echo 'There should be no direct access to this script!';
		}*/
		
		# Temp non dynamic Data
		echo '<ul>';
   			echo '<li onClick="fill(\'One\');">One</li>';
			echo '<li onClick="fill(\'Two\');">Two</li>';
			echo '<li onClick="fill(\'Three\');">Three</li>';
			echo '<li onClick="fill(\'Four\');">Four</li>';
			echo '<li onClick="fill(\'Five\');">Five</li>';
			echo '<li onClick="fill(\'Six\');">Six</li>';
			echo '<li onClick="fill(\'Seven\');">Seven</li>';
			echo '<li onClick="fill(\'Eight\');">Eight</li>';
			echo '<li onClick="fill(\'Nine\');">Nine</li>';
			echo '<li onClick="fill(\'Ten\');">Ten</li>';
		echo '</ul>';
	}
	
	
	/**
	 * ajax_check functiuon
	 *
	 * @return void
	 * @author Adam Patterson
	 **/
	public function ajax_check ()
	{	
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		{
			// If its an ajax request execute the code below	
			echo '1';	
			exit;
		}

		//if it's not an ajax request echo the below.
		echo 'This is clearly not an ajax request!';
	}
	
	
	/**
	 * username_check function
	 *
	 * @return void
	 * @author Adam Patterson
	 **/
	public function username_check($username = '')
	{		
		$username = trim( strtolower( input::post( 'username') ) );
		
		# Query the database and then return the number of rows (1 == taken, 0 = availible. )
		
		# Static demo
		switch ($username) {
			case 'ashley':
		    case 'adam':
			case 'john':
			case 'mark':
			case 'paul':
			case 'rick':
			case 'luke':
			case 'simon':
		        echo '1';
		        break;
		}
	}
	
	
	/**
	* function_test function
	*
	* @return void
	* @author Adam Patterson
	**/

	public function function_test ()
	{
		load::helper ('template');
	}

	
    /**
	 * theme functions
	 *
	 * @return void
	 * @author Adam Patterson
	 **/
	public function theme()
	{ 
		define( 'SCAFFOLD' , 'TRUE' );
		
		echo '<h2>Detected Themes</h2>';
			
		clean_out(get_themes());
		
		echo '<h2>Valid Template Files</h2>';
			clean_out(get_templates('tentacle'));
		
		echo '<h2>Themes Settings</h2>';
			clean_out(get_settings('tentacle'));
		
		echo '<h2>Themes Resources</h2>';
			clean_out(get::resources(THEMES_DIR.'tentacle'));
	}
	
	
	/**
	* define_test function
	*
	* @return void
	* @author Adam Patterson
	**/
	public function define_test ($admin_var ="")
	{
		//echo dirname($_SERVER['PHP_SELF']). '<br />';
	
		echo '<strong>DS:</strong> ' .DS . '<br />';
		
		echo "<strong>realpath(''):</strong>" .realpath('') . '<br />';

		echo '<strong>APP_ROOT:</strong> ' . APP_ROOT . '<br />';
		echo '<strong>STORAGE_DIR:</strong> ' . STORAGE_DIR . '<br />';
		echo '<strong>STORAGE_URL:</strong> ' . STORAGE_URL . '<br />';
		echo '<strong>THEMES_DIR:</strong> ' . THEMES_DIR . '<br />';
		echo '<strong>THEMES_URL:</strong> ' . THEMES_URL . '<br />';
		echo '<strong>IMAGE_DIR:</strong> ' . IMAGE_DIR . '<br />';
		echo '<strong>IMAGE_URL:</strong> ' . IMAGE_URL . '<br />';
		echo '<strong>IMAGE_URI:</strong> ' . IMAGE_URI . '<br /><br />';

		echo '<strong>CONFIG:</strong> ' . CONFIG . '<br />';

		echo '<strong>BASE_URL:</strong> ' . BASE_URL . '<br />';
		echo '<strong>BASE_URI:</strong> ' . BASE_URI . '<br />';
		echo '<strong>URI:</strong> ' . URI . '<br />';

		echo '<br /><strong>Admin variable:</strong> ' . $admin_var . '<br />';
		
		echo "<strong>CMS Details:</strong><br />";
		echo "SERVER_NAME: ". $_SERVER['SERVER_NAME'] ."<br />";
		echo "SERVER_ADDR: ". $_SERVER['SERVER_ADDR'] ."<br />";
		echo "SERVER_PORT: ". $_SERVER['SERVER_PORT'] ."<br />";	
		
		
		echo "<strong>Server details:</strong><br />";
		echo "TENTACLE_URL: ". TENTACLE_URL ."<br />";
		echo "TENTACLE_URI: ". TENTACLE_URI ."<br />";
		echo "ADMIN_URL: ". ADMIN_URL ."<br />";
		echo "ADMIN_URI: ". ADMIN_URI ."<br />";
		echo "TENTACLE_LIB: ". TENTACLE_LIB ."<br />";
		echo "TENTACLE_PLUGIN: ". TENTACLE_PLUGIN ."<br />";
		echo "ADMIN_JS: ". ADMIN_JS ."<br />";
		echo "ADMIN_CSS: ". ADMIN_CSS ."<br />";
		echo "MINIFY: ". MINIFY ."<br />";
		echo "<br />";
		
		echo "<strong>Page details:</strong><br />";
		echo "PHP_SELF: ". $_SERVER['PHP_SELF'] ."<br />";
		echo "SCRIPT_FILENAME: ". $_SERVER['SCRIPT_FILENAME'] ."<br />";
		echo "<br />";
		
		echo "<strong>Request details:</strong><br />";
		echo "REMOTE_ADDR: ". $_SERVER['REMOTE_ADDR'] ."<br />";
		echo "REMOTE_PORT: ". $_SERVER['REMOTE_PORT'] ."<br />";
		echo "REQUEST_URI: ". $_SERVER['REQUEST_URI'] ."<br />";
		echo "QUERY_STRING: ". $_SERVER['QUERY_STRING'] ."<br />";
		echo "REQUEST_METHOD: ". $_SERVER['REQUEST_METHOD'] ."<br />";
		echo "REQUEST_TIME: ". $_SERVER['REQUEST_TIME'] ."<br />";
		echo "HTTP_REFERER: ". $_SERVER['HTTP_REFERER'] ."<br />";
		echo "HTTP_USER_AGENT: ". $_SERVER['HTTP_USER_AGENT'] ."<br />";
		
	}

	
	/**
	* diff function
	*
	* @return void
	* @author Adam Patterson
	**/
		
	public function diff () 
	{
		//http://svn.kd2.org/svn/misc/libs/diff/example.php
		?>
		<style type="text/css">.ins { background: #cfc; }.del { background: #fcc; }ins { background: #9f9; }
		del { background: #f99; }hr { background: none; border: none; border-top: 2px dotted #000; color: #fff; }
		</style>
		<h1>LibDiff</h1>
		<hr />
		<?php

		// Include the diff class
		load::library('diff');

			$a_raw = '<html>
				<head>
					<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
					<title>Hello World!</title>
				</head>
				<body>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			
					<h2>A heading well be removing</h2>
			
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				</body>
			</html>';
			
			$b_raw = '<html>
			<head>
					<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
					<title>Goodbye Cruel World!</title>
				</head>
				<body>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			
			
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			
					<p>Just a small amount of new text...</p>
				</body>
			</html>';

		// Include two sample files for comparison
		$a = explode("\n", $a_raw);
		$b = explode("\n", $b_raw);

		// Options for generating the diff
		$options = array(
		);

		// Initialize the diff class
		$diff = new Diff($a, $b, $options);
		
		?><h2>Side By Side</h2> <?
		
		// Generate a side by side diff
		load::file(APPLICATION.'/library/diff/Renderer/Html','SideBySide');
		$renderer = new Diff_Renderer_Html_SideBySide;
		echo $diff->Render($renderer);
		
		?><h2>Inline</h2> <?

		// Generate an inline diff
		load::file(APPLICATION.'/library/diff/Renderer/Html','Inline');
		$renderer = new Diff_Renderer_Html_Inline;
		echo $diff->render($renderer);
		
	} // END DIFF


	public function hash () 
	{
		
		/*
		* create a hash from a users domain name an email address
		* send hash to remote servier for verification.
		*/
		load::library('hash');

		$hash = new Crypt_Hash('sha512');

		$email 		= 'adamapatterson@gmail.com';
		$domain 	= 'tentaclecms.com';
		$token 		= '&@?(l?95jl!rxxknfzc!';
		
		$hash_string = '7oHB0wNEzMsXmeQStp3wHgFOutaT0in3FvVnZbXJ0NjV7rEJHfYBbfrsfPpnADPPQs0xka9tTJ+eZaTBbGN/ow==';
		
		$hash->setKey($email.$token);	
		
		if (base64_encode($hash->hash($domain)) == $hash_string )
		{
			echo 'We have a match!<br>';
		}

	} // END Hash
 

	public function smushit ()
	{
		echo 'smushIt';

		load::helper ('smushIt');

		$sample = 'http://a0.twimg.com/profile_images/1079746338/profile-adam-large.jpg';

		$smushed = new smushit();
		
		$raw = $smushed->compress($sample);
		
		echo '<pre>';
		print_r($raw);
		echo '</pre>';
		
		echo '<img src="'.$sample.'" alt="Raw" title="Raw"/>';
		
		echo '<img src="'.$raw->dest.'" alt="Smushed" title="Smushed" />';
		
	}// END SmushIt
	

	public function gravatar ()
	{
		load::helper ('gravatar');
		
		echo '<h2>get::gravatar()</h2>';
		
		echo get::gravatar('adamapatterson@gmail.com');
		
		?>
			<script type="text/javascript" src="<?=ADMIN_JS; ?>jquery.min.js"></script>
			<script type="text/javascript" src="<?=ADMIN_JS; ?>md5.js"></script>
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function(){

			var email = $("#email"),
			avatar = $("#avatar");

			email.blur(function() {
			avatar.css("background-image","url(http://www.gravatar.com/avatar/" + MD5(email.val()) + ")");

			});

			});
			
		</script>
		<div id="avatar"><img src="http://papermashup.com/demos/gravatar-image/thumb.png" width="80" height="80"/></div>

		<form class="gravatar">
		<input type="text" onFocus="if(this.value=='Email Address') this.value='';" onBlur="if(this.value=='') this.value='Email Address';" value="Email Address" name="s" id="email" />
		</form>
		
	<?
	}
	
	
	public function request()
	{
		if (function_exists('fopen')) {
			echo 'fopen exists<br>';
		}
		
		if (function_exists( 'fsockopen' )) {
			echo 'fsockopen exists<br>';
		}
		
		if (function_exists('fopen') || (function_exists('ini_get') && ini_get('allow_url_fopen') != true) ) {
			echo 'fopen ini_get allow_url_fopen<br>';
		}
		
		if ( function_exists('curl_init') && function_exists('curl_exec') ){
			echo 'curl_init curl_exec exists<br>';
		}
	}
	
	
	public function counting()
	{
        echo increment('themes')."<br />";

        deincrement('template');
	
		echo increment('modules')."<br />";

        deincrement('test');
	
		echo 'themes '.total_update('themes')."<br />";
		echo 'modules '.total_update('modules')."<br />";
		echo total_update();
	}
	

	/**
	 * inflector function
	 *
	 * @return void
	 * @author Adam Patterson
	 **/
	public function inflector ()
	{
		echo '<h2>Inflector</h2>';
	
		$string = 'In pellentesque faucibus vestibulum';
		$camel = 'inPellentesqueFaucibusVestibulum';
		$upper = 'UPPER';
		$lower = 'lower';
	
		echo '<strong>Camelize Turned</strong> '. $string .' <strong>to</strong> '. camelize($string).'<br />';
	
		echo '<strong>Underscore Turned</strong> '. $camel .' <strong>to</strong> '. underscore($camel).'<br />';

		echo '<strong>Dash Turned</strong> '. $camel .' <strong>to</strong> '. dash($camel).'<br />';
	
		echo '<strong>Humanize Turned</strong> '. $string .' <strong>to</strong> '. humanize($string).'<br />';
	
		if (is_upper($upper)) {
			echo '<strong>is_upper</strong> says '. $upper .' is all upper case.<br />';
		}
	
		if (is_lower($lower)) {
			echo '<strong>is_upper</strong> says '. $lower.' is all lower case.<br />';
		}
	}// END inflector
	
	/**
	 * string function
	 *
	 * @return void
	 * @author Adam Patterson
	 **/
	public function string ()
	{
		echo '<h2>String</h2>';
		
		load::helper ('string');

		$long_string = 'In pellentesque faucibus vestibulum. Nulla at nulla justo, eget luctus tortor. Nulla facilisi. Duis aliquet egestas purus in blandit. Curabitur vulputate, ligula lacinia scelerisque tempor, lacus lacus ornare ante, ac egestas est urna sit amet arcu. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed molestie augue sit amet leo consequat posuere. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Proin vel ante a orci.';
		$string = 'In pellentesque faucidsdsbus vestibulum@';';[;4]';
		$html_string = '<strong>Strings & Stuff</strong>';
		$san_string = '&lt;strong&gt;Strings &amp; Stuff&lt;/strong&gt;';
		$slash_string = 'Is your name O\'reilly?';
		echo '<h4>truncate()</h4> '.string::truncate($long_string, 30).'<br />';
		echo '<h4>truncate_middle()</h4> '.string::truncate_middle($long_string, 30).'<br />';
		echo '<h4>fix()</h4> '.string::fix($html_string, true).'<br />';
		echo '<h4>unfix()</h4> '.string::unfix($san_string).'<br />';
		echo '<h4>sanitize()</h4> '.string::sanitize($string).'<br />';
		echo '<h4>random()</h4> '.string::random(20, true).'<br />';
		echo '<h4>normalize()</h4> '.string::normalize($string).'<br />';
		echo '<h4>pluralize()</h4>'.string::pluralize(3, 'bean','beans');
		echo '<h4>escapeStr()</h4> '.string::escape_string($slash_string).'<br />';
		echo '<h4>widont()</h4> '.string::widont($long_string).'<br />';
		echo '<h4>highlight()</h4>'.highlight($long_string, 'faucibus').'<br />';
	
	}// END Function

	/**
	 * numbers function
	 *
	 * @return void
	 * @author Adam Patterson
	 **/
	public function numbers()
	{
		echo '<h2>Numbers</h2>';
		
		load::helper ('numbers');

		echo '<h4>number_to_phone()</h4>'. number_to_phone(1235551234, array('areaCode' => true,'extension' => 555,'countryCode' => 1)).'<br />';
		echo '<h4>number_to_currency()</h4>'. number_to_currency(1234567890.50) .'<br />';
		echo '<h4>number_to_percentage()</h4>'. number_to_percentage(100) .'<br />';
		echo '<h4>number_with_delimiter()</h4>'. number_with_delimiter(12345678.05, ".").'<br />';
		echo '<h4>number_with_precision()</h4>'. number_with_precision(111.2345, 2). '<br />';
		echo '<h4>number_to_human_size()</h4>'. number_to_human_size(1234567890123). '<br />';
		
	}// END Function
	

	/**
	 * date functiuon
	 *
	 * @return void
	 * @author Adam Patterson
	 **/
	public function date( $date='' ) 
	{
		echo '<h2>Date</h2>';

		$date = new date();
	
		$minute	= 30;
		$hour	= 11;
		$day 	= 18;	
		$month 	= 'DEC';
		$year	= 1982;
		
		//2012-02-08 14:16:05
		//$year.'-'.$month.'-'.$day.' '.$hour.':'.$min
		
		echo date('l dS \o\f F Y h:i:s A', strtotime( $year.'-'.$month.'-'.$day.' '.$hour.':'.$minute.':00' ));
		
	}// END Function
	
	/**
	 * time functiuon
	 *
	 * @return void
	 * @author Adam Patterson
	 **/
	public function time()
	{
		echo '<h2>Time</h2>';

		echo '<h4>time_in_timezone()</h4>'.date::time_in_timezone('Pacific/Chatham');
		
		echo '<h4>date::timezones()</h4>';
		//print_r(timezones());
		
		echo '<h4>date::set_timezone()</h4><p>Used in date::time_in_timezone()</p>';
		
		echo '<h4>date::get_timezone()</h4>'.date::get_timezone();
		
		echo '<h4>date::relative_time()</h4><p>Does not work.</p>';
		
		echo '<h4>now()</h4><p>'.date::now().'</p>';

        echo '<h4>now(\'+1 day\')</h4><p>'.date::now('+1 day').'</p>';
		
		echo date::current('year');
        echo date::current('month');
        echo date::current('day');
        echo date::current('hour');
		
	}// END Function
	
	
	/**
	 * state function
	 *
	 * @return void
	 * @author Adam Patterson
	 **/
	public function state()
	{	
		echo '<h2>State</h2><p>Auto Loaded</p>';
		
		echo 'CURRENT_PAGE'.CURRENT_PAGE;
		
		echo '<h4>odd_even()</h4>';
		echo odd_even();
		
		echo '<h4>even_odd()</h4>';
		echo even_odd();
		
	}// END Function
	
	
	/**
	 * track function
	 *
	 * @return void
	 * @author Adam Patterson
	 **/
	public function track()
	{	
		echo '<h2>Track</h2>';
		load::helper('track');
	}// END Function
	
	
	/**
	 * create_user function
	 *
	 * @return void
	 * @author Adam Patterson
	 **/
	public function create_user ()
	{
		/*user::create(array(
			'username'=>'adampatterson',
			'email'=>'adamapatterson@gmail.com',
			'password'=>'pineapple23',
			'type'=>'admin'
		));
	
		user::update('adamapatterson@gmail.com')
			->data('first_name','Adam')
	        ->data('last_name','Patterson')
			->data('activity_key','')
			->data('url','http://www.adampatterson.ca')
			->data('display_name','Adam Patterson')
			->save(); */
	}
	
	
	
	/**
	 * zip function
	 *
	 * @return void
	 * @author Adam Patterson
	 **/
	public function zip()
	{	
		echo '<h2>Zip</h2>';
		load::helper ('zip');
		
		echo '<a href="?app=file" class="button">Unzip File!</a>';
		
		$app = input::request ( 'app' );
		
		$appdata = STORAGE_DIR.'/file.zip';
		$appname = '$app.zip';
		
		if (file_exists($appdata)) {
			if (isset($app)) {
			    $result = download_and_extract_zip($appname,$appdata);
			}
			else {
			   // ob_end_clean();
			 echo '<a href="?app=file" class="button">Unzip File!</a>';
			 }
		}
		else {
			echo 'Can not load the file.';			
		}
	}// END Function
	
	public function navigation ()
	{
		load::helper('navigation');
		
		$args = array();
		
		define ( 'FRONT'		,'true' );

		$page = load::model( 'page' );
		$pages = $page->get( );
		// Current URI to be used with .current page
		$uri = URI;
		
		$get_page_level = 0;

		$page_tree = $page->get_page_tree( $pages );
		_e('<h3>Page Tree - $page->get_page_tree( $pages )</h3>');
		//clean_out( $page_tree );
		
		$page_array = $page->get_page_children( 0, $pages, 0 );
		_e('<h3>Page Array - $page->get_page_children( 0, $pages, 0 )</h3>');
		//clean_out( $page_array );
		
		$page_object = (object)$page_array;
		
		$get_page_level = $page->get_page_level( $page_object, 'portfolio/design/' );
		//_e('<h3>Page Array - $page->get_page_level( $page_object, \'portfolio/design/print/\' )</h3>');
		//clean_out( $get_page_level );
		
		$get_page_by_level = $page->get_page_by_level( $page_object, $get_page_level );
		_e('<h3>Page Array - $page->get_page_by_level( $page_object, $get_page_level )</h3>');
		clean_out( $get_page_by_level );
		
		
		$get_home = $page->get_home( );
		
		$get_flat_page_hierarchy = $page->get_flat_page_hierarchy( $pages );
		
		$get_descendant_ids = $page->get_descendant_ids( 3 );
		
		$page_children = $page->get_page_children( 0, $pages );
	
		// Generate the HTML output.
		//nav_generate ( (array)$page_array, $args );

	}
	
	
	//http://stackoverflow.com/questions/4843945/php-tree-structure-for-categories-and-sub-categories-without-looping-a-query
	public function tree()
	{
	
		$items = array(
		    (object) array('id' => 1,  'parent' => 0, 'alias' => 'alias', 'title' => 'Category A'),
		    (object) array('id' => 2,  'parent' => 0, 'alias' => 'alias', 'title' => 'Category B'),
		    (object) array('id' => 4,  'parent' => 0, 'alias' => 'alias', 'title' => 'Category C'),
		    (object) array('id' => 6,  'parent' => 2, 'alias' => 'alias', 'title' => 'Subcategory D'),
		    (object) array('id' => 7,  'parent' => 2, 'alias' => 'alias', 'title' => 'Subcategory E'),
		    (object) array('id' => 9,  'parent' => 4, 'alias' => 'alias', 'title' => 'Subcategory F'),
		    (object) array('id' => 10, 'parent' => 9, 'alias' => 'alias', 'title' => 'Subcategory G'),
		);
		
		function build_tree_object ( $items ) {
			$childs = array();

			foreach($items as $item)
			    $childs[$item->parent][] = $item;

			foreach($items as $item) if (isset($childs[$item->id]))
			    $item->childs = $childs[$item->id];

			$tree = $childs[0];
			
			return $tree;
		}
		
		$object_tree = build_tree_object( $items );

		
		// http://www.sitepoint.com/forums/showthread.php?448787-Creating-an-Unordered-List-from-The-Adjacency-List-Model
		function build_menu($currentPageId, $menuItems, $output = '')
		    {
		        // Loop through menu items
		        if(count($menuItems) > 0)
		        {
		            $output .= "\n<ul>\n";
		            foreach($menuItems as $item)
		            {
		                $pageId = !empty($item->alias) ? $item->alias : 'page/view/' . $item->id;
		                $current = ($item->id == $currentPageId) ? ' class="active"' : '';
		                $output .= "  <!-- <li> --><a href=\"" . $pageId . "\" title=\"" . $item->title . "\" " . $current . ">" . $item->title . "</a>";
		                // Child menu
		                if(isset($item->childs))
		                {
		                    // Recursive function call
		                    $thisFunction = __FUNCTION__;
		                    $output = $thisFunction($currentPageId, $item->childs, $output);
		                }
		                $output .= "  </li>\n";
		            }
		            //$output .= "  <li><a href=\"#\" class=\"end\"></a></li>\n";
		            $output .= "</ul>\n";
		        } else {
		            $output = "&nbsp;";
		        }

		        return $output;
		    }

		echo build_menu(1, $object_tree);
		
	}
	
	public function dbug_test()
	{
        function test() {
            throw new Exception;
        }

        try {
            test();
        } catch(Exception $e) {
            echo 'getMessage</br><pre>';
            echo $e->getMessage();

            echo '</pre></br>getCode</br><pre>';
            echo $e->getCode();

            echo '</pre></br>getFile</br><pre>';
            echo $e->getFile();

            echo '</pre></br>getLine</br><pre>';
            echo $e->getLine();

            echo '</pre></br>getPrevious</br><pre>';
            echo $e->getPrevious();

            echo '</pre></br>getTraceAsString</br><pre>';
            echo $e->getTraceAsString();

            echo '</pre></br>getTrace</br><pre>';
            print_r($e->getTrace() );

            echo '</pre>';
        }
	}
	
	public function chyrp_import()
	{	
		load::library('import');
	}

	public function tumblr_import()
	{	
		load::library('import');
	}
	
	public function textpattern_import()
	{	
		load::library('import');
	}
	
	public function movabletype_import()
	{	
		load::library('import');
	}
	
	public function wordpress_import()
	{	
		/*
		Post this with JSON.
		
		$data = array("name" => "Hagrid", "age" => "36");                                                                    
		$data_string = json_encode($data);                                                                                   

		$ch = curl_init('http://api.local/rest/users');                                                                      
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		    'Content-Type: application/json',                                                                                
		    'Content-Length: ' . strlen($data_string))                                                                       
		);                                                                                                                   

		$result = curl_exec($ch);
		*/
		
		
		//load::helper('import');

		$wordpress_xml = file_get_contents(TEMP.'tentaclecms.wordpress.2012-11-26.xml');
		
		$xml = new SimpleXmlElement($wordpress_xml);
		if (!$xml or !substr_count($xml->channel->generator, "wordpress.org"))
		    echo 'Invalid Wordpress XML';
		
		foreach ($xml->channel->item as $entry){

			echo $entry->title.'<br>'; 			// Posts title
			echo $entry->link.'<br>';			// URI to post
			echo $entry->pubDate.'<br>';		// Date
			//echo $entry->description.'<br>';	// NA
			
			$namespaces = $entry->getNamespaces(true);
			
			$dc = $entry->children($namespaces['dc']); 
			$content = $entry->children($namespaces['content']); 
			$excerpt = $entry->children($namespaces['excerpt']); 
			$wp = $entry->children($namespaces['wp']); 
			
			echo $dc->creator.'<br>';           // Authors name
			echo $content->encoded.'<br>';      // the post or pages content
			//echo $excerpt->encoded.'<br>';    // the post or pages excerpt
			echo $wp->post_id.'<br>';           // The post ID, try to keep this if possible
			echo $wp->post_date.'<br>';         // Date
			//echo $wp->post_date_gmt.'<br>';   // NA
			echo $wp->comment_status.'<br>';    // open or closed
			echo $wp->ping_status.'<br>'; 		// open or closed
			echo $wp->post_name.'<br>'; 		// the slug
			echo $wp->status.'<br>'; 			// published, draft, trash
			echo $wp->post_parent.'<br>'; 		// The ID that an attachment might belloing to or a post.
			echo $wp->menu_order.'<br>';        // Apply to pages
			echo $wp->post_type.'<br>';         // attachemnt, page, or post
			//echo $wp->post_password.'<br>';   // NA
			//echo $wp->is_sticky.'<br>';       // NA
			echo $wp->attachment_url.'<br>';    // Path to the image ( download these and place them in the storage folder )
			
			echo '<hr />';
		}
		
	}
	
	
	public function serverstats()
	{
		load::helper('serverstats');
		build_server_stats(0, '', 'utf8');
	}


    public function http_test_two()
    {
       load::library('httpclient','http');

		set_time_limit(0);
		$http=new http_class;

		/* Connection timeout */
		$http->timeout=0;

		/* Data transfer timeout */
		$http->data_timeout=0;

		/* Output debugging information about the progress of the connection */
		$http->debug=1;

		/* Format dubug output to display with HTML pages */
		$http->html_debug=1;


		/*
		 *  Need to emulate a certain browser user agent?
		 *  Set the user agent this way:
		 */
		$http->user_agent="Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";

		/*
		 *  If you want to the class to follow the URL of redirect responses
		 *  set this variable to 1.
		 */
		$http->follow_redirect=1;

		/*
		 *  How many consecutive redirected requests the class should follow.
		 */
		$http->redirection_limit=5;

		/*
		 *  If your DNS always resolves non-existing domains to a default IP
		 *  address to force the redirection to a given page, specify the
		 *  default IP address in this variable to make the class handle it
		 *  as when domain resolution fails.
		 */
		$http->exclude_address="";

		/*
		 *  If you want to establish SSL connections and you do not want the
		 *  class to use the CURL library, set this variable to 0 .
		 */
		$http->prefer_curl=0;

		/*
		 *  If basic authentication is required, specify the user name and
		 *  password in these variables.
		 */

		$user="";
		$password="";
		$realm="";       /* Authentication realm or domain      */
		$workstation=""; /* Workstation for NTLM authentication */
		$authentication=(strlen($user) ? UrlEncode($user).":".UrlEncode($password)."@" : "");

	/*
		Do you want to access a page via SSL?
		Just specify the https:// URL.
		$url="https://www.openssl.org/";
	*/

		$url="http://api.tentaclecms.com/get/core/";

		/*
		 *  Generate a list of arguments for opening a connection and make an
		 *  HTTP request from a given URL.
		 */
		$error=$http->GetRequestArguments($url,$arguments);

		if(strlen($realm))
			$arguments["AuthRealm"]=$realm;

		if(strlen($workstation))
			$arguments["AuthWorkstation"]=$workstation;

		$http->authentication_mechanism=""; // force a given authentication mechanism;

		/* Set additional request headers */
		$arguments["Headers"]["Pragma"]="nocache";
	/*
		Is it necessary to specify a certificate to access a page via SSL?
		Specify the certificate file this way.
		$arguments["SSLCertificateFile"]="my_certificate_file.pem";
		$arguments["SSLCertificatePassword"]="some certificate password";
	*/

	/*
		Is it necessary to preset some cookies?
		Just use the SetCookie function to set each cookie this way:

		$cookie_name="LAST_LANG";
		$cookie_value="de";
		$cookie_expires="2010-01-01 00:00:00"; // "" for session cookies
		$cookie_uri_path="/";
		$cookie_domain=".php.net";
		$cookie_secure=0; // 1 for SSL only cookies
		$http->SetCookie($cookie_name, $cookie_value, $cookie_expiry, $cookie_uri_path, $cookie_domain, $cookie_secure);
	*/


		echo "<LI><H2>Opening connection to:</H2>\n<P><TT>",HtmlSpecialChars($arguments["HostName"]),"</TT></P>\n";
		flush();
		$error=$http->Open($arguments);
		echo "</LI>\n";

		if($error=="")
		{
			echo "<LI><H2>Sending request for page:</H2>\n<P><TT>";
			echo HtmlSpecialChars($arguments["RequestURI"]),"\n";
			if(strlen($user))
				echo "\nLogin:    ",$user,"\nPassword: ",str_repeat("*",strlen($password));
			echo "</TT></P>\n";
			flush();
			$error=$http->SendRequest($arguments);
			echo "</LI>\n";

			if($error=="")
			{
				echo "<LI><H2>Request:</H2>\n<PRE>\n".HtmlSpecialChars($http->request)."</PRE></LI>\n";
				echo "<LI><H2>Request headers:</H2>\n<PRE>\n";
				for(Reset($http->request_headers),$header=0;$header<count($http->request_headers);Next($http->request_headers),$header++)
				{
					$header_name=Key($http->request_headers);
					if(GetType($http->request_headers[$header_name])=="array")
					{
						for($header_value=0;$header_value<count($http->request_headers[$header_name]);$header_value++)
							echo $header_name.": ".$http->request_headers[$header_name][$header_value],"\r\n";
					}
					else
						echo $header_name.": ".$http->request_headers[$header_name],"\r\n";
				}
				echo "</PRE>\n";
				flush();

				$headers=array();
				$error=$http->ReadReplyHeaders($headers);
				echo "</LI>\n";
				if($error=="")
				{
					echo "<LI><H2>Response status code:</H2>\n<P>".$http->response_status;
					switch($http->response_status)
					{
						case "301":
						case "302":
						case "303":
						case "307":
							echo " (redirect to <TT>".$headers["location"]."</TT>)<BR>\nSet the <TT>follow_redirect</TT> variable to handle redirect responses automatically.";
							break;
					}
					echo "</P></LI>\n";
					echo "<LI><H2>Response headers:</H2>\n<PRE>\n";
					for(Reset($headers),$header=0;$header<count($headers);Next($headers),$header++)
					{
						$header_name=Key($headers);
						if(GetType($headers[$header_name])=="array")
						{
							for($header_value=0;$header_value<count($headers[$header_name]);$header_value++)
								echo $header_name.": ".$headers[$header_name][$header_value],"\r\n";
						}
						else
							echo $header_name.": ".$headers[$header_name],"\r\n";
					}
					echo "</PRE></LI>\n";
					flush();

					echo "<LI><H2>Response body:</H2>\n<PRE>\n";

					/*
						You can read the whole reply body at once or
						block by block to not exceed PHP memory limits.
					*/

					/*
					$error = $http->ReadWholeReplyBody($body);
					if(strlen($error) == 0)
						echo HtmlSpecialChars($body);
					*/

					for(;;)
					{
						$error=$http->ReadReplyBody($body,1000);
						if($error!=""
						|| strlen($body)==0)
							break;
						echo HtmlSpecialChars($body);
					}

					echo "</PRE></LI>\n";
					flush();
				}
			}
			$http->Close();
		}
		if(strlen($error))
			echo "<H2 align=\"center\">Error: ",$error,"</H2>\n";
    }
	
	public function http_test()
    {
		load::library('Snoopy','Snoopy.class');

        $snoopy = new Snoopy;

// need an proxy?:
//$snoopy->proxy_host = "my.proxy.host";
//$snoopy->proxy_port = "8080";

// set browser and referer:
        $snoopy->agent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";
        $snoopy->referer = "http://www.adampatterson.ca/";

// set some cookies:
        $snoopy->cookies["SessionID"] = '238472834723489';
        $snoopy->cookies["favoriteColor"] = "blue";

// set an raw-header:
        $snoopy->rawheaders["Pragma"] = "no-cache";

// set some internal variables:
        $snoopy->maxredirs = 2;
        $snoopy->offsiteok = false;
        $snoopy->expandlinks = false;

// set username and password (optional)
//$snoopy->user = "joe";
//$snoopy->pass = "bloe";

// fetch the text of the website www.google.com:
        if($snoopy->fetch("http://api.tentaclecms.com/get/core/")){
            // other methods: fetch, fetchform, fetchlinks, submittext and submitlinks

            // response code:
            //print "response code: ".$snoopy->response_code."<br/>\n";

            // print the headers:

            // print "<b>Headers:</b><br/>";
            //            while(list($key,$val) = each($snoopy->headers)){
            //                print $key.": ".$val."<br/>\n";
            //            }
            // 
            //            print "<br/>\n";

            // print the texts of the website:
            print "<pre>".htmlspecialchars($snoopy->results)."</pre>\n";

        }
        else {
            print "Snoopy: error while fetching document: ".$snoopy->error."\n";
        }
	}
}