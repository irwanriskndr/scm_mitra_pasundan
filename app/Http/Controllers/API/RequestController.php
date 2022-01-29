<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\RequestSiswa;
use App\Models\RequestSiswaDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 5);
        // $deskripsi = $request->input('deskripsi');
        $status = $request->input('status');
        $jumlah = $request->input('jumlah');

        if ($id) {
            $requests = RequestSiswa::with(['requestDetails.siswa'])->where('users_id', Auth::user()->id);

            if ($requests)
                return ResponseFormatter::success(
                    $requests,
                    'Data request berhasil di ambil'
                );
            else
                return ResponseFormatter::error(
                    null,
                    'Data request tidak ditemukan',
                    404
                );
        }

        $requests = RequestSiswa::query();
        if ($status)
            return $requests->where('status', 'like', '%' . $status . '%');
        if ($jumlah)
            return $requests->where('jumlah', $jumlah);

        return ResponseFormatter::success(
            $requests->paginate($limit),
            'Data list request berhasil di ambil',
        );
    }

    public function requestDetail(Request $request)
    {
        $requests = RequestSiswa::create([
            'users_id' => Auth::user()->id,
            'deskripsi' => $request->deskripsi,
            'jumlah' => $request->jumlah,
            'status' => $request->status,
        ]);

        foreach ($requests->requestDetails as $siswa) {
            RequestSiswaDetail::create([
                'users_id' => Auth::user()->id,
                'siswa_id' => $siswa['id'],
                'request_id' => $requests->id,
            ]);
        }

        return ResponseFormatter::success(
            $requests->load('RequestDetails.siswa'),
            'Request Berhasil',
        );
    }
}
