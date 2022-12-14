@extends('admin.dashboard.index')
@section('content')
    <main>
        <h1 class="title">Quản lý năm học-học kỳ</h1>
        <ul class="breadcrumbs">
            <li><a href="{{route('admin.homead')}}">Home</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">Quản lý năm học-học kỳ</a></li>
        </ul>
            <h2>{{$title}}</h2>
            @if (session('msg'))
                <div class="alert alert-success">{{session('msg')}}</div>
            @endif

            @if ($errors-> any())
                <div class="alert alert-danger">Dữ liệu nhập vào không hợp lệ.Vui lòng nhập lại!</div>
            @endif
            <hr>
            <form action="{{route('admin.postedithk')}}" method="POST" class="row mb-3" >
                    <div class="col-mb-3">
                    <label for="inputEmail4" class="form-label">Tên học kỳ</label>
                    <input type="text" class="form-control" id="hk" name="hk" placeholder="Tên học kỳ..." value="{{old('hk') ?? $formDetail->tenhk}}">
                    @error('hk')
                        <span style="color: red;">{{$message}}</span>
                    @enderror
                    </div>
                    @csrf
                    <div class="col-12" style="margin-top: 10px;">
                        <button type="submit" class="btn btn-success">Cập nhật <i class="fa-solid fa-arrow-up-from-bracket"></i></button>
                        <a href="{{route('admin.listhk')}}" class="btn btn-danger">Trở về <i class="fa-solid fa-rotate-left"></i></a>
                    </div>
            </form>
    </main>
@endsection
