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
            {{-- @if(Session::has('editErr'))
                <div class="alert alert-danger">{{ Session::get('editErr') }}</div>
            @endif --}}
            {{-- <div class="row" style="font-size:2.5vh;">
                <div class="col">刷新詞語
                    <img src="{{asset('/img/replay_121.png')}}" style="max-width:4.3vh;" onclick="reloadWeb()" />
                </div>
            </div> --}}
            <div class="row" style="margin:2.5vh 0;font-size:3vh;">
                <div class="col">你該知道的關鍵字</div>
            </div>
            <div class="accordion marginTit" id="accordionExample" style="margin-bottom:6vh;">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            可使用的關鍵字.
                            {{-- {{count($message1)>0?'success':'secondary'}} --}}
                            <span class="badge bg-success" style="margin-left:1vh;">{{count($message1)}}</span>
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            @if(count($message1)>0)
                                @foreach($message1 as $v)
                                    <div class="row" style="font-size:2.5vh;margin-bottom:3.5vh;">
                                        {{-- <div class="col-md-2" style="display:flex;">
                                            狀態：
                                            <img src="{{ asset($v->oc==1?'/img/open_icon.png':'/img/close_icon.png') }}" style="width:4.3vh;" />
                                        </div> --}}
                                        <div class="col-md-9">
                                            {{-- 字串： --}}
                                            {{$v->u_text}}
                                        </div>
                                    </div>
                                @endforeach
                                @else
                                <div class="row" style="font-size:2.5vh;margin-bottom:1.5vh;">
                                    <div class="col-md-12" style="display:flex;font-size:2.3vh;">
                                        ---沒有可用的關鍵字---
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            停止使用的關鍵字.
                            <span class="badge bg-danger" style="margin-left:1vh;">{{count($message0)}}</span>
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="card-body">
                                @if(count($message0)>0)
                                    @foreach($message0 as $v)
                                        <div class="row" style="font-size:2.5vh;margin-bottom:4.5vh;">
                                            {{-- <div class="col-md-2" style="display:flex;">
                                                狀態：
                                                <img src="{{ asset($v->oc==1?'/img/open_icon.png':'/img/close_icon.png') }}" style="width:4.3vh;" />
                                            </div> --}}
                                            <div class="col-md-9">
                                                {{-- 字串： --}}
                                                {{$v->u_text}}
                                            </div>
                                        </div>
                                    @endforeach
                                    @else
                                    <div class="row" style="font-size:2.5vh;margin-bottom:1.5vh;">
                                        <div class="col-md-12" style="display:flex;font-size:2.3vh;">
                                            ---無停用 關鍵字---
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- @if($messageRow>0)
                @foreach($messageD as $v)
                    <div class="row" style="font-size:2.5vh;margin-bottom:4.5vh;">
                        <div class="col-md-2" style="display:flex;">
                            狀態：
                            <img src="{{ asset($v->oc==1?'/img/open_icon.png':'/img/close_icon.png') }}" style="width:4.3vh;" /> --}}
                            {{-- @if($v->oc==1)
                                <label style="color:#0F0;">●</label>{{'啟用'}}
                                
                            @else
                                <label><label style="color:#ffc400;">●{{'停用'}}</label></label>
                            @endif --}}
                        {{-- </div>
                        <div class="col-md-9">
                            字串：{{$v->u_text}}
                        </div>
                    </div>
                @endforeach
            @endif --}}
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
