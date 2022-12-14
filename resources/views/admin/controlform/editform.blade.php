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
            @if (session('msg'))
                <div class="alert alert-success">{{session('msg')}}</div>
            @endif

            @if ($errors-> any())
                <div class="alert alert-danger">Dữ liệu nhập vào không hợp lệ.Vui lòng nhập lại!</div>
            @endif
            <hr>
            <form action="{{route('admin.posteditform')}}" method="POST" class="row mb-3" >
                <div class="col-md-4">
                    <label for="inputEmail4" class="form-label">Mã tiêu chí</label>
                    <input type="text" class="form-control" id="inputEmail4" name="matc" placeholder="Mã tiêu chí..." value="{{old('matc') ?? $formDetail->matc}}">
                    @error('matc')
                        <span style="color: red;">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="inputAddress" class="form-label">Tên tiêu chí</label>
                    <input type="text" class="form-control" id="inputAddress" name="tentc" placeholder="Tên tiêu chí..." value="{{old('tentc') ?? $formDetail->tentc}}">
                    @error('tentc')
                        <span style="color: red;">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="inputPassword4" class="form-label">Điểm tối đa</label>
                    <input type="text" class="form-control" id="inputPassword4" name="diemmax" placeholder="Điểm tối đa..." value="{{old('diemmax') ?? $formDetail->diemmax}}">
                    @error('diemmax')
                        <span style="color: red;">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="inputPassword4" class="form-label">Quyền của người dùng</label>
                    <select class="form-control" name="quyen">
                                {{-- <option value="0">Auto tính</option> --}}
                                <option value="1">Sinh viên</option>
                                <option value="2">GVCV</option>
                                <option value="3">Khoa</option>
                                <option value="4">PCTSV</option>
                                <option value="5">Đoàn khoa</option>
                    </select>
                    @error('quyen')
                        <span style="color: red;">{{$message}}</span>
                    @enderror
                </div>
                {{-- <div class="col-md-4">
                    <label for="inputPassword4" class="form-label">Điểm trung bình</label>
                    <select class="form-control" name="dtb">
                                <option value="0">TBHK sau lớn hơn </option>
                                <option value="1">Điểm trung bình</option>
                    </select>
                    @error('dtb')
                        <span style="color: red;">{{$message}}</span>
                    @enderror
                </div> --}}
                @csrf
                <div class="col-12 p-3">
                    <button type="submit" class="btn btn-success">Cập nhật <i class="fa-solid fa-arrow-up-from-bracket"></i></button>
                    <a href="{{route('admin.formad')}}" class="btn btn-danger">Trở về <i class="fa-solid fa-rotate-left"></i></a>
                </div>
        </form>
    </main>
@endsection
