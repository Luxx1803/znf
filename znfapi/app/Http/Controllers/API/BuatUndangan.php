<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Wish;
use App\Models\Rsvp;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use File;

class BuatUndangan extends Controller
{

    public function wishlist($orderid)
    {
        $wish = Wish::where('orderid', $orderid)->get();

        if ($wish->count() > 0) {
            return response()->json([
                'status' => 200,
                'wish' => $wish,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Belum ada ucapan',
            ]);
        }
    }

    public function wish(Request $request, $orderid)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'ucapan' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'validation_errors' => $validator->messages(),
            ]);
        } else {
            $order = Order::find($orderid);

            if (!$order) {
                return response()->json(['message' => 'Order not found'], 404);
            }

            $wish = new Wish;
            $wish->name = $request->name;
            $wish->ucapan = $request->ucapan;
            $wish->orderid = $orderid;

            $wish->save();


            return response()->json(['message' => 'Rsvp added successfully']);

        }

    }

    public function rsvplist($orderid)
    {
        $rsvp = Rsvp::where('orderid', $orderid)->get();

        if ($rsvp->count() > 0) {
            return response()->json([
                'status' => 200,
                'rsvp' => $rsvp,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Belum ada Rsvp',
            ]);
        }
    }

    public function rsvp(Request $request, $orderid)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'telepon' => 'required|string',
            'kehadiran' => 'required|string',

        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'validation_errors' => $validator->messages(),
            ]);
        } else {
            $order = Order::find($orderid);

            if (!$order) {
                return response()->json(['message' => 'Order not found'], 404);
            }

            $rsvp = new Rsvp;
            $rsvp->nama = $request->nama;
            $rsvp->orderid = $orderid;
            $rsvp->telepon = $request->telepon;
            $rsvp->kehadiran = $request->kehadiran;


            $rsvp->save();


            return response()->json(['message' => 'rsvp added successfully']);

        }

    }

    public function editStatus(Request $request, $id)
    {
        $order = Order::find($id); // Cari pesanan berdasarkan ID

        if ($order) {

            // Update status pesanan
            $order->update([
                'status' => $request->input('status'),

            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Order status updated successfully.'
            ]);
        } else if (!$order) {
            return response()->json([
                'status' => 'error',
                'message' => 'Order tidak ditemukan.'
            ], 500);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update order status.'
            ], 500);
        }
    }

    public function placeorder(Request $request)
    {
        if (auth('sanctum')->check()) {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|max:191',
                'name' => 'required|max:191',
                'jenis' => 'required|max:191',
                'fotopria',
                'fotowanita',
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
                'harga' => 'max:191',
                'linkvideoprewed' => 'max:191',
                'jamlive' => 'max:191',
                'linkliveyt' => 'max:191',
                'linkliveig' => 'max:191',
                'linklivetiktok' => 'max:191',
                'fotocover' => 'max:5000',
                'fotolovestory' => 'max:5000',
                'fotorsvp' => 'max:5000',
                'fotopenutup' => 'max:5000',
                'namabank1' => 'max:191',
                'norek1' => 'max:191',
                'an1' => 'max:191',
                'namabank2' => 'max:191',
                'norek2' => 'max:191',
                'an2' => 'max:191',
                'status' => 'max:191',
                'masaaktif' => 'max:191',
                'noref' => 'max:191',
                'paket' => 'max:191',
                'galeri' => 'max:5000',
                'tema' => 'max:191',


            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 422,
                    'validation_errors' => $validator->messages(),
                ]);
            } else {
                $user_id = auth('sanctum')->user()->id;
                $order = new Order;
                $order->user_id = auth('sanctum')->user()->id;
                $order->name = $request->name;
                $order->harga = $request->harga;

                $order->fotopria = $request->fotopria;
                if ($request->hasFile('fotopria')) {
                    $path = $order->fotowanita;
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                    $file = $request->file('fotopria');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/fotopria/', $filename);
                    $order->fotowanita = 'uploads/fotopria/' . $filename;
                }
                $order->fotowanita = $request->fotopria;
                if ($request->hasFile('fotowanita')) {
                    $path = $order->fotowanita;
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                    $file = $request->file('fotowanita');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/fotowanita/', $filename);
                    $order->fotowanita = 'uploads/fotowanita/' . $filename;
                }
                $order->masaaktif = $request->masaaktif;
                $order->noref = $request->noref;
                $order->paket = $request->paket;

                $order->jenis = $request->jenis;
                $order->namelwanita = $request->namelwanita;
                $order->namelpria = $request->namelpria;
                $order->namewanita = $request->namewanita;
                $order->namepria = $request->namepria;
                $order->nameotpria = $request->nameotpria;
                $order->nameotwanita = $request->nameotwanita;
                $order->igpria = $request->igpria;
                $order->igwanita = $request->igwanita;
                $order->lovestory = $request->lovestory;
                $order->tglacara = $request->tglacara;
                $order->tglakad = $request->tglakad;
                $order->jamakad = $request->jamakad;
                $order->tempatakad = $request->tempatakad;
                $order->alamatakad = $request->alamatakad;
                $order->linkgmapsakad = $request->linkgmapsakad;
                $order->tglresepsi = $request->tglresepsi;
                $order->jamresepsi = $request->jamresepsi;
                $order->tempatresepsi = $request->tempatresepsi;
                $order->alamatresepsi = $request->alamatresepsi;
                $order->linkgmapsresepsi = $request->linkgmapsresepsi;

                if ($request->hasFile('fotocover')) {
                    $path = $order->fotocover;
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                    $file = $request->file('fotocover');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/fotocover/', $filename);
                    $order->fotocover = 'uploads/fotocover/' . $filename;
                }

                if ($request->hasFile('fotolovestory')) {
                    $path = $order->lovestory;
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                    $file = $request->file('fotolovestory');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/fotolovestory/', $filename);
                    $order->lovestory = 'uploads/fotolovestory/' . $filename;
                }

                if ($request->hasFile('fotorsvp')) {
                    $path = $order->fotorsvp;
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                    $file = $request->file('fotorsvp');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/fotorsvp/', $filename);
                    $order->fotorsvp = 'uploads/fotorsvp/' . $filename;
                }

                if ($request->hasFile('fotopenutup')) {
                    $path = $order->fotopenutup;
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                    $file = $request->file('fotopenutup');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move('uploads/fotopenutup/', $filename);
                    $order->fotopenutup = 'uploads/fotopenutup/' . $filename;
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
                    $order->galeri = $galeri;
                    $order->save(); // Save the changes to the database
                }
                $order->tema_id = $request->tema_id;

                $order->linkvideoprewed = $request->linkvideoprewed;
                $order->jamlive = $request->jamlive;
                $order->linkliveyt = $request->linkliveyt;
                $order->linkliveig = $request->linkliveig;
                $order->linklivetiktok = $request->linklivetiktok;
                $order->fotocover = $request->fotocover;
                $order->namabank1 = $request->namabank1;
                $order->norek1 = $request->norek1;
                $order->an1 = $request->an1;
                $order->namabank2 = $request->namabank2;
                $order->norek2 = $request->norek2;
                $order->an2 = $request->an2;
                $order->status = $request->status;

                $order->save();

                return response()->json([
                    'status' => 200,
                    'message' => 'Data berhasil disimpan',
                    'order' => $order
                ]);
            }

        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Login to Continue',
            ]);
        }
    }

    public function updateorder(Request $request, $id)
    {
        if (auth('sanctum')->check()) {
            $validator = Validator::make($request->all(), [
                'fotopria',
                'jenis' => 'max:191',
                'fotowanita',
                'namelwanita' => 'max:191',
                'namelpria' => 'max:191',
                'namewanita' => 'max:191',
                'namepria' => 'max:191',
                'nameotpria' => 'max:191',
                'nameotwanita' => 'max:191',
                'harga' => 'max:191',
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
                'namabank1' => 'max:191',
                'norek1' => 'max:191',
                'an1' => 'max:191',
                'namabank2' => 'max:191',
                'norek2' => 'max:191',
                'an2' => 'max:191',
                'status' => 'max:191',
                'masaaktif' => 'max:191',
                'noref' => 'max:191',
                'paket' => 'max:191',
                'galeri' => 'max:5000',
                'tema' => 'max:191',

            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 422,
                    'validation_errors' => $validator->messages(),
                ]);
            } else {
                $order = Order::find($id);
                if ($order) {

                    if ($request->hasFile('fotopria')) {
                        $path = $order->fotopria;
                        if (File::exists($path)) {
                            File::delete($path);
                        }
                        $file = $request->file('fotopria');
                        $extension = $file->getClientOriginalExtension();
                        $filename = time() . '.' . $extension;
                        $file->move('uploads/fotopria/', $filename);
                        $order->fotopria = 'uploads/fotopria/' . $filename;
                    }


                    if ($request->hasFile('fotowanita')) {
                        $path = $order->fotowanita;
                        if (File::exists($path)) {
                            File::delete($path);
                        }
                        $file = $request->file('fotowanita');
                        $extension = $file->getClientOriginalExtension();
                        $filename = time() . '.' . $extension;
                        $file->move('uploads/fotowanita/', $filename);
                        $order->fotowanita = 'uploads/fotowanita/' . $filename;
                    }
                    $order->harga = $request->harga;
                    $order->masaaktif = $request->masaaktif;
                    $order->noref = $request->noref;
                    $order->paket = $request->paket;
                    $order->tema_id = $request->tema_id;

                    $order->jenis = $request->jenis;
                    $order->namelwanita = $request->namelwanita;
                    $order->namelpria = $request->namelpria;
                    $order->namewanita = $request->namewanita;
                    $order->namepria = $request->namepria;
                    $order->nameotpria = $request->nameotpria;
                    $order->nameotwanita = $request->nameotwanita;
                    $order->igpria = $request->igpria;
                    $order->igwanita = $request->igwanita;
                    $order->lovestory = $request->lovestory;
                    $order->tglacara = $request->tglacara;
                    $order->tglakad = $request->tglakad;
                    $order->jamakad = $request->jamakad;
                    $order->tempatakad = $request->tempatakad;
                    $order->alamatakad = $request->alamatakad;
                    $order->linkgmapsakad = $request->linkgmapsakad;
                    $order->tglresepsi = $request->tglresepsi;
                    $order->jamresepsi = $request->jamresepsi;
                    $order->tempatresepsi = $request->tempatresepsi;
                    $order->alamatresepsi = $request->alamatresepsi;
                    $order->linkgmapsresepsi = $request->linkgmapsresepsi;
                    $order->linkvideoprewed = $request->linkvideoprewed;
                    $order->jamlive = $request->jamlive;
                    $order->linkliveyt = $request->linkliveyt;
                    $order->linkliveig = $request->linkliveig;
                    $order->linklivetiktok = $request->linklivetiktok;

                    if ($request->hasFile('fotocover')) {
                        $path = $order->fotocover;
                        if (File::exists($path)) {
                            File::delete($path);
                        }
                        $file = $request->file('fotocover');
                        $extension = $file->getClientOriginalExtension();
                        $filename = time() . '.' . $extension;
                        $file->move('uploads/fotocover/', $filename);
                        $order->fotocover = 'uploads/fotocover/' . $filename;
                    }

                    if ($request->hasFile('fotolovestory')) {
                        $path = $order->fotolovestory;
                        if (File::exists($path)) {
                            File::delete($path);
                        }
                        $file = $request->file('fotolovestory');
                        $extension = $file->getClientOriginalExtension();
                        $filename = time() . '.' . $extension;
                        $file->move('uploads/fotolovestory/', $filename);
                        $order->fotolovestory = 'uploads/fotolovestory/' . $filename;
                    }

                    if ($request->hasFile('fotorsvp')) {
                        $path = $order->fotorsvp;
                        if (File::exists($path)) {
                            File::delete($path);
                        }
                        $file = $request->file('fotorsvp');
                        $extension = $file->getClientOriginalExtension();
                        $filename = time() . '.' . $extension;
                        $file->move('uploads/fotorsvp/', $filename);
                        $order->fotorsvp = 'uploads/fotorsvp/' . $filename;
                    }

                    if ($request->hasFile('fotopenutup')) {
                        $path = $order->fotopenutup;
                        if (File::exists($path)) {
                            File::delete($path);
                        }
                        $file = $request->file('fotopenutup');
                        $extension = $file->getClientOriginalExtension();
                        $filename = time() . '.' . $extension;
                        $file->move('uploads/fotopenutup/', $filename);
                        $order->fotopenutup = 'uploads/fotopenutup/' . $filename;
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
                        $order->galeri = $galeri;
                        $order->save(); // Save the changes to the database
                    }

                    $order->namabank1 = $request->namabank1;
                    $order->norek1 = $request->norek1;
                    $order->an1 = $request->an1;
                    $order->namabank2 = $request->namabank2;
                    $order->norek2 = $request->norek2;
                    $order->an2 = $request->an2;
                    $order->status = $request->status;

                    $order->update();


                    return response()->json([
                        'status' => 200,
                        'message' => 'Data berhasil disimpan',
                    ]);
                }
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
        $order = Order::find($id);
        if ($order) {
            $order->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Order Deleted Successfully',
            ]);

        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Order ID Found',
            ]);

        }

    }

    public function vieworder()
    {
        $order = Order::all();
        if ($order) {
            return response()->json([
                'status' => 200,
                'order' => $order,
            ]);

        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Order ID Found',
            ]);

        }

    }

    public function vieworderbyid($userId)
    {
        $order = Order::where('user_id', $userId)->get();

        if ($order->count() > 0) {
            return response()->json([
                'status' => 200,
                'order' => $order,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No order found for this user.',
            ]);
        }
    }


}