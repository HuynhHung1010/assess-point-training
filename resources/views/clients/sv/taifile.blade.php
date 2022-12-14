@extends('clients.layout.layouthome')


@section('content')
<div class="p-3 border">
    <main>
        <ul class="breadcrumbs">
            <li><a href="{{route('home')}}" class="home">Trang chủ</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">Sinh viên</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">Tải minh chứng</a></li>
        </ul>
    </main>
    <div class="text-center">
        <h2>{{$title}}</h2>
            @if (session('msg'))
                    <div class="alert alert-success">{{session('msg')}}</div>
            @endif
        </div>
    <form action="{{route('sv.postmc')}}" method="POST" class="row mb-3" enctype="multipart/form-data">
            <div class="pb-4 row d-flex justify-content-center">
                <div class="col-5">
                    <select class="form-control" name="idnh">
                        <option value="0">Năm học</option>
                        @if (!empty($getallnam))
                            @foreach ($getallnam as $item)
                                <option value="{{$item->idnh}}"
                                    {{old('id')==$item->idnh?'selected':false}}>{{$item->tennam}}</option>
                                {{-- {{request()->id==$item->id?'selected':true}} --}}
                            @endforeach
                        @endif
                    </select>
                    @error('idnh')
                        <span style="color: red;">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-5">
                    <select class="form-control" name="idhk">
                        <option value="0">Học kỳ</option>
                        @if (!empty($getallhk))
                            @foreach ($getallhk as $item)
                                <option value="{{$item->idhk}}"
                                    {{old('id')==$item->idhk?'selected':false}}>{{$item->tenhk}}</option>
                                {{-- {{request()->id==$item->id?'selected':true}} --}}
                            @endforeach
                        @endif
                    </select>
                    @error('idhk')
                        <span style="color: red;">{{$message}}</span>
                    @enderror
                </div>
            </div>
        <div class="d-flex justify-content-center">
            <div class="col-md-6 pe-3">
            <label for="inputEmail4" class="form-label">Tên minh chứng </label>
            <input type="text" class="form-control" id="inputEmail4" name="tenmc" placeholder="Tên minh chứng...">
            @error('tenmc')
                <span style="color: red;">{{$message}}</span>
            @enderror
            </div>
            <div class="col-md-5">
                <label for="inputEmail4" class="form-label">Minh chứng kèm theo: </label>
                <input type="file" class="form-control" id="file" name="file" placeholder="Tên file...">
                @error('file')
                    <span style="color: red;">{{$message}}</span>
                @enderror
                </div>
            </div>
            @csrf
            <div class="p-3 text-end">
                <div class="col-12" style="margin-top: 10px;">
                    <button type="submit" class="btn btn-success">Thêm <i class="fa-solid fa-check"></i></button>
                    <a href="{{route('home')}}" class="btn btn-danger">Trở về <i class="fa-solid fa-rotate-left"></i></a>
                </div>
            </div>
    </form>
</div>
@endsection
