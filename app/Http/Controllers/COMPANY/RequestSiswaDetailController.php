<?php

namespace App\Http\Controllers\COMPANY;

use App\Http\Controllers\Controller;
use App\Models\RequestSiswa;
use App\Models\RequestSiswaDetail;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RequestSiswaDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RequestSiswa $requested)
    {
        if (request()->ajax()) {
            // $jurusan = Jurusan::find(($siswa->jurusan_id)->nama);
            $query = RequestSiswaDetail::query()
                ->with(['request', 'siswa', 'user'])
                ->where('request_siswa_id', $requested->id);

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                    
                    <form class="inline-flex gap-1" action="' . route('dashboard.details.destroy', $item->id) . '" method="POST">
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
        return view('pages.dashboard.company.request_detail.index', compact('requested'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RequestSiswaDetail  $requestSiswaDetail
     * @return \Illuminate\Http\Response
     */
    public function show(RequestSiswaDetail $requestSiswaDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RequestSiswaDetail  $requestSiswaDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(RequestSiswaDetail $requestSiswaDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RequestSiswaDetail  $requestSiswaDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RequestSiswaDetail $requestSiswaDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RequestSiswaDetail  $requestSiswaDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(RequestSiswaDetail $requestSiswaDetail)
    {
        //
    }
}
