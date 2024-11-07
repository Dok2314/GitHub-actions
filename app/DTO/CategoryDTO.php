<?php

namespace App\DTO;

class CategoryDTO
{
    private string $name;
    private string $slug;

    public function __construct(array $params)
    {
        $this->name = $params['name'];
        $this->slug = $params['slug'];
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
        ];
    }
}
