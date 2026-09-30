<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student; // <-- PERBAIKAN: Import model Student

class StudentController extends Controller
{
    public function index()
{
    $client = new Client();
    $url = "http://127.0.0.1:8000/api/student";
    $response = $client->request('GET', $url);
    $content = $response->getBody()->getContents();
    $contentArray = json_decode($content, true); // decode response JSON

    $students = $contentArray['data']; // ambil data dari response
    return view('student.index', ['students' => $students]);
}


    public function store(Request $request)
    {
        $dataStudent = new Student;
        $dataStudent->nim = $request->nim; // <-- PERBAIKAN: Typo 'reques'
        $dataStudent->nama = $request->nama;
        $dataStudent->prodi = $request->prodi;
        $dataStudent->tanggal_lahir = $request->tanggal_lahir;
        $dataStudent->email = $request->email;
        $dataStudent->alamat = $request->alamat;

        $post = $dataStudent->save(); // <-- PERBAIKAN: Gunakan () untuk memanggil fungsi

        return response()->json([
            'status' => true,
            'message' => 'Sukses menyimpan data'
        ]);
    }

    public function show(string $id)
    {
        
    }
    
    // ... sisa fungsi lainnya ...

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         
    }
}