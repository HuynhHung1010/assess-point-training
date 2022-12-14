@extends('admin.dashboard.index')
@section('content')
    <main>
        <h1 class="title">Quản lý tiêu chí</h1>
        <ul class="breadcrumbs">
            <li><a href="{{route('admin.homead')}}">Home</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">Quản lý tiêu chí</a></li>
        </ul>
        <h1>{{$title}}</h1>
        @if (session('msg'))
                <div class="alert alert-success">{{session('msg')}}</div>
        @endif
        @if (session('msgerro'))
                <div class="alert alert-danger">{{session('msgerro')}}</div>
        @endif
        <hr>
        <div class="d-flex justify-content-start">
            <a href="{{route('admin.addmucform')}}" class="btn btn-primary">Update tổng điểm</a>
        </div>
        <div class="d-flex justify-content-end">
            <a href="{{route('admin.addform')}}" class="btn btn-success">+ Thêm tiêu chí</a>
        </div>
        <b>Tổng điểm của phiếu chấm:</b>
        @if (!empty($muc))
                @foreach ($muc as $key => $i)
                <b style="color: red;padding-bottom: 10px;">{{$i->muc}}</b>
                @endforeach
        @else
            <p>Không có dữ liệu</p>
        @endif
        <br>
        <b>Tổng điểm đã nhập của phiếu chấm:</b>
        @if (!empty($Tongdiem))
                @foreach ($Tongdiem as $key => $item)
                <b style="color: red;padding-bottom: 10px;">{{$item->tongdiem}}</b>
                @endforeach
        @else
            <p>Không có dữ liệu</p>
        @endif
        <table class="table table-bordered">
            <thead class="table-primary">
                <tr>
                    <th width="5%">STT</th>
                    <th width="5%">Mã tiêu chí</th>
                    <th>Tên tiêu chí</th>
                    <th width="14%">Quyền</th>
                    <th width="5%">Điểm tối đa</th>
                    <th width="5%">Sửa</th>
                    <th width="5%">Xóa</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($formList))
                @foreach ($formList as $key => $item)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$item->matc}}</td>
                    <td>{{$item->tentc}}</td>
                    <td>
                    @switch($item->quyen)
                        @case(0)
                            <p>Tự động tính điểm</p>
                            @break
                        @case(1)
                            <p>Sinh viên</p>
                            @break
                        @case(2)
                            <p>GVCV</p>
                            @break
                        @case(3)
                            <p>Khoa</p>
                            @break
                        @case(4)
                            <p>PCTSV</p>
                            @break
                        @case(5)
                            <p>Đoàn khoa</p>
                            @break
                        @default
                        <p>Tự động tính điểm</p>
                    @endswitch
                    </td>
                    <td>{{$item->diemmax}}</td>
                    <td><a href="{{route('admin.editform', ['idform'=>$item->idform])}}" class="btn btn-outline-info"><i class="fa-solid fa-pen-to-square"></i></a></td>
                    <td><a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="{{route('admin.deleteform', ['idform'=>$item->idform])}}" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a></td>
                </tr>
                @endforeach
                @else
                    <tr>
                        <td colspan="6">Không có dữ liệu</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </main>
@endsection
