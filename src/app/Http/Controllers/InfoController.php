<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ApiResponse;

class InfoController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        $info = [
            'app_name' => env('INFO_APP_NAME', ''),
            'description' => env('INFO_DESCRIPTION', ''),
            'address_vi' => env('INFO_ADDRESS_VI', ''),
            'address_ru' => env('INFO_ADDRESS_RU', ''),
            'email' => env('INFO_EMAIL', ''),
            'thumbnail' => env('INFO_THUMBNAIL', ''),
        ];
        return $this->successResponse($info, 'Info retrieved successfully');
    }

    public function setEnvironmentValue(array $values)
    {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);

        if (count($values) > 0) {
            foreach ($values as $envKey => $envValue) {
                $str .= "\n"; // In case the searched variable is in the last line without \n
                $keyPosition = strpos($str, "{$envKey}=");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine = substr(
                    $str,
                    $keyPosition,
                    $endOfLinePosition - $keyPosition
                );

                // If key does not exist, add it
                if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                    $str .= "{$envKey}={$envValue}\n";
                } else {
                    $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
                }
            }
        }

        $str = substr($str, 0, -1);
        if (!file_put_contents($envFile, $str)) {
            return false;
        }
        return true;
    }
}