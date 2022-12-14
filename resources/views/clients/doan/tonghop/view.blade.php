@extends('clients.layout.layouthome')


@section('content')
<div class="p-3 border">
    <main>
        <ul class="breadcrumbs">
            <li><a href="{{route('home')}}" class="home">Trang chủ</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">Đoàn khoa</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">Tổng hợp điểm rèn luyện</a></li>
        </ul>
    </main>
    <div class="text-center">
        <h2>{{$title}}</h2>
    </div>
    <div class="d-flex justify-content-center">
        <form action="" method="get" class="mb-3">
            <div class="row">
                <div class="pb-3 d-flex" style="padding-right: 10px;">
                    <div class="col-6 pe-4">
                        <select class="form-control" name="idlop">
                            <option value="0">----Lớp----</option>
                            @if (!empty($getlop))
                                @foreach ($getlop as $item)
                                    <option value="{{$item->id}}"
                                        {{request()->old('id')==$item->id?'selected':false}}>{{$item->tenlop}}</option>
                                    {{-- {{request()->id==$item->id?'selected':true}} --}}
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-5">
                        <select class="form-control" name="idkhoahoc">
                            <option value="0">----Khóa học----</option>
                            @if (!empty($getnk))
                                @foreach ($getnk as $item)
                                    <option value="{{$item->idnienkhoa}}"
                                        {{request()->old('id')==$item->idnienkhoa?'selected':false}}>{{$item->khoahoc}}</option>
                                    {{-- {{request()->id==$item->id?'selected':true}} --}}
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
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
                {{-- <input type="hidden" name="idsv" value="{{$idsv}}"> --}}
                <div class="col-1">
                    <button type="submit" class="btn btn-info btn-block"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </div>
        </form>
    </div>

    <div class="pb-3 d-flex justify-content-end">
        {{-- <a href="{{route('doan.doanxuatfilePDF', ['keywords'=>$keywords,'nh'=>$nh,'hk'=>$hk,'lop'=>$lop,'khoahoc'=>$khoahoc])}}" class="pe-3 btn btn-success">Export PDF</a> --}}
        <a href="{{route('doan.doanxuatfileEX', ['nh'=>$nh,'hk'=>$hk,'lop'=>$lop,'khoahoc'=>$khoahoc])}}" class="btn btn-success">Export Excel</a>
    </div>
    <div class="d-flex justify-content-center">
        <table id="customers">
        <tr>
            <th>STT</th>
            <th>MSSV</th>
            <th>Họ tên sinh viên</th>
            <th>Mã lớp</th>
            <th>Điểm rèn luyện</th>
            <th>xếp loại</th>
        </tr>
            @if (!empty($thList))
            @foreach ($thList as $key => $item)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$item->mssv}}</td>
                <td>{{$item->hoten}}</td>
                <td>{{$item->malop}}</td>
                <td><b>{{$item->tongdiem}}</b></td>
                @if($item->tongdiem<=$item->muccham&&$item->tongdiem>=($item->muccham-10))
                    <td><b style="color: red;">Xuất sắc</b></td>
                @elseif($item->tongdiem<($item->muccham-10)&&$item->tongdiem>=($item->muccham-20))
                    <td><b style="color: red;">Tốt</b></td>
                @elseif($item->tongdiem<($item->muccham-20)&&$item->tongdiem>=($item->muccham-30))
                    <td><b style="color: red;">Khá</b></td>
                @elseif($item->tongdiem<($item->muccham-30)&&$item->tongdiem>=($item->muccham-40))
                    <td><b style="color: red;">Trung bình-Khá</b></td>
                @elseif($item->tongdiem<($item->muccham-40)&&$item->tongdiem>=($item->muccham-50))
                    <td><b style="color: red;">Trung bình</b></td>
                @elseif($item->tongdiem<($item->muccham-50)&&$item->tongdiem>=($item->muccham-70))
                    <td><b style="color: red;">Yếu</b></td>
                @else
                    <td><b style="color: red;">Kém</b></td>
                @endif
            </tr>
            @endforeach
            @else
                <tr>
                    <td colspan="7">Không có dữ liệu</td>
                </tr>
            @endif
        </tr>
        </table>
    </div>
    <div class="col-12 p-3">
        <a href="{{route('home')}}" class="btn btn-danger">Trở về <i class="fa-solid fa-rotate-right"></i></a>
    </div>
@endsection

@section('css')
    @parent
    <style>
        #customers {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 68em;
    justify-content: center;
  }

  #customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
  }

  #customers tr:nth-child(even){background-color: #f2f2f2;}

  #customers tr:hover {background-color: #ddd;}

  #customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #1d86ee;
    color: white;
  }

.inmath{
  width: 60px;
  text-align: center;
}

.select-box{
  width: 150px;
}
.select-box select{
  height: 40px;
  padding: 10px 15px;
  line-height: 18px;
  font-size: 16px;
  width: 100%;
  border: 2px solid #ccc;
  border-radius: 8px;
  -webkit-appearance: none;
  appearance: none;
}

.select-box:after{
  content: "";
  position: absolute;
  right: 8px;
  top: 50%;
  margin-top: -4px;
  border-top: 8px solid #ccc;
  border-left: 6px solid transparent;
  border-right: 6px solid transparent;
  pointer-events: none;
}
    </style>
@endsection

