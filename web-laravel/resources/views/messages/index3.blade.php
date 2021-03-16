<div class="contact-profile">
<img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
<p>
@if(isset($sender))
   {{$sender['name']}}
@endif
</p>
</div>
<div class="messages"> 
    <ul>        
    @if(isset($messages))
        @foreach($messages as $message)                                                    
            <li class=<?php echo ($sender['id']!=$pageId) ? "replies" : 'sent' ?>>
                <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
                @if($message['message']!==null)
                    <p>{{$message['message']}}</p>
                @endif
                @if(isset($message['attachments']))
                    @foreach($message['attachments']['data'] as $img)
                        <img src="{{$img['image_data']['url']}}" alt="img" class="imgSend"/>
                    @endforeach
                @endif
            </li>  
        @endforeach
    @endif
    </ul>
</div>
<div class="message-input">
    <div class="wrap">
        <input type="text" class='inputMsg' name="inputMsg">
    </div>
</div>
