<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Picture;

class CropImageController extends Controller
{

    public function index()
    {
        return view('crop-image-upload');
        // return "ok";
    }

    public function uploadCropImage(Request $request)
    {

        // $some = $request->all();
        $folderPath = public_path('upload/');

        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        $imageName = uniqid() . '.png';

        $imageFullPath = $folderPath.$imageName;

        file_put_contents($imageFullPath, $image_base64);

         $saveFile = new Picture;
         $saveFile->name = $imageName;
         $saveFile->save();

        return response()->json(['success'=>'Crop Image Uploaded Successfully']);
        // return response()->json($some);
    }
    public function store(Request $request)
    {

        $user = auth()->user();

        // return $request->all();
        // $some = $request->all();
        // return response()->json($some);

        // $folderPath = public_path('upload/');

        // $image_parts = explode(";base64,", $request->image);
        // $image_type_aux = explode("image/", $image_parts[0]);
        // $image_type = $image_type_aux[1];
        // $image_base64 = base64_decode($image_parts[1]);

        // $imageName = uniqid() . '.png';

        // $imageFullPath = $folderPath.$imageName;

        // file_put_contents($imageFullPath, $image_base64);

        //  $saveFile = new Picture;
        //  $saveFile->name = $imageName;
        //  $saveFile->save();

         $user->addMedia($request->image)->toMediaCollection();

        return response()->json(['success'=>'Crop Image Uploaded Successfully']);
        // return response()->json($some);
    }

    public function test(Request $request)
    {
        return $request->all();
    }



}
