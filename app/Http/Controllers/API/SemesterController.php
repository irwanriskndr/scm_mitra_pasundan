<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 5);
        $siswa_id = $request->input('siswa_id');
        $semester_ke = $request->input('semester_ke');
        // $show_mata_pelajaran = $request->input('show_mata_pelajaran');

        if ($id) {
            $semester = Semester::with(['siswa', 'mataPelajarans'])->find($id);

            if ($semester)
                return ResponseFormatter::success(
                    $semester,
                    'Data semester berhasil diambil'
                );
            else
                return ResponseFormatter::error(
                    null,
                    'Data semester tidak ada',
                    404
                );
        }

        $semester = Semester::with(['siswa:id,nama', 'mataPelajarans:id,semester_id,nama,nilai']);

        if ($siswa_id)
            $semester->where('siswa_id', $siswa_id);
        if ($semester_ke)
            $semester->where('semester_ke', 'like', '%' . $semester_ke . '%');
        // if ($semester_ke)
        //     if ($semester->where('semester_ke', 'like', '%' . $semester_ke . '%'))
        //         $semester->with('mataPelajarans');
        // if ($show_mata_pelajaran)
        //     $semester->with('mataPelajarans');


        return ResponseFormatter::success(
            $semester->paginate($limit),
            'Data list semester berhasil diambil',
        );
    }
}
