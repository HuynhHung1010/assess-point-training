<?php

namespace App\Models\clients;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

class Taikhoan extends Model
{
    use HasFactory;
    protected $table = 'taikhoan';

    protected $fillable = ['tentk','password','ngdung','idsv','idgv','idk','idpct'];


    public function getall($keywords=null){
        $ng = DB::table($this->table)
        ->orderBy('created_at','DESC')
        ;
        if(!empty($keywords)){
            $ng = $ng->where(function($query) use ($keywords) {
                $query->orwhere('tentk', 'like', '%'.$keywords.'%');
                $query->orwhere('ngdung', 'like', '%'.$keywords.'%');
                $query->orwhere('created_at', 'like', '%'.$keywords.'%');
            });
        }
        $ng = $ng->get();
        return $ng;
    }

    public function getDetail($idtk){
        return DB::select('SELECT * FROM '.$this->table.' WHERE id=?', [$idtk]);
     }


     public function deleteTK($idtk){
        return DB::delete("DELETE FROM $this->table  WHERE id=?", [$idtk]);
      }
    public function getidsv(){
        $tknd = Auth::id();
        $listtk = DB::table('taikhoan')
        ->select('idsv')
        ->where('id' , $tknd)
        ->get();
        return $listtk;
    }

    public function getidgv(){
        $tknd = Auth::id();
        $listtk = DB::table($this->table)
        ->select('idgv')
        ->where('id' , $tknd)
        ->get();
        return $listtk;
    }

    public function getidkhoa(){
        $tknd = Auth::id();
        $listtk = DB::table($this->table)
        ->select('idk')
        ->where('id' , $tknd)
        ->get();
        return $listtk;
    }

    public function getiddoan(){
        $tknd = Auth::id();
        $listtk = DB::table($this->table)
        ->select('idd')
        ->where('id' , $tknd)
        ->get();
        return $listtk;
    }

    public function getidpct(){
        $tknd = Auth::id();
        $listtk = DB::table($this->table)
        ->select('idpct')
        ->where('id' , $tknd)
        ->get();
        return $listtk;
    }

    public function getquyen(){
        $tknd = Auth::id();
        $listtk = DB::table($this->table)
        ->select('ngdung','tentk')
        ->where('id' , $tknd)
        ->get();
        return $listtk;
    }

    public function getNullTK($ten){
        $null = DB::table($this->table)
        ->where('tentk',$ten)
        ->get();
        return $null;
    }
    // public function login($ten,$mk){
        // $form = DB::select('SELECT * FROM form');

        // $tk = DB::table($this->table)
        // ->where('tentk',$ten)
        // ->get();
        // // dd($ten,$mk);
        // // dd($tk);
        // foreach($tk as $item){
        //     if($item->pass == $mk){
        //         return view('clients/home',$item->tentk);
        //     }else{
        //         return 'dang nhap sai';
        //     }
        // }

    // }
}
