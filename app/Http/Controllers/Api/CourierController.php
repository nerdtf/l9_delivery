<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Courier\UpdateCourierRequest;
use App\Http\Resources\Couriers\CourierResource;
use App\Models\Courier;
use App\Services\CourierService;

class CourierController extends Controller
{

    private $courierService;

    public function __construct(CourierService $courierService)
    {
        $this->courierService = $courierService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return CourierResource::collection($this->courierService->getAll());
    }


    public function show($id)
    {
        return new CourierResource($this->courierService->getById($id));
    }

    public function update(UpdateCourierRequest $request, Courier $courier)
    {
        return new CourierResource($this->courierService->update($courier->id, $request->validated()));
    }

}
