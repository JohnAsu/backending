<?php

namespace App\Http\Controllers;

use App\Models\Tv;
use Exception;
use Illuminate\Http\Request;

class TvController extends Controller
{
    public function show(Tv $tv) {
        return response()->json($tv,200);
    }

    public function search(Request $request) {
        $request->validate(['key'=>'string|required']);

        $tvs = Tv::where('brand','like',"%$request->key%")
            ->orWhere('description','like',"%$request->key%")->get();

        return response()->json($tvs, 200);
    }

    public function store(Request $request) {
        $request->validate([
            'brand' => 'string|required',
            'model' => 'string|required',
            'description' => 'string|required',
            'contained_in' => 'numeric',
            'price' => 'numeric|required',
        ]);

        try {

            $tv =  Tv::create([
                "brand" => $request->brand,
                "model"=> $request->model,
                "description"=>$request->description,
                "price"=>$request->price,
                "user_id"=>auth()->user()->id,

            ]);

            return response()->json($tv, 202);
        }catch(Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ],500);
        }

    }

    public function update(Request $request, Tv $tv) {
        try {
            $tv->update($request->all());
            return response()->json($tv, 202);
        }catch(Exception $ex) {
            return response()->json(['message'=>$ex->getMessage()], 500);
        }
    }

    public function destroy(Tv $tv) {
        $tv->delete();
        return response()->json(['message'=>'Tv has been deleted.'],202);
    }

    public function index() {
        $tvs = Tv::where('user_id', auth()->user()->id)->orderBy('brand')->get();
        return response()->json($tvs, 200);
    }
}
