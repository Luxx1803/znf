<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use File;


class ProductController extends Controller
{


    public function index()
    {
        $product = Product::all();
        return response()->json([
            'status' => 200,
            'product' => $product,
        ]);

    }

    public function edit($id)
    {
        $product = Product::find($id);
        if ($product) {
            return response()->json([
                'status' => 200,
                'product' => $product,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No product Id found',
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [

            'fotodepan' => 'max:5000',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ]);

        } else {
            $product = Product::find($id);
            if ($product) {
                $product->fotodepan = $request->fotodepan;

                if ($request->hasFile('fotodepan')) {
                    $path = $product->fotodepan;
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                    $file = $request->file('fotodepan');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/fotodepan/', $filename);
                    $product->fotodepan = 'uploads/fotodepan/' . $filename;
                }
                $product->save();

                return response()->json([
                    'status' => 200,
                    'message' => 'Update Produk Berhasil',
                    'product' => $product
                ]);

            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Update Produk Gagal',
                ]);

            }
        }
    }


    public function updateDesain(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'background_id' => 'max:191',
            'warna_id' => 'max:191',
            'karakter_id' => 'max:191',
            'font_id' => 'max:191',
            'elemen_id' => 'max:191',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ]);

        } else {
            $product = Product::find($id);
            if ($product) {
                $product->background_id = $request->background_id;
                $product->warna_id = $request->background_id;
                $product->font_id = $request->background_id;
                $product->elemen_id = $request->elemen_id;
                $product->karakter_id = $request->karakter_id;

                $product->save();

                return response()->json([
                    'status' => 200,
                    'message' => 'Data Desain berhasil disimpan',
                    'product' => $product
                ]);

            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Update Produk Gagal',
                ]);

            }
        }
    }

    public function updateInfoMempelai(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'namelwanita' => 'max:191',
            'namelpria' => 'max:191',
            'namewanita' => 'max:191',
            'namepria' => 'max:191',
            'nameotpria' => 'max:191',
            'lovestory' => 'max:191',
            'nameotwanita' => 'max:191',
            'igpria' => 'max:191',
            'igwanita' => 'max:191',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ]);

        } else {
            $product = Product::find($id);
            if ($product) {
                $product->namelwanita = $request->namelwanita;
                $product->namelpria = $request->namelpria;
                $product->namewanita = $request->namewanita;
                $product->namepria = $request->namepria;
                $product->nameotpria = $request->nameotpria;
                $product->nameotwanita = $request->nameotwanita;
                $product->igpria = $request->igpria;
                $product->igwanita = $request->igwanita;
                $product->lovestory = $request->lovestory;
                $product->save();

                return response()->json([
                    'status' => 200,
                    'message' => 'Data Mempelai berhasil disimpan',
                    'product' => $product
                ]);

            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Update Produk Gagal',
                ]);

            }
        }
    }

    public function updateInfoAcara(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tglacara' => 'max:191',
            'tglakad' => 'max:191',
            'jamakad' => 'max:191',
            'tempatakad' => 'max:191',
            'alamatakad' => 'max:191',
            'linkgmapsakad' => 'max:191',
            'tglresepsi' => 'max:191',
            'jamresepsi' => 'max:191',
            'tempatresepsi' => 'max:191',
            'alamatresepsi' => 'max:191',
            'linkgmapsresepsi' => 'max:191',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ]);

        } else {
            $product = Product::find($id);
            if ($product) {
                $product->tglacara = $request->tglacara;
                $product->tglakad = $request->tglakad;
                $product->jamakad = $request->jamakad;
                $product->tempatakad = $request->tempatakad;
                $product->alamatakad = $request->alamatakad;
                $product->linkgmapsakad = $request->linkgmapsakad;
                $product->tglresepsi = $request->tglresepsi;
                $product->jamresepsi = $request->jamresepsi;
                $product->tempatresepsi = $request->tempatresepsi;
                $product->alamatresepsi = $request->alamatresepsi;
                $product->linkgmapsresepsi = $request->linkgmapsresepsi;

                $product->save();

                return response()->json([
                    'status' => 200,
                    'message' => 'Data Acara berhasil disimpan',
                    'product' => $product
                ]);

            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Update Produk Gagal',
                ]);

            }
        }
    }

    public function updateInfoTambahan(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'namabank1' => 'max:191',
            'norek1' => 'max:191',
            'an1' => 'max:191',
            'namabank2' => 'max:191',
            'norek2' => 'max:191',
            'an2' => 'max:191',
            'linkvideoprewed' => 'max:191',
            'jamlive' => 'max:191',
            'linkliveyt' => 'max:191',
            'linkliveig' => 'max:191',
            'linklivetiktok' => 'max:191',
            'status' => 'max:191',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ]);

        } else {
            $product = Product::find($id);
            if ($product) {
                $product->namabank1 = $request->namabank1;
                $product->norek1 = $request->norek1;
                $product->an1 = $request->an1;
                $product->namabank2 = $request->namabank2;
                $product->norek2 = $request->norek2;
                $product->an2 = $request->an2;
                $product->linkvideoprewed = $request->linkvideoprewed;
                $product->jamlive = $request->jamlive;
                $product->linkliveyt = $request->linkliveyt;
                $product->linkliveig = $request->linkliveig;
                $product->linklivetiktok = $request->linklivetiktok;
                $product->status = $request->status;

                $product->save();

                return response()->json([
                    'status' => 200,
                    'message' => 'Data Acara berhasil disimpan',
                    'product' => $product
                ]);

            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Update Produk Gagal',
                ]);

            }
        }
    }

    public function updateGaleri(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'fotopria' => 'max:5000',
            'fotowanita' => 'max:5000',
            'fotocover' => 'max:5000',
            'fotolovestory' => 'max:5000',
            'fotorsvp' => 'max:5000',
            'fotopenutup' => 'max:5000',
            'fotodepan' => 'max:5000',
            'galeri' => 'max:5000',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ]);

        } else {
            $product = Product::find($id);
            if ($product) {
                if ($request->hasFile('fotopria')) {
                    $path = $product->fotopria;
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                    $file = $request->file('fotopria');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/fotopria/', $filename);
                    $product->fotopria = 'uploads/fotopria/' . $filename;
                }

                if ($request->hasFile('fotowanita')) {
                    $path = $product->fotowanita;
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                    $file = $request->file('fotowanita');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/fotowanita/', $filename);
                    $product->fotowanita = 'uploads/fotowanita/' . $filename;
                }

                if ($request->hasFile('fotocover')) {
                    $path = $product->fotocover;
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                    $file = $request->file('fotocover');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/fotocover/', $filename);
                    $product->fotocover = 'uploads/fotocover/' . $filename;
                }

                if ($request->hasFile('fotolovestory')) {
                    $path = $product->fotolovestory;
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                    $file = $request->file('fotolovestory');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/fotolovestory/', $filename);
                    $product->fotolovestory = 'uploads/fotolovestory/' . $filename;
                }

                if ($request->hasFile('fotorsvp')) {
                    $path = $product->fotorsvp;
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                    $file = $request->file('fotorsvp');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/fotorsvp/', $filename);
                    $product->fotorsvp = 'uploads/fotorsvp/' . $filename;
                }

                if ($request->hasFile('fotopenutup')) {
                    $path = $product->fotopenutup;
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                    $file = $request->file('fotopenutup');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/fotopenutup/', $filename);
                    $product->fotopenutup = 'uploads/fotopenutup/' . $filename;
                }

                if ($request->hasFile('fotodepan')) {
                    $path = $product->fotodepan;
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                    $file = $request->file('fotodepan');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/fotodepan/', $filename);
                    $product->fotodepan = 'uploads/fotodepan/' . $filename;
                }
                $galeri = [];
                if ($request->hasFile('galeri')) {
                    foreach ($request->file('galeri') as $file) {
                        $extension = $file->getClientOriginalExtension();
                        $filename = time() . '_' . uniqid() . '.' . $extension;
                        $file->move('uploads/galeri/', $filename);
                        $galeri[] = 'uploads/galeri/' . $filename;
                    }

                    // Update product's galeri field to store multiple file paths
                    $product->galeri = $galeri;
                    $product->save(); // Save the changes to the database
                }



                $product->save();

                return response()->json([
                    'status' => 200,
                    'message' => 'Data Acara berhasil disimpan',
                    'product' => $product
                ]);

            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Update Produk Gagal',
                ]);

            }
        }
    }




    public function store(Request $request)
    {

        if (auth('sanctum')->check()) {

            $validator = Validator::make($request->all(), [
                'user_id' => 'required|max:191',
                'name' => 'max:191',
                'jenis' => 'max:191',
                'paket' => 'max:191',
                'template' => 'max:191',
                'kode' => 'max:191',

                'fotopria' => 'max:5000',
                'fotowanita' => 'max:5000',
                'namelwanita' => 'max:191',
                'namelpria' => 'max:191',
                'namewanita' => 'max:191',
                'namepria' => 'max:191',
                'nameotpria' => 'max:191',
                'nameotwanita' => 'max:191',
                'igpria' => 'max:191',
                'igwanita' => 'max:191',
                'lovestory' => 'max:600',
                'tglacara' => 'max:191',
                'tglakad' => 'max:191',
                'jamakad' => 'max:191',
                'tempatakad' => 'max:191',
                'alamatakad' => 'max:191',
                'linkgmapsakad' => 'max:191',
                'tglresepsi' => 'max:191',
                'jamresepsi' => 'max:191',
                'tempatresepsi' => 'max:191',
                'alamatresepsi' => 'max:191',
                'linkgmapsresepsi' => 'max:191',
                'linkvideoprewed' => 'max:191',
                'jamlive' => 'max:191',
                'linkliveyt' => 'max:191',
                'linkliveig' => 'max:191',
                'linklivetiktok' => 'max:191',
                'fotocover' => 'max:5000',
                'fotolovestory' => 'max:5000',
                'fotorsvp' => 'max:5000',
                'fotopenutup' => 'max:5000',
                'fotodepan' => 'max:5000',

                'namabank1' => 'max:191',
                'norek1' => 'max:191',
                'an1' => 'max:191',
                'namabank2' => 'max:191',
                'norek2' => 'max:191',
                'an2' => 'max:191',
                'status' => 'max:191',
                'galeri' => 'max:5000',
                'tema_id' => 'max:191',

                'background_id' => 'max:191',
                'warna_id' => 'max:191',
                'karakter_id' => 'max:191',
                'font_id' => 'max:191',


            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'errors' => $validator->messages(),
                ]);

            } else {
                $product = new Product;
                $product->user_id = auth('sanctum')->user()->id;
                $product->name = $request->name;
                $product->tema_id = $request->tema_id;
                $product->paket = $request->paket;
                $product->template = $request->template;
                $product->kode = $request->kode;

                $product->jenis = $request->jenis;
                $product->namelwanita = $request->namelwanita;
                $product->namelpria = $request->namelpria;
                $product->namewanita = $request->namewanita;
                $product->namepria = $request->namepria;
                $product->nameotpria = $request->nameotpria;
                $product->nameotwanita = $request->nameotwanita;
                $product->igpria = $request->igpria;
                $product->igwanita = $request->igwanita;
                $product->lovestory = $request->lovestory;
                $product->tglacara = $request->tglacara;
                $product->tglakad = $request->tglakad;
                $product->jamakad = $request->jamakad;
                $product->tempatakad = $request->tempatakad;
                $product->alamatakad = $request->alamatakad;
                $product->linkgmapsakad = $request->linkgmapsakad;
                $product->tglresepsi = $request->tglresepsi;
                $product->jamresepsi = $request->jamresepsi;
                $product->tempatresepsi = $request->tempatresepsi;
                $product->alamatresepsi = $request->alamatresepsi;
                $product->linkgmapsresepsi = $request->linkgmapsresepsi;
                $product->linkvideoprewed = $request->linkvideoprewed;
                $product->jamlive = $request->jamlive;
                $product->linkliveyt = $request->linkliveyt;
                $product->linkliveig = $request->linkliveig;
                $product->linklivetiktok = $request->linklivetiktok;
                $product->namabank1 = $request->namabank1;
                $product->norek1 = $request->norek1;
                $product->an1 = $request->an1;
                $product->namabank2 = $request->namabank2;
                $product->norek2 = $request->norek2;
                $product->an2 = $request->an2;
                $product->status = $request->status;

                $product->background_id = $request->background_id;
                $product->warna_id = $request->background_id;
                $product->font_id = $request->background_id;
                $product->karakter_id = $request->karakter_id;



                if ($request->hasFile('fotopria')) {
                    $path = $product->fotowanita;
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                    $file = $request->file('fotopria');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/fotopria/', $filename);
                    $product->fotowanita = 'uploads/fotopria/' . $filename;
                }

                if ($request->hasFile('fotowanita')) {
                    $path = $product->fotowanita;
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                    $file = $request->file('fotowanita');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/fotowanita/', $filename);
                    $product->fotowanita = 'uploads/fotowanita/' . $filename;
                }

                if ($request->hasFile('fotocover')) {
                    $path = $product->fotocover;
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                    $file = $request->file('fotocover');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/fotocover/', $filename);
                    $product->fotocover = 'uploads/fotocover/' . $filename;
                }

                if ($request->hasFile('fotolovestory')) {
                    $path = $product->fotolovestory;
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                    $file = $request->file('fotolovestory');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/fotolovestory/', $filename);
                    $product->fotolovestory = 'uploads/fotolovestory/' . $filename;
                }

                if ($request->hasFile('fotorsvp')) {
                    $path = $product->fotorsvp;
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                    $file = $request->file('fotorsvp');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/fotorsvp/', $filename);
                    $product->fotorsvp = 'uploads/fotorsvp/' . $filename;
                }

                if ($request->hasFile('fotopenutup')) {
                    $path = $product->fotopenutup;
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                    $file = $request->file('fotopenutup');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/fotopenutup/', $filename);
                    $product->fotopenutup = 'uploads/fotopenutup/' . $filename;
                }

                if ($request->hasFile('fotodepan')) {
                    $path = $product->fotodepan;
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                    $file = $request->file('fotodepan');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/fotodepan/', $filename);
                    $product->fotodepan = 'uploads/fotodepan/' . $filename;
                }
                $galeri = [];
                if ($request->hasFile('galeri')) {
                    foreach ($request->file('galeri') as $file) {
                        $extension = $file->getClientOriginalExtension();
                        $filename = time() . '_' . uniqid() . '.' . $extension;
                        $file->move('uploads/galeri/', $filename);
                        $galeri[] = 'uploads/galeri/' . $filename;
                    }

                    // Update product's galeri field to store multiple file paths
                    $product->galeri = $galeri;
                    $product->save(); // Save the changes to the database
                }



                if ($request->hasFile('fotopria')) {
                    $path = $product->fotowanita;
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                    $file = $request->file('fotopria');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/fotopria/', $filename);
                    $product->fotowanita = 'uploads/fotopria/' . $filename;
                }
                if ($request->hasFile('fotowanita')) {
                    $path = $product->fotowanita;
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                    $file = $request->file('fotowanita');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/fotowanita/', $filename);
                    $product->fotowanita = 'uploads/fotowanita/' . $filename;
                }
                if ($request->hasFile('fotodepan')) {
                    $path = $product->fotodepan;
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                    $file = $request->file('fotodepan');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/fotodepan/', $filename);
                    $product->fotodepan = 'uploads/fotodepan/' . $filename;
                }
                if ($request->hasFile('fotocover')) {
                    $path = $product->fotocover;
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                    $file = $request->file('fotocover');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/fotocover/', $filename);
                    $product->fotocover = 'uploads/fotocover/' . $filename;
                }

                if ($request->hasFile('fotolovestory')) {
                    $path = $product->fotolovestory;
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                    $file = $request->file('fotolovestory');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/fotolovestory/', $filename);
                    $product->fotolovestory = 'uploads/fotolovestory/' . $filename;
                }

                if ($request->hasFile('fotorsvp')) {
                    $path = $product->fotorsvp;
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                    $file = $request->file('fotorsvp');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/fotorsvp/', $filename);
                    $product->fotorsvp = 'uploads/fotorsvp/' . $filename;
                }

                if ($request->hasFile('fotopenutup')) {
                    $path = $product->fotopenutup;
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                    $file = $request->file('fotopenutup');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/fotopenutup/', $filename);
                    $product->fotopenutup = 'uploads/fotopenutup/' . $filename;
                }

                $galeri = [];
                if ($request->hasFile('galeri')) {
                    foreach ($request->file('galeri') as $file) {
                        $extension = $file->getClientOriginalExtension();
                        $filename = time() . '_' . uniqid() . '.' . $extension;
                        $file->move('uploads/galeri/', $filename);
                        $galeri[] = 'uploads/galeri/' . $filename;
                    }

                    // Update product's galeri field to store multiple file paths
                    $product->galeri = $galeri;
                    $product->save(); // Save the changes to the database
                }


                $product->save();

                return response()->json([
                    'status' => 200,
                    'message' => 'Data berhasil disimpan',
                    'product' => $product
                ]);
            }
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Login to Continue',
            ]);
        }

    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Hapus Produk Berhasil',
            ]);

        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Hapus Produk Gagal',
            ]);

        }

    }

    public function singleproduct($id)
    {
        $itemw = Product::find($id);
        if ($itemw) {
            return response()->json([
                'status' => 200,
                'itemw' => $itemw,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Produk Tidak ada',
            ]);
        }

    }

    public function desainUndangan($request, $id)
    {
        $product = Product::find($id);

        if ($product) {
            $product->background_id = $request->background_id;
            $product->elemen_id = $request->elemen_id;
            $product->karakter_id = $request->karakter_id;
            $product->font_id = $request->font_id;
            $product->warna_id = $request->warna_id;
            $product->save();

            return response()->json([
                'status' => 200,
                'product' => $product,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No product ID found',
            ]);
        }
    }


}
