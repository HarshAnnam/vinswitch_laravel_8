<?php

namespace App\Imports;

use App\Models\Did;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;

class DidImport implements ToModel
{

    private $vendor_id; 

    public function __construct(array $vendor_id = [])
    {
        $this->vendor_id = $vendor_id;         
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $did = Did::where('number', $row[0])->first();
        
        if($row[0] != 'number' && empty($did)){
            $did['vendor_id'] = $this->vendor_id['vendor'];
            $did['number'] = $row[0];
            $did['rate_center'] = $row[1];           
            return new Did($did);
        }  
       
    }
    
}
