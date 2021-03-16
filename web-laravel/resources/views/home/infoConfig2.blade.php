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
              <h3 class="box-title">Danh sach Bai dang</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" id="bodyData">
              <table id="example1" class="table table-hover table-bordered">
                <thead>
                  <tr>
                      <th>ID</th>
                      <th>Ý định</th>
                      <th>Loại</th>
                      <th>Câu trả lời</th>
                      
                  </tr>
                </thead>
                <tbody>
                  @if(isset($configInfo))                    
                    @foreach(json_decode(json_encode($configInfo), true) as $value)
                      <tr>
                          <td></td>                                        
                          <td>{{$value['config']}}</td>
                          <td>{{$value['type']}}</td>
                          <td>
                            <?php 
                              if($value['type']=='image'){
                                foreach (explode(',',$value['answer']) as $val) {
                                  echo '<img src="'.$val.'" style="width:50px;height:50px" />';
                                }
                              }elseif($value['type']=='text'){
                                  echo $value['answer'];
                              }elseif($value['type']=='quick-reply'){
                                foreach (explode(',',$value['answer']) as $val) {
                                  echo '<button type="button" class="btn btn-block btn-default">'.$val.'</button>';
                                }
                              }
                            ?>
                          </td>
                      </tr>                  
                    @endforeach
                  @endif
                </tbody>
                <prof>
                  <tr>
                    <th>ID</th>
                    <th>Ý định</th>
                    <th>Loại</th>
                    <th>Câu trả lời</th>
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