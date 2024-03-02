<?php

namespace Tests\Unit;

use App\Database\Repositories\ProductsRepository;
use App\Models\Product;
use Domain\UseCases\ListProductsUseCase;
use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class ListProductsUseCaseTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     */
    public function test_list_with_products(): void
    {
        $product1 = Product::create([
            'id' => 1,
            'name' => 'Product 1',
            'description' => 'Product 1 description',
            'price' => 100,
        ]);

        $product2 = Product::create([
            'id' => 2,
            'name' => 'Product 2',
            'description' => 'Product 2 description',
            'price' => 100,
        ]);


        $productsRepository = new ProductsRepository();
        $listProductsUseCase = new ListProductsUseCase($productsRepository);
        $productsListed = $listProductsUseCase->execute();

        $this->assertTrue(count($productsListed) === 2);
    }

    public function test_list_with_no_products(): void
    {
        $productsRepository = new ProductsRepository();
        $listProductsUseCase = new ListProductsUseCase($productsRepository);
        $productsListed = $listProductsUseCase->execute();

        $this->assertTrue(count($productsListed) === 0);
    }
}