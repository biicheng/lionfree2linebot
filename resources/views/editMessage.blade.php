@extends('layouts.app')

@section('content')
<div class="container">
    @if($errors->any())
        <div class="div-group row alert alert-success" role="alert" id="alert" style="margin:0;"><label class="col-form-label text-md-left" style="width:95%;" id="alertT">
            {{$errors->first()}}
            {{$errors->second()}}
        </label><label class="col-form-label text-md-right" style="width:5%;" onclick="winClose()"><a>X</a></label></div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">系統回覆圖文</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12" style="margin-bottom:2.5%;display:flex;font-size:120%;">
                            狀態：
                            @if($oc==1)
                                <label style="color:#0F0;">●</label>{{'啟用'}}</label>
                                <form method="POST" action="{{ route('edit') }}">
                                    @csrf
                                    <button type="submit" style="border:none;background:#0000;width:85%;height:85%;">
                                    <img src="{{ asset('/img/close_icon.png') }}" style="width:25%;" />
                                    </button>
                                    <input type="hidden" value={{ $oc }} name="oc" id="oc" />
                                    <input type="hidden" value={{ $utext }} name="utext" id="utext" />
                                </form>
                                
                            @else
                                <label style="color:#ffc400;">●</label>{{'停用'}}</label>
                                <form method="POST" action="{{ route('edit') }}">
                                    @csrf
                                    <button type="submit" style="border:none;background:#0000;width:85%;height:85%;">
                                    <img src="{{ asset('/img/open_icon.png') }}" style="width:25%;" />
                                    </button>
                                    <input type="hidden" value={{ $oc }} name="oc" id="oc" />
                                    <input type="hidden" value={{ $utext }} name="utext" id="utext" />
                                </form>
                                
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="margin-top:2.5%;display:flex;font-size:120%;">
                            系統回覆修改：
                        </div>
                    </div>
                    <form method="POST" action="{{ route('editMessage') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="Utxt" class="col-md-4 col-form-label text-md-right">使用者訊息</label>
                            <div class="col-md-6">
                                <input id="Utxt" type="text" class="form-control" name="Utxt" value="{{$utext}}" readonly />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="reType" class="col-md-4 col-form-label text-md-right">回覆類型</label>
                            <div class="col-md-6">
                                <select id="reType" name="reType" class="form-control">
                                    @if($reType=='text')
                                        <option value="text" selected>文字</option>
                                        <option value="img">圖片</option>
                                    @else
                                        <option value="text">文字</option>
                                        <option value="img" selected>圖片</option>
                                    @endif
                                </select> 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="re_txt" class="col-md-4 col-form-label text-md-right">系統回覆文字</label>
                            <div class="col-6">
                                <input id="re_txt" type="text" class="form-control" name="re_txt" value="{{$retext}}">
                            </div>
                        </div>
                        <div class="form-group row gx-5" style="margin-top:3%;">
                            <div class="col">
                                系統回覆圖片(大)<br>
                                @if($bimg!='')
                                    <img src="{{$bimg}}" class="re_img">
                                @else
                                    <label id="bImg" name="bImg">無</label>
                                @endif
                            </div>
                            <div class="col">
                                系統回覆圖片(小)<br>
                                @if($simg!='')
                                    <img src="{{$simg}}" class="re_img">
                                @else
                                    <label id="sImg" name="sImg">無</label>
                                @endif
                            </div>
                        </div>
                    </form>
                    <button type="submit" class="btn btn-primary smitBtn">送出</button>
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
  {{-- <script src="{{URL::asset('/js/datainsert.js')}}"></script> --}}
@endsection