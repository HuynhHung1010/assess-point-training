<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Phieucham extends Model
{
    use HasFactory;

    protected $table = 'phieucham';
    public function getnh(){
        $hanhk = DB::table('hknh')
        ->join('namhoc','hknh.idnh','=','namhoc.idnh')
        ->join('hocky','hknh.idhk','=','hocky.idhk')
        ->get();
        return $hanhk;
    }

    public function getallpc($filters = []){

        $hanhk = DB::table('hknh')
        ->get();
        // dd($hanhk);
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

    public function addpc($data){
        $Listidf = DB::table('form')
        ->get();

            foreach($Listidf as $item){
                DB::insert('INSERT INTO phieucham (idnh, idhk, muccham) values (?, ?, ?)',
                $data);
                $lastId =DB::getPdo()->lastInsertId();
                    DB::table($this->table)
                    ->where('idpc', $lastId)
                    ->update(['idf' => $item->idform,
                        'matc' => $item->matc,
                        'tentc' => $item->tentc,
                        'diemmax' => $item->diemmax,
                        'quyen' => $item->quyen
                ]);
        }
    }

    public function getDetail($idnh,$idhk){
        $list = DB::table($this->table)
        ->where('idnh',$idnh)
        ->where('idhk',$idhk)
        ->get();
        return $list;

    }

    public function deletepc($idn,$idhk){
        DB::table($this->table)
        ->where('idnh',$idn)
        ->where('idhk',$idhk)
        ->delete();
    }

    public function getdmax($idpc){
        $max = DB::table($this->table)
        ->join('form', 'phieucham.idf', '=', 'form.idform')
        ->select('diemmax')
        ->where('idpc',$idpc)
        ->get();
        return $max;
    }

    public function getIDPCgv(){
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
        $idpc = DB::table($this->table)
        ->join('form', 'phieucham.idf', '=', 'form.idform')
        ->select('diemmax')
        ->where('quyen',2)
        ;
        if(!empty($idnam)&&!empty($idhocky)){
            $idpc =$idpc->where('idnh',$idnam);
            $idpc =$idpc->where('idhk',$idhocky);
        }

        $idpc = $idpc->get();
        return $idpc;
    }
    public function getIDPCsv(){
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
        $idpc = DB::table($this->table)
        ->join('form', 'phieucham.idf', '=', 'form.idform')
        ->select('diemmax')
        ->where('quyen',1)
        ;
        if(!empty($idnam)&&!empty($idhocky)){
            $idpc =$idpc->where('idnh',$idnam);
            $idpc =$idpc->where('idhk',$idhocky);
        }

        $idpc = $idpc->get();
        return $idpc;
    }
}
