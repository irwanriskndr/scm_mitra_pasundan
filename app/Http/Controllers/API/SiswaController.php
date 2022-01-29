<?php

namespace App\Http\Controllers\API;

use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\ResponseFormatter;

use function PHPUnit\Framework\returnSelf;


class SiswaController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 5);
        $nisn = $request->input('nisn');
        $tgl_lahir = $request->input('tgl_lahir');
        $alamat = $request->input('alamat');
        $gender = $request->input('gender');
        $phone_number = $request->input('phone_number');
        $status = $request->input('status');

        // $jurusan = $request->input('jurusan');
        // $semester = $request->input('semester');
        // $dokumen = $request->input('dokumen');

        $show_dokumen_siswa = $request->input('show_dokumen_siswa');

        if ($id) {
            $siswa = Siswa::with(['semesters', 'jurusan', 'dokumenSiswas'])->find($id);

            if ($siswa) {
                return ResponseFormatter::success(
                    $siswa,
                    'Data Siswa berhasil di ambil'
                );
            } else {
                return ResponseFormatter::error(
                    null,
                    'Data Siswa tidak ada',
                    404
                );
            }
        }


        $siswa = Siswa::with('semesters', 'jurusan', 'dokumenSiswas');

        if ($nisn)
            $siswa->where('nisn', 'like', '%' . $nisn . '%');
        // if ($tgl_lahir)
        //     $siswa->where('tgl$tgl_lahir', 'like', '%' . $tgl_lahir . '%');
        // if ($alamat)
        //     $siswa->where('alamat', 'like', '%' . $alamat . '%');
        if ($gender)
            $siswa->where('gender', 'like', '%' . $gender . '%');
        if ($status)
            $siswa->where('status', 'like', '%' . $status . '%');
        if ($phone_number)
            $siswa->where('phone_number', 'like', '%' . $phone_number . '%');
        // if ($jurusan)
        //     $siswa->where('nama', $jurusan);
        // if ($semester)
        //     $siswa->where('semester_ke', 'like', '%' . $semester . '%');
        // if ($dokumen)
        //     $siswa->where('jenis', 'like', '%' . $dokumen . '%');

        // if ($show_dokumen_siswa)
        //     $siswa->with('dokumenSiswas');

        return ResponseFormatter::success(
            $siswa->paginate($limit),
            'Data list Siswa berhasil diambil'
        );
    }
}
