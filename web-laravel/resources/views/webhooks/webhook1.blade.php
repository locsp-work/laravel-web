<?php
if (isset($_GET['hub_verify_token'])&& isset($_GET['hub_mode'])) {
        if ($_GET['hub_verify_token'] == 'my_verify_token')
          echo '<script>alert("'.$_GET['hub_challenge'].'")</script>';
      }else{
      $access_token="EAAtzSw5bU1wBACobodXOkY3UliTm55TAncJHjt0Yq1RzZBbu8J7JTiV6ZCg3AylcjBnCzmG9VDq7BtJBGCRRwpjf9H2I7ZAd0lc3PF58leDfZAdO7s1Fz3SKj9T27xum5iJhWHbwGDlNBHE1shu3Qrn9gxjFEbvwVzEVUfgNvAZDZD";
      // $_POST = json_decode(file_get_contents('php://input'));
      // $id=$input['entry'][0]['messaging'][0]['sender']['id'];
      // $message=$input['entry'][0]['messaging'][0]['message']['text'];
      // $response=[
      //   'recipient' => ['id'=> $id],
      //   'message' => ['text'=>'hello word']
      // ];      
      // $this->send_message($response);
  //      $config = [
   //        'facebook' => [
   //            'token' => env('FACEBOOK_TOKEN'),
   //            'app_secret' => env('FACEBOOK_APP_SECRET'),
   //            'verification'=>env('FACEBOOK_VERIFICATION'),
   //        ],
   //     'botman' => [
    //      'facebook_token' => 'EAAtzSw5bU1wBACobodXOkY3UliTm55TAncJHjt0Yq1RzZBbu8J7JTiV6ZCg3AylcjBnCzmG9VDq7BtJBGCRRwpjf9H2I7ZAd0lc3PF58leDfZAdO7s1Fz3SKj9T27xum5iJhWHbwGDlNBHE1shu3Qrn9gxjFEbvwVzEVUfgNvAZDZD',
    //      'facebook_app_secret' => env('FACEBOOK_APP_SECRET'),
    //  ]
  //    ];
  //    DriverManager::loadDriver(\BotMan\Drivers\Facebook\FacebookDriver::class);
    // $botman = BotManFactory::create($config);
    // $botman->hears('hi', function (BotMan $bot) {
    //     $bot->reply('Hello yourself.');
    // });
    // $botman->listen();
      }