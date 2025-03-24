<?php

namespace App\Http\Controllers;


use App\Models\NasabahAktif;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class NasabahAktifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return response()->json([
                'status'  => 'error',
                'message' => 'User belum login!'
            ], 401);
        }

        $validated = $request->validate([
            'noAccount'       => 'required',
            'custname'        => 'required',
            'branch_id'       => 'required',
            'account_type'    => 'required',
            'account_status'  => 'required',
            'gudang_id'       => 'required',
            'rak_id'          => 'required',
            'dokumen_aktif'   => 'required',
        ]);

        try {
            $validated['createdby'] = Auth::user()->name ?? 'system';
            $validated['updatedby'] = Auth::user()->name ?? 'system';

            NasabahAktif::create($validated);

            return response()->json([
                'status'  => 'success',
                'message' => 'Data berhasil ditambahkan.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(NasabahAktif $nasabahAktif)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NasabahAktif $nasabahAktif)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $nasabah = NasabahAktif::findOrFail($id);

        $validated = $request->validate([
            'noAccount'       => 'required',
            'custname'        => 'required',
            'branch_id'       => 'required',
            'account_type'    => 'required',
            'account_status'  => '',
            'gudang_id'       => 'required',
            'rak_id'          => 'required',
            'dokumen_aktif'   => 'required',
        ]);

        $validated['updatedby'] = Auth::user()->name ?? 'system';

        $nasabah->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diupdate.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NasabahAktif $nasabahAktif)
    {
        //
    }
}
