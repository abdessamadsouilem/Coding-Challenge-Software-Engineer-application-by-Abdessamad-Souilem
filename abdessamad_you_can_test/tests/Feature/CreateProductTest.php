<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;

class CreateProductTest extends TestCase
{
    use RefreshDatabase;

    public $faker;
    public $category;

    public function setUp(): void
    {
        parent::setUp();
        $this->faker = \Faker\Factory::create();
    }

    /** @test */
    public function a_name_is_required(): void
    {
        $response = $this->postJson('/api/createPro', [
            'name' => '',
            'description' => $this->faker->text,
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'category_id' => $this->faker->numberBetween(1, 10),
            'image' => $this->faker->imageUrl()
        ]);

        $response->assertStatus(500);
    }

    /** @test */
    public function a_description_is_required(): void
    {
        $response = $this->postJson('/api/createPro', [
            'name' => $this->faker->name,
            'description' => '',
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'category_id' => $this->faker->numberBetween(1, 10),
            'image' => $this->faker->imageUrl()
        ]);

        $response->assertStatus(500);
    }

    /** @test */
    public function a_price_is_required(): void
    {
        $response = $this->postJson('/api/createPro', [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'price' => '',
            'category_id' => $this->faker->numberBetween(1, 10),
            'image' => $this->faker->imageUrl()
        ]);

        $response->assertStatus(500);
    }

    /** @test */
    public function a_category_id_is_required(): void
    {
        $response = $this->postJson('/api/createPro', [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'category_id' => '',
            'image' => $this->faker->imageUrl()
        ]);

        $response->assertStatus(500);
    }

    /** @test */
    public function a_product_can_be_created(): void
    {

        $this->category = \App\Models\Category::factory()->create(
            [
                'name' => 'test',
                
            ]
        
        );

        
        $response = $this->postJson('/api/createPro', [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'category_id' => $this->category->id,
            'image' => $this->faker->imageUrl()
        ]);

        $response->assertStatus(201);
    }





}
