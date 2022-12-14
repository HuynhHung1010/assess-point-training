<?php

use App\Models\clients\Lop;

    use App\Models\Years;

    use App\Models\Diem;

    use App\Models\clients\Taikhoan;

    // use App\Http\Controllers\LoginController;

    // $this->login = new LoginController();

    function getAllnam(){
        $year = new Years;
        return $year->getAll();
    }

    function getAllhocky(){
        $hk = new Years;
        return $hk->getAllhk();
    }

    function gettkgv(){
        $tk = new Diem;
        if($tk->getTKgv()!= 0){
            return 1;
        }else{
            return 0;
        };
    }


    function getidsv($id){
        $id = new Taikhoan;
        return $id->getidsv($id);
    }

    function getidgv(){
        $idgv = new Taikhoan;
        return $idgv->getidgv();
    }

    function getquyennd(){
        $quyen = new Taikhoan();
        return $quyen->getquyen();
    }

    //tong hop diem RL cho ad
    function getkhoa(){
        $khoa = new Lop();
        return $khoa->getalllistkhoa();
    }

    function getlop(){
        $khoa = new Lop();
        return $khoa->getalllistlop();
    }
    function getgv(){
        $khoa = new Lop();
        return $khoa->getalllistgv();
    }
    function getnk(){
        $khoa = new Lop();
        return $khoa->getalllistnk();
    }

    //tong hop diemRL cho khoa
    function getgvkhoa(){
        $khoa = new Lop();
        return $khoa->getallgvkhoa();
    }

    function getlopkhoa(){
        $khoa = new Lop();
        return $khoa->getlopkhoa();
    }
    //tong hop diemRl cho doan khoa
    function getlopdoan(){
        $khoa = new Lop();
        return $khoa->getlopdoan();
    }
    //tong hop diemRl cho gvcv
    function getlopgv(){
        $khoa = new Lop();
        return $khoa->getlopgv();
    }
