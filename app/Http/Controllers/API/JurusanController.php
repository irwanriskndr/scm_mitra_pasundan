<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 5);
        $nama =  $request->input('nama');
        // $show_siswa =  $request->input('show_siswa');

        if ($id) {
            $jurusan = Jurusan::with(['siswas'])->find($id);
            if ($jurusan)
                return ResponseFormatter::success(
                    $jurusan,
                    'Data jurusan berhasil diambil'
                );
            else
                return ResponseFormatter::error(
                    null,
                    'Data jurusan tidak ada',
                    404
                );
        }

        $jurusan = Jurusan::with('siswas');

        if ($nama)
            $jurusan->where('nama', 'like', '%' . $nama . '%');
        // if ($show_siswa)
        //     $jurusan->with('siswas');

        return ResponseFormatter::success(
            $jurusan->paginate($limit),
            'Data list jurusan berhasil diambil'
        );
    }
}
