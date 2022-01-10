<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParseRequest;
use App\Models\ForecastQuantity;
use App\Services\QuantityParserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ParseController extends Controller
{
    public function parse(ParseRequest $request, QuantityParserService $parser)
    {
        return new JsonResponse($parser->parse()->getResult());
    }

    public function getQuantityGroupedByDate()
    {
        return new JsonResponse(ForecastQuantity::query()
            ->select(DB::raw('SUM(forecast.Qliq) as forecast_Qliq, SUM(forecast.Qoil) as forecast_Qoil, DATE_FORMAT(forecast.date, "%d-%m-%Y") AS date, SUM(fact.Qliq) as fact_Qliq, SUM(fact.Qoil) as fact_Qoil'))
            ->from('forecast_quantities as forecast')
            ->join('fact_quantities as fact', 'forecast.date', '=', 'fact.date')
            ->groupBy('date')
            ->get()
            ->toArray());
    }

    public function view()
    {
        return view('parser.view');
    }
}
