<?php

namespace App\Services;

use App\DTO\CategoryDTO;
use App\Models\Category;
use App\Repositories\CategoriesRepository;
use Exception;
use Illuminate\Support\Facades\Cache;

class CategoryService
{
    public function __construct(private readonly CategoriesRepository $categoriesRepository)
    {
    }

    public function getAllCached()
    {
        return $this->categoriesRepository->getAllCached();
    }

    /**
     * @throws Exception
     */
    public function createWithCache(array $data)
    {
        try {
            return $this->categoriesRepository->createWithCache($data);
        } catch (Exception $exception) {
            throw new Exception($exception);
        }
    }

    /**
     * @throws Exception
     */
    public function updateWithCache(Category $category, array $data)
    {
        try {
            return $this->categoriesRepository->updateWithCache($category, $data);
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
            return $this->categoriesRepository->deleteWithCache($category);
        } catch (Exception $exception) {
            throw new Exception($exception);
        }
    }
}
