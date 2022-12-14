@extends('admin.dashboard.index')
@section('content')
    <main>
        <h1 class="title">Quản lý biểu mẫu</h1>
            <ul class="breadcrumbs">
                <li><a href="{{route('admin.homead')}}">Home</a></li>
                <li class="divider">/</li>
                <li><a href="#" class="active">Quản lý biểu mẫu</a></li>
            </ul>
            <h2>{{$title}}</h2>
            <hr>
            @if (session('msg'))
                <div class="alert alert-success">{{session('msg')}}</div>
            @endif

            @if ($errors-> any())
                <div class="alert alert-danger">Dữ liệu nhập vào không hợp lệ.Vui lòng nhập lại!</div>
            @endif
            <form action="{{route('admin.addmucform')}}" method="POST" class="row mb-3" >
                @csrf
                {{-- <div class="border border-dark"> --}}
                    <div class="col-md-4">
                    <label for="inputEmail4" class="form-label">Tổng điểm tối đa</label>
                    <input type="text" class="form-control" id="inputEmail4" name="muc" placeholder="Tổng điểm tối đa..."  value="{{old('muc')}}">
                    @error('muc')
                        <span style="color: red;">{{$message}}</span>
                    @enderror
                    </div>
                    <div class="col-12 p-3">
                        <button type="submit" class="btn btn-success">Cập nhật <i class="fa-solid fa-arrow-up-from-bracket"></i></button>
                        <a href="{{route('admin.formad')}}" class="btn btn-danger">Trở về <i class="fa-solid fa-rotate-left"></i></a>
                    </div>
            </form>
    </main>
@endsection
