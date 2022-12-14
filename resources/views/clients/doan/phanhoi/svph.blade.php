@extends('clients.layout.layouthome')


@section('content')
<div class="p-3 border">
    <main>
        <ul class="breadcrumbs">
            <li><a href="{{route('home')}}" class="home">Trang chủ</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">Đoàn khoa</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">Xem phản hồi</a></li>
        </ul>
    </main>
    <div class="text-center">
        <h2>{{$title}}</h2>
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
                {{-- <input type="hidden" name="idf"> --}}
                <div class="col-1">
                    <button type="submit" class="btn btn-info btn-block"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </div>
        </form>
    </div>
    <div class="d-flex justify-content-center">
        <table id="customers">
        <tr>
            <th>STT</th>
            <th>MSSV</th>
            <th>Họ và tên</th>
            <th>Mã lớp</th>
            <th>Nội dung phản hồi</th>
            <th>Ngày phản hồi</th>
            <th>Trả lời</th>
            <th>Phản hồi</th>
        </tr>
            @if (!empty($phList))
            @foreach ($phList as $key => $item)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$item->mssv}}</td>
                <td>{{$item->hoten}}</td>
                <td>{{$item->malop}}</td>
                <td>{{$item->svph}}</td>
                <td>{{$item->ngayph}}</td>
                <td>{{$item->traloi}}</td>
                <td><a href="{{route('doan.guiph', ['idph'=>$item->idph])}}" class="btn btn-danger">Trả lời <i class="fa-solid fa-pen"></i></a></td>
            </tr>
            @endforeach
            @else
                <tr>
                    <td colspan="10">Không có dữ liệu</td>
                </tr>
            @endif
        </tr>
        </table>
    </div>
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

