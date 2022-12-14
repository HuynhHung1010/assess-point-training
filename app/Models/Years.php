<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Years extends Model
{
    use HasFactory;

    protected $table = 'namhoc';

    protected $table1 = 'hocky';

    public function getallhknh(){
        $hknh = DB::table('hknh')
        ->join('namhoc','hknh.idnh','=','namhoc.idnh')
        ->join('hocky','hknh.idhk','=','hocky.idhk')
        ->orderBy('tennam', 'DESC')
        ->orderBy('tenhk', 'DESC')
        ->get();
        return $hknh;
    }

    public function addhknh($data){
        DB::insert('INSERT INTO hknh (idnh, idhk, ngaybd,ngaykt) values (?, ?, ?, ?)',$data);
    }

    public function getDetailhknh($idhknh){
        return DB::select('SELECT * FROM hknh WHERE idhknh=?', [$idhknh]);
     }

     public function updatehknh($data, $idhknh){
        DB::table('hknh')
        ->where('idhknh',$idhknh)
        ->update($data);
    }

    public function deletehknh($idhknh){
        return DB::delete("DELETE FROM hknh  WHERE idhknh=?", [$idhknh]);
      }



    public function getAll(){
        $year = DB::table($this->table)
        ->orderBy('tennam', 'DESC')
        ->get();
        return $year;
    }


    public function addNam($data){
        DB::table($this->table)
        ->insert(['tennam' => $data]);
    }

    public function getDetail($idnh){
        return DB::select('SELECT * FROM '.$this->table.' WHERE idnh=?', [$idnh]);
     }

     public function updateNH($nh, $id){
         DB::table($this->table)
         ->where('idnh',$id)
         ->update(['tennam' => $nh]);
      }

     public function deleteNamhoc($idnh){
        return DB::delete("DELETE FROM $this->table  WHERE idnh=?", [$idnh]);
      }

    public function namenam($idnh){
        $namenh = DB::table($this->table)
        ->select('tennam')
        ->where('idnh',$idnh)
        ->get();
        return $namenh;
    }
    public function namehk($idhk){
        $namehk = DB::table($this->table1)
        ->select('tenhk')
        ->where('idhk',$idhk)
        ->get();
        return $namehk;
    }



    public function getAllhk(){
        $hk = DB::table($this->table1)
        ->orderBy('tenhk', 'ASC')
        ->get();

        return $hk;
    }

    public function addHK($data){
        DB::table($this->table1)
        ->insert(['tenhk' => $data]);
    }

    public function getDetailhk($idhk){
        return DB::select('SELECT * FROM '.$this->table1.' WHERE idhk=?', [$idhk]);
     }

     public function updatehk($hk, $id){
         DB::table($this->table1)
         ->where('idhk',$id)
         ->update(['tenhk' => $hk]);
      }

     public function deletehk($idhk){
        return DB::delete("DELETE FROM $this->table1  WHERE idhk=?", [$idhk]);
      }

    // get nam theo hien tai
// public function getAll(){
//     $hanhk = DB::table('hknh')
//     ->get();
//     foreach($hanhk as $item){
//         $bd = $item->ngaybd;
//         $kt = $item->ngaykt;
//         $now = date('Y-m-d');

//         if($kt >= $now && $now >= $bd){
//             $idnam = $item->idnh;
//         }else{

//         }
//     }

//     $year = DB::table($this->table)
//     ->orderBy('tennam', 'ASC');
//     if(!empty($idnam)){
//         $year =$year->where('idnh',$idnam);
//     }
//     $year = $year->get();
//     return $year;
// }

    //get hoc ky theo hien tai
    // public function getAllhk(){
    //     $hanhk = DB::table('hknh')
    //     ->get();
    //     foreach($hanhk as $item){
    //         $bd = $item->ngaybd;
    //         $kt = $item->ngaykt;
    //         $now = date('Y-m-d');

    //         if($kt >= $now && $now >= $bd){
    //             $idhocky = $item->idhk;
    //         }else{

    //         }
    //     }
    //     $hk = DB::table($this->table1)
    //     ->orderBy('tenhk', 'ASC');
    //     if(!empty($idhocky)){
    //         $hk =$hk->where('idhk',$idhocky);
    //     }

    //     $hk = $hk->get();

    //     return $hk;
    // }

}
