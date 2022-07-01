<?php

namespace App\Http\Requests\Tweet;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['tweet' => "string"])]
    public function rules(): array
    {
        return [
            'tweet' => 'required|max:140'
        ];
    }

    /**
     * @return string
     */
    public function tweet(): string
    {
        return $this->input('tweet');
    }
}
