<?php

namespace App\Http\Controllers\Newsletter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Newsletter\UpdateRequest;
use App\Models\Newsletter;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Newsletter $newsletter) 
    {
        $is_active = $request->validated();

        $newsletter->update($is_active);

        \Illuminate\Support\Facades\Artisan::call('birthday:greeting');

        return response()->json(['newsletter' => 'updated']);
    }
}
