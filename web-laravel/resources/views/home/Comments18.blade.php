@extends('layouts.main20')
@section('section')
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Comment
        <small>Control panel</small>
      </h1> 
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">        
        <div class="comment-tabs">
            <ul class="nav nav-tabs" role="tablist" style="padding-left: 20px">
                <li class="active"><a href="#comments-logout" role="tab" data-toggle="tab"><h4 class="reviews text-capitalize">Comments</h4></a></li>
                <li><a href="#add-comment" role="tab" data-toggle="tab"><h4 class="reviews text-capitalize">Add comment</h4></a></li>
            </ul>     
            <div id="cmtSuccess"></div>       
            <div class="tab-content">
                <div class="tab-pane active" id="comments-logout" style="margin: 40px">     
                  @if($node->getField('comments')!==null)
                    @foreach($node->getField('comments') as $key => $value)
                      <div class="direct-chat-msg">
                        <div class="direct-chat-info clearfix">
                          @if(isset($value['from']))
                            <span class="direct-chat-name pull-left">{{$value['from']['name']}}</span>
                          @endif
                          <span class="direct-chat-timestamp pull-right">{{date_format($value['created_time'],'d-m-Y H:i:s')}}</span>
                        </div>
                        <img class="direct-chat-img" src="https://s3.amazonaws.com/uifaces/faces/twitter/dancounsell/128.jpg" alt="profile">
                        <div class="direct-chat-text">
                          <div style="word-wrap: break-word;padding: 10px 0;">
                            <p>
                              {{$value['message']}}
                            </p>                       
                          </div>
                          <a data-toggle="collapse" href="#like" style="margin-right:10px ">Like</a>
                          <a data-toggle="collapse" href="#{{$value['id']}}">Comments</a>
                        </div>
                        <div class="direct-chat-info clearfix" style="margin: 10px 0 0 60px">
                          <a data-toggle="collapse" href="#{{$value['id']}}">Xem comment<span class="direct-chat-name pull-left"></span></a>            
                        </div>
                      </div>
                      <div class="collapse" id="{{$value['id']}}">
                        <form method="post" action="{{route('comments')}}" id="form-comment">
                          @csrf
                          <input type="text" name="reply" class="textarea" />
                          <input type="text" name="post_commentId" value="{{$value['id']}}" style="display: none" />
                          <span class="textarea" name="reply" role="textbox" contenteditable></span>
                          <button type="submit" name="replyCmt"><i class="fa fa-paper-plane " aria-hidden="true"></i></button>
                        </form>                    
                      </div> 
                      <div class="collapse" id="{{$value['id']}}">
                        <div class="direct-chat-msg" style="margin-left:60px">
                          <div class="direct-chat-info clearfix">
                            <span class="direct-chat-name pull-left">Name</span>
                            <span class="direct-chat-timestamp pull-right">Time</span>
                          </div>
                          <img class="direct-chat-img" src="https://s3.amazonaws.com/uifaces/faces/twitter/dancounsell/128.jpg" alt="profile">
                          <div class="direct-chat-text">
                            <div style="word-wrap: break-word;padding: 10px 0;">
                              <p>
                                fvfdgdfgdf
                              </p>                       
                            </div>
                            <a data-toggle="collapse" href="#replyOne" style="margin-right:10px ">Reply</a>
                            <a data-toggle="collapse" href="#replyOne">Comments</a>
                          </div>
                        </div>  
                      </div>
                    @endforeach                    
                  @endif                                   
                </div>
                <div class="tab-pane" id="add-comment">
                    <form action="#" method="post" class="form-horizontal" id="commentForm" role="form"> 
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Comment</label>
                            <div class="col-sm-10">
                              <textarea class="form-control" name="addComment" id="addComment" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="uploadMedia" class="col-sm-2 control-label">Upload media</label>
                            <div class="col-sm-10">                    
                                <div class="input-group">
                                  <div class="input-group-addon">http://</div>
                                  <input type="text" class="form-control" name="uploadMedia" id="uploadMedia">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">                    
                                <button class="btn btn-success btn-circle text-uppercase" type="submit" id="submitComment"><span class="glyphicon glyphicon-send"></span> Summit comment</button>
                            </div>
                        </div>            
                    </form>
                </div>
            </div>
        </div>
      </div>
    </section>
</div>
@stop()