<?php

namespace App\Models\clients;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Lop extends Model
{
    use HasFactory;

    protected $table = 'lop';


    //chuc nang tong hop diem RL
    public function getalllistkhoa(){
        $khoa = DB::table('khoa')
        ->get();
        return $khoa;
    }

    public function getalllistlop(){
        $lop = DB::table($this->table)
        ->get();
        return $lop;
    }

    public function getalllistgv(){
        $khoa = DB::table('giaovien')
        ->get();
        return $khoa;
    }

    public function getalllistnk(){
        $khoa = DB::table('nienkhoa')
        ->get();
        return $khoa;
    }

    public function getnamekhoa($id){
        $khoa = DB::table('khoa')
        ->select('tenkhoa')
        ->where('idkhoa',$id)
        ->get();
        return $khoa;
    }

    public function getnamegv($id){
        $khoa = DB::table('giaovien')
        ->select('hotengv')
        ->where('idgv',$id)
        ->get();
        return $khoa;
    }

    public function getnamelop($id){
        $khoa = DB::table('lop')
        ->select('tenlop')
        ->where('id',$id)
        ->get();
        return $khoa;
    }
    public function getnamekhoahoc($id){
        $khoa = DB::table('nienkhoa')
        ->select('khoahoc')
        ->where('idnienkhoa',$id)
        ->get();
        return $khoa;
    }

    //tonghop diem RL cho khoa
    public function getallgvkhoa(){

        $idgv = Auth::id();
        $idnd = DB::table('taikhoan')
        ->select('idk')
        ->where('id',$idgv)
        ->get();
        foreach($idnd as $item){
            $id = $item->idk;
        }

        $dslop = DB::table('giaovien')
        ->join('khoa', 'giaovien.idk', '=', 'khoa.idkhoa')
        ->select('idgv','magv','hotengv')
        ->where('idk',$id)
        ->get();

        return $dslop;

    }

    public function getlopkhoa(){

        $idgv = Auth::id();
        $idnd = DB::table('taikhoan')
        ->select('idk')
        ->where('id',$idgv)
        ->get();
        foreach($idnd as $item){
            $id = $item->idk;
        }

        $dslop = DB::table($this->table)
        ->join('giaovien', 'lop.idgvv', '=', 'giaovien.idgv')
        ->select('lop.id','malop','tenlop')
        ->where('idk',$id)
        ->orderBy('malop', 'ASC')
        ->get();

        return $dslop;

    }

    //tonghop diem RL cho doan khoa
    public function getlopdoan(){

        $idgv = Auth::id();
        $idnd = DB::table('taikhoan')
        ->select('idd')
        ->where('id',$idgv)
        ->get();
        foreach($idnd as $item){
            $id = $item->idd;
        }

        $dslop = DB::table($this->table)
        ->where('iddoank',$id)
        ->orderBy('malop', 'ASC')
        ->get();

        return $dslop;

    }
    //tonghop diem RL cho gvcv
    public function getlopgv(){

        $idgv = Auth::id();
        $idnd = DB::table('taikhoan')
        ->select('idgv')
        ->where('id',$idgv)
        ->get();
        foreach($idnd as $item){
            $id = $item->idgv;
        }

        $dslop = DB::table($this->table)
        ->join('giaovien', 'lop.idgvv', '=', 'giaovien.idgv')
        ->where('idgvv',$id)
        ->orderBy('malop', 'ASC')
        ->get();

        return $dslop;

    }

//list chuc nang cham va xem diem RL
    public function getalldslop(){

        $idgv = Auth::id();
        $idnd = DB::table('taikhoan')
        ->select('idgv')
        ->where('id',$idgv)
        ->get();
        foreach($idnd as $item){
            $id = $item->idgv;
        }

        $dslop = DB::table($this->table)
        ->join('nienkhoa', 'lop.idkh', '=', 'nienkhoa.idnienkhoa')
        ->join('giaovien', 'lop.idgvv', '=', 'giaovien.idgv')
        ->where('idgvv',$id)
        ->orderBy('malop', 'ASC')
        ->get();

        return $dslop;

    }

    public function getalldslopad($idgv){


        $dslop = DB::table($this->table)
        ->join('nienkhoa', 'lop.idkh', '=', 'nienkhoa.idnienkhoa')
        ->join('giaovien', 'lop.idgvv', '=', 'giaovien.idgv')
        ->where('idgvv',$idgv)
        ->orderBy('malop', 'ASC')
        ->get();

        return $dslop;

    }

    public function getalldslopd(){

        $idgv = Auth::id();
        $idnd = DB::table('taikhoan')
        ->select('idd')
        ->where('id',$idgv)
        ->get();
        foreach($idnd as $item){
            $id = $item->idd;
        }

        $dslop = DB::table($this->table)
        ->join('nienkhoa', 'lop.idkh', '=', 'nienkhoa.idnienkhoa')
        ->where('iddoank',$id)
        ->orderBy('malop', 'ASC')
        ->get();

        return $dslop;

    }

    public function getalldslopk(){

        $idgv = Auth::id();
        $idnd = DB::table('taikhoan')
        ->select('idk')
        ->where('id',$idgv)
        ->get();
        foreach($idnd as $item){
            $id = $item->idk;
        }

        $dslop = DB::table($this->table)
        ->join('nienkhoa', 'lop.idkh', '=', 'nienkhoa.idnienkhoa')
        ->join('giaovien', 'lop.idgvv', '=', 'giaovien.idgv')
        ->where('idk',$id)
        ->orderBy('malop', 'ASC')
        ->get();

        return $dslop;

    }
    public function getDetail($idloph,$keywords = null){
        // DB::enableQueryLog();
       $dssv = DB::table('sinhvien')
       ->join('lop', 'sinhvien.idlop', '=', 'lop.id')
        ->join('nienkhoa', 'lop.idkh', '=', 'nienkhoa.idnienkhoa')
        ->join('giaovien', 'lop.idgvv', '=', 'giaovien.idgv')
        ->where('lop.id',$idloph);

        if(!empty($keywords)){
            $dssv = $dssv->where(function($query) use ($keywords) {
                $query->orwhere('mssv', 'like', '%'.$keywords.'%');
                $query->orwhere('hoten', 'like', '%'.$keywords.'%');
            });
        }
        $dssv = $dssv->get();
        // $sql = DB::getQueryLog();
        // dd($sql);
        return $dssv;

     }

     public function getallkhoa(){
        $khoa = DB::table('khoa')
        ->orderBy('makhoa', 'ASC')
        ->get();

        return $khoa;
     }

     public function getgv($idk){
        // return DB::select('SELECT * FROM '.$this->table.' WHERE id=?', [$idloph]);
       $dsgv = DB::table('giaovien')
       ->join('khoa', 'giaovien.idk', '=', 'khoa.idkhoa')
        ->where('idk',$idk)
        ->get();
        return $dsgv;
     }
    //  public function getalllop($idlop){

    //     $dslop = DB::table($this->table)
    //     ->join('nienkhoa', 'lop.idkh', '=', 'nienkhoa.id')
    //     ->join('giaovien', 'lop.idgvv', '=', 'giaovien.idgv')
    //     ->orderBy('malop', 'ASC')
    //     ->get();

    //     return $dslop;

    // }
}
