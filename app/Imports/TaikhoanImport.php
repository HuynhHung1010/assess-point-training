<?php

namespace App\Imports;

use App\Models\clients\Taikhoan;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class TaikhoanImport implements ToModel,WithHeadingRow,WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {
        // dd($row['idd'],$row['idk']);
            return new Taikhoan([
                'tentk' => $row['tentk'],
                'password' => Hash::make($row['password']),
                'ngdung' => $row['ngdung'],
                'idsv' => $row['idsv'],
                'idgv' => $row['idgv'],
                'idd' => $row['idd'],
                'idk' => $row['idk'],
                'idpct' => $row['idpct'],
            ]);
    }
    public function rules(): array
    {
        return [
            'tentk' => 'required|unique:taikhoan',

             // Above is alias for as it always validates in batches
             '*.tentk' => 'required|unique:taikhoan',
             'password' => 'required',

             // Above is alias for as it always validates in batches
             '*.password' => 'required',
             'ngdung' => 'required',

             // Above is alias for as it always validates in batches
             '*.ngdung' => 'required',
            //  'idsv' => 'unique:taikhoan',

            //  // Above is alias for as it always validates in batches
            //  '*.idsv' => 'unique:taikhoan',
            //  'idgv' => 'unique:taikhoan',

            //  // Above is alias for as it always validates in batches
            //  '*.idgv' => 'unique:taikhoan',
            //  'idd' => 'unique:taikhoan',

            //  // Above is alias for as it always validates in batches
            //  '*.idd' => 'unique:taikhoan',
            //  'idk' => 'unique:taikhoan',

            //  // Above is alias for as it always validates in batches
            //  '*.idk' => 'unique:taikhoan',
            //  'idpct' => 'unique:taikhoan',

            // // Above is alias for as it always validates in batches
            // '*.idpct' => 'unique:taikhoan',
        ];
    }
    public function customValidationMessages()
    {
        return [
            'tentk.unique' => 'Tài khoản đã tồn tại ',
            'tentk.required' => 'Tên tài khoản không được để trống',
            'password.required' => 'Mật khẩu không được để trống',
            'ngdung.required' => 'Quyển người dùng tài khoản không được để trống',
            // 'idsv.unique' => 'id sinh viên đã tồn tại ',
            // 'idgv.unique' => 'id giáo viên đã tồn tại ',
            // 'idd.unique' => 'id đoàn khoa đã tồn tại ',
            // 'idk.unique' => 'id khoa đã tồn tại ',
            // 'idpct.unique' => 'id phòng công tác sinh viên đã tồn tại ',
        ];
    }
}

