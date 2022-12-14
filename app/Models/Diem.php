<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Diem extends Model
{
    use HasFactory;
    protected $table = 'diemrl';


    //chuc nang tong hop diem RL
    public function gettonghop($filters = []){
        $th = DB::table($this->table)
        ->join('phieucham', 'diemrl.idpcd', '=', 'phieucham.idpc')
        ->join('sinhvien', 'diemrl.idsv', '=', 'sinhvien.idhs')
        ->join('lop', 'sinhvien.idlop', '=', 'lop.id')
        ->join('nienkhoa', 'lop.idkh', '=', 'nienkhoa.idnienkhoa')
        ->join('giaovien', 'lop.idgvv', '=', 'giaovien.idgv')
        ->join('khoa', 'giaovien.idk', '=', 'khoa.idkhoa')
        ->select('idsv','idnh','idhk','muccham','mssv','hoten','magv','hotengv','malop','tenlop','makhoa','tenkhoa','khoahoc',DB::raw('SUM(diemdat) as tongdiem'))
        ->groupBy('idsv','idnh','muccham','idhk','mssv','hoten','magv','hotengv','malop','tenlop','makhoa','tenkhoa','khoahoc')
       ;
        if(!empty($filters)){
            $th = $th->where($filters);
        }
        $th = $th->get();
        return $th;
    }

    public function gettonghopPDF($idnh=null,$idhk=null,$idkhoa=null,$idlop=null,$idgv=null,$idkhoahoc=null){
        $th = DB::table($this->table)
        ->join('phieucham', 'diemrl.idpcd', '=', 'phieucham.idpc')
        ->join('sinhvien', 'diemrl.idsv', '=', 'sinhvien.idhs')
        ->join('lop', 'sinhvien.idlop', '=', 'lop.id')
        ->join('nienkhoa', 'lop.idkh', '=', 'nienkhoa.idnienkhoa')
        ->join('giaovien', 'lop.idgvv', '=', 'giaovien.idgv')
        ->join('khoa', 'giaovien.idk', '=', 'khoa.idkhoa')
        ->select('idsv','idnh','idhk','muccham','mssv','hoten','magv','hotengv','malop','tenlop','makhoa','tenkhoa','khoahoc',DB::raw('SUM(diemdat) as tongdiem'))
        ->groupBy('idsv','idnh','muccham','idhk','mssv','hoten','magv','hotengv','malop','tenlop','makhoa','tenkhoa','khoahoc')
       ;
        if(!empty($idnh)){
            $th = $th->where('idnh',$idnh);
        }
        if(!empty($idhk)){
            $th = $th->where('idhk',$idhk);
        }
        if(!empty($idkhoa)){
            $th = $th->where('idkhoa',$idkhoa);
        }
        if(!empty($idlop)){
            $th = $th->where('lop.id',$idlop);
        }
        if(!empty($idgv)){
            $th = $th->where('idgv',$idgv);
        }
        if(!empty($idkhoahoc)){
            $th = $th->where('idnienkhoa',$idkhoahoc);
        }
        $th = $th->get();
        return $th;
    }










    public function gettonghopkhoa($filters = []){
        $idgv = Auth::id();
        $idnd = DB::table('taikhoan')
        ->select('idk')
        ->where('id',$idgv)
        ->get();
        foreach($idnd as $item){
            $id = $item->idk;
        }
        $th = DB::table($this->table)
        ->join('phieucham', 'diemrl.idpcd', '=', 'phieucham.idpc')
        ->join('sinhvien', 'diemrl.idsv', '=', 'sinhvien.idhs')
        ->join('lop', 'sinhvien.idlop', '=', 'lop.id')
        ->join('nienkhoa', 'lop.idkh', '=', 'nienkhoa.idnienkhoa')
        ->join('giaovien', 'lop.idgvv', '=', 'giaovien.idgv')
        ->select('idsv','idnh','idhk','muccham','mssv','hoten','magv','hotengv','malop','tenlop','khoahoc','idk',DB::raw('SUM(diemdat) as tongdiem'))
        ->groupBy('idsv','idnh','muccham','idhk','mssv','hoten','magv','hotengv','malop','tenlop','khoahoc','idk')
        ->having('idk',$id)
       ;
        if(!empty($filters)){
            $th = $th->where($filters);
        }
        $th = $th->get();
        return $th;
    }

    public function khoagettonghopPDF($idnh=null,$idhk=null,$idlop=null,$idgv=null,$idkhoahoc=null){
        // $idgv = Auth::id();
        // $idnd = DB::table('taikhoan')
        // ->select('idk')
        // ->where('id',$idgv)
        // ->get();
        // foreach($idnd as $item){
        //     $id = $item->idk;
        // }
        $th = DB::table($this->table)
        ->join('phieucham', 'diemrl.idpcd', '=', 'phieucham.idpc')
        ->join('sinhvien', 'diemrl.idsv', '=', 'sinhvien.idhs')
        ->join('lop', 'sinhvien.idlop', '=', 'lop.id')
        ->join('nienkhoa', 'lop.idkh', '=', 'nienkhoa.idnienkhoa')
        ->join('giaovien', 'lop.idgvv', '=', 'giaovien.idgv')
        ->select('idsv','idnh','idhk','muccham','mssv','hoten','magv','hotengv','malop','tenlop','khoahoc','idk',DB::raw('SUM(diemdat) as tongdiem'))
        ->groupBy('idsv','idnh','muccham','idhk','mssv','hoten','magv','hotengv','malop','tenlop','khoahoc','idk')
        // ->having('idk',$id)
       ;
        if(!empty($idnh)){
            $th = $th->where('idnh',$idnh);
        }
        if(!empty($idhk)){
            $th = $th->where('idhk',$idhk);
        }
        if(!empty($idlop)){
            $th = $th->where('lop.id',$idlop);
        }
        if(!empty($idgv)){
            $th = $th->where('idgv',$idgv);
        }
        if(!empty($idkhoahoc)){
            $th = $th->where('idnienkhoa',$idkhoahoc);
        }
        $th = $th->get();
        return $th;
    }







    public function gettonghopdoan($filters = []){
        $idgv = Auth::id();
        $idnd = DB::table('taikhoan')
        ->select('idd')
        ->where('id',$idgv)
        ->get();
        foreach($idnd as $item){
            $id = $item->idd;
        }
        $th = DB::table($this->table)
        ->join('phieucham', 'diemrl.idpcd', '=', 'phieucham.idpc')
        ->join('sinhvien', 'diemrl.idsv', '=', 'sinhvien.idhs')
        ->join('lop', 'sinhvien.idlop', '=', 'lop.id')
        ->join('nienkhoa', 'lop.idkh', '=', 'nienkhoa.idnienkhoa')
        ->select('idsv','idnh','idhk','muccham','mssv','hoten','malop','tenlop','khoahoc','iddoank',DB::raw('SUM(diemdat) as tongdiem'))
        ->groupBy('idsv','idnh','muccham','idhk','mssv','hoten','malop','tenlop','khoahoc','iddoank')
        ->having('iddoank',$id)
       ;
        if(!empty($filters)){
            $th = $th->where($filters);
        }
        $th = $th->get();
        return $th;
    }

    public function doangettonghopPDF($idnh=null,$idhk=null,$idlop=null,$idkhoahoc=null){
        // $idgv = Auth::id();
        // $idnd = DB::table('taikhoan')
        // ->select('idd')
        // ->where('id',$idgv)
        // ->get();
        // foreach($idnd as $item){
        //     $id = $item->idd;
        // }

        $th = DB::table($this->table)
        ->join('phieucham', 'diemrl.idpcd', '=', 'phieucham.idpc')
        ->join('sinhvien', 'diemrl.idsv', '=', 'sinhvien.idhs')
        ->join('lop', 'sinhvien.idlop', '=', 'lop.id')
        ->join('nienkhoa', 'lop.idkh', '=', 'nienkhoa.idnienkhoa')
        ->select('idsv','idnh','idhk','muccham','mssv','hoten','malop','tenlop','khoahoc','iddoank',DB::raw('SUM(diemdat) as tongdiem'))
        ->groupBy('idsv','idnh','muccham','idhk','mssv','hoten','malop','tenlop','khoahoc','iddoank')
        // ->having('iddoank',$id)
       ;
        if(!empty($idnh)){
            $th = $th->where('idnh',$idnh);
        }
        if(!empty($idhk)){
            $th = $th->where('idhk',$idhk);
        }
        if(!empty($idlop)){
            $th = $th->where('lop.id',$idlop);
        }
        if(!empty($idkhoahoc)){
            $th = $th->where('idnienkhoa',$idkhoahoc);
        }
        $th = $th->get();
        return $th;
    }






    public function gettonghopgv($filters = []){

        $idgv = Auth::id();
        $idnd = DB::table('taikhoan')
        ->select('idgv')
        ->where('id',$idgv)
        ->get();
        foreach($idnd as $item){
            $id = $item->idgv;
        }

        $th = DB::table($this->table)
        ->join('phieucham', 'diemrl.idpcd', '=', 'phieucham.idpc')
        ->join('sinhvien', 'diemrl.idsv', '=', 'sinhvien.idhs')
        ->join('lop', 'sinhvien.idlop', '=', 'lop.id')
        ->join('nienkhoa', 'lop.idkh', '=', 'nienkhoa.idnienkhoa')
        ->select('idsv','idnh','idhk','muccham','mssv','hoten','malop','tenlop','khoahoc','idgvv',DB::raw('SUM(diemdat) as tongdiem'))
        ->groupBy('idsv','idnh','muccham','idhk','mssv','hoten','malop','tenlop','khoahoc','idgvv')
        ->having('lop.idgvv',$id)
       ;
        if(!empty($filters)){
            $th = $th->where($filters);
        }
        $th = $th->get();
        return $th;
    }

    public function gvgettonghopPDF($idnh=null,$idhk=null,$idlop=null,$idkhoahoc=null){
        // $idgv = Auth::id();
        // $idnd = DB::table('taikhoan')
        // ->select('idgv')
        // ->where('id',$idgv)
        // ->get();
        // foreach($idnd as $item){
        //     $id = $item->idgv;
        // }


        $th = DB::table($this->table)
        ->join('phieucham', 'diemrl.idpcd', '=', 'phieucham.idpc')
        ->join('sinhvien', 'diemrl.idsv', '=', 'sinhvien.idhs')
        ->join('lop', 'sinhvien.idlop', '=', 'lop.id')
        ->join('nienkhoa', 'lop.idkh', '=', 'nienkhoa.idnienkhoa')
        ->select('idsv','idnh','idhk','muccham','mssv','hoten','malop','tenlop','khoahoc','idgvv',DB::raw('SUM(diemdat) as tongdiem'))
        ->groupBy('idsv','idnh','muccham','idhk','mssv','hoten','malop','tenlop','khoahoc','idgvv')
        // ->having('idgvv',$id)
       ;
        if(!empty($idnh)){
            $th = $th->where('idnh',$idnh);
        }
        if(!empty($idhk)){
            $th = $th->where('idhk',$idhk);
        }
        if(!empty($idlop)){
            $th = $th->where('lop.id',$idlop);
        }
        if(!empty($idkhoahoc)){
            $th = $th->where('idnienkhoa',$idkhoahoc);
        }
        $th = $th->get();
        return $th;
    }


    //chuc nang cham diem va xem diem RL
    public function getthdat($filters = []){
        $td = DB::table($this->table)
        ->join('phieucham','diemrl.idpcd','=','phieucham.idpc')
        ->select(DB::raw('SUM(diemdat) as tongdiem'))
        ->groupBy('idsv')
        ;
        if(!empty($filters)){
            $td = $td->where($filters);
        }

        $td = $td->get();
        return $td;
    }
    public function getalldiem($filters = [],$id){
        $hanhk = DB::table('hknh')
        ->get();
        foreach($hanhk as $item){
            $bd = $item->ngaybd;
            $kt = $item->ngaykt;
            $now = date('Y-m-d');

            if($kt >= $now && $now >= $bd){
                $idnam = $item->idnh;
                $idhocky = $item->idhk;
            }
        }
        $hknhtruoc = DB::table('hknh')
        ->select(DB::raw('max(idhknh) as idm'))
        ->groupBy('idhknh')
        ->get();
        foreach($hknhtruoc as $item){
            $idmax = $item->idm;
        }
        $namt = DB::table('hknh')
        ->where('idhknh',$idmax)
        ->get();
        foreach($namt as $item){
                $idnamt = $item->idnh;
                $idhockyt = $item->idhk;
        }
        $pc = DB::table($this->table)
        ->join('phieucham', 'diemrl.idpcd', '=', 'phieucham.idpc')
        ->where('idsv',$id)
        ->orderBy('matc', 'ASC');
        if(!empty($filters)){
            $pc = $pc->where($filters);
        }elseif (!empty($idnam)&&!empty($idhocky)){
            $pc =$pc->where('idnh',$idnam);
            $pc =$pc->where('idhk',$idhocky);
        }else{
            $pc =$pc->where('idnh',$idnamt);
            $pc =$pc->where('idhk',$idhockyt);
        }

        $pc = $pc->get();
        return $pc;

    }

    public function addDiem($diem){

        DB::table($this->table)->insert($diem);
        // dd($id,$diem,$idnd);
        // for($i = 1; $i <= 2; $i++){
            // foreach($id as $item){
            // DB::table($this->table)->insert([
            //     'idpcd' => $item->$id[$item],
            //     'svdiem' => $item->$diem[$item],
            //     'idsv' => $idnd
            // ]);
            // $lastId =DB::getPdo()->lastInsertId();
            // DB::table($this->table)
            //         ->where('id', $lastId)
            //         ->update(['idsv' => $idnd]);
            // dd($diem);
            // DB::insert('INSERT INTO diemrl (idpcd, svdiem, idsv) values (?, ?, ?)',
            // $diem);
    }

    public function getNulldiem($idp,$id){
        $Null = DB::table($this->table)
        ->where('idpcd',$idp)
        ->where('idsv',$id)
        ->get();
        return $Null;
        if($Null!==null){
            return 1;
        }else{
            return 0;
        }
    }

    public function upDatediem($cndiem,$idp,$ids){
        DB::table($this->table)
        ->where('idpcd',$idp)
        ->where('idsv',$ids)
        ->update($cndiem);
    }

//lay diem tong cua diem toi da, diem khoa, diem sv
    public function getSUMdd($filters = [],$idsv){
        $hanhk = DB::table('hknh')
        ->get();
        foreach($hanhk as $item){
            $bd = $item->ngaybd;
            $kt = $item->ngaykt;
            $now = date('Y-m-d');

            if($kt >= $now && $now >= $bd){
                $idnam = $item->idnh;
                $idhocky = $item->idhk;
            }
        }
        $hknhtruoc = DB::table('hknh')
        ->select(DB::raw('max(idhknh) as idm'))
        ->groupBy('idhknh')
        ->get();
        foreach($hknhtruoc as $item){
            $idmax = $item->idm;
        }
        $namt = DB::table('hknh')
        ->where('idhknh',$idmax)
        ->get();
        foreach($namt as $item){
                $idnamt = $item->idnh;
                $idhockyt = $item->idhk;
        }
        $td = DB::table($this->table)
        ->join('phieucham','diemrl.idpcd','=','phieucham.idpc')
        ->select('muccham',DB::raw('SUM(diemdat) as tongdiem'))
        ->where('idsv',$idsv)
        ->groupBy('muccham')
        ;
        if(!empty($filters)){
            $td = $td->where($filters);
        }elseif (!empty($idnam)&&!empty($idhocky)){
            $td =$td->where('idnh',$idnam);
            $td =$td->where('idhk',$idhocky);
        }else{
            $td =$td->where('idnh',$idnamt);
            $td =$td->where('idhk',$idhockyt);
        }

        $td = $td->get();
        return $td;
    }

    public function getSUMmax($filters = [],$idsv){
        $hanhk = DB::table('hknh')
        ->get();
        foreach($hanhk as $item){
            $bd = $item->ngaybd;
            $kt = $item->ngaykt;
            $now = date('Y-m-d');

            if($kt >= $now && $now >= $bd){
                $idnam = $item->idnh;
                $idhocky = $item->idhk;
            }
        }
        $hknhtruoc = DB::table('hknh')
        ->select(DB::raw('max(idhknh) as idm'))
        ->groupBy('idhknh')
        ->get();
        foreach($hknhtruoc as $item){
            $idmax = $item->idm;
        }
        $namt = DB::table('hknh')
        ->where('idhknh',$idmax)
        ->get();
        foreach($namt as $item){
                $idnamt = $item->idnh;
                $idhockyt = $item->idhk;
        }
        $td = DB::table($this->table)
        ->join('phieucham','diemrl.idpcd','=','phieucham.idpc')
        ->select(DB::raw('SUM(diemmax) as tongmax'))
        ->where('idsv',$idsv);
        if(!empty($filters)){
            $td = $td->where($filters);
        }elseif (!empty($idnam)&&!empty($idhocky)){
            $td =$td->where('idnh',$idnam);
            $td =$td->where('idhk',$idhocky);
        }else{
            $td =$td->where('idnh',$idnamt);
            $td =$td->where('idhk',$idhockyt);
        }

        $td = $td->get();
        return $td;
    }

    public function getSUMsv($filters = [],$idsv){
        $hanhk = DB::table('hknh')
        ->get();
        foreach($hanhk as $item){
            $bd = $item->ngaybd;
            $kt = $item->ngaykt;
            $now = date('Y-m-d');

            if($kt >= $now && $now >= $bd){
                $idnam = $item->idnh;
                $idhocky = $item->idhk;
            }
        }
        $hknhtruoc = DB::table('hknh')
        ->select(DB::raw('max(idhknh) as idm'))
        ->groupBy('idhknh')
        ->get();
        foreach($hknhtruoc as $item){
            $idmax = $item->idm;
        }
        $namt = DB::table('hknh')
        ->where('idhknh',$idmax)
        ->get();
        foreach($namt as $item){
                $idnamt = $item->idnh;
                $idhockyt = $item->idhk;
        }
        $td = DB::table($this->table)
        ->join('phieucham','diemrl.idpcd','=','phieucham.idpc')
        ->select(DB::raw('SUM(svdiem) as tongsv'))
        ->where('idsv',$idsv);
        if(!empty($filters)){
            $td = $td->where($filters);
        }elseif (!empty($idnam)&&!empty($idhocky)){
            $td =$td->where('idnh',$idnam);
            $td =$td->where('idhk',$idhocky);
        }else{
            $td =$td->where('idnh',$idnamt);
            $td =$td->where('idhk',$idhockyt);
        }

        $td = $td->get();
        return $td;
    }

    public function getSUMgv($filters = [],$idsv){
        $hanhk = DB::table('hknh')
        ->get();
        foreach($hanhk as $item){
            $bd = $item->ngaybd;
            $kt = $item->ngaykt;
            $now = date('Y-m-d');

            if($kt >= $now && $now >= $bd){
                $idnam = $item->idnh;
                $idhocky = $item->idhk;
            }
        }
        $hknhtruoc = DB::table('hknh')
        ->select(DB::raw('max(idhknh) as idm'))
        ->groupBy('idhknh')
        ->get();
        foreach($hknhtruoc as $item){
            $idmax = $item->idm;
        }
        $namt = DB::table('hknh')
        ->where('idhknh',$idmax)
        ->get();
        foreach($namt as $item){
                $idnamt = $item->idnh;
                $idhockyt = $item->idhk;
        }
        $td = DB::table($this->table)
        ->join('phieucham','diemrl.idpcd','=','phieucham.idpc')
        ->select(DB::raw('SUM(gvdiem) as tonggv'))
        ->where('idsv',$idsv);
        if(!empty($filters)){
            $td = $td->where($filters);
        }elseif (!empty($idnam)&&!empty($idhocky)){
            $td =$td->where('idnh',$idnam);
            $td =$td->where('idhk',$idhocky);
        }else{
            $td =$td->where('idnh',$idnamt);
            $td =$td->where('idhk',$idhockyt);
        }

        $td = $td->get();
        return $td;
    }

    public function getSUMkhoa($filters = [],$idsv){
        $hanhk = DB::table('hknh')
        ->get();
        foreach($hanhk as $item){
            $bd = $item->ngaybd;
            $kt = $item->ngaykt;
            $now = date('Y-m-d');

            if($kt >= $now && $now >= $bd){
                $idnam = $item->idnh;
                $idhocky = $item->idhk;
            }
        }
        $hknhtruoc = DB::table('hknh')
        ->select(DB::raw('max(idhknh) as idm'))
        ->groupBy('idhknh')
        ->get();
        foreach($hknhtruoc as $item){
            $idmax = $item->idm;
        }
        $namt = DB::table('hknh')
        ->where('idhknh',$idmax)
        ->get();
        foreach($namt as $item){
                $idnamt = $item->idnh;
                $idhockyt = $item->idhk;
        }
        $td = DB::table($this->table)
        ->join('phieucham','diemrl.idpcd','=','phieucham.idpc')
        ->select(DB::raw('SUM(khoadiem) as tongkhoa'))
        ->where('idsv',$idsv);
        if(!empty($filters)){
            $td = $td->where($filters);
        }elseif (!empty($idnam)&&!empty($idhocky)){
            $td =$td->where('idnh',$idnam);
            $td =$td->where('idhk',$idhocky);
        }else{
            $td =$td->where('idnh',$idnamt);
            $td =$td->where('idhk',$idhockyt);
        }

        $td = $td->get();
        return $td;
    }

    public function getSUMdoan($filters = [],$idsv){
        $hanhk = DB::table('hknh')
        ->get();
        foreach($hanhk as $item){
            $bd = $item->ngaybd;
            $kt = $item->ngaykt;
            $now = date('Y-m-d');

            if($kt >= $now && $now >= $bd){
                $idnam = $item->idnh;
                $idhocky = $item->idhk;
            }
        }
        $hknhtruoc = DB::table('hknh')
        ->select(DB::raw('max(idhknh) as idm'))
        ->groupBy('idhknh')
        ->get();
        foreach($hknhtruoc as $item){
            $idmax = $item->idm;
        }
        $namt = DB::table('hknh')
        ->where('idhknh',$idmax)
        ->get();
        foreach($namt as $item){
                $idnamt = $item->idnh;
                $idhockyt = $item->idhk;
        }
        $td = DB::table($this->table)
        ->join('phieucham','diemrl.idpcd','=','phieucham.idpc')
        ->select(DB::raw('SUM(doandiem) as tongdoan'))
        ->where('idsv',$idsv);
        if(!empty($filters)){
            $td = $td->where($filters);
        }elseif (!empty($idnam)&&!empty($idhocky)){
            $td =$td->where('idnh',$idnam);
            $td =$td->where('idhk',$idhocky);
        }else{
            $td =$td->where('idnh',$idnamt);
            $td =$td->where('idhk',$idhockyt);
        }
        $td = $td->get();
        return $td;
    }


    public function getSUMpct($filters = [],$idsv){
        $hanhk = DB::table('hknh')
        ->get();
        foreach($hanhk as $item){
            $bd = $item->ngaybd;
            $kt = $item->ngaykt;
            $now = date('Y-m-d');

            if($kt >= $now && $now >= $bd){
                $idnam = $item->idnh;
                $idhocky = $item->idhk;
            }
        }
        $hknhtruoc = DB::table('hknh')
        ->select(DB::raw('max(idhknh) as idm'))
        ->groupBy('idhknh')
        ->get();
        foreach($hknhtruoc as $item){
            $idmax = $item->idm;
        }
        $namt = DB::table('hknh')
        ->where('idhknh',$idmax)
        ->get();
        foreach($namt as $item){
                $idnamt = $item->idnh;
                $idhockyt = $item->idhk;
        }
        $td = DB::table($this->table)
        ->join('phieucham','diemrl.idpcd','=','phieucham.idpc')
        ->select(DB::raw('SUM(pctdiem) as tongpct'))
        ->where('idsv',$idsv);
        if(!empty($filters)){
            $td = $td->where($filters);
        }elseif (!empty($idnam)&&!empty($idhocky)){
            $td =$td->where('idnh',$idnam);
            $td =$td->where('idhk',$idhocky);
        }else{
            $td =$td->where('idnh',$idnamt);
            $td =$td->where('idhk',$idhockyt);
        }

        $td = $td->get();
        return $td;
    }

    //tinh diem trung binh
    public function getDTB($filters = [],$idsv){
        $hanhk = DB::table('hknh')
        ->get();
        foreach($hanhk as $item){
            $bd = $item->ngaybd;
            $kt = $item->ngaykt;
            $now = date('Y-m-d');

            if($kt >= $now && $now >= $bd){
                $idnam = $item->idnh;
                $idhocky = $item->idhk;
            }
        }
        $hknhtruoc = DB::table('hknh')
        ->select(DB::raw('max(idhknh) as idm'))
        ->groupBy('idhknh')
        ->get();
        foreach($hknhtruoc as $item){
            $idmax = $item->idm;
        }
        $namt = DB::table('hknh')
        ->where('idhknh',$idmax)
        ->get();
        foreach($namt as $item){
                $idnamt = $item->idnh;
                $idhockyt = $item->idhk;
        }
        $diemtbhk = DB::table('diemtb')
        ->select('diemtb')
        ->where('idsv',$idsv)
        ->orderBy('idsv', 'ASC');
        if(!empty($filters)){
            $diemtbhk = $diemtbhk->where($filters);
        }elseif (!empty($idnam)&&!empty($idhocky)){
            $diemtbhk =$diemtbhk->where('idnh',$idnam);
            $diemtbhk =$diemtbhk->where('idhk',$idhocky);
        }else{
            $diemtbhk =$diemtbhk->where('idnh',$idnamt);
            $diemtbhk =$diemtbhk->where('idhk',$idhockyt);
        }
        $diemtbhk = $diemtbhk->get();
        return $diemtbhk;
    }

    public function getDiemTB($filters = [],$idsv){
        $diemtbhk = DB::table('diemtb')
        ->select('diemtb')
        ->where('idsv',$idsv)
        ->orderBy('idsv', 'ASC');
        if(!empty($filters)){
            $diemtbhk = $diemtbhk->where($filters);
        }
        $diemtbhk = $diemtbhk->get();
        foreach ($diemtbhk as $item){
               $diemtb =  $item->diemtb;
        }
        // dd($diemtbhk);
        if($diemtb>=2&&$diemtb<=2.49){
            $tentc = 'ĐTBCHK đạt từ 2,00 đến 2,49';
            $diem = 2;
        }elseif($diemtb>=2.50&&$diemtb<=3.19){
            $tentc = 'ĐTBCHK đạt từ 2,50 đến 3,19';
            $diem = 4;
        }elseif($diemtb>=3.20&&$diemtb<=3.59){
                $tentc = 'ĐTBCHK đạt từ 3,20 đến 3,59';
                $diem = 6;
        }else{
            $tentc = 'Điểm trung bình chung học kỳ (ĐTBCHK) đạt >= 3,60';
            $diem = 8;
        }
        // dd($tentc,$diem);
        DB::table('form')
        ->where('quyen',0)
        ->where('tbhk',1)
        ->update([
            'tentc' => $tentc,
            'diemmax' => $diem,
        ]);

        $idpc = DB::table('phieucham')
        ->select('idpc')
        ->join('form', 'phieucham.idf', '=', 'form.idform')
        ->where('form.quyen',0)
        ->where('tbhk',1)
        ->orderBy('matc', 'ASC');
        if(!empty($filters)){
            $idpc = $idpc->where($filters);
        }
        $idpc = $idpc->get();

        // dd($idpc);
        foreach ($idpc as $i){
            $idp =  $i->idpc;
        }
        // dd($idp);
        $Null = DB::table($this->table)
        ->where('idpcd',$idp)
        ->where('idsv',$idsv)
        ->get();
        // dd($Null);
        if(empty($Null)){
            DB::table($this->table)->insert([
                'idpcd' => $idp,
                'diemdat' => $diem,
                'idsv' => $idsv
            ]);
        }else{
            DB::table($this->table)
            ->where('idpcd',$idp)
            ->update([
                'diemdat' => $diem,
            ]);
        }
    }
}
