<?php

namespace IrishTitan\Handshake\Tests\Features;

use IrishTitan\Handshake\Exceptions\CategoryNotFoundException;
use IrishTitan\Handshake\Facades\Category;
use IrishTitan\Handshake\Tests\TestCase;

class CategoryTest extends TestCase
{

    /**
     * Get our class ready for testing.
     *
     */
    protected function setUp()
    {
        parent::setUp();
    }

    /** @test */
    public function a_category_can_be_created_and_deleted()
    {
        $category = $this->createCategory();

        Category::findOrFail($category->id);

        $category->delete();

        $this->expectException(CategoryNotFoundException::class);
        Category::findOrFail($category->id);
    }

    /** @test */
    public function a_category_can_be_found_by_url_key()
    {
        $this->createCategory();

        $category = Category::whereUrlKey('test-category');

        $this->assertNotNull($category->id);

        $category->delete();
    }

    /** @test */
    public function a_category_can_be_found_by_name()
    {
        $this->createCategory();

        $category = Category::whereName('Test Category');

        $this->assertNotNull($category->id);

        $category->delete();
    }

    /** @test */
    public function category_data_can_be_changed()
    {
        $category = Category::create([
            'name' => 'Category A',
            'url_key' => 'category-a-url-key',
            'description' => 'Category A Description Text.',
            'meta_title' => 'Category A Meta Title.',
            'meta_keywords' => 'Category A Meta Keywords',
            'meta_description' => 'Category A Meta Description'
        ]);

        $category->save();

        $this->assertSame('Category A', $category->name);
        $this->assertSame('category-a-url-key', $category->url_key);
        $this->assertSame('Category A Description Text.', $category->description);
        $this->assertSame('Category A Meta Title.', $category->meta_title);
        $this->assertSame('Category A Meta Keywords', $category->meta_keywords);
        $this->assertSame('Category A Meta Description', $category->meta_description);

        $category->name = 'Category B';
        $category->url_key = 'category-b-url-key';
        $category->description = 'Category B Description Text.';
        $category->meta_title = 'Category B Meta Title.';
        $category->meta_keywords = 'Category B Meta Keywords';
        $category->meta_description = 'Category B Meta Description';

        $category->save();

        $category = Category::find($category->id);

        $this->assertSame('Category B', $category->name);
        $this->assertSame('category-b-url-key', $category->url_key);
        $this->assertSame('Category B Description Text.', $category->description);
        $this->assertSame('Category B Meta Title.', $category->meta_title);
        $this->assertSame('Category B Meta Keywords', $category->meta_keywords);
        $this->assertSame('Category B Meta Description', $category->meta_description);

        $category->delete();
    }

    /** @test */
    public function a_category_can_have_a_parent()
    {
        $categoryA = Category::whereName('Default Category');
        $categoryB = Category::create(['name' => 'Category B']);
        $categoryC = Category::create(['name' => 'Category C']);

        $categoryC->setParent($categoryB)->save();
        $categoryB->setParent($categoryA)->save();

        $this->assertSame($categoryB->id, $categoryC->parent()->id);
        $this->assertSame($categoryA->id, $categoryB->parent()->id);

        $categoryB->delete();
        $categoryC->delete();
    }

    /**
     * Create a category for testing.
     *
     * @return mixed
     */
    protected function createCategory()
    {
        return Category::create([
            'name' => 'Test Category',
            'is_active' => 1,
            'url_key' => 'test-category',
            'store_id' => 1
        ]);
    }

}