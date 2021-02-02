<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;

class TestController extends Controller
{
    public function test()
    {
        // $test = Test::all();
        // return (new FastExcel($test))->download('file.csv');
        // return $test;
        return view('vender\voyager\test');
        return $collection = (new FastExcel)->import('C:\Users\game info\Desktop\file.csv');
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
