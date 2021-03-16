
@extends('layouts.main20')
@section('section')
  <?php 
    $fb = new \Facebook\Facebook([
      'app_id' => env('FACEBOOK_APP_ID'),
      'app_secret' => env('FACEBOOK_APP_SECRET'),
      'default_graph_version' => 'v7.0',
    ]);
    if(isset($_GET['PostId'])){
      $postId=$_GET['PostId'];
      try{
        $resPost= $fb->get("/".$postId."?fields=attachments,message,picture.width(200),is_published,story",session('fb_access_token'));
      }catch(Facebook\Exception\ResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
      } catch(Facebook\Exception\SDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
      }
      $nodePost=$resPost->getGraphObject();
    }
    if(isset($_POST['submit'])){  
      $res = $fb->post( '/'.$_GET['PostId'], array(
        'message' =>$_POST['message']
      ),session('fb_access_token'));
      echo '<script>location.href="'.route("feedInfo").'"</script>';
    } 
  ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          <small>Advanced form element</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Forms</a></li>
          <li class="active">Editors</li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-4">
              @if($nodePost->getProperty('picture')!=null)
                <img src=<?php echo $nodePost->getProperty('picture') ?> alt=""/>
              @endif
          </div>
          <div class="col-md-8">
            <div class="box box-info">
              <div class="box-header">
                <h3 class="box-title">
                  <small>Edit post facebook</small>
                </h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                  <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
                    <i class="fa fa-minus"></i></button>
                  <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                    title="Remove">
                    <i class="fa fa-times"></i></button>
                </div>
                <!-- /. tools -->
              </div>
              <!-- /.box-header -->
              <div class="box-body pad">
                <form name="editForm" method="post">
                  @csrf
                  <textarea name="message" rows="10" cols="138">
                    @if(isset($nodePost))
                      <?php
                        if($nodePost->getProperty('message')!=null){
                          echo $nodePost->getProperty('message');
                        }else{
                          echo $nodePost->getProperty('story');
                        }
                      ?>
                    @endif
                  </textarea>
                  <button type="submit" name="submit" class="btn btn-primary">Edit status</button>
                </form>
              </div>
            </div>
          </div>
          <!-- /.col-->
        </div>
        <!-- ./row -->
      </section>
      <!-- /.content -->
    </div>
@stop()