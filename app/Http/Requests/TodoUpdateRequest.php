<?php

namespace App\Http\Requests;

use App\Rules\CategoryBelongToUser;
use Illuminate\Foundation\Http\FormRequest;

class TodoUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->id == $this->todo->user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'category_id' => [
                'nullable',
                // Use this if you want to use the Rule class
                // Rule::exists('categories', 'id')->where(function ($query) {
                //     $query->where('user_id', auth()->user()->id);
                // })
                // Use this if you want to use the Closure class (App\Rules\CategoryBelongToUser)
                new CategoryBelongToUser(),
            ]
        ];
    }
}
