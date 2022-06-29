@extends('layouts.app')

@section('content')
<div class="container">
    <div class="myUI">
        {{-- <div class="container">
            <div class="loadingUI"> --}}
                {{-- <div class="row" style="width:100%;">
                    <div class="row justify-content-center align-items-center" style="width:100%;height:10%;">
                        <div class="col-3 imgTitleStyle"></div>
                        <div class="col-6  imgTitleStyle imgTitleStyleC">請選擇圖片</div>
                        <div class="col-3 imgTitleStyle imgTitleStyleR"><span onclick="closeBox()">X</span></div>
                        <div class="col-12">
                            <div class="row justify-content-center align-items-center" style="width:100%;height:10%;">
                                <div class="col-3 imgTitleStyle"></div>
                                <div class="col-6  imgTitleStyle imgTitleStyleC">請選擇圖片</div>
                                <div class="col-3 justify-content-end imgTitleStyle imgTitleStyleR"><span onclick="closeBox()">X</span></div>
                            </div></div>
                    </div>
                </div> --}}
            {{-- </div>
        </div> --}}
    </div>
    {{-- <div class="loadingUI"> --}}
        {{-- <div style="padding-left:50%;"><div class="spinner-border loadingUIPinner-border" role="status"></div><div class="loadingUIText">請稍後...</div></div> --}}
        {{-- <div class="loadingUIDiv"><div style="padding-left:50%;"><div class="spinner-border loadingUIPinner-border" role="status"></div><div class="loadingUIText">請稍後...</div></div></div> --}}
    {{-- </div> --}}
    <div class="row justify-content-center">
        <div class="col-md-12">
            {{-- <div class="card"> --}}
                @if(Session::has('editErr'))
                    <div class="alert alert-danger">{{ Session::get('editErr') }}</div>
                @endif
                <div class="accordion marginTit" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                新增回覆資訊.
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                {{-- <div class="card-header">新增回覆資訊.</div> --}}
                                <div class=myAlert></div>
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
                                關鍵詞與
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                {{-- <div class="card-header">Select bland</div> --}}
                                <div class="card-body">
                                    @if($messageRow>0)
                                        @foreach($messageD as $v)
                                            <div class="row" style="font-size:2.5vh;margin-top:4.5vh;">
                                                <div class="col-md-6">
                                                    字串：{{$v->u_text}}
                                                </div>
                                                <div class="col-md-3" style="display:flex;">
                                                    狀態：
                                                    @if($v->oc==1)
                                                        <label style="color:#0F0;">●</label>{{'啟用'}}
                                                        
                                                    @else
                                                        <label><label style="color:#ffc400;">●{{'停用'}}</label></label>
                                                        
                                                    @endif
                                                </div>
                                                <div class="col-md-3" style="display:flex;padding-top:-3%;">
                                                    <a href="edit/{{$v->mIndex}}">
                                                        <img src="{{asset('/img/edit_icon.png')}}" style="width:4.3vh;" />
                                                    </a>
                                                    @if($v->oc==1)
                                                        <form method="POST" action="{{route('edit')}}" style="margin:0 2.5vh;">
                                                            @csrf
                                                            <button type="submit" style="border:none;background:#0000;">
                                                            <img src="{{ asset('/img/close_icon.png') }}" style="width:4.3vh;" />
                                                            </button>
                                                            <input type="hidden" value={{$v->oc}} name="oc" id="oc" />
                                                            <input type="hidden" value={{$v->u_text}} name="utext" id="utext" />
                                                        </form>
                                                    @else
                                                    <form method="POST" action="{{route('edit')}}" style="margin:0 2.5vh;">
                                                        @csrf
                                                        <button type="submit" style="border:none;background:#0000;">
                                                        <img src="{{asset('/img/open_icon.png')}}" style="max-width:4.3vh;" />
                                                        </button>
                                                        <input type="hidden" value={{$v->oc}} name="oc" id="oc" />
                                                        <input type="hidden" value={{$v->u_text}} name="utext" id="utext" />
                                                    </form>
                                                    @endif
                                                    @if(Auth::id()==1)
                                                        <a href="edit/{{$v->mIndex}}">
                                                            <img src="{{asset('/img/delect_icon.png')}}" style="width:4.3vh;" />
                                                        </a>
                                                    {{-- <div class="col-md-2" style="display:flex;">
                                                        刪除
                                                        <form method="POST" action="{{route('messageDelete')}}" style="margin-left:2.5vh;">
                                                            @csrf
                                                            <button type="submit" style="border:none;background:#0000;">
                                                            <img src="{{ asset('/img/delect_icon.png') }}" style="width:4.3vh;" />
                                                            </button>
                                                            <input type="hidden" value={{$v->oc}} name="oc" id="oc" />
                                                            <input type="hidden" value={{$v->u_text}} name="utext" id="utext" />
                                                        </form>
                                                    </div> --}}
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- </div> --}}
        </div>
    </div>
</div>
@if(Auth::id()==1)
@endif
@endsection

@section('content_css')
  <link href="{{ URL::asset('/css/selectText_css.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('/css/dataInsert_css.css') }}" rel="stylesheet">
@endsection

@section('content_js')
  <script src="{{URL::asset('/js/datainsert.js')}}"></script>
  {{-- <script src="{{URL::asset('/js/datainsert.js')}}"></script> --}}
@endsection