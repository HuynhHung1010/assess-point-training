@extends('admin.dashboard.index')
@section('content')
    <main>
        <h1 class="title">Quản lý tài khoản</h1>
        <ul class="breadcrumbs">
            <li><a href="{{route('admin.homead')}}">Home</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">Quản lý tài khoản</a></li>
        </ul>
        <h1>{{$title}}</h1>
        @if (session('msg'))
                <div class="alert alert-success">{{session('msg')}}</div>
        @endif
        <hr>
        <div class="d-flex justify-content-start">
            <form action="" method="get" class="mb-3">
                <div class="row">
                    <div class="col-11">
                        <input type="search" name="keywords" class="form-control"
                        placeholder="Tên tài khoản hoặc quyền người dùng..." value="{{request()->keywords}}">
                    </div>
                    <div class="col-1">
                        <button type="submit" class="btn btn-info btn-block"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </div>
            </form>

        </div>
        <div class="pb-3 d-flex justify-content-end">
            <a href="{{route('admin.addtaikhoan')}}" class="btn btn-success">+ Thêm tài khoản</a>
        </div>
        <table class="table table-bordered">
            <thead class="table-primary">
                <tr>
                    <th width="5%">STT</th>
                    <th width="5%">Tên tài khoản</th>
                    <th width="14%">Người dùng</th>
                    <th width="14%">Ngày tạo</th>
                    <th width="5%">Xóa</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($ndList))
                @foreach ($ndList as $key => $item)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$item->tentk}}</td>
                    <td>{{$item->ngdung}}</td>
                    <td>
                        {{$item->created_at}}
                    </td>
                    <td><a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="{{route('admin.deletetk', ['idtk'=>$item->id])}}" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a></td>
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
