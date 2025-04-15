<?php

namespace App\Http\Controllers\Newsletter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Newsletter\StoreRequest;
use App\Models\Newsletter;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        Newsletter::create($data);

        return response()->json(['newsletter' => 'added']);
    }
}
