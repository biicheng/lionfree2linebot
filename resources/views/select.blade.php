@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Select bland</div>
                <div class="card-body">
                    @if(Session::has('editErr'))
                        <div class="alert alert-danger">{{ Session::get('editErr') }}</div>
                    @endif
                    @if($messageRow>0)
                        @foreach($messageD as $v)
                            <div class="row" style="font-size:2.5vh;margin-top:4.5vh;">
                                <div class="col-md-6">
                                    字串：{{$v->u_text}}
                                </div>
                                <div class="col-md-3" style="display:flex;">
                                    狀態：
                                    @if($v->oc==1)
                                        <label style="color:#0F0;">●</label>{{'啟用'}}
                                        
                                    @else
                                        <label><label style="color:#ffc400;">●{{'停用'}}</label></label>
                                        
                                    @endif
                                </div>
                                <div class="col-md-3" style="display:flex;padding-top:-3%;">
                                    <a href="edit/{{$v->mIndex}}">
                                        <img src="{{asset('/img/edit_icon.png')}}" style="width:4.3vh;" />
                                    </a>
                                    @if($v->oc==1)
                                        <form method="POST" action="{{route('edit')}}" style="margin:0 2.5vh;">
                                            @csrf
                                            <button type="submit" style="border:none;background:#0000;">
                                            <img src="{{ asset('/img/close_icon.png') }}" style="width:4.3vh;" />
                                            </button>
                                            <input type="hidden" value={{$v->oc}} name="oc" id="oc" />
                                            <input type="hidden" value={{$v->u_text}} name="utext" id="utext" />
                                        </form>
                                    @else
                                       <form method="POST" action="{{route('edit')}}" style="margin:0 2.5vh;">
                                           @csrf
                                           <button type="submit" style="border:none;background:#0000;">
                                           <img src="{{asset('/img/open_icon.png')}}" style="max-width:4.3vh;" />
                                           </button>
                                           <input type="hidden" value={{$v->oc}} name="oc" id="oc" />
                                           <input type="hidden" value={{$v->u_text}} name="utext" id="utext" />
                                       </form>
                                    @endif
                                    @if(Auth::id()==1)
                                        <a href="edit/{{$v->mIndex}}">
                                            <img src="{{asset('/img/delect_icon.png')}}" style="width:4.3vh;" />
                                        </a>
                                    {{-- <div class="col-md-2" style="display:flex;">
                                        刪除
                                        <form method="POST" action="{{route('messageDelete')}}" style="margin-left:2.5vh;">
                                            @csrf
                                            <button type="submit" style="border:none;background:#0000;">
                                            <img src="{{ asset('/img/delect_icon.png') }}" style="width:4.3vh;" />
                                            </button>
                                            <input type="hidden" value={{$v->oc}} name="oc" id="oc" />
                                            <input type="hidden" value={{$v->u_text}} name="utext" id="utext" />
                                        </form>
                                    </div> --}}
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif

                    {{-- <img src="{{ asset('/img/open_icon.png') }}" style="width:45%;" /> --}}
                {{-- </div> --}}
                    <!-- <div class="alert alert-success" role="alert">
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
@if(Auth::id()==1)
@endif
@endsection
