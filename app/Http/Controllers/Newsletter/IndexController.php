<?php

namespace App\Http\Controllers\Newsletter;

use App\Http\Controllers\Controller;
use App\Http\Resources\Newsletter\NewsletterResource;
use App\Models\Newsletter;

class IndexController extends Controller
{
    public function __invoke()
    {
        $newsletter = Newsletter::latest()->first();
        return new NewsletterResource($newsletter);
    }
}
