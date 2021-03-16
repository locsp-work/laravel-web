
  <?php
  require 'C:\xampp\htdocs\weblaravel\resources\views\login\fb-callback.php';
  $fb = new \Facebook\Facebook([
    'app_id' => env('FACEBOOK_APP_ID'),
    'app_secret' => env('FACEBOOK_APP_SECRET'),
    'default_graph_version' => 'v7.0',

  ]);
  var_dump($_SESSION['fb_access_token']);
    $fb->setDefaultAccessToken($_SESSION['fb_access_token']);
  // try {
  //   $fbToken = isset($_SESSION['fb_access_token']) ? $_SESSION['fb_access_token'] : NULL;
  //   if ($fbToken !== NULL) {
  //       $accessToken = (string)$fbToken;
  //   } else {
  //       $helper = $fb->getJavaScriptHelper();
  //       $accessToken = $helper->getAccessToken();
  //   }
  //   } catch(\Facebook\FacebookRequestException $ex) {
  //       echo 'error'. 'Facebook e1 :' . $ex->getCode();
  //       echo 'error'. 'Facebook e1 :' . $ex->getMessage();
  //   } catch(\Exception $ex) {
  //       echo 'error'. 'Facebook e2 :' . $ex->getCode();
  //       echo 'error'. 'Facebook e2 :' . $ex->getMessage();
  //   }

  // if (isset($accessToken)) {
  //     // $longLivedAccessToken = $accessToken->extend();
  //     $_SESSION['fb_access_token'] = (string) $accessToken;
  //     $fb->setDefaultAccessToken($accessToken);
  // } else {
  //     return FALSE;
  // }
  try {
    $resUser = $fb->get('/me?fields=id,name,picture');
  } catch(Facebook\Exception\ResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
  } catch(Facebook\Exception\SDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }
  $nodeUser = $resUser->getGraphObject();
  $user=$nodeUser['name'];
  try {
    $resPage = $fb->get('/me/accounts?fields=name,id,category,location,picture.width(120)');
  } catch(Facebook\Exception\ResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
  } catch(Facebook\Exception\SDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }
  $nodePage=$resPage->getGraphEdge();
  if(isset($_GET['page'])){
    $pageId=$_GET['page'];
    $resFeed= $fb->get("/".$pageId."/feed?fields=id,attachments,message,comments,picture,shares,is_published,story");
    $nodeFeed=$resFeed->getGraphEdge();
  }
  if(isset($_GET['PostId'])){
    $postId=$_GET['PostId'];
    $resPost= $fb->get("/".$postId."?fields=attachments,message,picture.width(200),is_published,story");
    $nodePost=$resPost->getGraphObject();
  }
  
  if(isset($_POST['Edit'])){  
    var_dump($_POST['message']);
    $res = $fb->post( '/'.$PostId, array(
      'message' => html_entity_decode($_POST['message'])
    ));
    $post = $res->getGraphObject();
    var_dump( $post );
    header('Location: {{route("/feedInfo")}}');
  } 

  // =========================
  if(isset($_POST['Add'])){
    $LongLiveUserAccessToken = $fb->get('/oauth/access_token?grant_type=fb_exchange_token&client_id='.env("FACEBOOK_APP_ID").'&client_secret='.env("FACEBOOK_APP_SECRET").'&fb_exchange_token='.$_SESSION['fb_access_token']);
    $nodeLongLiveUserAccessToken=$LongLiveUserAccessToken->getGraphObject();
    $PageAccessToken = $fb->get('/'.$_POST['postToPage'].'?fields=access_token');
    $nodePageAccessToken=$PageAccessToken->getGraphObject();
    var_dump($nodePageAccessToken->getProperty('access_token'));
    function uploadPhoto($photoPath){
      $photoIdArray = array();
      foreach($photoPath as $photoUrl){
        $paramas=array(
          'source' => $fb->fileToUpload($photoUrl),
          'published' => false
      );
      try {
        $resPost = $this->$fb->post('/'.$_POST['postToPage'].'/photos',$paramas,$nodePageAccessToken->getProperty('access_token'));
        $photoId = $resPost->getDecodedBody();
        if(!empty($photoId["id"])) {
          $photoIdArray[] = $photoId["id"];
        }
      } catch(Facebook\Exceptions\FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
      } catch(Facebook\Exceptions\FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
      }
      }
      return $photoIdArray;
    }
    $params = array( "message" => $_POST['messagePost'] );
    $photoIdArray=uploadPhoto($_FILES['file_upload']['tmp_name']);
    foreach($photoIdArray as $k => $photoId) {
        $params["attached_media"][$k] = '{"media_fbid":"' . $photoId . '"}';
    }
    try {
        $postResponse = $this->fb->post('/'.$_POST['postToPage'].'/photos',$params,$nodePageAccessToken->getProperty('access_token'));
    } catch (FacebookResponseException $e) {
        // display error message
        print $e->getMessage();
        exit();
    } catch (FacebookSDKException $e) {
        print $e->getMessage();
        exit();
    }

    // --------------------------------------------------------------------
    
  // function uploadFiles($uploadedFiles) {
  //   $files = array();
  //   $errors = array();
  //   foreach ($uploadedFiles as $key => $values) {
  //       foreach ($values as $index => $value) {
  //           $files[$index][$key] = $value;
  //       }
  //   }
  //   $uploadPath = "uploads/" . date('d-m-Y', time());
  //   if (!is_dir($uploadPath)) {
  //       mkdir($uploadPath, 0777, true);
  //   }
  //   foreach ($files as $file) {
  //       $file = validateUploadFile($file, $uploadPath);
  //       if ($file != false) {
  //           move_uploaded_file($file["tmp_name"], $uploadPath . '/' . $file["name"]);
  //           array_push($errors,$uploadPath . '/' . $file["name"]);
  //       } else {
  //           $errors[] = "The file " . basename($file["name"]) . " isn't valid.";
  //       }
  //   }
  //   return $errors;
  // }

  function validateUploadFile($file, $uploadPath) {
      //Kiểm tra xem có vượt quá dung lượng cho phép không?
      if ($file['size'] > 2 * 1024 * 1024) { //max upload is 2 Mb = 2 * 1024 kb * 1024 bite
          return false;
      }
      //Kiểm tra xem kiểu file có hợp lệ không?
      $validTypes = array("jpg", "jpeg", "png", "bmp","xls","xlsx","doc","docx");
      $fileType = substr($file['name'], strrpos($file['name'], ".") + 1);
      if (!in_array($fileType, $validTypes)) {
          return false;
      }
      //Check xem file đã tồn tại chưa? Nếu tồn tại thì đổi tên
      $num = 1;
      $fileName = substr($file['name'], 0, strrpos($file['name'], "."));
      while (file_exists($uploadPath . '/' . $fileName . '.' . $fileType)) {
          $fileName = $fileName . "(" . $num . ")";
          $num++;
      }
      $file['name'] = $fileName . '.' . $fileType;
      return $file;
  }
    // ------------------------
 
  } 
?>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<a href="javascript:fbLogoutUser();" class="btn btn-default btn-flat">Sign out</a>
<fb:login-button size="large" scope="public_profile,email,pages_show_list,pages_manage_posts,pages_read_engagement" onlogin="logInWithFacebook();"></fb:login-button>
<script>
  function statusChangeCallback(response) {  // Called with the results from FB.getLoginStatus().
    console.log('statusChangeCallback');
    console.log(response);                   // The current login status of the person.
    if (response.status === 'connected') { 
        $.get('{{route("handling")}}', function(resp){
          location.href="{{route('home')}}"
        });
    } else {                                 // Not logged into your webpage or we are unable to tell.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this webpage.';
    }
  }

  function checkLoginState() {               // Called when a person is finished with the Login Button.
    FB.getLoginStatus(function(response) {   // See the onlogin handler
      statusChangeCallback(response);
    });
  }

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

    logInWithFacebook = function() {
    FB.login(function(response) {
      if (response.authResponse) {
        $.get('{{route("handling")}}', function(resp){
        });
        location.href="{{route('home')}}"
      } else {
        alert('User cancelled login or did not fully authorize.');
      }
    });
    return false;
  };

  window.fbAsyncInit = function() {
    FB.init({
      appId      : '287506802477744',
      cookie     : true,  
      xfbml      : true,                   
      version    : 'v7.0'           
    });
  }; 
  function fbLogoutUser() {
    FB.getLoginStatus(function(response) {
        if (response && response.status === 'connected') {
            FB.logout(function(response) {
              var allCookies = document.cookie.split(';'); 
              for (var i = 0; i < allCookies.length; i++) 
                  document.cookie = allCookies[i] + "=;expires=" 
                  + new Date(0).toUTCString(); 
              document.location.reload();
            });
        }
    });
  }
</script>
<script src="{{asset('AdminLTE/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
</body>
</html> -->
