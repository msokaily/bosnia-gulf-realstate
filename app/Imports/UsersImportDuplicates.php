<?php
namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImportDuplicates implements ToCollection, WithHeadingRow
{

    protected $company_id;
    private $duplicatedIds = [];

    public function __construct($company_id)
    {
        $this->company_id = $company_id;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            if(isset($row['id_number']) AND $row['id_number'] != Null){
                $id_number = $row['id_number'];
                $duplicates = User::where('id_number', $id_number)
                ->where('company_id', $this->company_id)->where('user_type', 'Employee')->first();
                
                if ($duplicates AND $id_number != Null) {
                    $this->duplicatedIds[] = $id_number;
                }
            }
           
        }
    }
    
    public function getDuplicatedIds()
    {
        return $this->duplicatedIds;
    }
}