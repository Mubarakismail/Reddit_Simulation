<?php

namespace App\Traits;

trait AttachFile
{
    public function UploadFile($file, $folder)
    {
        $file_extinsion = $file->getClientOriginalExtension();
        $file_name = time() . '.' . $file_extinsion;
        $path = $folder;
        $file->move($path, $file_name);
        return $file_name;
    }

    public function buildNotificationString($user, $friend)
    {
        $data = "{";
        $data .= "\"user_id\":";
        $data .= $user;
        $data .= ",\"friend_id\":";
        $data .= $friend;
        $data .= "}";
        return $data;
    }
}
