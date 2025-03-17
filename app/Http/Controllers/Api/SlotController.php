<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSlotRequest;
use Illuminate\Http\Request;
use App\Models\DoctorAvailability;
use Symfony\Component\HttpFoundation\Response;

class SlotController extends Controller
{
    public function slots($id, Request $request)
    {
        $params = $request->all();
        $data = DoctorAvailability::with('appointments')->where('doctor_id', $id);
        $data = $this->filter($data, $params);
        $data = $data->whereDoesntHave('appointments', function ($query) {
            $query->where('status', '!=', 'Confirmed');
        });
        $data = $data->paginate(10);

        return sendResponse('Data fetched successfully',$data,Response::HTTP_OK);
    }
    private function filter($data, $params)
    {
        # search by date
        if (isset($params['date']) && !empty($params['date'])) {
            $data = $data->where('date', $params['date']);
        }
        # search by time
        if (isset($params['time_slot']) && !empty($params['time_slot'])) {
            $data = $data->where('time_slot', $params['time_slot']);
        }

        return $data;
    }
    public function availability(CreateSlotRequest $request)
    {
        try {
            $data = DoctorAvailability::create($request->all());
            return sendResponse(
                'Slot created successfully',
                $data,
                Response::HTTP_CREATED
            );
        }catch (\Exception $exception){
            return SendError(
                'Something went wrong',
                [],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
