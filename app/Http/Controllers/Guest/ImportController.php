<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Http\Requests\Guest\ImportRequest;
use App\Imports\GuestsImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function __invoke(ImportRequest $request)
    {
        $file = $request->file('file');

        Excel::import(new GuestsImport, $file);

        return response()->json(['guest' => 'added']);
    }
}
