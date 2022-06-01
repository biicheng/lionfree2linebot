@extends('layouts.app')

@section('content')
<div class="container" style="height:100%;">
    <div class="row justify-content-center" style="z-index:999;">
        <div class="card-body col-md-10">
            <div class="card">
                <div class="card-header" style="margin-bottom:3vh;">Line Bot User List.</div>
                @if(count($d)>0)
                    {{-- <div class="row" style="font-size:120%;margin-bottom:2vh;">
                        <div class="col-md-6">使用者：</div> style="padding:0 1.5vh;"
                        <div class="col-md-6" style="display:flex;">狀態：</div>
                    </div> --}}
                    <div class="container">
                        <div class="row row-cols-4">
                            <div class="col-3 row_col3">使用者</div>
                            <div class="col row_col">狀態</div>
                            <div class="col row_col">加入時間</div>
                            <div class="col row_col">更新時間</div>
                        </div>
                        @foreach($d as $v)
                            <div class="row row-cols-4 row_4">
                                <div class="col-3 row_col3_text"><img src="{{$v->uImgURL}}" class="row_col3_img" onclick="enlargeImg('{{$v->uImgURL}}')"><span onclick="enlargeText('{{$v->uName}}')">{{$v->uName}}</span></div>
                                <div class="col row_col">{{$v->uTitleMessage}}</div>
                                <div class="col row_col">{{$v->createTime}}</div>
                                <div class="col row_col">{{$v->updateTime}}</div>
                            </div>
                        @endforeach
                    </div>
                @else
                    @if(count($d)==0)
                        <div class="alert alert-warning" role="alert">
                            無使用者資料.
                        </div>
                    @else
                        @if($code==0)
                            <div class="alert alert-danger" role="alert">
                                資料庫異常.
                            </div>
                        @else
                            <div class="alert alert-danger" role="alert">
                                異常錯誤，請稍後再試.
                            </div>
                        @endif
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection


@section('content_css')
  <link href="{{ URL::asset('/css/userList_css.css') }}" rel="stylesheet">
@endsection

@section('content_js')
  {{-- <script src="{{URL::asset('/js/datainsert.js')}}"></script> --}}
@endsection