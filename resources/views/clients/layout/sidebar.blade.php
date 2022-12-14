@extends('clients.layout.sidebar1')
@section('cssside')
    <style>
         *{
    margin: 0;
    padding: 0;
    font-family: "Roboto",sans-serif;
}
.container{
    width: 980px;
    margin: 0 auto;
    padding-top: 10px;
}
img.logo{
    width: 80px;
    height: 100px;
    float: left;
}
.title{
  float: left;
  text-align: center;
  padding-top: 15px;
  padding-left: 10px;

}
a img.nen{
  float:right;
  padding-top: 0;
  border-radius: 15px 0px 0px 30px;
}

img.nen{
  border-radius: 10px;
}
header{
    height: 130px;
    background: rgb(247, 244, 244);
    background-image: url("https://www.hinhnenemail.com/files/elegant-simple/18/top.jpg");

}

header img {
    padding-left: 20px;
    padding-top: 5px;
}

    </style>
@endsection
