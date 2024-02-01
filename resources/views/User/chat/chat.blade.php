@extends('User.main')
@section('head')
    <style>
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
        .chat-app {
            max-width: 100%;
        }

        .people-list {
            height: 100%;
            overflow-y: auto;
            border-right: 1px solid #ddd;
        }

        .chat-history {
            height: 600px; /* Chiều cao cố định của khu vực chat */
            overflow-y: auto;
            border-left: 1px solid #ddd;
        }

        .chat-message {
            border-top: 1px solid #ddd;
            padding: 15px;
        }
    </style>
@endsection
@php
    $pnt=\Illuminate\Support\Facades\DB::table('phongnhantin')->where('id','=',$usid)->first();
    if($pnt->nd1 != \Illuminate\Support\Facades\Auth::user()->maNguoiDung){
        $nd=\Illuminate\Support\Facades\DB::table('nguoiDung')->where('maNguoiDung','=',$pnt->nd1)->select('maNguoiDung','ho','ten')->first();
    }else{
        $nd=\Illuminate\Support\Facades\DB::table('nguoiDung')->where('maNguoiDung','=',$pnt->nd2)->select('maNguoiDung','ho','ten')->first();
    }
@endphp
@section('content')
{{--    {{dd($usid)}}--}}
    <div class="container">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card chat-app">
{{--                    <div id="plist" class="people-list">--}}
{{--                        <div class="input-group">--}}
{{--                            <div class="input-group-prepend">--}}
{{--                                <span class="input-group-text"><i class="fa fa-search"></i></span>--}}
{{--                            </div>--}}
{{--                            <input type="text" class="form-control" placeholder="Search...">--}}
{{--                        </div>--}}
{{--                        <ul class="list-unstyled chat-list mt-2 mb-0">--}}
{{--                            <li class="clearfix">--}}
{{--                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="avatar">--}}
{{--                                <div class="about">--}}
{{--                                    <div class="name">Vincent Porter</div>--}}
{{--                                    <div class="status"> <i class="fa fa-circle offline"></i> left 7 mins ago </div>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li class="clearfix active">--}}
{{--                                <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">--}}
{{--                                <div class="about">--}}
{{--                                    <div class="name">Aiden Chavez</div>--}}
{{--                                    <div class="status"> <i class="fa fa-circle online"></i> online </div>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li class="clearfix">--}}
{{--                                <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="avatar">--}}
{{--                                <div class="about">--}}
{{--                                    <div class="name">Mike Thomas</div>--}}
{{--                                    <div class="status"> <i class="fa fa-circle online"></i> online </div>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li class="clearfix">--}}
{{--                                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar">--}}
{{--                                <div class="about">--}}
{{--                                    <div class="name">Christian Kelly</div>--}}
{{--                                    <div class="status"> <i class="fa fa-circle offline"></i> left 10 hours ago </div>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li class="clearfix">--}}
{{--                                <img src="https://bootdey.com/img/Content/avatar/avatar8.png" alt="avatar">--}}
{{--                                <div class="about">--}}
{{--                                    <div class="name">Monica Ward</div>--}}
{{--                                    <div class="status"> <i class="fa fa-circle online"></i> online </div>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li class="clearfix">--}}
{{--                                <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="avatar">--}}
{{--                                <div class="about">--}}
{{--                                    <div class="name">Dean Henry</div>--}}
{{--                                    <div class="status"> <i class="fa fa-circle offline"></i> offline since Oct 28 </div>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
                    <div class="chat">
                        <div class="chat-header clearfix">
                            <div class="row">
                                <div class="col-lg-6">
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                                        <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
                                    </a>
                                    <div class="chat-about">
                                        <h6 class="m-b-0">{{$nd->ho . ' ' . $nd->ten}}</h6>
{{--                                        <small>Last seen: 2 hours ago</small>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chat-history">
                            <ul class="m-b-0">
                                <?php
                                if ($usid != null) {
                                    $tinnhan = \Illuminate\Support\Facades\DB::table('tinnhan')
                                        ->where('idPhongNT','=',$usid)
                                        ->get();
//                                    dd($tinnhan);
                                }

                                ?>
                                @foreach($tinnhan as $tn)
                                    @if($tn->maNguoiGui!=\Illuminate\Support\Facades\Auth::user()->maNguoiDung)
                                        <li class="clearfix">
                                            <div class="message-data text-right">
                                                <span class="message-data-time">{{$tn->created_at}}</span>
                                                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar">
                                            </div>
                                            <div class="message other-message float-right">{{$tn->noiDung}}</div>
                                        </li>
                                    @else
                                        <li class="clearfix">
                                            <div class="message-data">
                                                <span class="message-data-time">{{$tn->created_at}}</span>
                                            </div>
                                            <div class="message my-message">{{$tn->noiDung}}</div>
                                        </li>
                                    @endif
                                @endforeach
{{--                                <?php $i=0?>--}}
{{--                                @for($i=0;$i<=10;$i++)--}}
{{--                                    <li class="clearfix">--}}
{{--                                        <div class="message-data">--}}
{{--                                            <span class="message-data-time">10:15 AM, Today</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="message my-message">Project has been already finished and I have results to show you.</div>--}}
{{--                                    </li>--}}
{{--                                @endfor--}}
                            </ul>
                        </div>
                        <div class="chat-message clearfix">
                            <div class="input-group mb-0">
                                <div class="input-group-prepend" id="sendButton" >
                                    <span class="input-group-text" style="height: 100%;"><i class="fa fa-send"></i></span>
                                </div>
                                <input type="text" id="messageInput" class="form-control" placeholder="Enter text here...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script>
        $(document).ready(function() {
            function scrollChatToBottom() {
                var chatHistory = $('.chat-history');
                chatHistory.scrollTop(chatHistory[0].scrollHeight);
            }
            scrollChatToBottom();
            $('#sendButton').on('click', function() {
                var messageContent = $('#messageInput').val();
                var usid = "{{$usid}}";
                // Lấy CSRF token từ trang
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                // Sử dụng AJAX để gửi tin nhắn lên máy chủ
                $.ajax({
                    url: '/send-message/{{$usid}}',
                    method: 'get',
                    data: {
                        {{--"_token": "{{ csrf_token() }}",--}}
                        message: messageContent,
                        usid : usid,
                    },
                    success: function(response) {
                        $('.chat-history ul').append('<li class="clearfix"><div class="message-data"><span class="message-data-time">Now</span></div><div class="message my-message">' + messageContent + '</div></li>');
                        scrollChatToBottom();
                        $('#messageInput').val('');
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            });
            $('#messageInput').on('keydown', function(event) {
                if (event.keyCode === 13) { // 13 là mã phím Enter
                    event.preventDefault();

                    var messageContent = $('#messageInput').val();
                    var usid = "{{$usid}}";
                    // Lấy CSRF token từ trang
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    // Sử dụng AJAX để gửi tin nhắn lên máy chủ
                    $.ajax({
                        url: '/send-message/{{$usid}}',
                        method: 'get',
                        data: {
                            {{--"_token": "{{ csrf_token() }}",--}}
                            message: messageContent,
                            usid : usid,
                        },
                        success: function(response) {
                            $('.chat-history ul').append('<li class="clearfix"><div class="message-data"><span class="message-data-time">Now</span></div><div class="message my-message">' + messageContent + '</div></li>');
                            scrollChatToBottom();
                            $('#messageInput').val('');
                        },
                        error: function(error) {
                            console.error(error);
                        }
                    });
                }
            });
        });
    </script>
    <script type="module">
        Echo.private('chat.private.{{\Illuminate\Support\Facades\Auth::user()->maNguoiDung}}')
            .listen('MessageSent', (e) => {
                console.log(e);
                $('.chat-history ul').append('<li class="clearfix"><div class="message-data text-right"><span class="message-data-time">'+e.message.created_at+'</span><img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar"></div><div class="message other-message float-right">'+e.message.noiDung+'</div></li>');
            })
    </script>
@endsection
