@extends('layouts.main20')
@section('section')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1> 
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
    <section class="content">
      <div class="row"> 
          <ul class="nav nav-tabs" style="padding-left: 20px">
            <li class="active" id="tab-file-upload"><a href="#file-upload-tab" role="tab" data-toggle="tab"><h4 class="reviews text-capitalize">Đăng hình ảnh từ máy</h4></a></li>
            <li id="tab-excel-upload"><a href="#excel-upload-tab" role="tab" data-toggle="tab"><h4 class="reviews text-capitalize">Đăng bài theo mẫu Excel</h4></a></li>
            <li id="tab-url-upload"><a href="#url-upload-tab" role="tab" data-toggle="tab"><h4 class="reviews text-capitalize">URL</h4></a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane fade in active" id="file-upload-tab" style="margin: 40px"> 
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Thêm bài đăng hình ảnh từ máy</h3>
                </div>       
                <div class="box-body">                 
                  <div id="div_uploadedImgs"></div>
                  <form id="form_uploadImg" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group box-header">    
                      <label for="selectPage">Select page to post</label>
                      @foreach(json_decode($nodePage) as $value)
                        <input type="checkbox" name="postToPage[]" style="margin: 0px 0px 0 20px" value=<?php echo $value->id ?>>
                        <label for="postToPage">{{$value->name}}</label>
                      @endforeach
                    </div> 
                    <div class="form-group box-header">
                      <label for="filesToUpload">Chọn hình ảnh đăng</label>
                      <input name="filesToUpload[]" id="input_multifileSelect" type="file" multiple>
                    </div>
                  </form>                
                  <form method="post" action="{{route('addPost')}}" enctype="multipart/form-data">
                    @csrf                
                    <div class="form-group" >
                      <label for="status">Trạng thái</label>
                      <div class="box box-info">
                        <div id="SubmitPostFile"></div>
                        <div class="box-header">
                            <h3 class="box-title">
                                <small>Status facebook</small>
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
                        </div>
                        <div class="box-body pad">
                            <textarea name="messagePostFile" rows="10" style="resize:vertical;width: 100%"></textarea>
                        </div>
                      </div>
                      <input type="submit" name="submitAddPostFile">
                    </div>
                  </form>
                  
                </div>                
              </div>
            </div>
            <div class="tab-pane fade" id="excel-upload-tab"> 
              <div class="box">       
                <div class="box-body">
                  <div class="box-header with-border">
                    <h3 class="box-title">Thêm bài đăng theo mẫu Excel</h3>
                  </div>                 
                  <form method="post" action="{{route('addPost')}}" enctype="multipart/form-data" id="FormAdd">
                    @csrf
                    <div class="form-group box-header">    
                      <label for="selectPage">Select page to post</label>
                      @foreach(json_decode($nodePage) as $value)
                        <input type="checkbox" name="postToPage[]" style="margin: 0px 0px 0 20px" value=<?php echo $value->id ?>>
                        <label for="postToPage">{{$value->name}}</label>
                      @endforeach
                    </div> 
                    <div class="form-group box-header">    
                      <label for="select_file_Excel">Đăng bài theo form Excel</label>
                      <input type="file" name="select_file_Excel" id="select_file_Excel" style="width: 60%" onchange="javascript:this.form.submit();" />
                    </div> 
                  </form> 
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="url-upload-tab" style="margin: 40px"> 
              <div class="box"> 
                <div class="box-header with-border">
                  <h3 class="box-title">Thêm bài đăng hình ảnh từ URL</h3>
                </div>      
                <div class="box-body">                  
<!--                   <div id="div_uploadedUrls"></div>-->
                  <form id="form_uploadUrl" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group box-header">    
                      <label for="selectPage">Select page to post</label>
                      @foreach(json_decode($nodePage) as $value)
                        <input type="checkbox" name="postToPage[]" style="margin: 0px 0px 0 20px" value=<?php echo $value->id ?>>
                        <label for="postToPage">{{$value->name}}</label>
                      @endforeach
                    </div> 
                    <div class="form-group">
                      <label for="uploadURL">Upload from URL</label>
                      <div>                    
                        <div class="input-group">
                          <div class="input-group-addon">Link URL</div>
                          <input type="text" class="form-control" name="uploadURL" id="uploadURL">
                        </div>
                      </div>
                    </div>
                  </form>                   
                  <form method="post" action="{{route('addPost')}}" enctype="multipart/form-data">
                    @csrf                 
                    <div class="form-group">
                        <label for="status">Trạng thái</label>
                        <div class="box box-info">
                          <div id="SubmitPostUrls"></div>
                          <div class="box-header">
                              <h3 class="box-title">
                                  <small>Status facebook</small>
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
                          </div>
                          <div class="box-body pad">
                              <textarea name="messagePostUrl" rows="10" style="resize:vertical;width: 100%"></textarea>
                          </div>
                        </div>
                        <input type="submit" name="submitAddPostURL">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
      </div>
    </section>
  </div>
  @stop()