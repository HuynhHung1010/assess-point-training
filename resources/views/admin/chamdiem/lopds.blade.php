@extends('admin.dashboard.index')
@section('content')
    <main>
        <h1 class="title">Quản lý Chấm điểm rèn luyện</h1>
        <ul class="breadcrumbs">
            <li><a href="{{route('admin.homead')}}">Home</a></li>
            <li class="divider">/</li>
            <li><a href="#" class="active">Quản lý chấm điểm rèn luyện</a></li>
        </ul>
        <h1 style="color: red;">{{$title}}</h1>
        @if (session('msg'))
                <div class="alert alert-success">{{session('msg')}}</div>
        @endif
        @if (session('msgerro'))
                <div class="alert alert-danger">{{session('msgerro')}}</div>
        @endif
        <hr>

        <table id="customers">
            <tr>
                <th>STT</th>
                <th>Mã lớp</th>
                <th>Tên lớp</th>
                <th>Khóa</th>
                <th>Niên khóa</th>
                <th>Họ tên GVCV</th>
                <th>Số điện thoại GVCV</th>
                <th>gmail GVCV</th>
                <th>Hiển thị danh sách</th>
            </tr>
                @if (!empty($lopList))
                @foreach ($lopList as $key => $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->malop}}</td>
                    <td>{{$item->tenlop}}</td>
                    <td>{{$item->khoahoc}}</td>
                    <td>{{$item->tennienkhoa}}</td>
                    <td>{{$item->hotengv}}</td>
                    <td>{{$item->sdtgv}}</td>
                    <td>{{$item->gmailgv}}</td>
                    <td><a href="{{route('admin.dssv', ['idloph'=>$item->id])}}" class="btn btn-success">Hiển thị <i class="fa-solid fa-list"></i></a></td>
                </tr>
                @endforeach
                @else
                    <tr>
                        <td colspan="9">Không có dữ liệu</td>
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

