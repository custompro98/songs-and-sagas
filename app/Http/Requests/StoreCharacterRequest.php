<?php

namespace App\Http\Requests;

use App\Popos\Character\Armor;
use App\Popos\Character\Pronouns;
use App\Popos\Character\Vanori;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCharacterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'pronouns' => ['required', Rule::enum(Pronouns::class)],
            'vanori' => ['required', Rule::enum(Vanori::class)],
            'str' => 'required|integer|min:-1|max:4',
            'dex' => 'required|integer|min:-1|max:4',
            'wil' => 'required|integer|min:-1|max:4',
            'hrt' => 'required|integer|min:-1|max:4',
            'resilience_current' => 'required|integer|min:4|max:15',
            'resilience_max' => 'required|integer|min:4|max:15',
            'experience' => 'required|integer|min:0|max:8',
            'armor' => ['required', Rule::enum(Armor::class)],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'resilience_current' => $this['resilience'],
            'resilience_max' => $this['resilience'],
            'experience' => 0,
        ]);
    }
}
