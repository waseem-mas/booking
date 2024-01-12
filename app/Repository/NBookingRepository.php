<?php

namespace DTApi\Repository;

use DTApi\Events\SessionEnded;
use DTApi\Helpers\SendSMSHelper;
use Event;
use Carbon\Carbon;
use Monolog\Logger;
use DTApi\Models\Job;
use DTApi\Models\User;
use DTApi\Models\Language;
use DTApi\Models\UserMeta;
use DTApi\Helpers\TeHelper;
use Illuminate\Http\Request;
use DTApi\Models\Translator;
use DTApi\Mailers\AppMailer;
use DTApi\Models\UserLanguages;
use DTApi\Events\JobWasCreated;
use DTApi\Events\JobWasCanceled;
use DTApi\Models\UsersBlacklist;
use DTApi\Helpers\DateTimeHelper;
use DTApi\Mailers\MailerInterface;
use Illuminate\Support\Facades\DB;
use Monolog\Handler\StreamHandler;
use Illuminate\Support\Facades\Log;
use Monolog\Handler\FirePHPHandler;
use Illuminate\Support\Facades\Auth;
use App\Services\JobService;

/**
 * Class BookingRepository
 * @package DTApi\Repository
 */
class BookingRepository extends BaseRepository
{

    protected $job,$jobService;

    /**
     * @param Job $model
     */
    function __construct(Job $job,JobService $jobService)
    {
        parent::__construct();
        $this->job = $job;
        $this->jobService = $jobService;
    }

    /**
     * @param $user_id
     * @return array
     */
    public function getAllJobs($user_id,$request)
    {
        $user = User::find($user_id);
        $jobs = [];
        if(auth()->user()->hasRole([env('ADMIN_ROLE_ID'),env('SUPERADMIN_ROLE_ID')])){
            $jobs = $this->job->filter($request)->get();
        }else{

            $jobs = $this->job->with('user.userMeta', 'user.average', 'translatorJobRel.user.average', 'language', 'feedback')
            ->when($user->type == 'customer',function($query){
                return $query->whereIn('status', ['pending', 'assigned', 'started']);
            })
            ->when($user->type == 'translator',function($query){
                // here condition for translator
                return $query->whereIn('status', ['pending', 'assigned', 'started']);
            })
            ->orderBy('due', 'asc')->get();
        }
        return ['emergencyJobs' => array_filter($jobs,$this->jobService->filterEmergenyJobs), 'noramlJobs' => array_filter($jobs,$this->jobService->filterNormalJobs), 'cuser' => $user, 'usertype' => $user->type];
    }


}