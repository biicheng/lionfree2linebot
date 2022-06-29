@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            {{-- <div class="card"> --}}
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <a class="listA" href="{{route('selectText')}}" >
                        <div class="alert alert-success listDiv">
                            <img class="listImgStyle" src="{{asset('/img/textlist_128.png')}}" />
                            關鍵詞語列表.
                        </div>
                    </a>
                </div>
                <div class="col-md-5">
                    <a class="listA" href="{{route('insert')}}" >
                        <div class="alert alert-success listDiv">
                            <img class="listImgStyle" src="{{asset('/img/add_icon.png')}}" />
                            新增關鍵詞語.
                        </div>
                    </a>
                </div>
            </div>
            @if(Auth::id()==1)
                <div class="row justify-content-center ">
                    <div class="col-md-5">
                        <a class="listA" href="{{route('lineUser')}}" >
                            <div class="alert alert-primary listDiv">{{-- background:#d78af2; --}}
                                <img class="listImgStyle" src="{{asset('/img/users_128.png')}}" />
                                LineBot User.
                            </div>
                        </a>
                    </div>
                    <div class="col-md-5"></div>
                </div>
            @endif
                {{-- <a href="{{route('update')}}" style="text-decoration:none;">
                    <div class="alert alert-warning" style="margin-top:5%;border:1px #A9A9A9 solid;">
                        更新關鍵詞語.
                    </div>
                </a> --}}
                {{-- <a href="{{route('delet')}}" style="text-decoration:none;">
                    <div class="alert alert-danger" style="margin-top:5%;border:1px #A9A9A9 solid;">
                        刪除關鍵詞語.
                    </div>
                </a> --}}

                {{-- <div class="card-body"> --}}
                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif --}}

                    {{-- You are logged in!<br> --}}
                    @csrf
                    {{-- <a href="/select">select Link test.</a><br>
                    <a href="/insert">insert Link test.</a><br>
                    <a href="/update">update Link test.</a><br>
                    <a href="/delet">delet Link test.</a><br> --}}
                {{-- </div> --}}
            {{-- </div> --}}
        </div>
    </div>
</div>
@endsection

@section('content_css')
  <link href="{{ URL::asset('/css/home_css.css') }}" rel="stylesheet">
@endsection
