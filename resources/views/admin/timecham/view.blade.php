@extends('admin.dashboard.index')
@section('content')
    <main>
        <h1 class="title">Quản lý thời gian chấm</h1>
        <ul class="breadcrumbs">
            <li><a href="{{route('admin.homead')}}">Home</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">Quản lý thời gian chấm</a></li>
        </ul>
        <h1>{{$title}}</h1>
        @if (session('msg'))
                <div class="alert alert-success">{{session('msg')}}</div>
        @endif
        @if (session('msgerro'))
                <div class="alert alert-danger">{{session('msgerro')}}</div>
        @endif
        <hr>
        <div class="pb-3 d-flex justify-content-end">
            <a href="{{route('admin.addtime')}}" class="btn btn-success">+ Thêm thời gian</a>
        </div>
        {{-- <b>Tổng điểm của phiếu chấm:</b>
        @if (!empty($Tongdiem))
                @foreach ($Tongdiem as $key => $item)
                <b style="color: red;padding-bottom: 10px;">{{$item->tongdiem}}</b>
                @endforeach
        @else
            <p>Không có dữ liệu</p>
        @endif --}}
        <table class="table table-bordered">
            <thead class="table-primary align-items-center text-align-center">
                <tr>
                    <th width="5%">STT</th>
                    <th>Năm học</th>
                    <th>Học kỳ</th>
                    <th>sinh viên bắt đầu</th>
                    <th>sinh viên kết thúc</th>
                    <th>Giáo viên bắt đầu</th>
                    <th>Giáo viên kết thúc</th>
                    <th>Đoàn khoa bắt đầu</th>
                    <th>Đoàn khoa kết thúc</th>
                    <th>Khoa bắt đầu</th>
                    <th>Khoa kết thúc</th>
                    <th>Hạn lập phiếu</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($timeList))
                @foreach ($timeList as $key => $item)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$item->tennam}}</td>
                    <td>{{$item->tenhk}}</td>
                    <td>{{$item->ngaysvbd}}</td>
                    <td>{{$item->ngaysvkt}}</td>
                    <td>{{$item->ngaygvbd}}</td>
                    <td>{{$item->ngaygvkt}}</td>
                    <td>{{$item->ngaydbd}}</td>
                    <td>{{$item->ngaydkt}}</td>
                    <td>{{$item->ngaykbd}}</td>
                    <td>{{$item->ngaykkt}}</td>
                    <td>{{$item->hanlapphieu}}</td>
                    <td><a href="{{route('admin.edittime', ['idt'=>$item->id])}}" class="btn btn-outline-info"><i class="fa-solid fa-pen-to-square"></i></a></td>
                    <td><a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="{{route('admin.deletetime', ['idt'=>$item->id])}}" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a></td>
                </tr>
                @endforeach
                @else
                    <tr>
                        <td colspan="10">Không có dữ liệu</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </main>
@endsection
