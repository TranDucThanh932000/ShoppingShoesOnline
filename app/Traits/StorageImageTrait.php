<?php
namespace App\Traits;
use Storage;
use Illuminate\Http\Request;

trait StorageImageTrait{
    public function storageTraitUpload(Request $request,$fieldName,$folderName){
        
        if($request->hasFile($fieldName)){
            $file = $request->$fieldName;
            //getClientOriginalName() có sẵn của Laravel
            $fileNameOrigin = $file->getClientOriginalName();
            // tương tự getClientOriginalExtension() cũng vậy
            $fileNameHash = str_random(20). '.' . $file->getClientOriginalExtension();
            $filePath = $request->file($fieldName)->storeAs('public/'. $folderName. '/' . auth()->id(), $fileNameHash);
            $dataUploadTrait = [
                'file_name' => $fileNameOrigin,
                'file_path' => Storage::url($filePath),
            ];
            return $dataUploadTrait;
        }else{
            return null;
        }

        
    }

    public function storageTraitUploadMultiple($file,$folderName){
            
            //getClientOriginalName() có sẵn của Laravel
            $fileNameOrigin = $file->getClientOriginalName();
            // tương tự getClientOriginalExtension() cũng vậy
            $fileNameHash = str_random(20). '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('public/'. $folderName. '/' . auth()->id(), $fileNameHash);
            $dataUploadTrait = [
                'file_name' => $fileNameOrigin,
                'file_path' => Storage::url($filePath),
            ];
            return $dataUploadTrait;
            
    }
}