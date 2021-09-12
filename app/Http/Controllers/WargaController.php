<?php

namespace App\Http\Controllers;
use App\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WargaController extends Controller
{
    public function index()
    {
        $warga = Warga::all();
        
        return response()->json([
            'success' => true,
            'message' =>'Data warga yang tersedia',
            'data'    => $warga
        ], 200);
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_warga'   => 'required',
            'alamat' => 'required',
            'pekerjaan' => 'required',
            'no_telp' => 'required',
        ]);
        
        if ($validator->fails()) {
            
            return response()->json([
                'success' => false,
                'message' => 'Semua kolom wajib diisi!',
                'data'   => $validator->errors()
            ],401);
            
        } else {
            
            $warga = Warga::create([
                'nama_warga'     => $request->input('nama_warga'),
                'alamat'   => $request->input('alamat'),
                'pekerjaan'   => $request->input('pekerjaan'),
                'no_telp'   => $request->input('no_telp'),
            ]);
            
            if ($warga) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data warga Berhasil Disimpan!',
                    'data' => $warga
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Warga Gagal Disimpan!',
                ], 400);
            }
            
        }
    }
    
    public function show($id)
    {
        $warga = Warga::find($id);
        
        if ($warga) {
            return response()->json([
                'success'   => true,
                'message'   => 'Detail Data Warga',
                'data'      => $warga
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data Warga Tidak Ditemukan!',
            ], 404);
        }
    }
    
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_warga'   => 'required',
            'alamat' => 'required',
            'pekerjaan' => 'required',
            'no_telp' => 'required',
        ]);
        
        if ($validator->fails()) {
            
            return response()->json([
                'success' => false,
                'message' => 'Semua Kolom Wajib Diisi!',
                'data'   => $validator->errors()
            ],401);
            
        } else {
            
            $warga = Warga::whereId($id)->update([
                'nama_warga'     => $request->input('nama_warga'),
                'alamat'   => $request->input('alamat'),
                'pekerjaan'   => $request->input('pekerjaan'),
                'no_telp'   => $request->input('no_telp'),
            ]);
            
            if ($warga) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data Warga Berhasil Diupdate!',
                    'data' => $warga
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Data Warga Gagal Diupdate!',
                ], 400);
            }
            
        }
    }
    
    public function destroy($id)
    {
        $warga = Warga::whereId($id)->first();
        $warga->delete();
        
        if ($warga) {
            return response()->json([
                'success' => true,
                'message' => 'Data Warga Berhasil Dihapus!',
            ], 200);
        }
        
    }
    
    
}