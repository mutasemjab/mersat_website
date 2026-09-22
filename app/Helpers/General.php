<?php


function uploadImage($folder, $image)
{
    $extension = strtolower($image->getClientOriginalExtension());

    // generate unique name with timestamp + random string
    $filename = uniqid() . '_' . time() . '.' . $extension;

    $image->move(base_path($folder), $filename);

    return $filename;
}



function uploadFile($file, $folder)
{
    $path = $file->store($folder);
    return $path;
}

/**
 * Delete a file previously stored with uploadImage().
 * External URLs (http/https) and empty values are ignored.
 */
function deleteImage($folder, $filename)
{
    if (!$filename || preg_match('#^(https?:)?//#i', $filename)) {
        return false;
    }

    $path = base_path(trim($folder, '/') . '/' . basename($filename));

    return is_file($path) ? @unlink($path) : false;
}

/**
 * Public URL of a stored media value.
 * Accepts either a file name saved by uploadImage() (resolved against $folder)
 * or an already complete URL / absolute path.
 */
function media_url($value, $folder = 'assets/uploads')
{
    if (!$value) {
        return null;
    }

    if (preg_match('#^(https?:)?//#i', $value) || str_starts_with($value, '/')) {
        return $value;
    }

    return asset(trim($folder, '/') . '/' . $value);
}

/**
 * Website setting in the current locale (see App\Models\Setting).
 */
function setting($key, $default = null)
{
    return \App\Models\Setting::get($key, $default);
}

/**
 * Website media setting (image / video) as a public URL.
 */
function setting_media($key)
{
    return media_url(\App\Models\Setting::raw($key), \App\Models\Setting::MEDIA_FOLDER);
}




