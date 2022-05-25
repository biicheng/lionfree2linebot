@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card-body col-md-8">
            <div class="card">
                <div class="card-header">Line Bot User List.</div>
                @if(count($d)>0)
                    <div>資料庫異常.</div>
                @else
                    @foreach($d as $v)
                    <div>
                        <label>User: {{$v['name']}}</label>
                        <label>eMail: {{$v['email']}}</label>
                        {{-- <label><img src="{{$v['uImgURL']}}">{{$v['uName']}}</label>
                        <label>{{$v['uTitleMessage']}}</label> --}}
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