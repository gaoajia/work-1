<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Image;

class Attachment extends Model
{
    // 存储文件到磁盘
    public function store($attachment)
    {
        $filename = strtolower(str_random(32) . '.jpg');

        $image = Image::make($attachment['data']);
        $path = storage_path('app/' . $filename);
        $image->save($path);

        $this->record_id = $attachment['record_id'];
        $this->name = $filename;
        $this->size = Storage::size($filename);
    }

    public function delete_file()
    {
        Storage::delete($this->name);
    }

    public function record()
    {
        return $this->belongsTo('App\Record');
    }
}
