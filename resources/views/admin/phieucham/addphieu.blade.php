@extends('admin.dashboard.index')
@section('content')
    <main>
        <h1 class="title">Quản lý phiếu chấm điểm</h1>
        <ul class="breadcrumbs">
            <li><a href="{{route('admin.homead')}}">Home</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">Quản lý phiếu chấm điểm</a></li>
        </ul>
        <h1>{{$title}}</h1>
        @if (session('msg'))
                <div class="alert alert-success">{{session('msg')}}</div>
        @endif
        @if (session('msgerro'))
                <div class="alert alert-danger">{{session('msgerro')}}</div>
        @endif
        <hr>
          <form action="{{route('admin.postaddpc')}}" method="POST" class="mb-3">
            @csrf
            <div class="row">
                <div class="col-3">
                    <select class="form-control" name="idnh">
                        <option value="0">Năm học</option>
                        @if (!empty($getallnam))
                            @foreach ($getallnam as $item)
                                <option value="{{$item->idnh}}"
                                    {{request()->id==$item->idnh?'selected':false}}>{{$item->tennam}}</option>
                                {{-- {{request()->id==$item->id?'selected':true}} --}}
                            @endforeach
                        @endif
                    </select>
                </div>
                @error('idnh')
                    <span style="color: red;">{{$message}}</span>
                @enderror
                <div class="col-3">

                    <select class="form-control" name="idhk">
                        <option value="0">Học kỳ</option>
                        @if (!empty($getallhk))
                            @foreach ($getallhk as $item)
                                <option value="{{$item->idhk}}"
                                    {{request()->id==$item->idhk?'selected':false}}>{{$item->tenhk}}</option>
                                {{-- {{request()->id==$item->id?'selected':true}} --}}
                            @endforeach
                        @endif
                    </select>
                </div>
                @error('idhk')
                    <span style="color: red;">{{$message}}</span>
                @enderror
                <div class="col-2">
                    {{-- @if($k == 1) --}}
                        <button type="submit" class="btn btn-success btn-block">+Thêm</button>
                    {{-- @else
                    @endif --}}
                </div>
            </div>
          </form>
        <hr>
          <form action="{{route('admin.postdeletepc')}}" method="POST" class="mb-3">
            @csrf
            <div class="row">

                <div class="col-3">
                    <select class="form-control" name="idnhx">
                        <option value="0">Năm học</option>
                        @if (!empty($getallnam))
                            @foreach ($getallnam as $item)
                                <option value="{{$item->idnh}}"
                                    {{request()->id==$item->idnh?'selected':false}}>{{$item->tennam}}</option>
                                {{-- {{request()->id==$item->id?'selected':true}} --}}
                            @endforeach
                        @endif
                    </select>
                </div>
                @error('idnhx')
                    <span style="color: red;">{{$message}}</span>
                @enderror
                <div class="col-3">

                    <select class="form-control" name="idhkx">
                        <option value="0">Học kỳ</option>
                        @if (!empty($getallhk))
                            @foreach ($getallhk as $item)
                                <option value="{{$item->idhk}}"
                                    {{request()->id==$item->idhk?'selected':false}}>{{$item->tenhk}}</option>
                                {{-- {{request()->id==$item->id?'selected':true}} --}}
                            @endforeach
                        @endif
                    </select>
                </div>
                @error('idhkx')
                    <span style="color: red;">{{$message}}</span>
                @enderror
                <div class="col-2">
                    {{-- @if($k == 1) --}}
                    <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger btn-block">Xóa</button>
                    {{-- @else
                    @endif --}}
                </div>
            </div>
          </form>
        <a href="{{route('admin.viewpc')}}" class="btn btn-outline-danger"><i class="fa-solid fa-rotate-right"></i>  Trở về</a>
        {{-- <table class="table table-bordered">
            <thead class="table-primary">
                <tr>
                    <th width="5%">STT</th>
                    <th width="5%">Mã tiêu chí</th>
                    <th>Tên tiêu chí</th>
                    <th width="8%">Điểm tối đa</th>
                    <th width="5%">Sửa</th>
                    <th width="5%">Xóa</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($pcList))
                @foreach ($pcList as $key => $item)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$item->matc}}</td>
                    <td>{{$item->tentc}}</td>
                    <td>{{$item->diemmax}}</td>
                    <td><a href="{{route('admin.editform', ['idform'=>$item->idform])}}" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i></a></td>
                    <td><a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="{{route('admin.deleteform', ['idform'=>$item->idform])}}" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a></td>
                </tr>
                @endforeach
                @else
                    <tr>
                        <td colspan="6">Không có dữ liệu</td>
                    </tr>
                @endif
            </tbody>
        </table> --}}
    </main>
@endsection
