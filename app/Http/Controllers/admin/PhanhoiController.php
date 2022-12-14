<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\clients\Taikhoan;
use App\Models\Phanhoi;


class PhanhoiController extends Controller
{
    private $tk;
    private $ph;
    public function __construct()
    {
        $this->tk = new Taikhoan();
        $this->ph = new Phanhoi();
    }

    public function getlistsvph(Request $request){
        $title = 'Danh sách sinh viên Phản hồi về điểm rèn luyện';

            $filters = [];

            if(!empty($request->idnh)){
                $Idnh = $request->idnh;

                $filters[] = ['idnh', '=', $Idnh];

            }

            if(!empty($request->idhk)){
                $Idhk = $request->idhk;

                $filters[] = ['idhk', '=', $Idhk];

        }

        $listtk = $this->tk->getidpct();
            foreach($listtk as $item){
                $idpct = $item->idpct;
            }

        $getallnam = getAllnam();
        $getallhk = getAllhocky();
        $phList = $this->ph->getallphsvphong($filters,$idpct);

        // dd($phList);

        return view('admin/phanhoi/svphanhoi', compact('title','phList','getallnam','getallhk'));
    }
    public function addPH(Request $request){
        $title = 'Phản hồi về điểm rèn luyện';

        $idph = $request->idph;

        $getallnam = getAllnam();
        $getallhk = getAllhocky();

        return view('admin/phanhoi/phanhoisv', compact('title','getallnam','getallhk','idph'));
    }

    public function postaddPH(Request $request){
        $request->validate([
            // 'matc' => 'required',
            // 'idnh' => ['required','integer',function($attribute, $value, $fail){
            //     if($value==0){
            //         $fail('Bắt buộc phải chọn năm học');
            //     }
            // }],
            // 'idhk' => ['required','integer',function($attribute, $value, $fail){
            //     if($value==0){
            //         $fail('Bắt buộc phải chọn học kỳ');
            //     }
            // }],
            'phanhoi' => 'required'
        ],[
            // 'idnh.integer' => 'Năm không hợp lệ',
            // 'idnh.required' => 'Năm không được để trống',
            // 'idnh.integer' => 'Học kỳ không hợp lệ',
            // 'idnh.required' => 'Học kỳ không được để trống',
            'phanhoi.required' => 'Phản hồi bắt buộc phải nhập',
        ]);
        $idph = $request->idph;
        $phInsert = [
           'traloi' => $request->phanhoi,
           'ngaytl' => date('Y-m-d H:i:s')
        ];
        // dd($TimeInsert);
        $this->ph->updateph($phInsert,$idph);

        return redirect()->route('admin.guiph')->with('msg', 'Thêm phản hồi thành công!');
    }

}
