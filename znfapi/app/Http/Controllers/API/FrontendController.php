<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Tema;
use Illuminate\Http\Request;

class FrontendController extends Controller
{



    public function alltema()
    {

        $tema = Tema::all();
        if ($tema) {
            return response()->json([
                'status' => 200,
                'tema' => $tema,
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'No Tema Available'
            ]);
        }



    }

    public function tema($id)
    {
        $tema = Tema::find($id)->get();

        if ($tema->count() > 0) {
            return response()->json([
                'status' => 200,
                'tema' => $tema,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Tema tidak ada.',
            ]);
        }
    }






}