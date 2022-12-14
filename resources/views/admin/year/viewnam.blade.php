@extends('admin.dashboard.index')
@section('content')
    <main>
        <h1 class="title">Quản lý năm học-học kỳ</h1>
        <ul class="breadcrumbs">
            <li><a href="{{route('admin.homead')}}">Home</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">Quản lý năm học-học kỳ</a></li>
        </ul>
        <h1>{{$title}}</h1>
        @if (session('msg'))
                <div class="alert alert-success">{{session('msg')}}</div>
        @endif
        @if (session('msgerro'))
                <div class="alert alert-danger">{{session('msgerro')}}</div>
        @endif
        <a href="{{route('admin.listnam')}}" class="btn btn-primary">Quản lý năm học</a>
        <a href="{{route('admin.listhk')}}" class="btn btn-outline-dark">Quản lý học kỳ</a>
        <hr>
        <div class="pb-3 d-flex justify-content-end">
            <a href="{{route('admin.addnam')}}" class="btn btn-success">+ Thêm năm học-học kỳ</a>
        </div>
        <table class="table table-bordered">
            <thead class="table-primary">
                <tr>
                    <th width="5%">STT</th>
                    <th width="10%">Tên năm học</th>
                    <th width="5%">Học kỳ</th>
                    <th>Ngày bắt đầu</th>
                    <th>Ngày kết thúc</th>
                    <th width="5%">Sửa</th>
                    <th width="5%">Xóa</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($formList))
                @foreach ($formList as $key => $item)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$item->tennam}}</td>
                    <td>{{$item->tenhk}}</td>
                    <td>{{$item->ngaybd}}</td>
                    <td>{{$item->ngaykt}}</td>
                    <td><a href="{{route('admin.editnam', ['idhknh'=>$item->idhknh])}}" class="btn btn-outline-info"><i class="fa-solid fa-pen-to-square"></i></a></td>
                    <td><a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="{{route('admin.deletenam', ['idhknh'=>$item->idhknh])}}" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a></td>
                </tr>
                @endforeach
                @else
                    <tr>
                        <td colspan="7">Không có dữ liệu</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </main>
@endsection
