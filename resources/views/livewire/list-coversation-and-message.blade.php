@if ($conversations->isNotEmpty())
    <div>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    
        <div class="container" wire:poll >
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card chat-app">
                            
                        <div id="plist" class="people-list">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Search...">
                            </div>
                            
                            <ul class="list-unstyled chat-list mt-2 mb-0">
                                @foreach ($conversations as $conversation)
                                <li class="clearfix {{ $conversation->id === $selectedConversation->id ? 'bg-warning' : '' }}">
                                    <a wire:click="viewMessage( {{$conversation->id}})">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="avatar">
                                    <div class="about">
                                        @if ($conversation->sender_id === auth()->id())
                                        <div class="name">{{$conversation->receiver->name}}</div>
                                        @else
                                        <div class="name">{{$conversation->sender->name}}</div>
                                        @endif
                                        <div class="status"> <i class=""></i>{{$conversation->messages->last()?->body}} </div>                                            
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        
                        </div>
                    
    
                        <div class="chat">
                            <div class="chat-header clearfix">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <a data-toggle="modal" data-target="#view_info">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
                                        </a>
                                        <div class="chat-about">
                                            <h6 class="m-b-0">
                                            @if ($conversation->sender_id === auth()->id())
                                            {{ $selectedConversation->receiver->name }}
                                            @else
                                            {{ $selectedConversation->sender->name }}
                                            @endif
                                          </h6> 
                                            
                                        </div>
                                    </div>
                                
                                </div>
                            </div>

                            
                            @foreach ($selectedConversation->messages as $message)
                            <div class="chat-history overflow-auto ">
                                <ul class="m-b-0">
                                    <li class="clearfix">
                                        <div class="message-data {{ $message->user_id === auth()->id() ? 'text-right ' : '' }}">
                                            <span class="">{{ $message->user->id === auth()->id() ? 'You' : $message->user->name}}</span>
                                            <br>
                                            <div class="message-data">
                                                <p class="message other-message ">{{$message->body}}<br><small class="message-data-time">{{ $message->created_at->format('d M h:i a') }}</small>
                                                </p>
                                                </div>
                                     </div>
                                    </li>
                                </ul>
                            </div>
                            @endforeach
                       
                            <div class="chat-message clearfix">
                                <form wire:submit.prevent="sendMessage" action="#">
                                <div class="input-group mb-0">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-send"></i></span>
                                    </div>
                                    <input wire:model.defer="body" type="text" name="message" placeholder="Type Message ..." class="form-control">
                                    <span class="input-group-append">
                                        <button type="submit" class="btn btn-warning">Send</button>
                                    </span>                                  
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <style type="text/css">
            body{
                background-color: #f4f7f6;
                margin-top:20px;
            }
            .card {
                background: #fff;
                transition: .5s;
                border: 0;
                margin-bottom: 30px;
                border-radius: .55rem;
                position: relative;
                width: 100%;
                box-shadow: 0 1px 2px 0 rgb(0 0 0 / 10%);
            }
            .chat-app .people-list {
                width: 280px;
                position: absolute;
                left: 0;
                top: 0;
                padding: 20px;
                z-index: 7
            }
            
            .chat-app .chat {
                margin-left: 280px;
                border-left: 1px solid #eaeaea
            }
            
            .people-list {
                -moz-transition: .5s;
                -o-transition: .5s;
                -webkit-transition: .5s;
                transition: .5s
            }
            
            .people-list .chat-list li {
                padding: 10px 15px;
                list-style: none;
                border-radius: 3px
            }
            
            .people-list .chat-list li:hover {
                background: #efefef;
                cursor: pointer
            }
            
            .people-list .chat-list li.active {
                background: #efefef
            }
            
            .people-list .chat-list li .name {
                font-size: 15px
            }
            
            .people-list .chat-list img {
                width: 45px;
                border-radius: 50%
            }
            
            .people-list img {
                float: left;
                border-radius: 50%
            }
            
            .people-list .about {
                float: left;
                padding-left: 8px
            }
            
            .people-list .status {
                color: #999;
                font-size: 13px
            }
            
            .chat .chat-header {
                padding: 15px 20px;
                border-bottom: 2px solid #f4f7f6
            }
            
            .chat .chat-header img {
                float: left;
                border-radius: 40px;
                width: 40px
            }
            
            .chat .chat-header .chat-about {
                float: left;
                padding-left: 10px
            }
            
            .chat .chat-history {
                padding: 20px;
                border-bottom: 2px solid #fff
            }
            
            .chat .chat-history ul {
                padding: 0
            }
            
            .chat .chat-history ul li {
                list-style: none;
                margin-bottom: 30px
            }
            
            .chat .chat-history ul li:last-child {
                margin-bottom: 0px
            }
            
            .chat .chat-history .message-data {
                margin-bottom: 15px
            }
            
            .chat .chat-history .message-data img {
                border-radius: 40px;
                width: 40px
            }
            
            .chat .chat-history .message-data-time {
                color: #434651;
                padding-left: 6px
            }
            
            .chat .chat-history .message {
                color: #444;
                padding: 18px 20px;
                line-height: 26px;
                font-size: 16px;
                border-radius: 7px;
                display: inline-block;
                position: relative
            }
           
            .chat .chat-history .message:after {
                bottom: 100%;
                left: 7%;
                border: solid transparent;
                content: " ";
                height: 0;
                width: 0;
                position: absolute;
                pointer-events: none;
                border-bottom-color: #fff;
                border-width: 10px;
                margin-left: -10px
            }
            
            .chat .chat-history .my-message {
                background: #efefef
            }
            
            .chat .chat-history .my-message:after {
                bottom: 100%;
                left: 30px;
                border: solid transparent;
                content: " ";
                height: 0;
                width: 0;
                position: absolute;
                pointer-events: none;
                border-bottom-color: #efefef;
                border-width: 10px;
                margin-left: -10px
            }
            
            .chat .chat-history .other-message {
                background: #e8f1f3;
                text-align: right
            }
            
            .chat .chat-history .other-message:after {
                border-bottom-color: #e8f1f3;
                left: 93%
            }
            
            .chat .chat-message {
                padding: 20px
            }
            
            .online,
            .offline,
            .me {
                margin-right: 2px;
                font-size: 8px;
                vertical-align: middle
            }
            
            .online {
                color: #86c541
            }
            
            .offline {
                color: #e47297
            }
            
            .me {
                color: #1d8ecd
            }
            
            .float-right {
                float: right
            }
            
            .clearfix:after {
                visibility: hidden;
                display: block;
                font-size: 0;
                content: " ";
                clear: both;
                height: 0
            }
            
            @media only screen and (max-width: 767px) {
                .chat-app .people-list {
                    height: 465px;
                    width: 100%;
                    overflow-x: auto;
                    background: #fff;
                    left: -400px;
                    display: none
                }
                .chat-app .people-list.open {
                    left: 0
                }
                .chat-app .chat {
                    margin: 0
                }
                .chat-app .chat .chat-header {
                    border-radius: 0.55rem 0.55rem 0 0
                }
                .chat-app .chat-history {
                    height: 300px;
                    overflow-x: auto
                }
            }
            
            @media only screen and (min-width: 768px) and (max-width: 992px) {
                .chat-app .chat-list {
                    height: 650px;
                    overflow-x: auto
                }
                .chat-app .chat-history {
                    height: 600px;
                    overflow-x: auto
                }
            }
            
            @media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation: landscape) and (-webkit-min-device-pixel-ratio: 1) {
                .chat-app .chat-list {
                    height: 480px;
                    overflow-x: auto
                }
                .chat-app .chat-history {
                    height: calc(100vh - 350px);
                    overflow-x: auto
                }
            }
            </style>
    </div>
    @else
    <div><h1>You Don't have any messages</h1></div>
    @endif

