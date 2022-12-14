<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Time extends Model
{
    use HasFactory;

    protected $table = 'thongbao';

    public function gethanphanhoi($filters = []){
        $tg = DB::table('hknh')
        ->orderBy('idhknh', 'DESC');
        if(!empty($filters)){
            $tg = $tg->where($filters);
        }

        $tg = $tg->get();
        return $tg;
    }

    public function getalltime(){
        $time = DB::table($this->table)
        ->join('namhoc', 'thongbao.idnh', '=', 'namhoc.idnh')
        ->join('hocky', 'thongbao.idhk', '=', 'hocky.idhk')
        ->orderBy('tennam', 'DESC')
        ->get();

        return $time;

    }

    public function gethanlap(){
        $han = DB::table($this->table)
        ->select('hanlapphieu')
        ->get();
        return $han;
    }

    public function gettimecham($filters = []){
        $tg = DB::table($this->table)
        ->orderBy('id', 'ASC');
        if(!empty($filters)){
            $tg = $tg->where($filters);
        }

        $tg = $tg->get();
        return $tg;
    }

    public function addtime($data){
        DB::table($this->table)->insert($data);
    }

    public function getDetail($idt){
        $time = DB::table($this->table)
        ->where('id',$idt)
        ->get();
        return $time;
    }


    public function edittime($data, $idt){
        DB::table($this->table)
        ->where('id',$idt)
        ->update($data);
    }

    public function deleteTime($idt){
        return DB::delete("DELETE FROM $this->table  WHERE id=?", [$idt]);
      }

}
