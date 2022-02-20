<?php

namespace App\Http\Controllers;

use App\Models\RequestSiswa;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RequestSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = RequestSiswa::query()
                ->with('user');
            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                    
                    <div class="inline-flex gap-1">
                        <a class="inline-flex" title="Detail" data-toggle="tooltip" data-placement="top" href="' . route('dashboard.requesting.detail.index', $item->id) . '">
                            <i class="material-icons view">visibility</i>
                        </a>
                        <a class="inline-flex" title="Edit" data-toggle="tooltip" data-placement="top" href="' . route('dashboard.requesting.edit', $item->id) . '">
                            <i class="material-icons edit">edit</i>
                        </a>      
                    </div>
                        
                        ';
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('pages.dashboard.request.index');
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
     * @param  \App\Models\RequestSiswa  $requestSiswa
     * @return \Illuminate\Http\Response
     */
    public function show(RequestSiswa $requestSiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RequestSiswa  $requestSiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(RequestSiswa $requesting)
    {
        return view('pages.dashboard.request.edit', [
            'item' => $requesting
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RequestSiswa  $requestSiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RequestSiswa $requesting)
    {
        $data = $request->all();
        $requesting->update($data);
        return redirect()->route('dashboard.requesting.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RequestSiswa  $requestSiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(RequestSiswa $requestSiswa)
    {
        //
    }
}
