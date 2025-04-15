<?php


namespace App\Http\Controllers\Newsletter\Statistics;

use App\Http\Controllers\Controller;
use App\Http\Resources\Newsletter\Statistics\StatisticsResource;
use App\Models\Statistics;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    public function __invoke()
    {  
        $start_date = Session::get('start_date');
        $end_date = Session::get('end_date');

        if ($start_date == true && $end_date == true) {
            $stastisticsCount = Statistics::whereBetween('created_at', [$start_date, $end_date])
            ->select('title', \Illuminate\Support\Facades\DB::raw('count(*) as count'))
            ->groupBy('title')
            ->get();
        } else {
            $stastisticsCount = Statistics::select('title', \Illuminate\Support\Facades\DB::raw('count(*) as count'))
            ->groupBy('title')
            ->get();
        }

        $statisticsWithCount = [];

        foreach ($stastisticsCount as $el) {

            if ($start_date == true && $end_date == true) {
                $delivered = Statistics::whereBetween('created_at', [$start_date, $end_date])->where('title', $el->title)->where('delivered', true)->count();
            } else {
                $delivered = Statistics::where('title', $el->title)->where('delivered', true)->count();
            }
            
            $el['sent'] = $el['count'];
            unset($el['count']); 
            $el['delivered'] = $delivered;
            array_push($statisticsWithCount, $el);
        }
        
        return StatisticsResource::collection($statisticsWithCount); 
    }
}
