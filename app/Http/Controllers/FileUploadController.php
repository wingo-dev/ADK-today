<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
  
class FileUploadController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|max:2048',
        ]);
        
        $fileName = time().'.'.$request->file->extension();  
         
        $request->file->move(public_path(), $fileName);
        
        return response()->json($fileName);
    }
}