<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthCheckController extends Controller
{
    public function __invoke()
    {
        $result = [
            'value' => Auth::check(),
        ];

        return response()->json($result);
    }
}
