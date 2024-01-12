<?php

namespace DTApi\Http\Controllers;

use DTApi\Models\Job;
use DTApi\Http\Requests;
use DTApi\Models\Distance;
use Illuminate\Http\Request;
use DTApi\Repository\BookingRepository;
use App\Traits\GlobalResponseTrait;
use Log;

/**
 * Class BookingController
 * @package DTApi\Http\Controllers
 */
class BookingController extends Controller
{
    use GlobalResponseTrait;

    /**
     * @var BookingRepository
     */
    protected $bookingRepository;

    /**
     * BookingController constructor.
     * @param BookingRepository $bookingRepository
     */
    public function __construct(BookingRepository $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        try {
            $user_id = $request->get('user_id');
            $response['jobs'] = $this->bookingRepository->getAllJobs($user_id);

            if (sizeof($jobs) > 0) {
                return $this->returnResponse('', $response, 200 , count($response['jobs']));
            } else {
                return $this->returnResponseError(204, '', 'No job found');
            }

        } catch (\Throwable $exception) {
            Log::error($exception->getMessage());
            return $this->returnResponseError(999, 'Something went wrong. Please try again', '');
        }
    }

    
}
