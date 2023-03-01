<?php
namespace App\Services;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;


class AuthService
{
    public function attemptLogin($input)
    {
        $emailUsername = $input['email_username'];
        $password = $input['password'];

        $credentials = [
            filter_var($emailUsername, FILTER_VALIDATE_EMAIL) ? 'email' : 'username' => $emailUsername,
            'password' => $password,
        ];

        return Auth::attempt($credentials);
    }

    public function handleImage($imageFile)
    {
        $path = 'images/user/avatar/';
        // Open the image and create the compressed
        $image = Image::make($imageFile);
        $compressedImage = $image->resize(null, 600, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->encode('webp', 60);

        // Generate the file names
        $filename = uniqid().'.webp';

        // Save the image to storage
        Storage::put($path . $filename, (string) $compressedImage, 'public');

        // Return the path
        return $path.$filename;
    }
}