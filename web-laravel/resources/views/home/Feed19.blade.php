@extends('layouts.main20')
@section('section')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
    <!-- Main content -->
        <section class="content">
      <div class="row">
          <div class="box" id="contentFeed">
            <div class="box-header">
              <div>
                <h3 class="box-title">Danh sach Bai dang</h3>
              </div>
                <div>
                  <p>Chon trang de hien thi</p>
                  <form class="form-group" action="{{route('feedInfo')}}" method="get">
                    <select class="form-control" name="page">
                      @foreach(json_decode($nodePage) as $value)
                      <option value=<?php echo $value->id ?>>{{$value->name}}</option>
                      @endforeach
                    </select>
                    <input type="submit" style="width:150px" class="btn btn-block btn-primary"></input>
                  </form>                  
                </div>   
            </div>
            <!-- /.box-header -->
            <div class="box-body" id="bodyData">
              <table id="example1" class="table table-hover table-bordered">
                <thead>
                  <tr>
                      <th>ID</th>
                      <th>Image</th>
                      <th>Message</th>
                      <th>Is_Published</th>
                      <th>Share</th>
                      <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @if(isset($nodeFeed))                    
                    @foreach(json_decode($nodeFeed) as $value)
                      <tr>
                          <td>{{$value->id}}</td>                                        
                          <td><img src=<?php if(isset($value->picture)){echo $value->picture;}else{'#';} ?>></td>
                          <td>{{(isset($value->message) && $value->is_published===true) ? $value->message : (isset($value->story) ? $value->story : '')}}</td>
                          <td><?php echo $value->is_published ?></td>
                          <td> 
                            {{isset($value->shares) ? $value->shares->count : '0'}} <br/>                          
                          </td>
                          <td>
                            <div class="box-body ">
                              <form action="feedInfo/edit" method="get">
                                <button type='submit' class='btn btn-primary' style="justify-content: space-between;" name="PostId" value=<?php echo $value->id ?>><i class='fa fa-edit'></i>Edit</button>
                              </form>
                              <form method="post"  action="{{route('feedInfo')}}">
                                @csrf
                                <button type='submit' class='btn btn-danger ' name="PostIdDel" value=<?php echo $value->id ?>><i class='fa fa-remove'></i>Delete</button>
                              </form>
                              <form action="feedInfo/comments" method="get">
                                <button type='submit' class='btn btn-info' style="justify-content: space-between;" name="PostId" value=<?php echo $value->id ?>><i class='fa fa-comments-o'></i>Comment</button>
                                <input type="hidden" name="code" value="{{$pageToken['access_token']}}">
                              </form>
                            </div>                        
                          </td>
                      </tr>                  
                    @endforeach
                  @endif
                </tbody>
                <prof>
                  <tr>
                      <th>ID</th>
                      <th>Image</th>
                      <th>Message</th>
                      <th>Is_Published</th>
                      <th>Share</th>
                      <th>Action</th>
                  </tr>
                </prof>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  @stop()