@extends('layouts.app')

@section('content')
<div class="container">
    <div class="myUI"></div>
    @if($errors->any())
        <div class="div-group row alert alert-success" role="alert" id="alert" style="margin:0;"><label class="col-form-label text-md-left" style="width:95%;" id="alertT">
            {{$errors->first()}}
            {{$errors->second()}}
        </label><label class="col-form-label text-md-right" style="width:5%;" onclick="winClose()"><a>X</a></label></div>
    @endif
    <div class="row justify-content-center" style="margin-top:2vh;">
        <div class="col-md-12" style="margin-bottom:7vh;">
            <div class="card">
                <div class="card-header">系統回覆圖文</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12" style="margin-bottom:2.5%;display:flex;font-size:120%;">
                            狀態：
                            <label class="colorLabel" style="color:{{$oc==1?'#0F0':'#ffc400'}};">●</label>{{'啟用'}}</label>
                            @if(Auth::id()==1)
                                <img class="statusImgS" src="{{asset($oc==1?'/img/close_icon.png':'/img/open_icon.png')}}" style="height:4.3vh;width:4.3vh;margin-left:3vh;" onclick="editMessageStatus({{$oc}},'{{$utext}}')" />
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="margin-top:2.5%;display:flex;font-size:120%;">
                            系統回覆修改：
                        </div>
                    </div>
                    @if(Auth::id()==1)
                    <form method="POST" action="{{ route('editMessage') }}">
                    @endif
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label for="Utxt" class="col-form-label text-md-right">使用者訊息:</label>
                            </div>
                            <div class="col-md-8 align-self-center">
                                @if(Auth::id()==1)
                                    <input id="Utxt" type="text" class="form-control" name="Utxt" value="{{$utext}}" readonly />
                                @else
                                    <span id="Utxt" class="">{{$utext}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row" style="margin-top:2vh;">
                            <div class="col-md-3">
                                <label for="reType" class="col-form-label text-md-right">回覆類型:</label>
                            </div>
                            <div class="col-md-8 align-self-center">
                            @if(Auth::id()==1)
                                <select id="reType" name="reType" class="form-control">
                                    @if($reType=='text')
                                        <option value="text" selected>文字</option>
                                        <option value="img">圖片</option>
                                    @else
                                        <option value="text">文字</option>
                                        <option value="img" selected>圖片</option>
                                    @endif
                                </select>
                            @else
                                <span id="Utxt" class="">
                                    @if($reType=='text')文字@endif
                                    @if($reType=='img')圖片@endif
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="form-group row" style="margin-top:2vh;">
                            <div class="col-md-3">
                                <label for="re_txt" class="col-form-label text-md-right">系統回覆文字:</label>
                            </div>
                            <div class="col-md-8 align-self-center">
                                @if(Auth::id()==1)
                                    <input id="re_txt" type="text" class="form-control" name="re_txt" value="{{$retext}}">
                                @else
                                    <span>
                                        @if($retext!=null) {{$retext}}
                                        @else 無.
                                        @endif
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row" style="margin-top:3vh;">
                            <div class="col text-start">
                                系統回覆圖片(大):<br>
                                @if($bimg!='')
                                    <img src="{{$bimg}}" class="re_img">
                                @else
                                    <label id="bImg" name="bImg">無</label>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row" style="margin-top:3vh;">
                            <div class="col  text-start">
                                系統回覆圖片(小):<br>
                                @if($simg!='')
                                    <img src="{{$simg}}" class="re_img">
                                @else
                                    <label id="sImg" name="sImg">無</label>
                                @endif
                            </div>
                        </div>
                    @if(Auth::id()==1)
                    </form>
                    <button type="submit" class="btn btn-primary smitBtn">送出</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content_css')
    <link href="{{ URL::asset('/css/editMessage_css.css') }}" rel="stylesheet">
@endsection

@section('content_js')
    @if(Auth::id()==1)
        <script src="{{URL::asset('/js/botMessageStatus.js')}}"></script>
        <script src="{{URL::asset('/js/errCodeUI.js')}}"></script>
        <script src="{{URL::asset('/js/publicJs.js')}}"></script>
    @endif
  {{-- <script src="{{URL::asset('/js/datainsert.js')}}"></script> --}}
@endsection