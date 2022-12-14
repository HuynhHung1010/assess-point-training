<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Form extends Model
{
    use HasFactory;

    protected $table = 'form';


    public function getallform($filters = []){
        // $form = DB::select('SELECT * FROM form');

        $form = DB::table($this->table)
        ->orderBy('matc', 'ASC')
        ->get();

         return $form;

    }

    public function muc(){
        $muc = DB::table($this->table)
        ->select('muc')
        ->groupBy('muc')
        ->get();
        return $muc;
    }
    public function getSUM(){
        $td = DB::table($this->table)
        ->select(DB::raw('SUM(diemmax) as tongdiem'))
        ->get();
        return $td;
    }

    public function dmax($idform){
        $m = DB::table($this->table)
        ->select('diemmax')
        ->where('idform',$idform)
        ->get();
        return $m;
    }
    public function addmuc($muc){
        DB::table($this->table)
        ->update(['muc' => $muc]);
    }
    public function addform($data){
        DB::insert('INSERT INTO form (matc, tentc, diemmax,quyen) values (?, ?, ?, ?)',
        $data);
    }

    public function getDetail($idform){
       return DB::select('SELECT * FROM '.$this->table.' WHERE idform=?', [$idform]);
    }

    public function updateForm($data, $idform){
        DB::table($this->table)
        ->where('idform',$idform)
        ->update($data);
     }

     public function deleteForm($idform){
       return DB::delete("DELETE FROM $this->table  WHERE idform=?", [$idform]);
     }

}
