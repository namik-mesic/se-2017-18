<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 24.10.2017
 * Time: 19:51
 */

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;


class CreateEventInvitationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        ];
    }
}