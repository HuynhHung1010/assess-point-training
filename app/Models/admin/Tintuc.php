<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tintuc extends Model
{
    use HasFactory;

    protected $table = 'tintuc';

    public function getalltt(){
        $tt = DB::table($this->table)
        ->orderBy('ngaylap','DESC')
        ->get();
        return $tt;
    }

    public function getalltb($id){
        $tt = DB::table($this->table)
        ->where('id',$id)
        ->orderBy('ngaylap','DESC')
        ->get();
        return $tt;
    }

    public function addtt($data){
        DB::table($this->table)->insert($data);
    }

    public function getDetail($idtb){
        return DB::select('SELECT * FROM '.$this->table.' WHERE id=?', [$idtb]);
     }

     public function edittt($data,$id){
        DB::table($this->table)
        ->where('id',$id)
        ->update($data);
    }
}
