<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Phanhoi extends Model
{
    use HasFactory;

    protected $table = 'phanhoi';

    public function getallphsv($filters = [],$idgv){
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
        $phgv = DB::table($this->table)
        ->join('sinhvien', 'phanhoi.idsv', '=', 'sinhvien.idhs')
        ->join('lop', 'sinhvien.idlop', '=', 'lop.id')
        ->join('giaovien', 'lop.idgvv', '=', 'giaovien.idgv')
        ->where('idgv',$idgv)
        ->where('gv',1)
        ->orderBy('idph', 'ASC');
        if(!empty($filters)){
            $phgv = $phgv->where($filters);
        }elseif (!empty($idnam)&&!empty($idhocky)){
            $phgv = $phgv->where('idnh',$idnam);
            $phgv = $phgv->where('idhk',$idhocky);
        }else{
            $phgv = $phgv->where('idnh',$idnamt);
            $phgv = $phgv->where('idhk',$idhockyt);
        }

        $phgv = $phgv->get();
        return $phgv;
    }

    public function getallphsvd($filters = [],$idk){
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
        $phgv = DB::table($this->table)
        ->join('sinhvien', 'phanhoi.idsv', '=', 'sinhvien.idhs')
        ->join('lop', 'sinhvien.idlop', '=', 'lop.id')
        ->join('doankhoa', 'lop.iddoank', '=', 'doankhoa.iddoankhoa')
        ->where('iddoankhoa',$idk)
        // ->where('phanhoi.idsv',$idsv)
        ->where('doan',1)
        ->orderBy('idph', 'ASC');
        if(!empty($filters)){
            $phgv = $phgv->where($filters);
        }elseif (!empty($idnam)&&!empty($idhocky)){
            $phgv = $phgv->where('idnh',$idnam);
            $phgv = $phgv->where('idhk',$idhocky);
        }else{
            $phgv = $phgv->where('idnh',$idnamt);
            $phgv = $phgv->where('idhk',$idhockyt);
        }

        $phgv = $phgv->get();
        return $phgv;
    }



    public function getallphsvk($filters = [],$idd){
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
        $phgv = DB::table($this->table)
        ->join('sinhvien', 'phanhoi.idsv', '=', 'sinhvien.idhs')
        ->join('lop', 'sinhvien.idlop', '=', 'lop.id')
        ->join('giaovien', 'lop.idgvv', '=', 'giaovien.idgv')
        ->join('khoa', 'giaovien.idk', '=', 'khoa.idkhoa')
        ->where('idkhoa',$idd)
        // ->where('phanhoi.idsv',$idsv)
        ->where('khoa',1)
        ->orderBy('idph', 'ASC');
        if(!empty($filters)){
            $phgv = $phgv->where($filters);
        }elseif (!empty($idnam)&&!empty($idhocky)){
            $phgv = $phgv->where('idnh',$idnam);
            $phgv = $phgv->where('idhk',$idhocky);
        }else{
            $phgv = $phgv->where('idnh',$idnamt);
            $phgv = $phgv->where('idhk',$idhockyt);
        }

        $phgv = $phgv->get();
        return $phgv;
    }




    public function getallphsvphong($filters = [],$idtr){
        $hanhk = DB::table('hknh')
        ->get();
        foreach($hanhk as $item){
            $bd = $item->ngaybd;
            $kt = $item->ngaykt;
            $now = date('Y-m-d');

            if($kt >= $now && $now >= $bd){
                $idnam = $item->idnh;
                $idhocky = $item->idhk;
            }else{

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
        $phgv = DB::table($this->table)
        ->join('sinhvien', 'phanhoi.idsv', '=', 'sinhvien.idhs')
        ->join('lop', 'sinhvien.idlop', '=', 'lop.id')
        ->join('giaovien', 'lop.idgvv', '=', 'giaovien.idgv')
        ->join('khoa', 'giaovien.idk', '=', 'khoa.idkhoa')
        ->join('pct', 'khoa.idphongct', '=', 'pct.idphong')
        ->where('idphong',$idtr)
        // ->where('phanhoi.idsv',$idsv)
        ->where('truong',1)
        ->orderBy('idph', 'ASC');
        if(!empty($filters)){
            $phgv = $phgv->where($filters);
        }elseif (!empty($idnam)&&!empty($idhocky)){
            $phgv = $phgv->where('idnh',$idnam);
            $phgv = $phgv->where('idhk',$idhocky);
        }else{
            $phgv = $phgv->where('idnh',$idnamt);
            $phgv = $phgv->where('idhk',$idhockyt);
        }

        $phgv = $phgv->get();
        return $phgv;
    }


    public function updateph($data,$id){
        DB::table($this->table)
        ->where('idph',$id)
        ->update($data);
    }

}
