<?php

namespace App\Http\Controllers\GURU;

use App\Http\Controllers\Controller;
use App\Http\Requests\MataPelajaranRequest;
use App\Models\MataPelajaran;
use App\Models\Semester;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MataPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Semester $semester, Siswa $siswa)
    {
        if (request()->ajax()) {
            // $query = Semester::where('siswa_id', $siswa->id);
            $query = MataPelajaran::query()
                ->with(['siswa', 'semester'])
                ->where('siswa_id', $siswa->id);

            return DataTables::of($query)
                ->addcolumn('action', function ($item) {
                    return '
                    <div class="inline-flex gap-1">
                        <a class="inline-flex" title="Edit" data-toggle="tooltip" data-placement="top" href="' . route('dashboard.nilai.edit', $item->id) . '">
                            <i class="material-icons edit">edit</i>
                        </a>      
                    </div>
                    <form class="inline-flex gap-1" action="' . route('dashboard.nilai.destroy', $item->id) . '" method="POST">
                        <button class="btn btn-default" >
                            <i class="material-icons delete" title="Hapus" data-toggle="tooltip" data-placement="top">delete</i>
                        </button>
                        ' . method_field('delete') . csrf_field() . '
                    </form>
                    
                    ';
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('pages.dashboard.guru.nilai.index', compact('semester', 'siswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Siswa $siswa)
    {
        $semesters = Semester::all();
        return view('pages.dashboard.guru.nilai.create', compact('semesters', 'siswa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MataPelajaranRequest $request, Siswa $siswa)
    {
        $data = $request->all();
        $data['siswa_id'] = $siswa->id;
        MataPelajaran::create($data);

        return redirect()->route('dashboard.siswas.nilai.index', $siswa->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MataPelajaran  $mataPelajaran
     * @return \Illuminate\Http\Response
     */
    public function show(MataPelajaran $mataPelajaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MataPelajaran  $mataPelajaran
     * @return \Illuminate\Http\Response
     */
    public function edit(MataPelajaran $nilai, Siswa $siswa)
    {
        $semesters = Semester::all();
        return view('pages.dashboard.guru.nilai.edit', [
            'nilai' => $nilai,
            'semesters' => $semesters,
            'siswa' => $siswa
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MataPelajaran  $mataPelajaran
     * @return \Illuminate\Http\Response
     */
    public function update(MataPelajaranRequest $request, MataPelajaran $nilai)
    {
        $data = $request->all();
        $nilai->update($data);

        return redirect()->route('dashboard.siswas.nilai.index', $nilai->siswa_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MataPelajaran  $mataPelajaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(MataPelajaran $nilai)
    {
        $nilai->delete();

        return redirect()->route('dashboard.siswas.nilai.index', $nilai->siswa_id);
    }
}
