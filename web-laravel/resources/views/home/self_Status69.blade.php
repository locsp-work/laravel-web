@extends('layouts.main20')
@section('section')
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Status
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Status</li>
      </ol>
    </section>
    <section class="content">
      <!-- row -->
      <div class="row">
        <div class="col-md-12">
          <!-- The time line -->
          <ul class="timeline">
            <!-- timeline time label -->
            @foreach($statusData as $status)
            <li class="time-label">
              <span class="bg-red">
                {{date('d/m/Y',strtotime($status['created_time']) + 25200)}}
              </span>
            </li>
            <li>
              <i class="{{
                $status['status_type']=='added_photos' ? 'fa fa-photo bg-blue' 
                : ($status['status_type']=='mobile_status_update' ? 'fa fa-history bg-grey'
                : 'fa fa-share-square bg-red')
                }}">
              </i>
              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i>{{date('h:i:s A',strtotime($status['created_time']) + 25200)}}</span>

                <h3 class="timeline-header">
                  <a href="{{$status['permalink_url']}}">{{$status['from']['name']}}</a>
                  {{
                    $status['status_type']=='added_photos' ? 'Đã đăng ảnh lên' 
                    : ($status['status_type']=='mobile_status_update' ? 'Đã chia sẻ từ điện thoại'
                    : 'Đã chia sẻ nội dung')
                  }}
                </h3>

                <div class="timeline-body">
                  @if(isset($status['message']))
                    {{$status['message']}}
                  @elseif(isset($status['attachments']['data'][0]['description']) && isset($status['attachments']['data'][0]['title']))
                    {{$status['attachments']['data'][0]['title']}}
                  @elseif(isset($status['attachments']['data'][0]['description']))
                    {{$status['attachments']['data'][0]['description']}}
                  @endif
                </div>
                <div id="{{$status['id']}}"></div>
               <!--  <div class="timeline-footer">
                  <a class="btn btn-primary btn-xs">Read more</a>
                  <a class="btn btn-danger btn-xs">Delete</a>
                </div> -->
              </div>
            </li>
            @endforeach

            <li>
              <i class="fa fa-clock-o bg-gray"></i>
            </li>
          </ul>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
</div>
@stop() 