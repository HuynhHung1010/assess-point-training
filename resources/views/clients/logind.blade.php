@extends('clients.logind1')

@section('csslogin')
    <style>
        body {
    margin: 0;
    padding: 0;
    background: url(https://austrong.com.vn/Images/gallery/project/toa-nha-cong-nghe-cao-truong-dh-can-tho/toa-nha-cong-nghe-cao-truong-dh-can-tho-3.jpg);
    /* background-size: cover; */
    /* background-position: center; */
    font-family: sans-serif;
}

.loginbox {
    width: 320px;
    height: 420px;
    background: black;
    color: #fff;
    top: 50%;
    left: 50%;
    position: absolute;
    transform: translate(-50%, -50%);
    box-sizing: border-box;
    padding: 70px 30px;
    border-radius: 10px;

}

.avatar {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    position: absolute;
    top: -10%;
    left: calc(50% - 50px);
}

h1 {
    margin: 0;
    padding: 0;
    text-align: center;
    font-size: 26px;
    padding-bottom: 40px;
    padding-top: 10px;
}

.loginbox p {
    margin: 0;
    padding: 0;
    font-weight: bold;
}

.loginbox input {
    width: 100%;
    margin-bottom: 20px;
}

.loginbox input[type = "text"], input[type = "password"] {
    border: none;
    border-bottom: 1px solid #fff;
    background: transparent;
    outline: none;
    height: 40px;
    color: #fff;
    font-size: 16px;
}

.loginin{
    display: flex;
}


.loginbox input[type = "text"]:hover {
    border-bottom: 1px solid #08b0ce;
}

.loginbox input[type = "password"]:hover {
    border-bottom: 1px solid #08b0ce;
}

.eye{
    cursor: pointer;
    padding-top: 20px;
    padding-right: 10px;
}
.icon{
    padding-top: 12px;
    padding-right: 5px;
}
.loginbox input[type = "submit"] {
    border: none;
    outline: none;
    height: 40px;
    background: #08b0ce ;
    color: #fff;
    font-size: 18px;
    border-radius: 20px;
    margin-top: 10px;
}

.loginbox input[type = "submit"]:hover {
    cursor: pointer;
    background: #fff;
    color: #000;

}

.loginbox a {
    text-decoration: none;
    font-size: 12px;
    line-height: 20px;
    color: darkgrey;
}

.loginbox a:hover {
    color: #fff;

}

    </style>
@endsection

@section('jslogin')
    <script type="text/javascript">
        var x = true;
        function myfunction(){
            if(x){
                document.getElementById('pass').type = "text";
                x = false;
            }else{
                document.getElementById('pass').type = "password";
                x = true;
            }
        }
    </script>
@endsection
