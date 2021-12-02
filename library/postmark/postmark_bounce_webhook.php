<?php
/**
 * Handles bounced emails from SendGrid. Relays bounced email addresses to the Reply-to address
 * specifiled in settings for SKF theme. 
 * API Endpoint https://konstforeningar.se/sendgrid/bounce (POST)
 * @author Bébé Jane
*/

require_once(__DIR__ . '/autoload.php');
use Postmark\PostmarkClient;


add_action( 'rest_api_init', function () {
  register_rest_route( 'postmark', '/bounce', array(
    'methods' => 'POST',
    'callback' => 'bounced_email_webhook'
  ));
});

function bounced_email_webhook(){

	$entityBody = file_get_contents('php://input');
	$payload = json_decode($entityBody, true);
	$data = get_by_postmark_id($payload['MessageID']);
	if($data and $payload){
		send_bounced_email($data, $payload['Email']);
		return wp_send_json(array(
			'success' => true,
			'reply-to' => $data['reply_to'],
			'pm_message_id' => $payload['MessageID'],
			'error_email' => $payload['Email']
		));
		debug('success sending bounce to ' . $data['reply_to']);
	} else {
		debug('data or payload empty!');
		debug($data);
		debug($payload);
		wp_send_json( array('success' => false), 200 );
	}	
}

function get_by_postmark_id($pm_message_id){
	$data = null;

	if(!function_exists('get_sites')){
		return get_post_and_reply_to($pm_message_id);
	}
	
	$subsites = get_sites(array(
		'order_by' => 'last_updated',
		'order'  => 'DESC',
		'number' => 10000,
	));
	
	foreach( $subsites as $subsite ) {
		$subsite_id = get_object_vars($subsite)["blog_id"];
		switch_to_blog($subsite_id);
		$data = get_post_and_reply_to($pm_message_id);
		if($data != null){
			return $data;
		}
	}
	return $data;
}

function get_post_and_reply_to($pm_message_id){

	$from_name = 'Sveriges Konstföreningar';

	$posts = get_posts(array(
		'post_type' => 'newsletter',
		'meta_query' => array(
			array(
				'key' => 'pm_message_id',
				'value' => $pm_message_id,
			)
		)
	));
	
	if( $posts ) {
		if(function_exists('get_blog_details')){
    	$blog = get_blog_details();
			$from_name = $blog->blogname;
		}
		$reply_to = get_field('newsletter_reply_to','option');
		return  array('post' => $posts[0], 'reply_to' => $reply_to, 'from_name' => $from_name);
	}
	return null;
}


function send_bounced_email($data, $error_email){

	$reply_to = $data['reply_to'];
	$from_name = $data['from_name'];
	$post = $data['post'];

	$text = 'Det uppstod ett fel med utskicket: ' . $post->post_title . '.\n\nDet gick inte att leverera meddelandet till följande adress:  ' . $error_email .'';
	$html = '<p>Det uppstod ett fel med utskicket: <b>' . $post->post_title . '</b></p><p>Det gick inte att leverera meddelandet till följande adress:  <b>' . $error_email . '</b></p>';

	$client = new PostmarkClient(POSTMARK_API_KEY);
	$error_message = null;		
	try {
		$response = $client->sendEmail(POSTMARK_EMAIL, $reply_to, 'Utskick: Ogliltig e-postadress', $html, $text, null, true, $reply_to);
		debug($response);
	} catch (Exception $e) {
		$error_message = $e->getMessage();
	}

	if($error_message){
		debug('ERROR sending email');
		debug($error_message);
		return false;
	} else {
		debug('Bounce email sent to ' . $reply_to . ', error email=' . $error_email);
		return true;
	}
}

?>