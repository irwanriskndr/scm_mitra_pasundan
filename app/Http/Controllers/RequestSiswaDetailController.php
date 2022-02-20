<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestSiswaDetailRequest;
use App\Models\Jurusan;
use App\Models\RequestSiswa;
use App\Models\RequestSiswaDetail;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RequestSiswaDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RequestSiswa $requesting)
    {
        if (request()->ajax()) {
            // $jurusan = Jurusan::find(($siswa->jurusan_id)->nama);
            $query = RequestSiswaDetail::query()
                ->with(['request', 'siswa', 'user'])
                ->where('request_siswa_id', $requesting->id);

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                    
                    <form class="inline-flex gap-1" action="' . route('dashboard.detail.destroy', $item->id) . '" method="POST">
                            <button class="btn btn-default" >
                                <i class="material-icons delete" title="Hapus" data-toggle="tooltip" data-placement="top">delete</i>
                            </button>
                            ' . method_field('delete') . csrf_field() . '
                    </form>';
                })
                // ->editColumn('jurusan', function ($jurusan) {
                //     return $jurusan->nama;
                //     // return ($item->siswa->jurusan_id)->nama;
                // })
                ->rawColumns(['action'])
                ->make();
        }
        return view('pages.dashboard.request_detail.index', compact('requesting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(RequestSiswa $requesting)
    {
        $siswas = Siswa::all();
        $user = User::all();
        return view('pages.dashboard.request_detail.create', compact('requesting', 'siswas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $requesting
     * @return \Illuminate\Http\Response
     */
    public function store(RequestSiswaDetailRequest $request, RequestSiswa $requesting)

    {
        $data = $request->all();
        // $data = $requesting->all();
        $data['user_id'] = $requesting->user_id;
        $data['request_siswa_id'] = $requesting->id;
        // $data['request_siswa_id'] = $detail->request_siswa_id;
        RequestSiswaDetail::create($data);

        return redirect()->route('dashboard.requesting.detail.index', $requesting->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RequestSiswaDetail  $detail
     * @return \Illuminate\Http\Response
     */
    public function show(RequestSiswaDetail $detail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RequestSiswaDetail  $detail
     * @return \Illuminate\Http\Response
     */
    public function edit(RequestSiswaDetail $detail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $requesting
     * @param  \App\Models\RequestSiswaDetail  $detail
     * @return \Illuminate\Http\Response
     */
    public function update(RequestSiswaDetailRequest $requesting, RequestSiswaDetail $detail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RequestSiswaDetail  $detail
     * @return \Illuminate\Http\Response
     */
    public function destroy(RequestSiswaDetail $detail)
    {
        $detail->delete();
        return redirect()->route('dashboard.requesting.detail.index', $detail->request_siswa_id);
    }
}
