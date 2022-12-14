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

        <div class="d-flex justify-content-start">
            <form action="" method="get" class="mb-3">
                <input type="hidden" name="idloph" value="{{$idlop}}">
                <div class="row">
                    <div class="col-11">
                        <input type="search" name="keywords" class="form-control"
                        placeholder="MSSV hoặc tên sinh viên..." value="{{request()->keywords}}">
                    </div>
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
                <th>Địa chỉ</th>
                <th>Ngày sinh</th>
                <th>gmail</th>
                <th>Chức vụ</th>
                <th>Chức vụ đoàn</th>
                <th>số điện thoại</th>
                <th>Niên khóa</th>
                <th>Xem điểm RL</th>
            </tr>
                @if (!empty($svDetail))
                @foreach ($svDetail as $key => $item)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$item->mssv}}</td>
                    <td>{{$item->hoten}}</td>
                    <td>{{$item->diachi}}</td>
                    <td>{{$item->ngaysinh}}</td>
                    <td>{{$item->gmail}}</td>
                    <td>{{$item->chucvu}}</td>
                    <td>{{$item->chucvudoan}}</td>
                    <td>{{$item->sdt}}</td>
                    <td>{{$item->tennienkhoa}}</td>
                    <td><a href="{{route('admin.xemdiemsv', ['idsv'=>$item->idhs])}}" class="btn btn-danger">Xem <i class="fa-solid fa-eye"></i></a></td>
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

