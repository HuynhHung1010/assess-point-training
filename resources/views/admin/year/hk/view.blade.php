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
        <a href="{{route('admin.themhk')}}" class="btn btn-success">+ Thêm học kỳ</a>
        <hr>
        <table class="table table-bordered">
            <thead class="table-primary">
                <tr>
                    <th width="5%">STT</th>
                    <th width="19%">Tên học kỳ</th>
                    <th width="5%">Sửa</th>
                    <th width="5%">Xóa</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($formList))
                @foreach ($formList as $key => $item)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$item->tenhk}}</td>
                    <td><a href="{{route('admin.edithk', ['idhk'=>$item->idhk])}}" class="btn btn-outline-info"><i class="fa-solid fa-pen-to-square"></i></a></td>
                    <td><a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="{{route('admin.deletehk', ['idhk'=>$item->idhk])}}" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a></td>
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
