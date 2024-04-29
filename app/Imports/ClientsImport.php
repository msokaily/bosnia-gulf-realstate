<?php

namespace App\Imports;

use App\Models\Client;
use App\Models\ClientProduct;
use App\Models\Product;
use App\Models\Realstate;
use App\Models\RealstateProduct;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithColumnLimit;
use Maatwebsite\Excel\Concerns\WithLimit;

class ClientsImport implements WithColumnLimit, WithLimit, ToCollection, WithMultipleSheets
{

    public function __construct()
    {
    }

    public function endColumn(): string
    {
        return 'P';
    }

    public function limit(): int
    {
        return 1000;
    }

    public function sheets(): array
    {
        $sheets = [];
        // for ($i=1; $i < 62; $i++) { 
        //     $sheets[$i] = $this;
        // }
        $sheets[0] = $this;
        return $sheets;
    }

    public function collection(Collection $rows)
    {
        $client = null;
        $realstate = null;
        for ($i = 26; $i < count($rows); $i++) {
            $row = $rows[$i];
            if (isset($row[1]) && !empty($row[1])) {
                if (trim($row[2]) == 'I  MJESEC') {
                    $retName = explode('OPU-IP:', $row[1]);
                    $name = trim(str_replace(',', '', $retName[0]));
                    $splitName = count(explode('KO:', $retName[1])) > 1 ? explode('KO:', $retName[1]) : explode('KO.', $retName[1]);
                    $opuip = trim($splitName[0]);
                    $address = trim($splitName[1] ?? '');
                    
                    $client = Client::where('name', 'like', $name)->first();
                    if (!$client) {
                        $client = new Client();
                        $client->name = empty($name) ? 'NoName('.str_random(7).')' : $name;
                        $client->save();
                    }
                    
                    $realstate = new Realstate();
                    $realstate->client_id = $client->id;
                    $realstate->opu_ip = $opuip;
                    $realstate->address = $address;
                    $realstate->save();
                    // else {
                    //     $patternOpuip = "/OPU-IP[^A-Z]+[\s]/i";
                    //     preg_match($patternOpuip, $row[1], $retOpuip);
                    //     if (count($retOpuip) > 0) {
                    //         $client_opu_ip = trim(str_replace(['OPU-IP:', 'OPU-IP'], ['', ''], $retOpuip[0]));
                    //         $client = Client::where('opu_ip', 'like', '%' . $client_opu_ip . '%')->first() ?? null;
                    //     }
                    // }
                } else if (trim($row[1]) != 'TOTAL' && $realstate) {
                    $product = Product::where('realstate_id', $realstate->id)->where('name', trim($row[1]))->first() ?? new Product();
                    $product->name = trim($row[1]);
                    $product->realstate_id = $realstate->id;
                    $product->save();
                    for ($t = 2; $t < 13; $t++) {
                        if (!empty(trim($row[$t]))) {
                            $realstateProduct = new RealstateProduct();
                            $realstateProduct->realstate_id = $realstate->id;
                            $realstateProduct->product_id = $product->id;
                            $realstateProduct->amount = $row[$t];
                            $realstateProduct->paid_at = Carbon::now()->month($t - 1);
                            $realstateProduct->save();
                        }
                    }
                } else if (trim($row[1]) == 'TOTAL') {
                    $client = null;
                }
            }
        }
        return true;
    }

    /*
    // Insert Clients Info
    public function collection(Collection $rows)
    {
        if (isset($row[10][1]) && !empty($row[10][1])) {
            $client = new Client();
            $client->name = $rows[10][1];
            $client->opu_ip = trim(str_replace(['OPU-IP:', 'OPU-IP'], ['', ''], $rows[11][1]));
            $client->address = trim(str_replace(['KO.', 'KO'], ['', ''], $rows[12][1])) . ' ' . $rows[13][1];
            $client->year = !empty($rows[14][1]) ? trim(explode('.', $rows[14][1])[0]) : null;
            return $client->save();
        }
        return false;
    }
    */
}
