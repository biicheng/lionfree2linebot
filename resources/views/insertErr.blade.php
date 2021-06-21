@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">系統訊息</div>
                <div class="card-body">
                    新增資訊 資料錯誤...
                    <div style="margin-top:2%;">
                        <input type="button"name="back" value="返回"onClick="javascript:history.back()">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
