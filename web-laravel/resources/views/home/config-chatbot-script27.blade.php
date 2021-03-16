@extends('layouts.main20')
@section('section')
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Config-bot
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">config-bot</li>
      </ol>
    </section>
    <section class="content">
      <!-- row -->
      <div class="row">
        <div class="col-md-12">
          <ul class="nav nav-tabs" style="padding-left: 20px">
            <li class="active" id=""><a href="#text" role="tab" data-toggle="tab"><h4 class="reviews text-capitalize">Text</h4></a></li>
            <li id=""><a href="#quick-reply" role="tab" data-toggle="tab"><h4 class="reviews text-capitalize">Quick reply</h4></a></li>
            <li id=""><a href="#image" role="tab" data-toggle="tab"><h4 class="reviews text-capitalize">Image</h4></a></li>
            <li id=""><a href="#generic" role="tab" data-toggle="tab"><h4 class="reviews text-capitalize">Generic</h4></a></li>
          </ul>
          <div id='alertStatus'></div>
          <div class="tab-content">
            <div class="tab-pane fade in active" id="text" style="margin: 40px"> 
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Text Config</h3>
                </div>       
                <div class="box-body">
                  <form id="config-chatbot-form" action="{{route('chatbot')}}" method="post" autocomplete="off">
                    @csrf
                   
                    <input type="text" name="type" value='text' style="display: none">
                    <div class="form-group">
                      <label for="textConfig">
                        <input type="text" class="form-control" placeholder='Ý định' name="textConfig">
                      </label>
                    </div> 
                     <div class="form-group">
                      <label for="textConfigAs">
                        <input type="text" class="form-control" placeholder='Câu trả lời' name="textConfigAs">
                      </label>
                    </div>
                    <input type="submit" name="submitTextCf" class="btn btn-primary"></input> 
                  </form>
                </div>
              </div>
            </div>
            <div class="tab-pane fade in" id="quick-reply" style="margin: 40px"> 
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Quick-reply</h3>
                </div>       
                <div class="box-body">
                  <form method="post" enctype="multipart/form-data">
                    @csrf
                   
                    <input type="text" name="type" value='quick-reply' style="display: none">
                    <div class="form-group">
                      <label for="qrConfig">
                        <input type="text" class="form-control" placeholder='Ý định' name="qrConfig">
                      </label>
                    </div> 
                    <div class="form-group">
                      <label for="qrMsgConfig">
                        <input type="text" class="form-control" placeholder='Tiêu đề' name="qrMsgConfig">
                      </label>
                    </div>
                     <div class="form-group">
                      <label for="qrConfigAs">
                        <input type="text" class="form-control" placeholder='Quick reply, Mỗi reply cách nhau bởi dấu phẩy' name="qrConfigAs">
                      </label>
                    </div>
                    <input type="submit" name="submitQRCf" class="btn btn-primary"></input> 
                  </form>
                </div>
              </div>
            </div>
            <div class="tab-pane fade in " id="image" style="margin: 40px"> 
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Image Config</h3>
                </div>       
                <div class="box-body">
                  <form method="post" enctype="multipart/form-data">
                    @csrf
                  
                    <input type="text" name="type" value='image' style="display: none">
                    <div class="form-group">
                      <label for="imageConfig">
                        <input type="text" class="form-control" placeholder='Ý định' name="imageConfig">
                      </label>
                    </div> 
                     <div class="form-group">
                      <label for="imageConfigAs">
                        <input type="text" class="form-control" placeholder='Link ảnh, Mỗi link cách nhau bởi dấu phẩy' name="imageConfigAs">
                      </label>
                    </div>
                    <input type="submit" name="submitImgCf" class="btn btn-primary"></input> 
                  </form>
                </div>
              </div>
            </div>
            <div class="tab-pane fade in" id="generic" style="margin: 40px"> 
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Generic Config</h3>
                </div>       
                <div class="box-body">
                  <form  method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="type" value='generic' style="display: none">
                    <div class="form-group">
                      <label for="genericConfig">
                        <input type="text" class="form-control" placeholder='Ý định' name="genericConfig">
                      </label>
                    </div> 
                     <div class="form-group">
                      <label for="genericConfigAs">
                        <input type="text" class="form-control" placeholder='Quick reply, Mỗi reply cách nhau bởi dấu phẩy' name="genericConfigAs">
                      </label>
                    </div>
                    <input type="submit" name="submitgenericCf" class="btn btn-primary"></input> 
                  </form>
                </div>
              </div>
            </div>
          </div>               
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
</div>
@stop()