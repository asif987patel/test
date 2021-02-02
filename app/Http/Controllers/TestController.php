<?php

namespace App\Http\Controllers;

use App\Models\ExchangeRate;
use App\Models\Test;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Rap2hpoutre\FastExcel\FastExcel;

class TestController extends Controller
{
    public function test()
    {
        $response = Http::get('https://api.exchangeratesapi.io/latest?base=USD');
        ExchangeRate::query()->delete();
        $exchange_rate = ExchangeRate::create([
            'base' => $response['base'],
            'date' => $response['date'],
            'rates' => $response['rates'],
        ]);

        return $exchange_rate;
    }

    public function testFile(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $request->file('file')->move('images', $filename);
            $image_path = realpath(__DIR__ . '/..' . '/..' . '/..') . '/public/images/' . $filename;
            // return $file->getClientOriginalName();
            // return "test";
            return $collection = (new FastExcel)->import($image_path);
        }
        return "fail";
    }
}
