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
        <a href="{{route('admin.themnam')}}" class="btn btn-success">+ Thêm năm học</a>
        <hr>
        <table class="table table-bordered">
            <thead class="table-primary">
                <tr>
                    <th width="5%">STT</th>
                    <th width="19%">Tên năm học</th>
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
                    <td><a href="{{route('admin.editnamhoc', ['idnh'=>$item->idnh])}}" class="btn btn-outline-info"><i class="fa-solid fa-pen-to-square"></i></a></td>
                    <td><a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="{{route('admin.deletenamhoc', ['idnh'=>$item->idnh])}}" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a></td>
                </tr>
                @endforeach
                @else
                    <tr>
                        <td colspan="7">Không có dữ liệu</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <a href="{{route('admin.viewnam')}}" class="btn btn-danger">Trở về</a>
    </main>
@endsection
