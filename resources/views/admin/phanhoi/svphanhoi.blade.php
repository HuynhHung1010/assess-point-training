@extends('admin.dashboard.index')
@section('content')
    <main>
        <h1 class="title">Quản lý phản hồi</h1>
        <ul class="breadcrumbs">
            <li><a href="{{route('admin.homead')}}">Home</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">Quản lý phản hồi</a></li>
        </ul>
        <hr>
        <div class="text-center">
            <h2 style="color: red;">{{$title}}</h2>
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
    <table id="customers">
    <tr>
        <th>STT</th>
        <th>MSSV</th>
        <th>Họ và tên</th>
        <th>Mã lớp</th>
        <th>Tên GVCV</th>
        <th>Tên khoa</th>
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
            <td>{{$item->hotengv}}</td>
            <td>{{$item->tenkhoa}}</td>
            <td>{{$item->svph}}</td>
            <td>{{$item->ngayph}}</td>
            <td>{{$item->traloi}}</td>
            <td><a href="{{route('admin.guiph', ['idph'=>$item->idph])}}" class="btn btn-danger">Trả lời <i class="fa-solid fa-pen"></i></a></td>
        </tr>
        @endforeach
        @else
            <tr>
                <td colspan="10">Không có dữ liệu</td>
            </tr>
        @endif
    </tr>
    </table>
    </main>
@endsection

@section('css')
    @parent
    <style>
        #customers {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 75em;
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

