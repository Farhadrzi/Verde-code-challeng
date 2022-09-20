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
            $userId = $request->user()->id;
            $requestData = $request->all();
            $requestData['user_id']=$userId;
            $appointment = $this->appointmentService->createAppointment($requestData);
            return $this->response->success($appointment,'success');
        }catch (\Exception $exception){
            return $this->response->error($exception->getMessage());
        }
    }

    public function updateAppointment(UpdateAppointmentRequest $request){
        try {
            if($request->appointmentData!=null||$request->appointmentData!=''){
                $this->appointmentService->updateAppointment($request->appointmentId, $request->only(['appointmentData']));
                return $this->response->success(null,'appointment updated successfully');
            }else{
                return $this->response->error('there is nothing to updated');
            }
        }catch (\Exception $exception){
            return $this->response->error($exception->getMessage());
        }
    }

    public function deleteAppointment(DeleteAppointmentRequest $request){
        try {
            $this->appointmentService->deleteAppointment($request->appointmentId);
            return $this->response->success(null,'appointment deleted successfully');
        }catch (\Exception $exception){
            return $this->response->error($exception->getMessage());
        }
    }

    public function getUserAppointmentList(Request $request){
        $userId = $request->user()->id;
        try {
            $appointmentList = $this->appointmentService->getAppointmentList($userId,$request->startDate,$request->endDate);
            return $this->response->success($appointmentList,'success');
        }catch (\Exception $exception){
            return $this->response->error($exception->getMessage());
        }
    }

    public function getAllAppointmentList(Request $request){
        try {
            $appointmentList = $this->appointmentService->getAppointmentList(null,$request->get('startDate'),$request->get('endDate'));
            return $this->response->success($appointmentList,'success');
        }catch (\Exception $exception){
            return $this->response->error($exception->getMessage());
        }
    }
}
