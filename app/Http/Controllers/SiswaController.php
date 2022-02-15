<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiswaRequest;
use App\Models\Jurusan;
use App\Models\Siswa;
use Yajra\DataTables\DataTables;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Siswa::with('jurusan');

            return DataTables::of($query)
                ->addcolumn('action', function ($siswa) {
                    return '
                    <div class="inline-flex gap-1">
                        <a class="inline-flex" title="Detail" data-toggle="tooltip" data-placement="top" href="' . route('dashboard.siswa.show', $siswa->id) . '">
                            <i class="material-icons view">visibility</i>
                        </a>
                        <a class="inline-flex" title="Document" data-toggle="tooltip" data-placement="top" href="' . route('dashboard.siswa.dokumen.index', $siswa->id) . '">
                            <i class="material-icons document">description</i>
                        </a>
                        <a class="inline-flex" title="Edit" data-toggle="tooltip" data-placement="top" href="' . route('dashboard.siswa.edit', $siswa->id) . '">
                            <i class="material-icons edit">edit</i>
                        </a>      
                    </div>
                    <form class="inline-flex gap-1" action="' . route('dashboard.siswa.destroy', $siswa->id) . '" method="POST">
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

        return view('pages.dashboard.siswa.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jurusans = Jurusan::all();
        return view('pages.dashboard.siswa.create', compact('jurusans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SiswaRequest $request)
    {
        $data = $request->all();

        Siswa::create($data);

        return redirect()->route('dashboard.siswa.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        $jurusans = Jurusan::all();

        return view('pages.dashboard.siswa.detail', [
            'siswa' => $siswa,
            'jurusans' => $jurusans
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $siswa)
    {
        $jurusans = Jurusan::all();

        return view('pages.dashboard.siswa.edit', [
            'siswa' => $siswa,
            'jurusans' => $jurusans
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(SiswaRequest $request, Siswa $siswa)
    {
        $data = $request->all();
        $siswa->update($data);

        return redirect()->route('dashboard.siswa.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $siswa)
    {
        $siswa->delete();

        return redirect()->route('dashboard.siswa.index');
    }
}
