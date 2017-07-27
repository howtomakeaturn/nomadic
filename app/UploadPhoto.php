<?php

namespace App;

use Request;
use Image;
use Ramsey\Uuid\Uuid;

class UploadPhoto
{

    function handle()
    {
        $file = Request::file('image');

        $image = Image::make($file->getRealPath());

        $image->orientate();

        $height = $image->height();

        $width = $image->width();

        $originalPath = public_path('upload_photos')."/original/";
        $path1 = public_path('upload_photos')."/width-900/";
        $path2 = public_path('upload_photos')."/width-600/";
        $path3 = public_path('upload_photos')."/width-300/";

        $name = Uuid::uuid4();

        $image->encode('jpg');

        // save original
        $image->save("$originalPath$name.jpg");

        //resize
        $image->widen(900, function($c){
            $c->upsize();
        });

        // save resized
        $image->save("$path1$name.jpg");

        //resize
        $image->widen(600, function($c){
            $c->upsize();
        });

        // save resized
        $image->save("$path2$name.jpg");

        //resize
        $image->widen(300, function($c){
            $c->upsize();
        });

        // save resized
        $image->save("$path3$name.jpg");

        $photo = new Photo();

        $photo->name = $name. '.jpg';

        $photo->height = $height;

        $photo->width = $width;

        $photo->save();

        return $photo;
    }

}
