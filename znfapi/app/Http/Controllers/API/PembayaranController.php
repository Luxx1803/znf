<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PembayaranController extends Controller
{

    public function buatPembayaran(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'username' => 'required|max:191',
            'status' => 'required|max:191',
            'nominal' => 'required|max:191',
            'bukti_transfer' => 'required|max:2000',
            'tanggal_bayar' => 'required|max:191',
            'paket' => 'required|max:191',
            'noreff' => 'required|max:191',
            'jenis' => 'required|max:191',
            'userid' => 'required|max:191',


        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);

        } else {
            $pembayaran = new Pembayaran;
            $pembayaran->username = $request->input('username');
            $pembayaran->status = $request->input('status');
            $pembayaran->nominal = $request->input('nominal');
            $pembayaran->bukti_transfer = $request->input('bukti_transfer');
            $pembayaran->tanggal_bayar = $request->input('tanggal_bayar');
            $pembayaran->paket = $request->input('paket');
            $pembayaran->noreff = $request->input('noreff');
            $pembayaran->jenis = $request->input('jenis');
            $pembayaran->userid = $request->input('userid');

            if ($request->hasFile('bukti_transfer')) {
                $file = $request->file('bukti_transfer');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/', $filename);
                $pembayaran->bukti_transfer = 'uploads/' . $filename;
            }

            $pembayaran->save();

            return response()->json([
                'status' => 200,
                'message' => 'Konfirmasi Pembayaran Berhasil',
            ]);
        }
    }

}