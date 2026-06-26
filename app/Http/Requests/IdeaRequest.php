<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\IdeaState;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IdeaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // for scope of this demo. no users yet to authorize
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'min:5', 'string'],
            'description' => ['nullable', 'string'],
            'state' => ['required', Rule::enum(IdeaState::class)],
            'links' => ['nullable', 'array'],
            'links.*' => ['url', 'max:255'],
            'steps' => ['nullable', 'array'],
            'steps.*' => ['string', 'max:255'],
        ];
    }

    #[\Override]
    public function messages(): array
    {
        return [
            'description.required' => 'Description is required sir',
        ];
    }
}
