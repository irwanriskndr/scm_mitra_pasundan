<?php

namespace App\Http\Controllers;

use App\Http\Requests\DokumenSiswaRequest;
use App\Models\DokumenSiswa;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DokumenSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Siswa $siswa)
    {
        if (request()->ajax()) {
            $query = DokumenSiswa::where('siswa_id', $siswa->id);

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                    <div class="inline-flex gap-1">
                        <form class="inline-block" action="' . route('dashboard.dokumen.destroy', $item->id) . '" method="POST"></form>
                        <button class="btn btn-default" >
                            <i class="material-icons orange">face</i></a>
                        </button>
                        ' . method_field('delete') . csrf_field() . '
                    </div>
                    <form class="border" action="' . route('dashboard.dokumen.destroy', $item->id) . '" method="POST">
                            <button class=" bg-red-500 text-white rounded-md px-2 py-1 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline" >
                            Hapus
                            </button>
                                ' . method_field('delete') . csrf_field() . '
                        </form>';
                })
                ->editColumn('url', function ($item) {
                    return '<img style="max-width: 150px;" src="' . $item->url . '"/>';
                })
                ->editColumn('is_featured', function ($item) {
                    return $item->is_featured ? 'No' : 'Yes';
                })
                ->rawColumns(['action', 'url'])
                ->make();
        }
        return view('pages.dashboard.dokumen.index', compact('siswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Siswa $siswa)
    {

        return view('pages.dashboard.dokumen.create', compact('siswa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DokumenSiswaRequest $request, Siswa $siswa)
    {
        $files = $request->file('files');


        if ($request->hasFile('files')) {
            foreach ($files as $file) {
                $path = $file->store('public/dokumen');

                DokumenSiswa::create([
                    'siswa_id' => $siswa->id,
                    'jenis' => $request['jenis'],
                    'url' => $path
                ]);
            }
        }

        return redirect()->route('dashboard.siswa.dokumen.index', $siswa->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DokumenSiswa  $dokumenSiswa
     * @return \Illuminate\Http\Response
     */
    public function show(DokumenSiswa $dokumenSiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DokumenSiswa  $dokumenSiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(DokumenSiswa $dokumenSiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DokumenSiswa  $dokumenSiswa
     * @return \Illuminate\Http\Response
     */
    public function update(DokumenSiswaRequest $request, DokumenSiswa $dokumenSiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DokumenSiswa  $dokumenSiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(DokumenSiswa $dokumen)
    {
        $dokumen->delete();
        return redirect()->route('dashboard.siswa.dokumen.index', $dokumen->siswa_id);
    }
}
