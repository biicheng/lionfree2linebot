@extends('layouts.app')

@section('content')
<div class="container" style="margin-top:3vh;">
    <div class="myUI"></div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(Session::has('editErr'))
                <div class="alert alert-danger">{{ Session::get('Err') }}</div>
            @endif
            <div class="accordion marginTit" id="accordionExample">
                @if(Auth::id()==1)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                上傳新增圖片
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class=myAlert></div>
                                <form method="POST" id="form" action="/insert" enctype="multipart/form-data" style="padding:0 2.5vh;">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="imgUrl" class="col-md-12 col-form-label text-md-left">圖片路徑網址:</label>
                                        <div class="col-md-7">
                                            <label id="iUrl" type="text">https://mytpl6.herokuapp.com</label>
                                            {{-- <input id="iUrl" type="text" class="form-control" name="iUrl" value="" required autofocus> --}}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="imgDir" class="col-md-12 col-form-label text-md-left">圖片資料夾:</label>
                                        <div class="col-md-7">
                                            <label id="iDir" type="text">img/linebot_img</label>
                                            {{-- <input id="iDir" type="text" class="form-control" name="imgDir" value="" required autofocus> --}}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="imgName" class="col-md-12 col-form-label text-md-left">圖片名稱:</label>
                                        <div class="col-md-7">
                                            <input id="imgName" type="text" class="form-control" name="imgName" value="" required autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group row" style="margin-top:2.5vh;">
                                        <label for="imgType" class="col-md-12 col-form-label text-md-left">圖片副檔名</label>
                                        <div class="col-md-6">
                                            <select id="imgType" name="imgType" class="form-control" onchange="uType(this.options[this.options.selectedIndex].value)">
                                                <option value="...">-- 請選副檔名 --</option>
                                                <option value="jpg">.jpg</option>
                                                <option value="png">.png</option>
                                            </select> 
                                        </div>
                                    </div>
                                </form>
                                <button type="button" class="btn btn-primary sumBtn" id="isChecked" onclick="cli()">送出</button>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            圖片列表
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse {{Auth::id()==1?'':'show'}}" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="card-body">
                                @if(count($allImg)>0)
                                    @foreach($allImg as $v)
                                        <div class="row" style="font-size:2.5vh;margin-top:4.5vh;">
                                            <div class="col-3">
                                                <img src="{{asset($v->url.$v->filedir.$v->imgName)}}" style="width:10vh;" />
                                            </div>
                                            <div class="col-7" style="display:flex;padding-top:-3%;">
                                                <div class="row">
                                                    <div class="col-12 single_ellipsis">
                                                        <label class="single_ellipsis">圖片位置: <br>{{$v->url}}</label>
                                                    </div>
                                                    <div class="col-12 single_ellipsis">
                                                        <label class="single_ellipsis">圖片名稱: <br>{{$v->imgName}}</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <label>圖片類別: {{$v->imgType==('b'||'s')?$v->imgType=='b'?'大圖':'小圖':'---'}}</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <label>圖片狀態:
                                                            <img src="{{asset($v->op==1?'/img/open_icon.png':'/img/close_icon.png')}}" style="width:4vh;" />
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2 align-self-center" style="text-align:center;">
                                                <div class="row" style="margin-top:2vh;">
                                                    @if(Auth::id()==1)
                                                        <div class="col-md-4" style="margin-top:1.5vh;">
                                                            <img src="{{asset('/img/edit_icon.png')}}" style="width:4vh;" />
                                                        </div>
                                                    @endif
                                                    <div class="col-md-{{Auth::id()==1?'4':'6'}}" style="margin-top:1.5vh;">
                                                        <img src="{{asset('/img/replay_121.png')}}" style="width:4vh;" />
                                                    </div>
                                                    <div class="col-md-{{Auth::id()==1?'4':'6'}}" style="margin-top:1.5vh;">
                                                        <img src={{asset($v->op==1?"/img/close_icon.png":"/img/open_icon.png")}} id="statusImg" style="width:4vh;" onclick="changeStatus('{{$v->imgName}}')" disabled />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
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
    <link href="{{ URL::asset('/css/botimgList_css.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('/css/dataInsert_css.css') }}" rel="stylesheet">
@endsection

@section('content_js')
    @if(Auth::id()==1)
        <script src="{{URL::asset('/js/botimgList.js')}}"></script>
    @endif
    <script src="{{URL::asset('/js/botimgStatus.js')}}"></script>
    <script src="/js/3.6.0.jquery.js" defer></script>
@endsection