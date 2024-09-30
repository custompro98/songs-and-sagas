<?php

namespace App\Http\Requests;

use App\Popos\Character\Armor;
use App\Popos\Character\Pronouns;
use App\Popos\Character\Vanori;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCharacterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<int, string|\Illuminate\Validation\Rules\Enum>|string|\Illuminate\Validation\Rules\Enum>
     */
    public function rules(): array
    {
        return [
            'name' => 'string|max:255',
            'pronouns' => Rule::enum(Pronouns::class),
            'vanori' => Rule::enum(Vanori::class),
            'str' => 'integer|min:-1|max:4',
            'dex' => 'integer|min:-1|max:4',
            'wil' => 'integer|min:-1|max:4',
            'hrt' => 'integer|min:-1|max:4',
            'resilience_current' => 'integer|min:4|max:2147483647',
            'resilience_max' => 'integer|min:4|max:2147483647',
            'experience' => 'integer|min:0|max:8',
            'armor' => Rule::enum(Armor::class),
        ];
    }

    protected function prepareForValidation(): void
    {
        $experience = 0;

        for ($i = 0; $i < 8; $i++) {
            if (isset($this['experience-'.$i]) && $this['experience-'.$i] === 'on') {
                $experience += 1;
            }
        }

        $this->merge([
            'experience' => $experience,
        ]);
    }
}
