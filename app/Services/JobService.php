<?php

namespace App\Services;

class JobService{

    public function filterEmergenyJobs($job){
       return $job->immediate == 'yes';
    }
    public function filterNormalJobs($job){
        return $job->immediate != 'yes';
     }
}


?>