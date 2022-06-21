@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center loadUI">
        <div class="loadingUI">
            <div class="loadingUIDiv"><div style="padding-left:50%;"><div class="spinner-border loadingUIPinner-border" role="status"></div><div class="loadingUIText">請稍後...</div></div></div>
        </div>
        <div class="card-body col-md-8">
            <div class="card">
                <div class="card-header">新增回覆資訊.</div>
                @if($postT)
                    <div class="alert alert-{{$alert}} div-group row" role="alert">
                    <label class="col-form-label text-md-left" style="width:95%;">{{$alertT}}</label>
                    <label class="col-form-label text-md-right" style="width:5%;" onclick="winClose()"><a>X</a></label>
                    </div>
                @endif
                <div class="div-group row" role="alert" id="alert" style="display:none;margin:0;">
                    {{-- <div class="modal-dialog modal-lg">...</div> --}}
                <label class="col-form-label text-md-left" style="width:95%;" id="alertT"></label>
                <label class="col-form-label text-md-right" style="width:5%;" onclick="winClose()"><a>X</a></label>
                </div>
                <form method="POST" id="form" action="/insert" enctype="multipart/form-data" style="padding:0 1.5vh;">
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
                    <div class="form-group row botReText" style="margin-top:2.5vh;">
                        {{-- <label for="Utxt" class="col-md-12 col-form-label text-md-left">Bot回覆訊息</label>
                        <div class="col-md-6">
                            <input id="BotText" type="text" class="form-control" name="BotText" value="">
                        </div> --}}
                    </div>
                    {{-- <fieldset id="imgType">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="imgType" id="flexRadioDefault1" value="update" onclick="updaType(1)" disabled>上傳圖片
                            <label class="form-check-label" for="flexRadioDefault1"></label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="imgType" id="flexRadioDefault2" value="use" onclick="updaType(2)">使用圖片
                            <label class="form-check-label" for="flexRadioDefault2"></label>
                        </div>
                    </fieldset> --}}
                    <div class="imgD" id="imgD">
                        {{-- <div class="mb-3" style="margin-top:2.5vh;">
                          <label for="formFile" class="form-label">Bot回覆大圖</label>
                          <input class="form-control" type="file" id="bImg" name="bImg" accept=".png, .jpg, .jpeg" style="width:90%;">
                        </div>
                        <div class="mb-3" style="margin-top:2.5vh;">
                          <label for="formFile" class="form-label">Bot回覆小圖</label>
                          <input class="form-control" type="file" id="sImg" name="sImg" accept=".png, .jpg, .jpeg" style="width:90%;">
                        </div> --}}
                    </div>
                    <div class="imgFileDiv"></div>
                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                        </div>
                    </div>
                </form>
                <button type="button" class="btn btn-primary btn" id="isChecked" onclick="cli()">送出</button>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    let i = @json($bimg);
</script>

@section('content_css')
  <link href="{{ URL::asset('/css/dataInsert_css.css') }}" rel="stylesheet">
@endsection

@section('content_js')
  <script src="{{URL::asset('/js/datainsert.js')}}"></script>
@endsection