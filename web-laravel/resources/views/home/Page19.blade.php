@extends('layouts.main20')
@section('section')
  <div class="content-wrapper">
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
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Danh sach Trang quan ly</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">                           
              <table id="example1" class="table table-hover table-bordered">
                <thead>
                  <tr>
                      <th>ID</th>
                      <th>Image</th>
                      <th>Name</th>
                      <th>Category</th>
                      <th>Info</th>
                  </tr>
                </thead>
                <tbody>
                  @if(isset($nodePage))                    
                    @foreach(json_decode($nodePage) as $value)
                      <tr>
                          <td>{{$value->id}}</td>                                        
                          <td><img src=<?php echo $value->picture->url ?>></td>
                          <td>{{$value->name}}</td>
                          <td>{{$value->category}}</td>
                          <td>
                            @if(isset($value->location))
                              @if(isset($value->location->city))
                                Thanh pho: {{$value->location->city}}</br>
                              @endif
                              @if(isset($value->location->street))
                                Dia chi: {{$value->location->street}}</br>
                              @endif
                              @if(isset($value->location->zip))
                                Zip: {{$value->location->zip}}</br>
                              @endif
                            @endif                        
                          </td>
                      </tr>                  
                    @endforeach
                  @endif
                </tbody>
                <prof>
                  <tr>
                      <th>ID</th>
                      <th>Image</th>
                      <th>Name</th>
                      <th>Category</th>
                      <th>Info</th>
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