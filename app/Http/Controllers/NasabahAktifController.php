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
        $request->validate([
            'noAccount'      => 'required',
            'custname'       => 'required',
            'branch_id'      => 'required',
            'gudang_id'      => 'required',
            'rak_id'         => 'required',
            'dokumen_aktif'  => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        try {
            $data = [
                'noAccount'     => $request->input('noAccount'),
                'custname'      => $request->input('custname'),
                'branch_id'     => $request->input('branch_id'),
                'account_type'  => $request->input('account_type'),
                'account_status'=> $request->input('account_status'),
                'gudang_id'     => $request->input('gudang_id'),
                'rak_id'        => $request->input('rak_id'),
                'createdby'     => Auth::user()->name ?? 'system',
                'updatedby'     => Auth::user()->name ?? 'system',
                'deleteSts'     => '0',
            ];

            // Simpan file
            if ($request->hasFile('dokumen_aktif')) {
                $file = $request->file('dokumen_aktif');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('dokumen', $filename, 'public');
                $data['dokumen_aktif'] = $filename;
            }

            NasabahAktif::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil ditambahkan.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ]);
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
