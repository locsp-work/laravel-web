<?php
 
$fb = new \Facebook\Facebook([
  'app_id' => env('FACEBOOK_APP_ID'),
  'app_secret' => env('FACEBOOK_APP_SECRET'),
  'default_graph_version' => 'v7.0',
]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['public_profile,email,pages_show_list,pages_manage_posts,pages_read_engagement,pages_manage_metadata,pages_messaging,pages_messaging_subscriptions,read_page_mailboxes,user_posts,user_likes,user_status,user_friends']; // Optional permissions
$loginUrl = $helper->getLoginUrl('https://loc1.thuctapoptimus.xyz/public/fb-callback', $permissions);

echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
