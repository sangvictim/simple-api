<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Author;
use Tests\TestCase;

class AuthorTest extends TestCase
{
  /**
   * tets get all authors
   */
  public function test_get_all_authors(): void
  {
    $response = $this->get('/api/authors');

    $response->assertStatus(200);
  }

  /**
   * test get detail of authors
   */
  public function test_get_detail_authors(): void
  {
    $author = Author::first();

    $response = $this->get("/api/authors/{$author->id}");

    $response->assertStatus(200);
  }

  /**
   * test get book of authors
   */
  public function test_get_book_of_authors(): void
  {
    $author = Author::first();

    $response = $this->get("/api/authors/{$author->id}/books");

    $response->assertStatus(200);
  }

  /**
   * test create authors
   */
  public function test_create_authors(): void
  {
    $response = $this->post('/api/authors', [
      'name' => fake()->name(),
      'bio' => fake()->address(),
      'birth_date' => fake()->date(),
    ]);

    $response->assertStatus(201);
  }

  /**
   * test update authors
   */
  public function test_update_authors(): void
  {
    $author = Author::first();

    $response = $this->put("/api/authors/{$author->id}", [
      'name' => fake()->name(),
      'bio' => fake()->address(),
      'birth_date' => fake()->date(),
    ]);

    $response->assertStatus(200);
  }

  /**
   * test delete authors
   */
  public function test_delete_author(): void
  {
    $author = Author::first();

    $response = $this->delete("/api/authors/{$author->id}");

    $response->assertStatus(200);
  }
}
