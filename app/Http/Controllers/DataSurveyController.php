<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class DataSurveyController extends Controller
{
    public function index()
    {
        $menus = Survey::all();
        
        return view('admin.datasurvey.index', compact('menus'));
    }

    
    public function create()
    {
        // Tampilkan form untuk menambahkan menu baru
        return view('admin.datasurvey.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_bisnis' => 'required',
            'jenis_usaha' => 'required',
            'nama_pic' => 'required',
            'no_hp' => 'required',
            'no_pelanggan' => 'required', // Validasi file gambar
            'alamat' => 'required', // Validasi file gambar
            'foto' => 'required|image', // Validasi file gambar
            'status' => 'none', 
        ]);

        // Simpan menu baru ke dalam database
    
        $foto_file = $request->file('foto');
        $foto_ekstensi = $foto_file->extension();
        $foto_nama = date('ymdhis'). "." . $foto_ekstensi;
        $foto_file->move(public_path('foto'), $foto_nama);
   
        $data = [
        'nama_bisnis' => $request->nama_bisnis,
        'jenis_usaha' => $request->jenis_usaha,
        'nama_pic' => $request->nama_pic,
        'no_hp' => $request->no_hp,
        'no_pelanggan' => $request->no_pelanggan, // Simpan path gambar ke database]
        'alamat' => $request->alamat, // Simpan path gambar ke database]
        'foto' => $foto_nama // Simpan path gambar ke database]
            
        ];

        Survey::create($data);

        return redirect()->route('admin.datasurvey')->with('success', 'Data Survey berhasil ditambahkan.');
    }

    public function edit($id)
    {
        // Fetch data from the database
    $survey = Survey::findOrFail($id);

    // Return a view with the edit form
    return view('admin.datasurvey.edit', compact('survey'));
    }

    public function update(Request $request, $id)
    {
        // Validation rules for update
    $request->validate([
        'nama_bisnis' => 'required',
        'jenis_usaha' => 'required',
        'nama_pic' => 'required',
        'no_hp' => 'required',
        'no_pelanggan' => 'required',
        'alamat' => 'required',
        'foto' => 'image', // Update: Remove 'required' for optional image update
    ]);

    // Fetch the survey from the database
    $survey = Survey::findOrFail($id);

    // Update the survey with the new data
    $survey->update([
        'nama_bisnis' => $request->nama_bisnis,
        'jenis_usaha' => $request->jenis_usaha,
        'nama_pic' => $request->nama_pic,
        'no_hp' => $request->no_hp,
        'no_pelanggan' => $request->no_pelanggan,
        'alamat' => $request->alamat,
    ]);

    // Handle optional image update
    if ($request->hasFile('foto')) {
        $foto_file = $request->file('foto');
        $foto_ekstensi = $foto_file->extension();
        $foto_nama = date('ymdhis'). "." . $foto_ekstensi;
        $foto_file->move(public_path('foto'), $foto_nama);

        // Update the 'foto' field in the database
        $survey->update(['foto' => $foto_nama]);
    }

    return redirect()->route('admin.datasurvey')->with('success', 'Survey data updated successfully.');
    }
    
    public function destroy($id)
{
    // Fetch the survey from the database
    $survey = Survey::findOrFail($id);

    // Delete the associated file from the storage
    if ($survey->foto) {
        $filePath = public_path('foto/' . $survey->foto);

        // Check if the file exists before attempting to delete
        if (File::exists($filePath)) {
            File::delete($filePath);
        }
    }

    // Delete the survey
    $survey->delete();

    return redirect()->route('admin.datasurvey')->with('success', 'Survey data deleted successfully.');
}

public function setuju($id)
    {
        $this->updateStatus($id, 'setuju');
        return Redirect::back()->with('success', 'Data disetujui.');
    }

    public function tolak($id)
    {
        $this->updateStatus($id, 'tolak');
        return Redirect::back()->with('success', 'Data ditolak.');
    }

    private function updateStatus($id, $status)
    {
        // Ambil data survei dari database
        $survey = Survey::findOrFail($id);

        // Perbarui status dengan data baru
        $survey->status = $status;
        $survey->save();
    }
}
