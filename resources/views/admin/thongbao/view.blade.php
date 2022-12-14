@extends('admin.dashboard.index')
@section('content')
    <main>
        <h1 class="title">Quản lý thông báo</h1>
        <ul class="breadcrumbs">
            <li><a href="{{route('admin.homead')}}">Home</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">Quản lý thông báo</a></li>
        </ul>
        <h1>{{$title}}</h1>
        @if (session('msg'))
                <div class="alert alert-success">{{session('msg')}}</div>
        @endif
        @if (session('msgerro'))
                <div class="alert alert-danger">{{session('msgerro')}}</div>
        @endif
        <hr>
        <div class="d-flex justify-content-end pb-3">
            <a href="{{route('admin.addtb')}}" class="btn btn-success">+ Thêm thông báo</a>
        </div>
        <table class="table table-bordered">
            <thead class="table-primary">
                <tr>
                    <th width="5%">STT</th>
                    <th>Tiêu đề thông báo</th>
                    <th>Nội dung thông báo</th>
                    <th>Ngày lập</th>
                    <th width="5%">Sửa</th>
                    <th width="5%">Xóa</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($ttList))
                @foreach ($ttList as $key => $item)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$item->tieude}}</td>
                    <td>{{$item->noidung}}</td>
                    <td>{{$item->ngaylap}}</td>
                    <td><a href="{{route('admin.edittb', ['idtb'=>$item->id])}}" class="btn btn-outline-info"><i class="fa-solid fa-pen-to-square"></i></a></td>
                    <td><a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="{{route('admin.deletetb', ['idtb'=>$item->id])}}" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a></td>
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
