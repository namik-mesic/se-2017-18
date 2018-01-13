<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class adRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'titles' => 'required|max:50',
            'image' => 'required|image',
            'description' => 'required|max:300',
            'url' => 'required|max:50',
        ];
    }
}