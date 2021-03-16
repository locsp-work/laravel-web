
@extends('layouts.main20')
@section('section')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <form class="form-group" method="get">
            <div class='row'>
                <select class="form-control col-xs-3" id="selectPage" style="width:400px;margin-left:25px; margin-right:20px" name="pageId">
                    @foreach(json_decode($nodePage) as $value)
                        <option value=<?php echo $value->id ?>>{{$value->name}}</option>
                    @endforeach
                </select>
                <input type="submit"  style="width:100px" class="btn btn-block btn-primary col-xs-3"></input>
            </div>
        </form>  
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="box">
                <div class="box-body">
                    <div class="col-md-12">
                        <div id="frame">
                            <div id="sidepanel">
                                <div id="profile">
                                    <div class="wrap">
                                        <img id="profile-img" src="http://emilcarlsson.se/assets/mikeross.png" class="online" alt="" />
                                        <p>Mike Ross</p>
                                        <i class="fa fa-chevron-down expand-button" aria-hidden="true"></i>
                                        <div id="status-options">
                                            <ul>
                                                <li id="status-online" class="active"><span class="status-circle"></span> <p>Online</p></li>
                                                <li id="status-away"><span class="status-circle"></span> <p>Away</p></li>
                                                <li id="status-busy"><span class="status-circle"></span> <p>Busy</p></li>
                                                <li id="status-offline"><span class="status-circle"></span> <p>Offline</p></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div id="search">
                                    <label for=""><i class="fa fa-search" aria-hidden="true"></i></label>
                                    <input type="text" placeholder="Search contacts..." />
                                </div>
                                <div id="contacts">                                   
                                    <ul>
                                        @if(isset($edgeMsg))
                                            @foreach($edgeMsg as $nodeMsg)
                                                @foreach($nodeMsg['senders'] as $sender)
                                                    @if($sender['id']!=$_GET['pageId'])
                                                        <li class="contact" data-id="{{$nodeMsg['id']}}" page-id="{{$_GET['pageId']}}" receiver-id="{{$sender['id']}}">
                                                            <div class="wrap">
                                                                <span class="contact-status busy"></span>
                                                                <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
                                                                <div class="meta">
                                                                    <div class="name" style="margin-right:60px; text-overflow:ellipsis">                                                                        
                                                                        {{$sender['name']}}                                                                           
                                                                    </div>
                                                                    <div class="time">{{date_format($nodeMsg->getField('updated_time'),'d-m-Y H:i:s')}}</div>
                                                                    <p class="preview">{{$nodeMsg->getField('snippet')}}</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="content" id="msgTabview">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  @stop()
