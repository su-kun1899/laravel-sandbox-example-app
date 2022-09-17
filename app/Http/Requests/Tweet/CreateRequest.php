<?php

namespace App\Http\Requests\Tweet;

use Illuminate\Foundation\Http\FormRequest;

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
    public function rules(): array
    {
        return [
            'tweet' => 'required|max:140',
            'images' => 'array|max:4',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    /**
     * @return string
     */
    public function tweet(): string
    {
        return $this->input('tweet');
    }

    /**
     * @return int
     */
    public function userId(): int
    {
        return $this->user()->id;
    }

    /**
     * @return array
     */
    public function images(): array
    {
        return $this->file('images', []);
    }
}
