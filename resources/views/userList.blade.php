@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card-body col-md-10">
            <div class="card">
                <div class="card-header" style="margin-bottom:3vh;">Line Bot User List.</div>
                @if(count($d)==0)
                    <div>資料庫異常.</div>
                @else
                    <div class="row" style="font-size:120%;margin-bottom:2vh;">
                        <div class="col-md-6">使用者：</div>
                        <div class="col-md-6" style="display:flex;">狀態：</div>
                    </div>
                    @foreach($d as $v)
                        <div class="row" style="font-size:120%;margin-top:5%;">
                            <div class="col-md-6" style="font-size: 2.5vh;align-items: flex-end;display: flex;">
                                <img src="{{$v->uImgURL}}" style="width:6vh;">{{$v->uName}}
                            </div>
                            <div class="col-md-6" style="font-size: 2.5vh;align-items: flex-end;display: flex;">
                                {{$v->uTitleMessage}}
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection


@section('content_css')
  {{-- <link href="{{ URL::asset('/css/gotop.css') }}" rel="stylesheet"> --}}
@endsection

@section('content_js')
  {{-- <script src="{{URL::asset('/js/datainsert.js')}}"></script> --}}
@endsection