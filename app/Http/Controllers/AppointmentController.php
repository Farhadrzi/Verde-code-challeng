<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAppointmentRequest;
use App\Http\Requests\DeleteAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Services\AppointmentService;
use Illuminate\Http\Request;

class AppointmentController extends AppBaseController
{
    /**
     * @var AppointmentService
     */
    private AppointmentService $appointmentService;

    public function __construct(AppointmentService $appointmentService)
    {
        parent::__construct();
        $this->appointmentService = $appointmentService;
    }

    public function createAppointment(CreateAppointmentRequest $request){
        try {
            $this->appointmentService->createAppointment($request->all());
        }catch (\Exception $exception){
            $this->response->error($exception->getMessage());
        }
    }

    public function updateAppointment(UpdateAppointmentRequest $request){
        try {
            if($request->appointmentData!=null||$request->appointmentData!=''){
                $this->appointmentService->updateAppointment($request->appointmentId, $request->appointmentData);
                $this->response->success('appointment updated successfully');
            }else{
                $this->response->error('there is nothing to updated');
            }
        }catch (\Exception $exception){
            $this->response->error($exception->getMessage());
        }
    }

    public function deleteAppointment(DeleteAppointmentRequest $request){
        try {
            $this->appointmentService->deleteAppointment($request->appointmentId);
            $this->response->success('appointment deleted successfully');
        }catch (\Exception $exception){
            $this->response->error($exception->getMessage());
        }
    }
}
