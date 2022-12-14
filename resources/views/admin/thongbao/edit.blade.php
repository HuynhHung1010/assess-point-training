@extends('admin.dashboard.index')
@section('content')
    <main>
        <h1 class="title">Quản lý thông báo</h1>
            <ul class="breadcrumbs">
                <li><a href="{{route('admin.homead')}}">Home</a></li>
                <li class="divider">/</li>
                <li><a href="#" class="active">Quản lý thông báo</a></li>
            </ul>
            <h2>{{$title}}</h2>
            <hr>
            @if (session('msg'))
                <div class="alert alert-success">{{session('msg')}}</div>
            @endif

            @if ($errors-> any())
                <div class="alert alert-danger">Dữ liệu nhập vào không hợp lệ.Vui lòng nhập lại!</div>
            @endif
            <form action="{{route('admin.postaddtb')}}" method="POST" class="row mb-3" >
                @csrf
                {{-- <div class="border border-dark"> --}}
                    <div class="col-md-11 pb-3">
                        <label for="inputEmail4" class="form-label">Tiêu đề thông báo</label>
                        <input type="text" class="form-control" id="inputEmail4" name="td" placeholder="Tiêu đề thông báo..." value="{{old('td') ?? $formDetail->tieude}}">
                        @error('td')
                            <span style="color: red;">{{$message}}</span>
                        @enderror
                    </div>
                    <br>
                    <div class="field">
                        <div class="control">
                          <textarea class="textarea"  name="nd" rows="7" cols="130" placeholder="Nội dung...." style="padding-top: 10px;" value="{{old('nd') ?? $formDetail->noidung}}"></textarea>
                        </div>
                        @error('nd')
                            <span style="color: red;">{{$message}}</span>
                        @enderror
                      </div>
                    <div class="col-12" style="margin-top: 10px;">
                        <button type="submit" class="btn btn-success">Cập nhật <i class="fa-solid fa-arrow-up-from-bracket"></i></button>
                        <a href="{{route('admin.thongbao')}}" class="btn btn-danger">Trở về <i class="fa-solid fa-rotate-left"></i></a>
                    </div>
            </form>
    </main>
@endsection
