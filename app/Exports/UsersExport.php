<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UsersExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    
    protected $company_id;

    public function __construct($company_id)
    {
        $this->company_id = $company_id;
    }

    
    public function view(): View
    {
        
        $users = User::where('user_type', 'Employee')->where('company_id',$this->company_id)->orderBy('created_at','asc')->get();

        return view('exports.users', [
            'items' => $users
        ]);
    }
}
