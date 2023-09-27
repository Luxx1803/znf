<?php

namespace App\Http\Controllers\API;

use App\Models\ElemenAcara;
use App\Models\ElemenAngpao;
use App\Models\ElemenGaleri;
use App\Models\ElemenLiveStream;
use App\Models\ElemenLovestory;
use App\Models\ElemenMempelai;
use App\Models\ElemenPembuka;
use App\Models\ElemenPenutup;
use App\Models\ElemenRsvp;
use App\Models\ElemenSusunanAcara;
use App\Models\ElemenUcapan;
use App\Models\ElemenVideoprewed;
use App\Models\Karakter;
use App\Models\KarakterAngpao;
use App\Models\KarakterCover;
use App\Models\KarakterLovestory;
use App\Models\KarakterMempelai;
use App\Models\KarakterPenutup;
use File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Elemen;
use App\Models\ElemenCover;

class ElemenController extends Controller
{
    public function index()
    {
        // Mengambil semua data elemen
        $elemen = Elemen::with(
            'elemencover',
            'elemenpembuka',
            'elemenmempelai',
            'elemenlovestory',
            'elemengaleri',
            'elemenvideoprewed',
            'elemenacara',
            'elemenrsvp',
            'elemenucapan',
            'elemenangpao',
            'elemenlivestream',
            'elemensusunanacara',
            'elemenpenutup'
        )
            ->get();

        return response()->json([
            'status' => 200,
            'elemen' => $elemen,
        ]);
    }

    public function show($id)
    {
        try {
            // Mengambil elemen berdasarkan ID
            $elemen = Elemen::with([
                'elemencover',
                'elemenpembuka',
                'elemenmempelai',
                'elemenlovestory',
                'elemengaleri',
                'elemenvideoprewed',
                'elemenacara',
                'elemenrsvp',
                'elemenucapan',
                'elemenangpao',
                'elemenlivestream',
                'elemensusunanacara',
                'elemenpenutup'
            ])->findOrFail($id);

            return response()->json([
                'status' => 200,
                'elemen' => $elemen,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 404,
                'message' => 'Elemen tidak ditemukan',
            ]);
        }
    }


    public function store(Request $request)
    {
        $elemen = new Elemen();
        $elemen->name = $request->input('name');

        $elemen->image = $request->input('image');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/elemen/', $filename);
            $elemen->image = 'uploads/elemen/' . $filename;
        }


        $elemen->save();




        return response()->json([
            'status' => 200,
            'elemen' => $elemen,
            'message' => 'Elemen berhasil dibuat'
        ]);
    }


    public function update(Request $request,$id)
    {
        $elemen = Elemen::findOrFail($id);
        $elemen->name = $request->input('name');

        $elemen->image = $request->input('image');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/elemen/', $filename);
            $elemen->image = 'uploads/elemen/' . $filename;
        }


        $elemen->save();




        return response()->json([
            'status' => 200,
            'elemen' => $elemen,
            'message' => 'Elemen berhasil dibuat'
        ]);
    }


    public function destroy($id)
    {
        try {
            // Menghapus elemen berdasarkan ID
            $elemen = Elemen::findOrFail($id);

            // Hapus file gambar jika ada
            if (File::exists($elemen->image)) {
                File::delete($elemen->image);
            }

            // Hapus elemen dari database
            $elemen->delete();

            return response()->json([
                'message' => 'Elemen berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 404,
                'message' => 'Terjadi Kesalahan',
            ]);
        }
    }



    public function storeElemenCover(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'elemen_id' => 'required|exists:elemen,id',
            // Pastikan elemen dengan ID ini sudah ada
            'image' => 'required|max:5000',
            // Validasi file gambar
            'name' => 'required',
            // Validasi file gambar

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        }

        $elemenCover = new ElemenCover();
        $elemenCover->elemen_id = $request->input('elemen_id');
        $elemenCover->name = $request->input('name');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/elemen/', $filename);
            $elemenCover->image = 'uploads/elemen/' . $filename;
        }

        $elemenCover->save();

        return response()->json([
            'status' => 200,
            'elemenCover' => $elemenCover,
            'message' => 'Elemen Cover berhasil dibuat',
        ]);
    }

    public function storeElemenPembuka(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'elemen_id' => 'required|exists:elemen,id',
            // Pastikan elemen dengan ID ini sudah ada
            'image' => 'required|max:5000',
            // Validasi file gambar
            'name' => 'required',
            // Validasi file gambar

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        }

        $elemenPembuka = new ElemenPembuka();
        $elemenPembuka->elemen_id = $request->input('elemen_id');
        $elemenPembuka->name = $request->input('name');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/elemen/', $filename);
            $elemenPembuka->image = 'uploads/elemen/' . $filename;
        }

        $elemenPembuka->save();

        return response()->json([
            'status' => 200,
            'elemenPembuka' => $elemenPembuka,
            'message' => 'Elemen Cover berhasil dibuat',
        ]);
    }

    public function storeElemenMempelai(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'elemen_id' => 'required|exists:elemen,id',
            // Pastikan elemen dengan ID ini sudah ada
            'image' => 'required|max:5000',
            // Validasi file gambar
            'name' => 'required',
            // Validasi file gambar

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        }

        $elemenMempelai = new ElemenMempelai();
        $elemenMempelai->elemen_id = $request->input('elemen_id');
        $elemenMempelai->name = $request->input('name');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/elemen/', $filename);
            $elemenMempelai->image = 'uploads/elemen/' . $filename;
        }

        $elemenMempelai->save();

        return response()->json([
            'status' => 200,
            'elemenMempelai' => $elemenMempelai,
            'message' => 'Elemen Cover berhasil dibuat',
        ]);
    }

    public function storeElemenLovestory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'elemen_id' => 'required|exists:elemen,id',
            // Pastikan elemen dengan ID ini sudah ada
            'image' => 'required|max:5000',
            // Validasi file gambar
            'name' => 'required',
            // Validasi file gambar

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        }

        $elemenLovestory = new ElemenLovestory();
        $elemenLovestory->elemen_id = $request->input('elemen_id');
        $elemenLovestory->name = $request->input('name');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/elemen/', $filename);
            $elemenLovestory->image = 'uploads/elemen/' . $filename;
        }

        $elemenLovestory->save();

        return response()->json([
            'status' => 200,
            'elemenLovestory' => $elemenLovestory,
            'message' => 'Elemen Cover berhasil dibuat',
        ]);
    }

    public function storeElemenGaleri(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'elemen_id' => 'required|exists:elemen,id',
            // Pastikan elemen dengan ID ini sudah ada
            'image' => 'required|max:5000',
            // Validasi file gambar
            'name' => 'required',
            // Validasi file gambar

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        }

        $elemenGaleri = new ElemenGaleri();
        $elemenGaleri->elemen_id = $request->input('elemen_id');
        $elemenGaleri->name = $request->input('name');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/elemen/', $filename);
            $elemenGaleri->image = 'uploads/elemen/' . $filename;
        }

        $elemenGaleri->save();

        return response()->json([
            'status' => 200,
            'elemenGaleri' => $elemenGaleri,
            'message' => 'Elemen Cover berhasil dibuat',
        ]);
    }

    public function storeElemenVideoPrewed(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'elemen_id' => 'required|exists:elemen,id',
            // Pastikan elemen dengan ID ini sudah ada
            'image' => 'required|max:5000',
            // Validasi file gambar
            'name' => 'required',
            // Validasi file gambar

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        }

        $elemenVideoPrewed = new ElemenVideoprewed();
        $elemenVideoPrewed->elemen_id = $request->input('elemen_id');
        $elemenVideoPrewed->name = $request->input('name');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/elemen/', $filename);
            $elemenVideoPrewed->image = 'uploads/elemen/' . $filename;
        }

        $elemenVideoPrewed->save();

        return response()->json([
            'status' => 200,
            'elemenVideoPrewed' => $elemenVideoPrewed,
            'message' => 'Elemen Cover berhasil dibuat',
        ]);
    }

    public function storeElemenAcara(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'elemen_id' => 'required|exists:elemen,id',
            // Pastikan elemen dengan ID ini sudah ada
            'image' => 'required|max:5000',
            // Validasi file gambar
            'name' => 'required',
            // Validasi file gambar

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        }

        $elemenAcara = new ElemenAcara();
        $elemenAcara->elemen_id = $request->input('elemen_id');
        $elemenAcara->name = $request->input('name');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/elemen/', $filename);
            $elemenAcara->image = 'uploads/elemen/' . $filename;
        }

        $elemenAcara->save();

        return response()->json([
            'status' => 200,
            'elemenAcara' => $elemenAcara,
            'message' => 'Elemen Cover berhasil dibuat',
        ]);
    }

    public function storeElemenRSVP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'elemen_id' => 'required|exists:elemen,id',
            // Pastikan elemen dengan ID ini sudah ada
            'image' => 'required|max:5000',
            // Validasi file gambar
            'name' => 'required',
            // Validasi file gambar

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        }

        $elemenRSVP = new ElemenRsvp();
        $elemenRSVP->elemen_id = $request->input('elemen_id');
        $elemenRSVP->name = $request->input('name');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/elemen/', $filename);
            $elemenRSVP->image = 'uploads/elemen/' . $filename;
        }

        $elemenRSVP->save();

        return response()->json([
            'status' => 200,
            'elemenRSVP' => $elemenRSVP,
            'message' => 'Elemen Cover berhasil dibuat',
        ]);
    }

    public function storeElemenUcapan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'elemen_id' => 'required|exists:elemen,id',
            // Pastikan elemen dengan ID ini sudah ada
            'image' => 'required|max:5000',
            // Validasi file gambar
            'name' => 'required',
            // Validasi file gambar

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        }

        $elemenUcapan = new ElemenUcapan();
        $elemenUcapan->elemen_id = $request->input('elemen_id');
        $elemenUcapan->name = $request->input('name');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/elemen/', $filename);
            $elemenUcapan->image = 'uploads/elemen/' . $filename;
        }

        $elemenUcapan->save();

        return response()->json([
            'status' => 200,
            'elemenUcapan' => $elemenUcapan,
            'message' => 'Elemen Cover berhasil dibuat',
        ]);
    }

    public function storeElemenAngpao(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'elemen_id' => 'required|exists:elemen,id',
            // Pastikan elemen dengan ID ini sudah ada
            'image' => 'required|max:5000',
            // Validasi file gambar
            'name' => 'required',
            // Validasi file gambar

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        }

        $elemenAngpao = new ElemenAngpao();
        $elemenAngpao->elemen_id = $request->input('elemen_id');
        $elemenAngpao->name = $request->input('name');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/elemen/', $filename);
            $elemenAngpao->image = 'uploads/elemen/' . $filename;
        }

        $elemenAngpao->save();

        return response()->json([
            'status' => 200,
            'elemenAngpao' => $elemenAngpao,
            'message' => 'Elemen Cover berhasil dibuat',
        ]);
    }

    public function storeElemenLiveStreaming(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'elemen_id' => 'required|exists:elemen,id',
            // Pastikan elemen dengan ID ini sudah ada
            'image' => 'required|max:5000',
            // Validasi file gambar
            'name' => 'required',
            // Validasi file gambar

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        }

        $elemenLiveStreaming = new ElemenLiveStream();
        $elemenLiveStreaming->elemen_id = $request->input('elemen_id');
        $elemenLiveStreaming->name = $request->input('name');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/elemen/', $filename);
            $elemenLiveStreaming->image = 'uploads/elemen/' . $filename;
        }

        $elemenLiveStreaming->save();

        return response()->json([
            'status' => 200,
            'elemenLiveStreaming' => $elemenLiveStreaming,
            'message' => 'Elemen Cover berhasil dibuat',
        ]);
    }

    public function storeElemenSusunanAcara(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'elemen_id' => 'required|exists:elemen,id',
            // Pastikan elemen dengan ID ini sudah ada
            'image' => 'required|max:5000',
            // Validasi file gambar
            'name' => 'required',
            // Validasi file gambar

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        }

        $elemenSusunanAcara = new ElemenSusunanAcara();
        $elemenSusunanAcara->elemen_id = $request->input('elemen_id');
        $elemenSusunanAcara->name = $request->input('name');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/elemen/', $filename);
            $elemenSusunanAcara->image = 'uploads/elemen/' . $filename;
        }

        $elemenSusunanAcara->save();

        return response()->json([
            'status' => 200,
            'elemenSusunanAcara' => $elemenSusunanAcara,
            'message' => 'Elemen Cover berhasil dibuat',
        ]);
    }

    public function storeElemenPenutup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'elemen_id' => 'required|exists:elemen,id',
            // Pastikan elemen dengan ID ini sudah ada
            'image' => 'required|max:5000',
            // Validasi file gambar
            'name' => 'required',
            // Validasi file gambar

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        }

        $elemenPenutup = new ElemenPenutup();
        $elemenPenutup->elemen_id = $request->input('elemen_id');
        $elemenPenutup->name = $request->input('name');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/elemen/', $filename);
            $elemenPenutup->image = 'uploads/elemen/' . $filename;
        }

        $elemenPenutup->save();

        return response()->json([
            'status' => 200,
            'elemenPenutup' => $elemenPenutup,
            'message' => 'Elemen Cover berhasil dibuat',
        ]);
    }


    public function indexKarakter()
    {
        // Mengambil semua data elemen
        $karakter = Karakter::with(
            'karaktercover',
            'karakterpenutup',
            'karaktermempelai',
            'karakterlovestory',
            'karakterangpao',
        )
            ->get();

        return response()->json([
            'karakter' => $karakter,
        ]);
    }

    public function showKarakter($id)
    {
        try {
            // Mengambil elemen berdasarkan ID
            $karakter = Karakter::with([
                'karaktercover',
                'karakterpenutup',
                'karaktermempelai',
                'karakterlovestory',
                'karakterangpao',
            ])->findOrFail($id);

            return response()->json([
                'karakter' => $karakter,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 404,
                'message' => 'karakter tidak ditemukan',
            ]);
        }
    }


    public function storeKarakter(Request $request)
    {
        $karakter = new Karakter();
        $karakter->name = $request->input('name');

        $karakter->image = $request->input('image');
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
            'karakter' => $karakter,
            'message' => 'karakter berhasil dibuat'
        ]);
    }


    public function destroyKarakter($id)
    {
        try {
            // Menghapus elemen berdasarkan ID
            $karakter = Karakter::findOrFail($id);

            // Hapus file gambar jika ada
            if (File::exists($karakter->image)) {
                File::delete($karakter->image);
            }

            // Hapus karakter dari database
            $karakter->delete();

            return response()->json([
                'message' => 'karakter berhasil dihapus',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 404,
                'message' => 'Terjadi Kesalahan',
            ]);
        }
    }



    public function storeKarakterCover(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'karakter_id' => 'required|exists:karakter,id',
            'image' => 'required|max:5000',
            'name' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        }

        $karaktercover = new KarakterCover();
        $karaktercover->karakter_id = $request->input('karakter_id');
        $karaktercover->name = $request->input('name');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/karakter/', $filename);
            $karaktercover->image = 'uploads/karakter/' . $filename;
        }

        $karaktercover->save();

        return response()->json([
            'status' => 200,
            'karaktercover' => $karaktercover,
            'message' => 'Karakter Cover berhasil dibuat',
        ]);
    }

    public function storeKarakterMempelai(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'karakter_id' => 'required|exists:karakter,id',
            'image' => 'required|max:5000',
            'name' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        }

        $karaktermempelai = new KarakterMempelai();
        $karaktermempelai->karakter_id = $request->input('karakter_id');
        $karaktermempelai->name = $request->input('name');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/karakter/', $filename);
            $karaktermempelai->image = 'uploads/karakter/' . $filename;
        }

        $karaktermempelai->save();

        return response()->json([
            'status' => 200,
            'karaktermempelai' => $karaktermempelai,
            'message' => 'Karakter mempelai berhasil dibuat',
        ]);
    }

    public function storeKarakterLovestory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'karakter_id' => 'required|exists:karakter,id',
            'image' => 'required|max:5000',
            'name' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        }

        $karakterlovestory = new KarakterLovestory();
        $karakterlovestory->karakter_id = $request->input('karakter_id');
        $karakterlovestory->name = $request->input('name');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/karakter/', $filename);
            $karakterlovestory->image = 'uploads/karakter/' . $filename;
        }

        $karakterlovestory->save();

        return response()->json([
            'status' => 200,
            'karakterlovestory' => $karakterlovestory,
            'message' => 'Karakter lovestory berhasil dibuat',
        ]);
    }

    public function storeKarakterAngpao(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'karakter_id' => 'required|exists:karakter,id',
            'image' => 'required|max:5000',
            'name' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        }

        $karakterangpao = new KarakterAngpao();
        $karakterangpao->karakter_id = $request->input('karakter_id');
        $karakterangpao->name = $request->input('name');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/karakter/', $filename);
            $karakterangpao->image = 'uploads/karakter/' . $filename;
        }

        $karakterangpao->save();

        return response()->json([
            'status' => 200,
            'karakterangpao' => $karakterangpao,
            'message' => 'Karakter angpao berhasil dibuat',
        ]);
    }

    public function storeKarakterPenutup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'karakter_id' => 'required|exists:karakter,id',
            'image' => 'required|max:5000',
            'name' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        }

        $karakterpenutup = new KarakterPenutup();
        $karakterpenutup->karakter_id = $request->input('karakter_id');
        $karakterpenutup->name = $request->input('name');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/karakter/', $filename);
            $karakterpenutup->image = 'uploads/karakter/' . $filename;
        }

        $karakterpenutup->save();

        return response()->json([
            'status' => 200,
            'karakterpenutup' => $karakterpenutup,
            'message' => 'Karakter penutup berhasil dibuat',
        ]);
    }

}
