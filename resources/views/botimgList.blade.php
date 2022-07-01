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
                                    <label for="imgUrl" class="col-md-12 col-form-label text-md-left">圖片路徑位置:</label>
                                    <div class="col-md-7">
                                        <input id="iUrl" type="text" class="form-control" name="imgUrl" value="" required autofocus>
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
                                            <option value="...">-- 請選擇回覆類型 --</option>
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
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            關鍵詞與
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="card-body">
                                @if(count($allImg)>0)
                                    @foreach($allImg as $v)
                                        <div class="row" style="font-size:2.5vh;margin-top:4.5vh;">
                                            <div class="col-3">
                                                <img src="{{asset($v->url.$v->imgName)}}" style="width:10vh;" />
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
                                                            {{-- {{$v->op==(0||1)?$v->op==1?'開啟':'關閉':'---'}} --}}
                                                            @if($v->op==1)
                                                                <img src="{{asset('/img/open_icon.png')}}" style="max-width:4.3vh;" />
                                                            @else
                                                                @if($v->op==0)
                                                                    <img src="{{asset('/img/close_icon.png')}}" style="width:4.3vh;" />
                                                                @else ---
                                                                @endif
                                                            @endif
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2 align-self-center" style="text-align:center;">
                                                {{--  justify-content-center justify-content-between align-items-center  --}}
                                                <img src="{{asset('/img/edit_icon.png')}}" style="width:4vh;" />
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
  <script src="{{URL::asset('/js/botimgList.js')}}"></script>
@endsection