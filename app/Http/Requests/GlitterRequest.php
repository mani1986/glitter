<?php
namespace Glitter\Http\Requests;

use Illuminate\Support\Facades\Auth;

class GlitterRequest extends Request
{
    public function rules()
    {
        return [
            'content' => 'required'
        ];
    }

    public function authorize()
    {
        if (!Auth::check()) {
            return false;
        }

        return true;
    }

    // OPTIONAL OVERRIDE
    public function forbiddenResponse()
    {
        // Optionally, send a custom response on authorize failure
        // (default is to just redirect to initial page with errors)
        //
        // Can return a response, a view, a redirect, or whatever else
        return Response::make('Permission denied foo!', 403);
    }

    // OPTIONAL OVERRIDE
    public function response()
    {
        // If you want to customize what happens on a failed validation,
        // override this method.
        // See what it does natively here:
        // https://github.com/laravel/framework/blob/master/src/Illuminate/Foundation/Http/FormRequest.php
    }
} 