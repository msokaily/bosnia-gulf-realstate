<?php
namespace App\Imports;

use App\Models\ActivityUsers;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Exception;

class ActivityUsersImport implements ToModel, WithHeadingRow
{

    protected $provider_id;
    protected $activity_id;

    public function __construct($provider_id, $activity_id)
    {
        $this->provider_id = $provider_id;
        $this->activity_id = $activity_id;
    }


    public function model(array $row)
    {
        if(isset($row['user_id']) AND !in_array($row['user_id'], ["",Null])){
            $activitiy_user = ActivityUsers::where('provider_id', $this->provider_id)->where('user_id', $row['user_id'])->where('activity_id', $this->activity_id)->first();

            if($activitiy_user == Null){
                $activitiy_user = new ActivityUsers;
            }

            $activitiy_user->user_id = $row['user_id'];
            $activitiy_user->usd = $row['usd'];
            $activitiy_user->try = $row['try'];
            $activitiy_user->syp = $row['syp'];
            $activitiy_user->distribution_point_id = $row['dp'];
            $activitiy_user->total_hours_worked = $row['total_hours_worked'];
            if(filled($row['total_hours_worked'])){
                $activitiy_user->is_emp = 1;
            }
            if(request('generate_qr_codes')){
                $activitiy_user->is_qr = 1;
            }
            $activitiy_user->total_overtime_hours = $row['total_overtime_hours'];
            $activitiy_user->total_vacations = $row['total_vacations'];
            $activitiy_user->notes = $row['notes'];
            $activitiy_user->activity_id = $this->activity_id;
            $activitiy_user->provider_id = intval($this->provider_id);

            $activitiy_user->save();
            return $activitiy_user;
        }

    }
}