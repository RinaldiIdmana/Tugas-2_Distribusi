<?php

namespace App\Http\Controllers; // Perbaikan 1: Hapus "Student"

use App\Http\Controllers\Controller; // Perbaikan 2: Tambahkan baris ini
use Illuminate\Http\Request;
use App\Models\Student;
use GuzzleHttp\Client; // <-- Tambahkan baris ini

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Student::orderBy('nim', 'asc')->get();
        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $data,
        ], 200);
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
        //
        $dataStudent = new Student;

        $rules = [
            'nim' => 'required',
            'nama' => 'required',
            'prodi' => 'required',
            'tanggal_lahir' => 'date',
            'email' => 'email|nullable',
        ];

        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal simpan data',
                'data' => $validator->errors(),
            ]);

            $dataStudent->nim = $request->nim;
            $dataStudent->nama = $request->nama;
            $dataStudent->prodi = $request->prodi;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Student::find($id);

        if ($data) { // <-- PERBAIKAN: Gunakan '$' pada variabel
            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $data,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Data tidak ditemukan"
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataStudent = Student::find($id);
        if (empty($dataStudent)) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 400);
        }

        $rules = [
             'nim' => 'required',
            'nama' => 'required',
            'prodi' => 'required',
            'tanggal_lahir' => 'date',
            'email' => 'email|nullable',
        ];

        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal simpan data',
                'data' => $validator->errors(),
            ]);

            $dataStudent->nim = $request->nim;
            $dataStudent->nama = $request->nama;
            $dataStudent->prodi = $request->prodi;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $dataStudent = Student::find($id);
        if (empty($dataStudent)) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }
        $hapus = $dataStudent->delete();

        return response()->json([
            'status' => true,
            'message' => 'Sukses hapus data',
        ]);
    }
}
