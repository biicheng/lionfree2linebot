@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            {{-- <div class="card"> --}}
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <a href="{{route('selectText')}}" style="text-decoration:none;">
                        <div class="alert alert-success listDiv">
                            <img class="listImgStyle" src="{{asset('/img/textlist_128.png')}}" />
                            關鍵詞語列表.
                        </div>
                    </a>
                </div>
                <div class="col-md-5">
                    <a href="{{route('insert')}}" style="text-decoration:none;">
                        <div class="alert alert-success listDiv">
                            <img class="listImgStyle" src="{{asset('/img/add_icon.png')}}" />
                            新增關鍵詞語.
                        </div>
                    </a>
                </div>
            </div>
            {{-- background:#d78af2; --}}
            {{-- <div class="row justify-content-center ">
                <div class="col-md-5">
                    <a href="{{route('manageBotImg')}}" style="text-decoration:none;">
                        <div class="alert alert-primary listDiv">
                            <img class="listImgStyle" src="{{asset('/img/requesImg_noback.png')}}" />
                            Bot回覆圖片管理
                        </div>
                    </a>
                </div>
                <div class="col-md-5"></div>
            </div> --}}
            @if(Auth::id()==1)
                <div class="row justify-content-center ">
                    <div class="col-md-5">
                        <a href="{{route('lineUser')}}" style="text-decoration:none;">
                            <div class="alert alert-primary listDiv">
                                <img class="listImgStyle" src="{{asset('/img/users_128.png')}}" />
                                LineBot User.
                            </div>
                        </a>
                    </div>
                    <div class="col-md-5">
                        <a href="{{route('manageBotImg')}}" style="text-decoration:none;">
                            <div class="alert alert-primary listDiv">
                                <img class="listImgStyle" src="{{asset('/img/requesImg_noback.png')}}" />
                                Bot回覆圖片管理
                            </div>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('content_css')
  <link href="{{ URL::asset('/css/home_css.css') }}" rel="stylesheet">
@endsection
