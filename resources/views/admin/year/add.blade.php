@extends('admin.dashboard.index')
@section('content')
    <main>
        <h1 class="title">Quản lý năm học-học kỳ</h1>
        <ul class="breadcrumbs">
            <li><a href="{{route('admin.homead')}}">Home</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">Quản lý năm học-học kỳ</a></li>
        </ul>
            <h2>{{$title}}</h2>
            @if (session('msg'))
                <div class="alert alert-success">{{session('msg')}}</div>
            @endif

            @if ($errors-> any())
                <div class="alert alert-danger">Dữ liệu nhập vào không hợp lệ.Vui lòng nhập lại!</div>
            @endif
            <hr>
            <form action="{{route('admin.postaddnam')}}" method="POST" class="row mb-3" >
                    <div class="col-mb-3">
                        <label for="inputPassword4" class="form-label">Năm học</label>
                        <select class="form-control" name="idnh">
                            @if (!empty($getallnam))
                            @foreach ($getallnam as $item)
                                    <option value="{{$item->idnh}}"
                                        {{request()->old('id')==$item->idnh?'selected':false}}>{{$item->tennam}}</option>
                                    {{-- {{request()->id==$item->id?'selected':true}} --}}
                                @endforeach
                            @endif
                        </select>
                        @error('idnh')
                            <span style="color: red;">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-mb-3">
                    <label for="inputPassword4" class="form-label">Ngày bắt đầu</label>
                    <input type="date" class="form-control" id="ngbd" name="ngbd" placeholder="Ngày bắt đầu..." value="{{old('ngbd')}}">
                    @error('ngbd')
                        <span style="color: red;">{{$message}}</span>
                    @enderror
                    </div>

                    <div class="col-mb-3">
                        <label for="inputPassword4" class="form-label">Ngày kết thúc</label>
                        <input type="date" class="form-control" id="ngkt" name="ngkt" placeholder="Ngày kết thúc..." value="{{old('ngkt')}}">
                        @error('ngkt')
                            <span style="color: red;">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-mb-3">
                        <label for="inputPassword4" class="form-label">Học kỳ</label>
                        <select class="form-control" name="idhk">
                            @if (!empty($getallhk))
                                @foreach ($getallhk as $item)
                                    <option value="{{$item->idhk}}"
                                        {{request()->old('id')==$item->idhk?'selected':false}}>{{$item->tenhk}}</option>
                                    {{-- {{request()->id==$item->id?'selected':true}} --}}
                                @endforeach
                            @endif
                        </select>
                        @error('idhk')
                            <span style="color: red;">{{$message}}</span>
                        @enderror
                    </div>

                    @csrf
                    <div class="col-12" style="margin-top: 10px;">
                        <button type="submit" class="btn btn-success">Thêm năm học</button>
                        <a href="{{route('admin.viewnam')}}" class="btn btn-danger">Trở về</a>
                    </div>
            </form>
    </main>
@endsection
