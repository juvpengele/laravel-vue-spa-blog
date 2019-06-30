<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class PostRequest extends FormRequest
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
            "title" => "required|max:200",
            "content" => "required",
            "category_id" => "required|exists:categories,id",
            "cover" => "required|image"
        ];
    }

    public function data()
    {
        return $this->merge([
            "slug" => Str::slug($this->get("title")),
            "visits" => 0,
            "user_id" => auth()->id(),
            "online" => $this->get("online") === "true"
        ])->only(["title", "slug", "content", "visits", "user_id", "category_id", "online"]);
    }


}
