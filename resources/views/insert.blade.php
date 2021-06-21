@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Insert bland</div>
                            <!--  style="display:flex;" -->
                <div class="card-body">
                    @if($postT)
                        <div class="alert alert-{{$alert}} div-group row" role="alert">
                        <label class="col-form-label text-md-left" style="width:95%;">{{$alertT}}</label>
                        <label class="col-form-label text-md-right" style="width:5%;" onclick="winClose()"><a>X</a></label>
                        </div>
                    @endif
                     {{-- method="POST" action="{{ route('insert') }}" --}}
                    <form method="POST" action="{{ route('insert') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="Utxt" class="col-md-4 col-form-label text-md-right">使用者訊息</label>
                            <div class="col-md-6">
                                <input id="Utxt" type="text" class="form-control" name="Utxt" value="" required autofocus>
                                <!-- @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="reType" class="col-md-4 col-form-label text-md-right">回覆類型</label>
                            <!-- <div class="col-md-6">
                                <input id="reType" type="text" class="form-control @error('password') is-invalid @enderror" name="reType">
                            </div> -->
                            <div class="col-md-6">
                                <select id="reType" name="reType" class="form-control">
                                    <option value="">-- 請選擇回覆類型 --</option>
                                    <option value="text">文字</option>
                                    <option value="img">圖片</option>
                                </select> 
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">送出</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
