<?php

namespace App\Http\Controllers\COMPANY;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestSiswaRequest;
use App\Models\RequestSiswa;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class RequestSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        if (request()->ajax()) {
            $query = RequestSiswa::query()
                ->with('user');
            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                    
                    <div class="inline-flex gap-1">
                        <a class="inline-flex" title="Detail" data-toggle="tooltip" data-placement="top" href="' . route('dashboard.requests.show', $item->id) . '">
                            <i class="material-icons view">visibility</i>
                        </a>
                        <a class="inline-flex" title="Edit" data-toggle="tooltip" data-placement="top" href="' . route('dashboard.requests.edit', $item->id) . '">
                            <i class="material-icons edit">edit</i>
                        </a>      
                    </div>
                        <form class="inline-flex gap-1" action="' . route('dashboard.requests.destroy', $item->id) . '" method="POST">
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

        return view('pages.dashboard.company.request.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        $users = User::all();
        return view('pages.dashboard.company.request.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestSiswaRequest $request, User $user)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        RequestSiswa::create($data);
        // RequestSiswa::create([
        //     $data,
        //     'user_id' => Auth::user()->id
        // ]);

        return redirect()->route('dashboard.requests.index', $user->id);
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
     * @param  \App\Models\RequestSiswa  $requests
     * @return \Illuminate\Http\Response
     */
    public function edit(Requestsiswa $request)
    {
        return view('pages.dashboard.company.request.edit', [
            'item' => $request
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RequestSiswa  $requests
     * @return \Illuminate\Http\Response
     */
    public function update(RequestSiswaRequest $requesting, RequestSiswa $request)
    {
        $data = $requesting->all();
        $request->update($data);
        return redirect()->route('dashboard.requests.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RequestSiswa  $requestSiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(RequestSiswa $request)
    {
        $request->delete();
        return redirect()->route('dashboard.requests.index');
    }
}
