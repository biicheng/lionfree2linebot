@extends('layouts.appHome')

@section('content')
<div class="goTop">
    <a class="goTopBtn jq-goTop" onclick="gotop()">
        <img src="{{asset('/img/gotop.png')}}" style="width:6vh;">
    </a>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if($messageRow>0)
            <div class="row" style="margin-top:4.5vh;margin-bottom:2.5vh;font-size:3vh;">
                <div class="col">你該知道的關鍵字</div>
            </div>
                @foreach($messageD as $v)
                    <div class="row" style="font-size:2.5vh;margin-bottom:4.5vh;">
                        <div class="col-md-2" style="display:flex;">
                            狀態：
                            <img src="{{ asset($v->oc==1?'/img/open_icon.png':'/img/close_icon.png') }}" style="width:4.3vh;" />
                            {{-- @if($v->oc==1)
                                <label style="color:#0F0;">●</label>{{'啟用'}}
                                
                            @else
                                <label><label style="color:#ffc400;">●{{'停用'}}</label></label>
                            @endif --}}
                        </div>
                        <div class="col-md-9">
                            字串：{{$v->u_text}}
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection

@section('content_css')
  <link href="{{ URL::asset('/css/home_css.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('/css/gotop.css') }}" rel="stylesheet">
@endsection

@section('content_js')
    <script src="{{URL::asset('/js/lineBotgotop.js')}}"></script>
@endsection
