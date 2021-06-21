@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- <div class="card"> --}}
                <a href="{{route('select')}}" style="text-decoration:none;">
                    <div class="alert alert-success" style="border:1px #A9A9A9 solid;">
                        查詢關鍵詞語.
                    </div>
                </a>
                <a href="{{route('insert')}}" style="text-decoration:none;">
                    <div class="alert alert-primary" style="margin-top:5%;border:1px #A9A9A9 solid;">
                        新增關鍵詞語.
                    </div>
                </a>
                <a href="{{route('update')}}" style="text-decoration:none;">
                    <div class="alert alert-warning" style="margin-top:5%;border:1px #A9A9A9 solid;">
                        更新關鍵詞語.
                    </div>
                </a>
                <a href="{{route('delet')}}" style="text-decoration:none;">
                    <div class="alert alert-danger" style="margin-top:5%;border:1px #A9A9A9 solid;">
                        刪除關鍵詞語.
                    </div>
                </a>

                {{-- <div class="card-body"> --}}
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

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
