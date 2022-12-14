@extends('clients.layout.layouthome')


@section('content')
<div class="p-3 border">
    <main>
        <ul class="breadcrumbs">
            <li><a href="{{route('home')}}" class="home">Trang chủ</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">Đoàn khoa</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">Chấm điểm rèn luyện</a></li>
        </ul>
    </main>
    <div class="text-end">
        @if (session('ten'))
            <p>Mã số người dùng: <span style="font-weight: 20px;color: red;">{{session('ten')}}</span></p>
        @endif
    </div>
    <div class="text-center">
        <h2>{{$title}}</h2>
    </div>
    <div class="d-flex justify-content-center">
        <table id="customers">
        <tr>
            <th>STT</th>
            <th>Mã lớp</th>
            <th>Tên lớp</th>
            <th>Khóa</th>
            <th>Niên khóa</th>
            <th width="13%">Hiển thị danh sách</th>
        </tr>
            @if (!empty($lopList))
            @foreach ($lopList as $key => $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->malop}}</td>
                <td>{{$item->tenlop}}</td>
                <td>{{$item->khoahoc}}</td>
                <td>{{$item->tennienkhoa}}</td>
                <td><a href="{{route('doan.doandssv', ['idloph'=>$item->id])}}" class="btn btn-success">Hiển thị <i class="fa-solid fa-list"></i></a></td>
            </tr>
            @endforeach
            @else
                <tr>
                    <td colspan="6">Không có dữ liệu</td>
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

