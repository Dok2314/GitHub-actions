<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use Exception;

class CategoriesRepository
{
    public function getAllCached()
    {
        return Cache::remember('categories', 60, function () {
            return Category::orderBy('id', 'desc')->get();
        });
    }

    /**
     * @throws Exception
     */
    public function createWithCache(array $data)
    {
        try {
            $category = Category::create($data);
            $this->updateCache();
            return $category;
        } catch (Exception $exception) {
            throw new Exception($exception);
        }
    }

    /**
     * @throws Exception
     */
    public function updateWithCache($category, array $data)
    {
        try {
            $category->update($data);
            $this->updateCache();
            return $category;
        } catch (Exception $exception) {
            throw new Exception($exception);
        }
    }

    /**
     * @throws Exception
     */
    public function deleteWithCache(Category $category)
    {
        try {
            $category->delete();

            Cache::forget('categories');
            return Cache::remember('categories', 60, function () {
                return Category::all();
            });
        } catch (Exception $exception) {
            throw new Exception($exception);
        }
    }

    protected function updateCache(): void
    {
        Cache::forget('categories');
        Cache::remember('categories', 60, function () {
            return Category::all();
        });
    }
}
