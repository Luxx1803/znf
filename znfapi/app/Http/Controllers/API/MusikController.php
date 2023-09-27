<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Musik;
use App\Models\Font;
use App\Models\Warna;

use Illuminate\Support\Facades\Validator;

class MusikController extends Controller
{
    public function getmusik()
    {

        $musik = Musik::all();
        if ($musik) {
            return response()->json([
                'status' => 200,
                'musik' => $musik,
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Belum ada musik'
            ]);
        }

    }

    public function storemusik(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'musik' => 'required|max:10000',
            'kategori' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        }

        $lagu = new Musik();
        $lagu->kategori = $request->input('kategori');
        $lagu->name = $request->input('name');

        if ($request->hasFile('musik')) {
            $file = $request->file('musik');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/musik/', $filename);
            $lagu->musik = 'uploads/musik/' . $filename;
        }

        $lagu->save();

        return response()->json([
            'status' => 200,
            'musik' => $lagu,
            'message' => 'Musik berhasil ditambahkan',
        ]);
    }

    public function getfont()
    {

        $font = Font::all();
        if ($font) {
            return response()->json([
                'status' => 200,
                'font' => $font,
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Belum ada font'
            ]);
        }

    }

    public function storefont(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'primaryfont' => 'required',
            'secondaryfont' => 'required',
            'regularfont' => 'required',
            'titlefont' => 'required',


        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        }

        $font = new Font();
        $font->name = $request->input('name');
        $font->primaryfont = $request->input('primaryfont');
        $font->secondaryfont = $request->input('secondaryfont');
        $font->regularfont = $request->input('regularfont');
        $font->titlefont = $request->input('titlefont');

        $font->save();

        return response()->json([
            'status' => 200,
            'font' => $font,
            'message' => 'Font berhasil ditambahkan',
        ]);
    }

    public function getfontid($id)
    {
        $font = Font::find($id);

        if ($font) {
            return response()->json([
                'status' => 200,
                'font' => $font,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'font tidak ada.',
            ]);
        }
    }

    public function destroyfont($id)
    {
        try {
            // Menghapus elemen berdasarkan ID
            $font = Font::findOrFail($id);


            // Hapus karakter dari database
            $font->delete();

            return response()->json([
                'message' => 'font berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 404,
                'message' => 'Terjadi Kesalahan',
            ]);
        }
    }

    public function update(Request $request, $id)
    {

            $font = Font::find($id);
            if ($font) {
                $font->save();

                return response()->json([
                    'status' => 200,
                    'message' => 'Update Produk Berhasil',
                    'font' => $font
                ]);

            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Update Produk Gagal',
                ]);

            }

    }

    public function getwarna()
    {

        $warna = Warna::all();
        if ($warna) {
            return response()->json([
                'status' => 200,
                'warna' => $warna,
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Belum ada warna'
            ]);
        }

    }

    public function storewarna(Request $request)
    {

        $warna = new Warna();
        $warna->name = $request->input('name');
        $warna->warnateks = $request->input('warnateks');
        $warna->warnatexticon = $request->input('warnatexticon');
        $warna->warnabutton = $request->input('warnabutton');
        $warna->warnabackground = $request->input('warnabackground');

        $warna->save();

        return response()->json([
            'status' => 200,
            'warna' => $warna,
            'message' => 'Font berhasil ditambahkan',
        ]);
    }

    public function getwarnaid($id)
    {
        $warna = Warna::find($id);

        if ($warna) {
            return response()->json([
                'status' => 200,
                'warna' => $warna,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'warna tidak ada.',
            ]);
        }
    }

    public function destroywarna($id)
    {
        try {
            // Menghapus elemen berdasarkan ID
            $warna = Warna::findOrFail($id);


            // Hapus karakter dari database
            $warna->delete();

            return response()->json([
                'message' => 'warna berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 404,
                'message' => 'Terjadi Kesalahan',
            ]);
        }
    }

    public function updatewarna(Request $request, $id)
    {

            $warna = Warna::find($id);
            if ($warna) {
                $warna->save();

                return response()->json([
                    'status' => 200,
                    'message' => 'Update Produk Berhasil',
                    'warna' => $warna
                ]);

            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Update Produk Gagal',
                ]);

            }

    }




}
