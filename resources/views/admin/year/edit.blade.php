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
            <form action="{{route('admin.posteditnam')}}" method="POST" class="row mb-3" >
                {{-- <div class="border border-dark"> --}}
                    {{-- <input type="hidden" name="idnh" value="{{$idnh}}"> --}}
                    <div class="col-mb-3">
                        <label for="inputPassword4" class="form-label">Năm học</label>
                        <select class="form-control" name="idnh">
                            @if (!empty(getAllnam()))
                            @foreach (getAllnam() as $item)
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
                    <input type="date" class="form-control" id="ngbd" name="ngbd" placeholder="Ngày bắt đầu..." value="{{old('ngbd') ?? $formDetail->ngaybd}}">
                    @error('ngbd')
                        <span style="color: red;">{{$message}}</span>
                    @enderror
                    </div>

                    <div class="col-mb-3">
                        <label for="inputPassword4" class="form-label">Ngày kết thúc</label>
                        <input type="date" class="form-control" id="ngkt" name="ngkt" placeholder="Ngày kết thúc..." value="{{old('ngkt') ?? $formDetail->ngaykt}}">
                        @error('ngkt')
                            <span style="color: red;">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="col-mb-3">
                        <label for="inputPassword4" class="form-label">Học kỳ</label>
                        <select class="form-control" name="idhk">
                            @if (!empty(getAllhocky()))
                                @foreach (getAllhocky() as $item)
                                    <option value="{{$item->idhk ?? $formDetail->hkid}}"
                                        {{request()->old('id')==$item->idhk?'selected':false}}>{{$item->tenhk}}</option>
                                    {{-- {{request()->id==$item->id?'selected':true}} --}}
                                @endforeach
                            @endif
                        </select>
                        @error('idhk')
                            <span style="color: red;">{{$message}}</span>
                        @enderror
                    </div>
                {{-- </div> --}}
                    @csrf
                    <div class="col-12" style="margin-top: 10px;">
                        <button type="submit" class="btn btn-success">Cập nhật</button>
                        <a href="{{route('admin.viewnam')}}" class="btn btn-danger">Trở về</a>
                    </div>
            </form>
    </main>
@endsection
