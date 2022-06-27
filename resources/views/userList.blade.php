@extends('layouts.app')

@section('content')
<div class="container" style="height:100%;">
    <div class="allWindowUI">
        {{-- <div class="UIDivTitle" onclick="UIDivTitleClose()">X</div>
        <div class="row justify-content-center uiStyle">
            <div class="col-12 UIText">
                <img class="jsUserImg" src="https://sprofile.line-scdn.net/0hkR3lSH57NH0eFR1roRRKAm5FNxc9ZG1vZyQpHClHakhzcnZ_MCFzHCwdah93d3Z4NXpzG3gcaEUSBkMbAEPISRklakonIXcuNnJ-kg">
            </div>
            <div class="col-12 UIText">請稍後...</div>
        </div> --}}
    </div>
    <div class="row justify-content-center" style="z-index:999;">
        <div class="card-body col-md-12">
            <div class="card">
                <div class="card-header" style="margin-bottom:3vh;">Line Bot User List.</div>
                @if(count($d)>0)
                    {{-- <div class="row" style="font-size:120%;margin-bottom:2vh;">
                        <div class="col-md-6">使用者：</div> style="padding:0 1.5vh;"
                        <div class="col-md-6" style="display:flex;">狀態：</div>
                    </div> --}}
                    <div class="container">
                        <div class="row row_tit">
                            <div class="col-3 colText">User</div>
                            <div class="col-7 colText">資訊</div>
                            <div class="col-2 colText">更新</div>
                        </div>
                        @foreach($d as $v)
                            <div class="row row_4">
                                <div class="col-3 colText">
                                    <img src="{{$v->uImgURL}}" class="row_col3_img" onclick="allWindowUI('{{$v->uImgURL}}','{{$v->uName}}')" />
                                </div>
                                <div class="col-7 colText">
                                    <div class="row">
                                    <div class="col-12 colText">使用者: {{$v->uName}}</div>
                                    <div class="col-12">狀態列: {{$v->uTitleMessage}}</div>
                                    <div class="col-12">建立時間: {{$v->createTime}}</div>
                                    </div>
                                </div>
                                <div class="col-2 colText"><img src="{{asset('img/replay_121.png')}}" class="replayImg" onclick="updateUser('{{$v->uid}}')"></div>
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
    {{-- <script src="{{URL::asset('/js/jquery_360min.js')}}"></script> --}}
    <script src="{{URL::asset('/js/userList_js.js')}}"></script>
@endsection