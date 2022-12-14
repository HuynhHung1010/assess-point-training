<?php

namespace App\Models\clients;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Minhchung extends Model
{
    use HasFactory;

    protected $table = 'minhchung';

    public function getallmc($filters = [], $id){
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

        $mc = DB::table($this->table)
        ->where('idsv',$id)
        ->orderBy('ngaytao', 'ASC');
        if(!empty($filters)){
            $mc = $mc->where($filters);
        }else{
            $mc =$mc->where('idnh',$idnam);
            $mc =$mc->where('idhk',$idhocky);
        }

        $mc = $mc->get();
        return $mc;

    }


    public function getidmc($id){
        // $form = DB::select('SELECT * FROM form');

        $mc = DB::table($this->table)
        ->where('idmc',$id)
        ->orderBy('ngaytao', 'ASC')
        ->get();
        return $mc;

    }

    public function addFile($ten,$file,$idnh,$idhk){
        $tknd = Auth::id();
        $listtk = DB::table('taikhoan')
        ->select('idsv')
        ->where('id' , $tknd)
        ->get();

        foreach($listtk as $item){
            // dd($ten,$file,$item->idsv);
            $idsv = $item->idsv;
        }
            DB::table($this->table)->insert([
                'tenmc' => $ten,
                'tenfile' => $file,
                'idsv' => $idsv,
                'ngaytao' => date('Y-m-d H:i:s'),
                'idnh' => $idnh,
                'idhk' => $idhk,
            ]);
    }
}
