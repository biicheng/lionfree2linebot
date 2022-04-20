@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">系統回覆圖文</div>

                <div class="card-body">
                    {{-- <img src="{{asset('img/reset.png')}}" /> --}}
                    <div class="row">
                        <div class="col-md-12" style="margin-bottom:2.5%;display:flex;font-size:120%;">
                            狀態：
                            @if($messageD[0]['oc']==1)
                                    <label style="color:#0F0;">●</label>{{'啟用'}}</label>
                                    <form method="POST" action="{{ route('edit') }}">
                                        @csrf
                                        <button type="submit" style="border:none;background:#0000;width:85%;height:85%;">
                                        <img src="{{ asset('/img/close_icon.png') }}" style="width:25%;" />
                                        </button>
                                        <input type="hidden" value={{ $messageD[0]['oc'] }} name="oc" id="oc" />
                                        <input type="hidden" value={{ $messageD[0]['u_text'] }} name="utext" id="utext" />
                                    </form>
                                
                            @else
                                <label>
                                    <label style="color:#ffc400;">●{{'停用'}}</label>
                                    <form method="POST" action="{{ route('edit') }}">
                                        @csrf
                                        <button type="submit" style="border:none;background:#0000;width:85%;height:85%;">
                                        <img src="{{ asset('/img/open_icon.png') }}" style="width:50%;" />
                                        </button>
                                        <input type="hidden" value={{ $messageD[0]['oc'] }} name="oc" id="oc" />
                                        <input type="hidden" value={{ $messageD[0]['u_text'] }} name="utext" id="utext" />
                                    </form>
                                </label>
                                
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="margin-top:2.5%;display:flex;font-size:120%;">
                            系統回覆修改：
                        </div>
                    </div>
                    <form method="POST" action="{{ route('update') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="Utxt" class="col-md-4 col-form-label text-md-right">使用者訊息</label>
                            <div class="col-md-6">{{--autofocus--}}
                                <input id="Utxt" type="text" class="form-control" name="Utxt" value="{{$messageD[0]['u_text']}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="reType" class="col-md-4 col-form-label text-md-right">回覆類型</label>
                            <div class="col-md-6">
                                <select id="reType" name="reType" class="form-control">
                                    <option value="">-- 請選擇回覆類型 --</option>
                                    @if($messageD[0]['reType']=='text')
                                        <option value="text" selected>文字</option>
                                        <option value="img">圖片</option>
                                    @else
                                        <option value="text">文字</option>
                                        <option value="img" selected>圖片</option>
                                    @endif
                                </select> 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="re_txt" class="col-md-4 col-form-label text-md-right">系統回覆文字</label>
                            <div class="col-md-6">{{--autofocus--}}
                                <input id="re_txt" type="text" class="form-control" name="re_txt" value="{{$messageD[0]['re_text']}}">
                            </div>
                        </div>
                        <div class="form-group row" style="margin-top:3%;">
                            <label for="Utxt" class="col-md-4 col-form-label text-md-right">系統回覆圖片(大)</label>
                            <div class="col-md-6">{{--autofocus--}}
                                @if($messageD[0]['bImg']!='')
                                    <input type="text" class="form-control" value="{{$messageD[0]['bImg']}}" id="bImg" name="bImg" />
                                @else
                                    <input type="text" class="form-control" id="bImg" name="bImg">
                                @endif
                            </div>
                        </div>
                        <div class="form-group row" style="margin-top:3%;">
                            <label for="Utxt" class="col-md-4 col-form-label text-md-right">系統回覆圖片(小)</label>
                            <div class="col-md-6">{{--autofocus--}}
                                @if($messageD[0]['sImg']!='')
                                    <input type="text" class="form-control" value="{{$messageD[0]['sImg']}}" id="sImg" name="sImg" />
                                @else
                                    <input type="text" class="form-control" id="sImg" name="sImg">
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">送出</button>
                            </div>
                        </div>
                    </form>
                    <!-- <div class="alert alert-success" role="alert">
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
