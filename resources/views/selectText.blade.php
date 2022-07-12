@extends('layouts.app')

@section('content')
<div class="goTop">
    <a class="goTopBtn jq-goTop" onclick="gotop()">
        <img src="{{asset('/img/gotop.png')}}" style="width:6vh;">
    </a>
</div>
<div class="container">
    <div class="myUI"></div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(Session::has('editErr'))
                <div class="alert alert-danger">{{ Session::get('editErr') }}</div>
            @endif
            <div class="myAlert" style="margin-top:2vh;"></div>
            <div class="accordion marginTit" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            新增回覆資訊.
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <form method="POST" id="form" action="/insert" enctype="multipart/form-data" style="padding:0 2.5vh;">
                                @csrf
                                <div class="form-group row">
                                    <label for="Utxt" class="col-md-12 col-form-label text-md-left">使用者訊息</label>
                                    <div class="col-md-7">
                                        <input id="Utxt" type="text" class="form-control" name="Utxt" value="" required autofocus>
                                    </div>
                                </div>
                                <div class="form-group row" style="margin-top:2.5vh;">
                                    <label for="reType" class="col-md-12 col-form-label text-md-left">回覆類型</label>
                                    <div class="col-md-6">
                                        <select id="reType" name="reType" class="form-control" onchange="uType(this.options[this.options.selectedIndex].value)">
                                            <option value="...">-- 請選擇回覆類型 --</option>
                                            <option value="text">文字</option>
                                            <option value="img">圖片</option>
                                        </select> 
                                    </div>
                                </div>
                                <div class="form-group row botReText" style="margin-top:2.5vh;"></div>
                                <div class="imgD" id="imgD"></div>
                                <div class="imgFileDiv"></div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                    </div>
                                </div>
                            </form>
                            <button type="button" class="btn btn-primary sumBtn" id="isChecked" onclick="cli()">送出</button>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            啟用的關鍵詞語
                            <span class="badge bg-success" style="margin-left:1vh;">{{count($enableMessagesD)}}</span>
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="card-body">
                                <div class="row" style="font-size:2.5vh;">
                                    <div class="col">刷新詞語
                                        <img src="{{asset('/img/replay_121.png')}}" style="max-width:4.3vh;" onclick="reloadWeb()" />
                                    </div>
                                </div>
                                @if($enableMessagesDRow>0)
                                    @foreach($enableMessagesD as $v)
                                        <div class="row" style="font-size:2.5vh;margin-top:4.5vh;">
                                            <div class="col-md-7">
                                                字串：{{$v->u_text}}
                                            </div>
                                            <div class="col-md-3" style="display:flex;">
                                                狀態：
                                                    <label style="{{$v->oc==1?'color:#0F0;':'color:#ffc400;'}}">●</label>{{'啟用'}}
                                            </div>
                                            <div class="col-md-2" style="display:flex;padding-top:-3%;">
                                                @if(Auth::id()==1)
                                                    <a href="edit/{{$v->mIndex}}"><img src="{{asset('/img/edit_icon.png')}}" style="width:4.3vh;" /></a>
                                                    <img class="statusImgS" src="{{asset($v->oc==1?'/img/close_icon.png':'/img/open_icon.png')}}" style="height:4.3vh;width:4.3vh;margin-left:3vh;" onclick="editMessageStatus({{$v->oc}},'{{$v->u_text}}')" />
                                                @else
                                                    <a href="mesaageView/{{$v->mIndex}}">
                                                        <img src="{{asset('/img/info1.png')}}" style="width:4.3vh;" />
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                    @else
                                    <div class="row" style="font-size:2.5vh;margin-bottom:1.5vh;">
                                        <div class="col-md-12" style="display:flex;font-size:2.3vh;">
                                            ---無啟用的關鍵字---
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            停用的關鍵詞語
                            <span class="badge bg-danger" style="margin-left:1vh;">{{count($disableMessagesD)}}</span>
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="card-body">
                                <div class="row" style="font-size:2.5vh;">
                                    <div class="col">刷新詞語
                                        <img src="{{asset('/img/replay_121.png')}}" style="max-width:4.3vh;" onclick="reloadWeb()" />
                                    </div>
                                </div>
                                @if($disableMessagesDRow>0)
                                    @foreach($disableMessagesD as $v)
                                        <div class="row" style="font-size:2.5vh;margin-top:4.5vh;">
                                            <div class="col-md-7">
                                                字串：{{$v->u_text}}
                                            </div>
                                            <div class="col-md-3" style="display:flex;">
                                                狀態：
                                                    <label style="{{$v->oc==1?'color:#0F0;':'color:#ffc400;'}}">●</label>{{'啟用'}}
                                            </div>
                                            <div class="col-md-2" style="display:flex;padding-top:-3%;">
                                                @if(Auth::id()==1)
                                                    <a href="edit/{{$v->mIndex}}"><img src="{{asset('/img/edit_icon.png')}}" style="width:4.3vh;" /></a>
                                                    <img class="statusImgS" src="{{asset($v->oc==1?'/img/close_icon.png':'/img/open_icon.png')}}" style="height:4.3vh;width:4.3vh;margin-left:3vh;" onclick="editMessageStatus({{$v->oc}},'{{$v->u_text}}')" />
                                                @else
                                                    <a href="mesaageView/{{$v->mIndex}}">
                                                        <img src="{{asset('/img/info1.png')}}" style="width:4.3vh;" />
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                    @else
                                    <div class="row" style="font-size:2.5vh;margin-bottom:1.5vh;">
                                        <div class="col-md-12" style="display:flex;font-size:2.3vh;">
                                            ---無停用的關鍵字---
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content_css')
  <link href="{{ URL::asset('/css/selectText_css.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('/css/dataInsert_css.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('/css/gotop.css') }}" rel="stylesheet">
@endsection

@section('content_js')
    <script src="{{URL::asset('/js/lineBotgotop.js')}}"></script>
    @if(Auth::id()==1)
        <script src="{{URL::asset('/js/datainsert.js')}}"></script>
        <script src="{{URL::asset('/js/botMessageStatus.js')}}"></script>
        <script src="{{URL::asset('/js/errCodeUI.js')}}"></script>
        <script src="{{URL::asset('/js/publicJs.js')}}"></script>
    @endif
@endsection