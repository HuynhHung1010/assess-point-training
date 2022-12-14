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
            'tentk.unique' => 'T??i kho???n ???? t???n t???i ',
            'tentk.required' => 'T??n t??i kho???n kh??ng ???????c ????? tr???ng',
            'password.required' => 'M???t kh???u kh??ng ???????c ????? tr???ng',
            'ngdung.required' => 'Quy???n ng?????i d??ng t??i kho???n kh??ng ???????c ????? tr???ng',
            // 'idsv.unique' => 'id sinh vi??n ???? t???n t???i ',
            // 'idgv.unique' => 'id gi??o vi??n ???? t???n t???i ',
            // 'idd.unique' => 'id ??o??n khoa ???? t???n t???i ',
            // 'idk.unique' => 'id khoa ???? t???n t???i ',
            // 'idpct.unique' => 'id ph??ng c??ng t??c sinh vi??n ???? t???n t???i ',
        ];
    }
}

