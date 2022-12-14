<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hệ thống chấm điểm rèn luyện</title>
</head>
<body>
    <h2>{{$title}}</h2>
    <h3>Tên lớp học:</h3>
        <b>{{$lop}}</b>
    <h3>Khóa học:</h3>
        <b>{{$khoahoc}}</b>
    <h3>Năm học</h3>
        <b>{{$namhoc}}</b>
    <h3>Học kỳ</h3>
        <b>{{$hocky}}</b>

        <table>
            <thead>
            <tr>
                <th>STT</th>
                <th>MSSV</th>
                <th>Họ tên sinh viên</th>
                <th>Mã lớp</th>
                <th>Điểm rèn luyện</th>
                <th>xếp loại</th>
            </tr>
            </thead>
            <tbody>
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
            </tbody>
        </table>
</body>
</html>
