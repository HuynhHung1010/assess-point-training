@extends('clients.layout.layouthome')


@section('content')
<div class="p-3 border">
    <main>
        <ul class="breadcrumbs">
            <li><a href="{{route('home')}}" class="home">Trang chủ</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">Khoa</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">Cập nhật chức vụ</a></li>
        </ul>
    </main>
    <div class="text-center">
        <h2>{{$title}}</h2>
            @if (session('msg'))
                    <div class="alert alert-success">{{session('msg')}}</div>
            @endif
        </div>
        <hr>
        <div class="ps-4 d-flex flex-row mb-3">
            @if (!empty($sv))
                @foreach ($sv as $key => $i)
                    <p style="font-size: 18px"><b>MSSV:</b><span style="font-weight: 800;color: #34BE82;padding-right: 10px;">{{$i->mssv}}</span></p>
                    <p style="font-size: 18px"><b>Họ tên Sinh viên:</b><span style="font-weight: 800;color: #34BE82;padding-right: 10px;">{{$i->hoten}}</span></p>
                    <p style="font-size: 18px"><b>Chức vụ:</b><span style="font-weight: 800;color: #34BE82;padding-right: 10px;">{{$i->chucvudoan}},{{$i->chucvu}}</span></p>
                    <p style="font-size: 18px"><b>Gmail:</b><span style="font-weight: 800;color: #34BE82;padding-right: 10px;">{{$i->gmail}}</span></p>
                @endforeach
            @else
                <h3>Không có dữ liệu</h3>
            @endif
        </div>
        <form action="{{route('khoa.postchucvu')}}" method="POST">
            <input type="hidden" name="idsv" value="{{$idsv}}">
        <div class="d-flex justify-content-center">
            <div class="col-4 pe-4">
                <label for="inputEmail4" class="form-label">Tên chức vụ đoàn </label>
                <select class="form-control" name="chucvud">
                    <option value="Bí thư">Bí thư</option>
                    <option value="Phó bí thư">Phó bí thư</option>
                    <option value="Ủy viên">Ủy viên</option>
                    <option value=""></option>
                </select>
                {{-- <input type="text" name="chucvu" value="{{old('chucvu') ?? $item->chucvu}}"> --}}
            </div>
            @error('chucvud')
                <span style="color: red;">{{$message}}</span>
            @enderror

            <div class="col-4">
                <label for="inputEmail4" class="form-label">Tên chức vụ lớp học</label>
                <select class="form-control" name="chucvu">
                    <option value="Lớp trưởng">Lớp trưởng</option>
                    <option value="Lớp phó học tập">Lớp phó học tập</option>
                    <option value="Lớp phó lao động">Lớp phó lao động</option>
                    <option value="Lớp phó đoàn thể">Lớp phó đoàn thể</option>
                    <option value=""></option>
                </select>
                {{-- <input type="text" name="chucvu" value="{{old('chucvu')  ?? $item->chucvu}}"> --}}
            </div>
            @error('chucvu')
                <span style="color: red;">{{$message}}</span>
            @enderror
        </div>
            @csrf
            <div class="p-3 text-end">
                <div class="col-12" style="margin-top: 10px;">
                    <button type="submit" class="btn btn-success">Cập nhật <i class="fa-solid fa-check"></i></button>
                    <a href="{{route('khoa.chucvulop')}}" class="btn btn-danger">Trở về <i class="fa-solid fa-rotate-left"></i></a>
                </div>
            </div>
    </form>
</div>
@endsection
