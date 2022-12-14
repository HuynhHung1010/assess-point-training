@extends('admin.dashboard.index')
@section('content')
    <main>
        <h1 class="title">Quản lý tài khoản</h1>
            <ul class="breadcrumbs">
                <li><a href="{{route('admin.homead')}}">Home</a></li>
                <li class="divider">/</li>
                <li><a href="#" class="active">Quản lý tài khoản</a></li>
            </ul>
            <h2>{{$title}}</h2>
            <hr>
            @if (Session::has('erromsg'))
                @foreach (Session::get('erromsg') as $failures)
                    <div class="alert alert-danger" role="alert">
                        {{$failures->errors()[0]}} tại dòng số- {{$failures->row()}}
                    </div>
                @endforeach
            @endif
            @if ($errors-> any())
                <div class="alert alert-danger">Dữ liệu nhập vào không hợp lệ.Vui lòng nhập lại!</div>
            @endif
            <form action="{{route('admin.postaddtaikhoan')}}" method="POST" class="row mb-3" enctype="multipart/form-data">
                <div class="d-flex justify-content-center">
                    <div class="col-md-5">
                        <label for="inputEmail4" class="form-label">Import: </label>
                        <input type="file" class="form-control" id="file" name="file" placeholder="Tên file...">
                        @error('file')
                            <span style="color: red;">{{$message}}</span>
                        @enderror
                        </div>
                    </div>
                    @csrf
                    <div class="p-3 text-end">
                        <div class="col-12" style="margin-top: 10px;">
                            <button type="submit" class="btn btn-success">Thêm <i class="fa-solid fa-check"></i></button>
                            <a href="{{route('admin.taikhoan')}}" class="btn btn-danger">Trở về <i class="fa-solid fa-rotate-left"></i></a>
                        </div>
                    </div>
            </form>
    </main>
@endsection
