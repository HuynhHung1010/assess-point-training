@extends('admin.dashboard.index')
@section('content')
    <main>
        <h1 class="title">Quản lý thời gian chấm</h1>
            <ul class="breadcrumbs">
                <li><a href="{{route('admin.homead')}}">Home</a></li>
                <li class="divider">/</li>
                <li><a href="#" class="active">Quản lý thời gian chấm</a></li>
            </ul>
            <h2>{{$title}}</h2>
            <hr>
            @if (session('msg'))
                <div class="alert alert-success">{{session('msg')}}</div>
            @endif

            @if ($errors-> any())
                <div class="alert alert-danger">Dữ liệu nhập vào không hợp lệ.Vui lòng nhập lại!</div>
            @endif
            <form action="{{route('admin.postedittime')}}" method="POST" class="row mb-3" >
                @csrf
                {{-- <div class="border border-dark"> --}}
                    <div class="row">
                        <div class="col-3">
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
                        <div class="col-3">
                            <select class="form-control" name="idhk">
                                <option value="0">Học kỳ</option>
                                @if (!empty($getallhk))
                                    @foreach ($getallhk as $item)
                                        <option value="{{$item->idhk}}"
                                        {{old('id')==$item->idhk?'selected':false}} >{{$item->tenhk}}</option>
                                        {{-- {{request()->id==$item->id?'selected':true}} --}}
                                    @endforeach
                                @endif
                            </select>
                            @error('idhk')
                                <span style="color: red;">{{$message}}</span>
                            @enderror
                        </div>
                    <div class="col-md-7">
                    <label for="inputEmail4" class="form-label">Ngày sinh viên bắt đầu</label>
                    <input type="date" class="form-control" id="inputEmail4" name="svbd" placeholder="Ngày sinh viên bắt đầu chấm..." value="{{old('svbd') ?? $timeDetail->ngaysvbd}}">
                    @error('svbd')
                        <span style="color: red;">{{$message}}</span>
                    @enderror
                    </div>
                    <div class="col-md-5">
                        <label for="inputAddress" class="form-label">Ngày sinh viên kết thúc</label>
                        <input type="date" class="form-control" id="inputAddress" name="svkt" placeholder="Ngày sinh viên kết thúc chấm..." value="{{old('svkd') ?? $timeDetail->ngaysvkt}}">
                        @error('svkt')
                            <span style="color: red;">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword4" class="form-label">Ngày GVCV bắt đầu chấm</label>
                        <input type="date" class="form-control" id="inputPassword4" name="gvbd" placeholder="Ngày GVCV bắt đầu chấm..." value="{{old('gvbd') ?? $timeDetail->ngaygvbd}}">
                        @error('gvbd')
                            <span style="color: red;">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword4" class="form-label">Ngày GVCV kết thúc chấm</label>
                        <input type="date" class="form-control" id="inputPassword4" name="gvkt" placeholder="Ngày GVCV kết thúc chấm..." value="{{old('gvkt') ?? $timeDetail->ngaygvkt}}">
                        @error('gvbd')
                            <span style="color: red;">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword4" class="form-label">Ngày đoàn khoa bắt đầu chấm</label>
                        <input type="date" class="form-control" id="inputPassword4" name="dbd" placeholder="Ngày GVCV bắt đầu chấm..." value="{{old('dbd') ?? $timeDetail->ngaydbd}}">
                        @error('dbd')
                            <span style="color: red;">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword4" class="form-label">Ngày đoàn khoa kết thúc chấm</label>
                        <input type="date" class="form-control" id="inputPassword4" name="dkt" placeholder="Ngày GVCV kết thúc chấm..." value="{{old('dkt') ?? $timeDetail->ngaydkt}}">
                        @error('dkt')
                            <span style="color: red;">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword4" class="form-label">Ngày khoa bắt đầu chấm</label>
                        <input type="date" class="form-control" id="inputPassword4" name="kbd" placeholder="Ngày GVCV bắt đầu chấm..." value="{{old('kbd') ?? $timeDetail->ngaykbd}}">
                        @error('gvbd')
                            <span style="color: red;">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword4" class="form-label">Ngày khoa kết thúc chấm</label>
                        <input type="date" class="form-control" id="inputPassword4" name="kkt" placeholder="Ngày GVCV kết thúc chấm..." value="{{old('kkt') ?? $timeDetail->ngaykkt}}">
                        @error('gvbd')
                            <span style="color: red;">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword4" class="form-label">Ngày kết thúc lập phiếu chấm</label>
                        <input type="date" class="form-control" id="inputPassword4" name="hanlap" placeholder="Ngày GVCV kết thúc chấm..." value="{{old('hanlap') ?? $timeDetail->hanlapphieu}}">
                        @error('hanlap')
                            <span style="color: red;">{{$message}}</span>
                        @enderror
                    </div>
                {{-- </div> --}}
                    <div class="col-12 p-3">
                        <button type="submit" class="btn btn-success">Cập nhật <i class="fa-solid fa-arrow-up-from-bracket"></i></button>
                        <a href="{{route('admin.thoigian')}}" class="btn btn-danger">Trở về <i class="fa-solid fa-rotate-left"></i></a>
                    </div>
            </form>
    </main>
@endsection
