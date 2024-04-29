<?php
namespace App\Http\Controllers\Admin;

use App\Models\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Imports\LocationsImport;
use Maatwebsite\Excel\Facades\Excel;

class ReportsController extends Controller
{
    public $settings;
    
    public function __construct()
    {
        $this->settings = Settings::query()->first();
        view()->share([
            'locales' => Language::all(),
            'settings' => $this->settings,
        ]);
    }
    
    public function index(Request $request)
    {
        return redirect()->route('admin.clients.index');
        return view('admin.reports.home');
    }

}
