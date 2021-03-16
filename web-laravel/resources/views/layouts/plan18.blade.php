<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="https://loc1.thuctapoptimus.xyz/public/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css?v=<?php echo(strtotime('now'))?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://loc1.thuctapoptimus.xyz/public/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css?v=<?php echo(strtotime('now')) ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://loc1.thuctapoptimus.xyz/public/AdminLTE/bower_components/Ionicons/css/ionicons.min.css?v=<?php echo(strtotime('now')) ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="https://loc1.thuctapoptimus.xyz/public/AdminLTE/dist/css/AdminLTE.min.css?v=<?php echo(strtotime('now'))?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="https://loc1.thuctapoptimus.xyz/public/AdminLTE/dist/css/skins/_all-skins.min.css?v=<?php echo(strtotime('now'))?>">
    <!-- DataTables -->
  <link rel="stylesheet" href="https://loc1.thuctapoptimus.xyz/public/AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css?v=<?php echo(strtotime('now'))?>">
  <link rel="stylesheet" href="https://loc1.thuctapoptimus.xyz/public/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css?v=".<?php echo(strtotime('now'))?>>
  <link rel="stylesheet" href="https://loc1.thuctapoptimus.xyz/public/AdminLTE/dist/css/chat.css?v=<?php echo(strtotime('now'))?>">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css'>
  <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.2/css/font-awesome.min.css'>
  <link rel="stylesheet" href="https://loc1.thuctapoptimus.xyz/public/AdminLTE/dist/css/dropdown.css?v=<?php echo(strtotime('now'))?>">
  <link rel="stylesheet" href="https://loc1.thuctapoptimus.xyz/public/AdminLTE/plugins/imageViewer/images-grid.css?v=<?php echo(strtotime('now'))?>">
  <link rel="stylesheet" href="https://loc1.thuctapoptimus.xyz/public/AdminLTE/plugins/justified-image-lightbox-gallery/jquery.flex-photo-gallery.css?v=<?php echo(strtotime('now'))?>">
</head>
<body class="hold-transition skin-blue sidebar-mini">
@yield('body')
<!-- jQuery 3 -->
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script src="https://loc1.thuctapoptimus.xyz/public/AdminLTE/bower_components/jquery/dist/jquery.min.js?v=<?php echo(strtotime('now'))?>"></script>
<script src="{{asset('AdminLTE/dist/js/jquery-multi-select.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="https://loc1.thuctapoptimus.xyz/public/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js?v=<?php echo(strtotime('now'))?>"></script>
<script src="https://loc1.thuctapoptimus.xyz/public/AdminLTE/dist/js/adminlte.min.js?v=.<?php echo(strtotime('now'))?>"></script>
<!-- DataTables -->
<script src="https://loc1.thuctapoptimus.xyz/public/AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js?v=<?php echo(strtotime('now'))?>"></script>
<script src="https://loc1.thuctapoptimus.xyz/public/AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js?v=<?php echo(strtotime('now'))?>"></script>
<!-- page script -->
<script src="https://loc1.thuctapoptimus.xyz/public/AdminLTE/bower_components/ckeditor/ckeditor.js?v=<?php echo(strtotime('now'))?>"></script>
<script src="https://loc1.thuctapoptimus.xyz/public/AdminLTE/plugins/imageViewer/images-grid.js?v=<?php echo(strtotime('now'))?>"></script>
<script src="https://loc1.thuctapoptimus.xyz/public/AdminLTE/plugins/justified-image-lightbox-gallery/jquery.flex-photo-gallery.js?v=<?php echo(strtotime('now'))?>">
</script>
<!-- <script>
  $(function(){
    $('#pageToPost').multiSelect();
  });
</script> -->

<script>
  $(function () {
    $('#example1').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<!-- ====================================================================== -->
<script>
  $(function () {
    CKEDITOR.replace('message')
  })
</script>
<script>

$("#profile-img").click(function() {
  $("#status-options").toggleClass("active");
});

$(".expand-button").click(function() {
  $("#profile").toggleClass("expanded");
  $("#contacts").toggleClass("expanded");
});

$("#status-options ul li").click(function() {
  $("#profile-img").removeClass();
  $("#status-online").removeClass("active");
  $("#status-away").removeClass("active");
  $("#status-busy").removeClass("active");
  $("#status-offline").removeClass("active");
  $(this).addClass("active");
  
  if($("#status-online").hasClass("active")) {
    $("#profile-img").addClass("online");
  } else if ($("#status-away").hasClass("active")) {
    $("#profile-img").addClass("away");
  } else if ($("#status-busy").hasClass("active")) {
    $("#profile-img").addClass("busy");
  } else if ($("#status-offline").hasClass("active")) {
    $("#profile-img").addClass("offline");
  } else {
    $("#profile-img").removeClass();
  };  
  $("#status-options").removeClass("active");
});
var threadId='';
var pageId='';
var receiveId='';
$(document).ready(function(){

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
   Pusher.logToConsole = true;

  var pusher = new Pusher("{{env('PUSHER_APP_KEY')}}",{
    cluster: "{{env('PUSHER_APP_CLUSTER')}}"
  });

  var channel = pusher.subscribe('my-channel');
  channel.bind('my-event', function(data) {
    alert(JSON.stringify(data));
  });
  $('.contact').click(function(){
    $('.contact').removeClass('active');
    $(this).addClass('active');
    threadId=$(this).attr('data-id');
    pageId=$(this).attr('page-id');
    receiveId=$(this).attr('receiver-id');
    $.ajax({
      type: 'get',
      url:"messages/"+threadId+'/'+pageId,
      data:"",
      cache:false,
      success:function(data){
        $('#msgTabview').html(data);
        scrollToBottomFunc();
      }
    });
  });
  $(document).on('keyup','.message-input input',function(e){      
    var message=$(this).val();
    if(e.keyCode==13){    
      $('<li class="sent"><img src="http://emilcarlsson.se/assets/mikeross.png" alt="" /><p>' + message + '</p></li>').appendTo($('.messages ul'));
      $(this).val('');
      $('.contact.active .preview').html('<span>You: </span>' + message);
      var datastr='receiverId=' + receiveId + '&message=' + message + '&pageId=' + pageId;
      $.ajax({
        method:'post',
        url: "messages",
        data: datastr,
        cache:false,
        success:function(data){
          
        },
        error:function(jqXHR,status,err){

        },
        complete:function(){

        }

      });

    }
  });
  function scrollToBottomFunc(){
    $(".messages").animate({ scrollTop: $(document).height() }, "fast");
  }
});
</script>
<!-- ============================Comment===================================-->
<script>
$(document).on('keyup','.comment-input input',function(e){      
    var message=$(this).val();
    var post_commentId=$(this).attr('post_commentId');
    var postId=$(this).attr('postId');
    var pageToken=$(this).attr('pageToken');
    if(e.keyCode==13){    
      $(this).val('');
      var datastr='pageToken=' + pageToken + '&message=' + message + '&postId=' + postId + '&post_commentId=' + post_commentId;
      $.ajax({
        method:'post',
        url:"comments",
        data: datastr,
        cache:false,
        success:function(data){
          
        },
        error:function(jqXHR,status,err){

        },
        complete:function(){

        }
      });
    }
});
</script>
<script>
  $(document).ready(function() {
    $('#input_multifileSelect').on('change', function(){
      var ajax_option={
          url: 'addPost',
          beforeSubmit: function () {
              $("#SubmitPostFile").addClass("overlay");
              $("#SubmitPostFile").append('<i class="fa fa-refresh fa-spin"></i>');
          },
          contentType: false,
          processData: false,
          error: function (response, status, e) {
              alert('Oops something went.');
          },
          success:function(){
            $("#SubmitPostFile").remove();

          },        
          complete: function (xhr,data) {
              if (xhr.responseText && xhr.responseText != "error")
              {
                $("#div_uploadedImgs").html(xhr.responseText);
              }
              else{                              
                $('#div_uploadedImgs').html(data);
              }
          }
      };
      $('#form_uploadImg').ajaxSubmit(ajax_option);
    });
  });
</script>
<script>
  $("#submitTextCf").click(function(){
    var ajax_option={
        url:'store-config',
        success:function(data){
          $('#alertStatus').html(data);
        },        
    };
    $('#config-chatbot-form').ajaxSubmit(ajax_option);
  });
</script>
<script type="text/javascript">
  $(document).on('keyup',function(e){      
    if(e.keyCode==13){    
      var ajax_option={
        url:"addPost",
        contentType: false,
        processData: false,
        beforeSubmit: function () {
          $("#SubmitPostUrls").addClass("overlay");
          $("#SubmitPostUrls").append('<i class="fa fa-refresh fa-spin"></i>');
        },
        error: function (response, status, e) {
          alert('Oops something went.');
        },
        success:function(){
          $("#SubmitPostUrls").remove();
        },        
        complete: function (xhr,data) {
            if (xhr.responseText && xhr.responseText != "error")
            {
              $("#div_uploadedUrls").html(xhr.responseText);
            }
            else{  
              $("#file-upload-tab").removeClass("active");
              $("#url-upload-tab").addClass('active');
              $('#div_uploadedUrls').html(data);
            }
        }
      };
      $('#form_uploadUrl').ajaxSubmit(ajax_option);  
    }
});
</script>
<!-- ============================================================================ -->
<script type="text/javascript">
<?php 
  if(isset($statusData)){
    foreach ($statusData as $status) {
      if(isset($status['attachments']['data'][0]['subattachments'])){
        $str='';
        $urls=array();
        foreach ($status['attachments']['data'][0]['subattachments']['data'] as $value) {
          $urls[]=$value['media']['image']['src'];
        }
        $str=join("','",$urls);
        echo "$('#".$status['id']."').imagesGrid({
          images: [
            '".$str."'
          ],  
          align: true,
          cells: 3, 
          nextOnClick: true,
          getViewAllText: function(imgsCount){return 'View all'},
          onGridRendered: $.noop,
          onGridItemRendered: $.noop,
          onGridLoaded: $.noop,
          onGridImageLoaded: $.noop,
          onModalClose: $.noop,
          onModalImageClick: $.noop,
        });";
      }
      elseif(isset($status['attachments']['data'][0]['media'])){     
        echo "$('#".$status['id']."').imagesGrid({
          images: [
            '".$status['attachments']['data'][0]['media']['image']['src']."'
          ],  
          align: false,
          cells: 1,
          nextOnClick: true,
          showViewAll: 'more',
          getViewAllText: function() {},
          onGridRendered: $.noop,
          onGridItemRendered: $.noop,
          onGridLoaded: $.noop,
          onGridImageLoaded: $.noop,
          onModalClose: $.noop,
          onModalImageClick: $.noop,
        });";
      }
    }
  }
?>
</script>
<script type="text/javascript">
  var imageArray=[
    <?php 
      if(isset($albumData)){
            foreach ($albumData as $image) {
              if (isset($image['attachments']['data'][0]['subattachments'])) {
                foreach ($image['attachments']['data'][0]['subattachments']['data'] as $img) {
                  echo 
                    '{'.
                      'url:"'.$img['media']['image']['src'].
                      '",height:'.$img['media']['image']['height'].
                      ',width:'.$img['media']['image']['width'].
                    '},';
                }
              }elseif(isset($image['attachments']['data'][0]['media'])){
                  echo 
                    '{'.
                      'url:"'.$image['attachments']['data'][0]['media']['image']['src'].
                      '",height:'.$image['attachments']['data'][0]['media']['image']['height'].
                      ',width:'.$image['attachments']['data'][0]['media']['image']['width'].
                    '},';
              }
            }
      }
    ?>
  ];
  $(function(){
    $('#albumData').flexPhotoGallery({
      imageArray: imageArray
    });
  });
</script>
<script>
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

</body>
</html>
