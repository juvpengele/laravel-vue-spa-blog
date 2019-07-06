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
        $this->reformatData();

        $rules = [
            "title" => "required|max:200",
            "content" => "required",
            "category_id" => "required|exists:categories,id",
            "cover" => ["nullable"],
            "tags"  => "required"
        ];

        if($this->method() == "POST") {
            $rules["cover"][0] = ["required", "image"];
        }

        if($this->method() === "PUT" && $this->cover !== null) {
            $rules["cover"][] = "image";
        }

        return $rules;
    }

    public function data()
    {
        return $this->merge([
            "slug" => Str::slug($this->get("title")),
            "user_id" => auth()->id(),
            "online" => $this->get("online") === "true"
        ])->only(["title", "slug", "content", "user_id", "category_id", "online"]);
    }

    /**
     * Reformat data format send through ajax t
     *
     */
    private function reformatData(): void
    {
        if($this->cover === "null") {
            $this->merge([ "cover"=> null ]);
        }
    }


}
