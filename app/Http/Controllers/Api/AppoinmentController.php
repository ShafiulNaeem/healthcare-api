<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookAppoinmentRequest;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Symfony\Component\HttpFoundation\Response;

class AppoinmentController extends Controller
{
    public function bookAppointment(BookAppoinmentRequest $request)
    {
        try {
            $data = Appointment::create($request->all());
            return sendResponse(
                'Appointment booked successfully',
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
    public function patient($id)
    {
        return sendResponse(
          'Data fetched successfully',
            Appointment::with(['patient','doctor','doctorAvailability'])
                ->where('patient_id', $id)->paginate(10),
            Response::HTTP_OK
        );
    }
    public function doctor($id)
    {
        return sendResponse(
            'Data fetched successfully',
            Appointment::with(['patient','doctor','doctorAvailability'])
                ->where('doctor_id', $id)->paginate(10),
            Response::HTTP_OK
        );
    }
}
