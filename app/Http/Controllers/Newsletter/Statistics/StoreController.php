<?php

namespace App\Http\Controllers\Newsletter\Statistics;

use App\Http\Controllers\Controller;
use App\Http\Requests\Newsletter\Statistics\StoreRequest;
use Illuminate\Support\Facades\Session;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        if ($data) {
            Session::put('start_date' , $data['start_date']);
            Session::put('end_date' , $data['end_date']);
        } else {
            Session::forget('start_date');
            Session::forget('end_date');
        }

        return response([]);
    }
}
