<?php

namespace App\Services;

use App\Models\FileStorage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Throwable;

class FileStorageService
{
    private $name;
    private $origin_name;
    private $path;
    private $url;

    public function store(UploadedFile $file, Model $relation, $path)
    {
        $this->_setFillableToModel($file, $path);

        $this->_storeFileToDatabase([
            'name' => $this->name,
            'origin_name' => $this->origin_name,
            'path' => $this->path,
            'url' => $this->url,
        ], $relation);

        $this->_storeFileToStorage($file, $path);
    }

    public function update(UploadedFile $file, FileStorage $fileStorage, $path)
    {
        $oldFilePath = $fileStorage->path;

        $this->_setFillableToModel($file, $path);

        $this->_updateFileToDatabase($fileStorage, [
            'name' => $this->name,
            'origin_name' => $this->origin_name,
            'path' => $this->path,
            'url' => $this->url,
        ]);

        $this->_deleteFileFromStorage($oldFilePath);

        $this->_storeFileToStorage($file, $path);
    }

    public function destroy(FileStorage $fileStorage)
    {
        $oldFilePath = $fileStorage->path;

        $this->_deleteFileFromDatabase($fileStorage);

        $this->_deleteFileFromStorage($oldFilePath);
    }
    
    private function _storeFileToStorage(UploadedFile $file, $path)
    {
        abort_if(!$file->storePubliclyAs($path, $this->name, 'public'), Response::HTTP_INTERNAL_SERVER_ERROR, 'Failed store a file to storage');
    }

    private function _deleteFileFromStorage($path)
    {
        abort_if(!Storage::delete($path), Response::HTTP_INTERNAL_SERVER_ERROR, 'Failed delete a file from storage');
    }

    private function _storeFileToDatabase(array $attributes, Model $relation)
    {
        try {
            $fileStorage = new FileStorage($attributes);

            $fileStorage->file()->associate($relation);
            $fileStorage->save();
        } catch (Throwable $e) {
            abort(Response::HTTP_INTERNAL_SERVER_ERROR, 'Failed store file to database');
        }
    }

    private function _updateFileToDatabase(FileStorage $fileStorage, array $attributes)
    {
        try {
            $fileStorage->fill($attributes);

            $fileStorage->save();
        } catch (Throwable $e) {
            abort(Response::HTTP_INTERNAL_SERVER_ERROR, 'Failed update file to database');
        }
    }

    private function _deleteFileFromDatabase(FileStorage $fileStorage)
    {
        try {
            $fileStorage->delete();
        } catch (Throwable $e) {
            abort(Response::HTTP_INTERNAL_SERVER_ERROR, 'Failed delete file from database');
        }
    }

    private function _setFillableToModel(UploadedFile $file, $path)
    {
        $this->name = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();
        $this->origin_name = $file->getClientOriginalName();
        $this->path = $path . '/' . $this->name;
        $this->url = url(Storage::url($this->path));
    }
}
