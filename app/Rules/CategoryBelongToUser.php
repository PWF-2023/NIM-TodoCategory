<?php

namespace App\Rules;

use Closure;
use App\Models\Category;
use Illuminate\Contracts\Validation\ValidationRule;

class CategoryBelongToUser implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $userId = auth()->user()->id;
        $exists = Category::where('id', $value)->where('user_id', $userId)->exists();
        if (!$exists) {
            $fail('The selected category does not exist or does not belong to the current user.');
        }
    }
}
