<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


trait UploadFileTrait
{

    function uploadFile(Request $request, $fileName, $oldPath = NULL, $path = '/uploads'): ?string
    {
        if ($request->hasFile($fileName)) {
            $file = $request->file($fileName);

            $originalName = $file->getClientOriginalName();

            $filenameWithoutExtension = pathinfo($originalName, PATHINFO_FILENAME);


            $extension = $file->getClientOriginalExtension();

            $fileName = 'media_' . uniqid() . '_' . time() . '.' . $filenameWithoutExtension . '.' . $extension;

            $file->storeAs($path, $fileName, 'public');

            if ($oldPath != NULL) {
                Storage::disk('public')->delete($oldPath);
            }

            return $path . '/' . $fileName;
        }
        return null;
    }

    function deleteFile($oldPath): bool
    {
        if ($oldPath && Storage::disk('public')->exists($oldPath)) {
            Storage::disk('public')->delete($oldPath);
            return true;
        }

        return false;
    }


}



