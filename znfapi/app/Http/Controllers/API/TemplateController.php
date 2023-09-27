<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use File;
use App\Models\Background;
use App\Models\Elemen;
use App\Models\Warna;
use App\Models\Karakter;
use App\Models\Font;


class TemplateController extends Controller
{
    public function background()
    {
        $background = Background::all();
        if ($background) {
            return response()->json([
                'status' => 200,
                'background' => $background,
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Error'
            ]);
        }

    }
    public function backgroundwid($id)
    {
        $background = Background::find($id);
        if ($background) {
            return response()->json([
                'status' => 200,
                'background' => $background,
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Error'
            ]);
        }

    }


    public function backgroundstore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:191|unique:background',
            'cover' => 'required|max:5000',
            'pembuka' => 'required|max:5000',
            'mempelai' => 'required|max:5000',
            'lovestory' => 'required|max:5000',
            'galeri' => 'required|max:5000',
            'videoprewed' => 'required|max:5000',
            'acara' => 'required|max:5000',
            'rsvp' => 'required|max:5000',
            'ucapan' => 'required|max:5000',
            'angpao' => 'required|max:5000',
            'livestreaming' => 'required|max:5000',
            'susunanacara' => 'required|max:5000',
            'penutup' => 'required|max:5000',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);

        } else {
            $background = new Background;
            $background->name = $request->input('name');

            if ($request->hasFile('cover')) {
                $file = $request->file('cover');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/background/', $filename);
                $background->cover = 'uploads/background/' . $filename;
            }
            if ($request->hasFile('pembuka')) {
                $file = $request->file('pembuka');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/background/', $filename);
                $background->pembuka = 'uploads/background/' . $filename;
            }
            if ($request->hasFile('mempelai')) {
                $file = $request->file('mempelai');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/background/', $filename);
                $background->mempelai = 'uploads/background/' . $filename;
            }
            if ($request->hasFile('lovestory')) {
                $file = $request->file('lovestory');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/background/', $filename);
                $background->lovestory = 'uploads/background/' . $filename;
            }
            if ($request->hasFile('galeri')) {
                $file = $request->file('galeri');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/background/', $filename);
                $background->galeri = 'uploads/background/' . $filename;
            }
            if ($request->hasFile('videoprewed')) {
                $file = $request->file('videoprewed');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/background/', $filename);
                $background->videoprewed = 'uploads/background/' . $filename;
            }
            if ($request->hasFile('acara')) {
                $file = $request->file('acara');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/background/', $filename);
                $background->acara = 'uploads/background/' . $filename;
            }
            if ($request->hasFile('rsvp')) {
                $file = $request->file('rsvp');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/background/', $filename);
                $background->rsvp = 'uploads/background/' . $filename;
            }
            if ($request->hasFile('ucapan')) {
                $file = $request->file('ucapan');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/background/', $filename);
                $background->ucapan = 'uploads/background/' . $filename;
            }
            if ($request->hasFile('angpao')) {
                $file = $request->file('angpao');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/background/', $filename);
                $background->angpao = 'uploads/background/' . $filename;
            }
            if ($request->hasFile('livestreaming')) {
                $file = $request->file('livestreaming');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/background/', $filename);
                $background->livestreaming = 'uploads/background/' . $filename;
            }
            if ($request->hasFile('susunanacara')) {
                $file = $request->file('susunanacara');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/background/', $filename);
                $background->susunanacara = 'uploads/background/' . $filename;
            }
            if ($request->hasFile('penutup')) {
                $file = $request->file('penutup');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/background/', $filename);
                $background->penutup = 'uploads/background/' . $filename;
            }

            $background->save();

            return response()->json([
                'status' => 200,
                'message' => 'Tambah Produk Berhasil',
            ]);
        }
    }

    public function backgroundupdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:191',
            'cover' => 'required|max:5000',
            'pembuka' => 'required|max:5000',
            'mempelai' => 'required|max:5000',
            'lovestory' => 'required|max:5000',
            'galeri' => 'required|max:5000',
            'videoprewed' => 'required|max:5000',
            'acara' => 'required|max:5000',
            'rsvp' => 'required|max:5000',
            'ucapan' => 'required|max:5000',
            'angpao' => 'required|max:5000',
            'livestreaming' => 'required|max:5000',
            'susunanacara' => 'required|max:5000',
            'penutup' => 'required|max:5000',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);

        } else {
            $background = Background::find($id);
            if ($background) {
                $background->name = $request->input('name');

                if ($request->hasFile('cover')) {
                    $file = $request->file('cover');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/background/', $filename);
                    $background->cover = 'uploads/background/' . $filename;
                }
                if ($request->hasFile('pembuka')) {
                    $file = $request->file('pembuka');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/background/', $filename);
                    $background->pembuka = 'uploads/background/' . $filename;
                }
                if ($request->hasFile('mempelai')) {
                    $file = $request->file('mempelai');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/background/', $filename);
                    $background->mempelai = 'uploads/background/' . $filename;
                }
                if ($request->hasFile('lovestory')) {
                    $file = $request->file('lovestory');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/background/', $filename);
                    $background->lovestory = 'uploads/background/' . $filename;
                }
                if ($request->hasFile('galeri')) {
                    $file = $request->file('galeri');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/background/', $filename);
                    $background->galeri = 'uploads/background/' . $filename;
                }
                if ($request->hasFile('videoprewed')) {
                    $file = $request->file('videoprewed');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/background/', $filename);
                    $background->videoprewed = 'uploads/background/' . $filename;
                }
                if ($request->hasFile('acara')) {
                    $file = $request->file('acara');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/background/', $filename);
                    $background->acara = 'uploads/background/' . $filename;
                }
                if ($request->hasFile('rsvp')) {
                    $file = $request->file('rsvp');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/background/', $filename);
                    $background->rsvp = 'uploads/background/' . $filename;
                }
                if ($request->hasFile('ucapan')) {
                    $file = $request->file('ucapan');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/background/', $filename);
                    $background->ucapan = 'uploads/background/' . $filename;
                }
                if ($request->hasFile('angpao')) {
                    $file = $request->file('angpao');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/background/', $filename);
                    $background->angpao = 'uploads/background/' . $filename;
                }
                if ($request->hasFile('livestreaming')) {
                    $file = $request->file('livestreaming');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/background/', $filename);
                    $background->livestreaming = 'uploads/background/' . $filename;
                }
                if ($request->hasFile('susunanacara')) {
                    $file = $request->file('susunanacara');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/background/', $filename);
                    $background->susunanacara = 'uploads/background/' . $filename;
                }
                if ($request->hasFile('penutup')) {
                    $file = $request->file('penutup');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/background/', $filename);
                    $background->penutup = 'uploads/background/' . $filename;
                }

                $background->save();


                return response()->json([
                    'status' => 200,
                    'message' => 'Update Produk Berhasil',
                ]);

            }
            else{
                return response()->json([
                    'status' => 404,
                    'message' => 'Update Produk Gagal',
                ]);

            }


        }
    }


    public function karakter()
    {
        $karakter = Karakter::all();
        if ($karakter) {
            return response()->json([
                'status' => 200,
                'karakter' => $karakter,
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'karakter'
            ]);
        }

    }

    public function karakterstore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:191',
            'produk_id' => 'required|max:191',
            'image' => 'required|max:5000',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);

        } else {
            $karakter = new Karakter;
            $karakter->name = $request->input('name');
            $karakter->produk_id = $request->input('produk_id');
            $karakter->orderid = $request->input('orderid');

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/karakter/', $filename);
                $karakter->image = 'uploads/karakter/' . $filename;
            }

            $karakter->save();

            return response()->json([
                'status' => 200,
                'message' => 'Tambah Produk Berhasil',
            ]);
        }
    }



    public function font()
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
                'message' => 'font'
            ]);
        }

    }

    public function fontstore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:191',
            'produk_id' => 'required|max:191',
            'image' => 'required|max:5000',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);

        } else {
            $font = new Font;
            $font->name = $request->input('name');
            $font->produk_id = $request->input('produk_id');
            $font->orderid = $request->input('orderid');

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/font/', $filename);
                $font->image = 'uploads/font/' . $filename;
            }

            $font->save();

            return response()->json([
                'status' => 200,
                'message' => 'Tambah Produk Berhasil',
            ]);
        }
    }


    public function warna()
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
                'message' => 'warna'
            ]);
        }

    }

    public function warnastore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:191',
            'produk_id' => 'required|max:191',
            'image' => 'required|max:5000',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);

        } else {
            $warna = new Warna;
            $warna->name = $request->input('name');
            $warna->produk_id = $request->input('produk_id');
            $warna->orderid = $request->input('orderid');

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/warna/', $filename);
                $warna->image = 'uploads/warna/' . $filename;
            }

            $warna->save();

            return response()->json([
                'status' => 200,
                'message' => 'Tambah Produk Berhasil',
            ]);
        }
    }




}
