@extends('admin.dashboard.index')
@section('content')
    <main>
        <h1 class="title">Quản lý phiếu chấm điểm</h1>
        <ul class="breadcrumbs">
            <li><a href="{{route('admin.homead')}}">Home</a></li>
            <li class="divider">/</li>
            <li><a href="{{route('admin.viewpc')}}" class="active">Quản lý phiếu chấm điểm</a></li>
        </ul>
        <hr>
        <div class="text-center">
            <h1 style="color: red;">{{$title}}</h1>
            @if (session('msg'))
                    <div class="alert alert-success">{{session('msg')}}</div>
            @endif
            @if (session('msgerro'))
                    <div class="alert alert-danger">{{session('msgerro')}}</div>
            @endif
        </div>
        <div class="d-flex justify-content-center">
          <form action="" method="get" class="mb-3">
            <div class="row">

                <div class="col-6">
                    <select class="form-control" name="idnh">
                        <option value="0">Năm học</option>
                        @if (!empty($getallnam))
                            @foreach ($getallnam as $item)
                                <option value="{{$item->idnh}}"
                                    {{request()->old('id')==$item->idnh?'selected':false}}>{{$item->tennam}}</option>
                                {{-- {{request()->id==$item->id?'selected':true}} --}}
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-5">
                    <select class="form-control" name="idhk">
                        <option value="0">Học kỳ</option>
                        @if (!empty($getallhk))
                            @foreach ($getallhk as $item)
                                <option value="{{$item->idhk}}"
                                    {{request()->old('id')==$item->idhk?'selected':false}}>{{$item->tenhk}}</option>
                                {{-- {{request()->id==$item->id?'selected':true}} --}}
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-1">
                    <button type="submit" class="btn btn-info btn-block"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </div>
          </form>
        </div>
          <div class="pb-3 text-end">
            <a href="{{route('admin.addpc')}}" class="btn btn-success" disabled><i class="fa-solid fa-plus"></i> Thêm phiếu chấm</a>
          </div>
        <table class="table table-bordered">
            <thead class="table-primary">
                <tr>
                    <th width="5%">STT</th>
                    <th width="5%">Mã tiêu chí</th>
                    <th>Tên tiêu chí</th>
                    <th width="8%">Điểm tối đa</th>
                    <th width="12%">Quyền người dùng</th>
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
                    <td>
                        @switch($item->quyen)
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

                    @endswitch
                    </td>
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
