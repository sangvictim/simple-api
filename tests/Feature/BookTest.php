<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Author;
use App\Models\Book;
use Tests\TestCase;

class BookTest extends TestCase
{
    /**
     * tets get all books
     */
    public function test_get_all_books()
    {
        $response = $this->get('/api/books');

        $response->assertStatus(200);
    }

    /**
     * test get detail of books
     */
    public function test_get_detail_of_book()
    {
        $book = Book::inRandomOrder()->first();

        $response = $this->get('/api/books/' . $book->id);

        $response->assertStatus(200);
    }

    /**
     * test create books
     */
    public function test_create_book()
    {
        $author = Author::inRandomOrder()->first();
        $response = $this->post('/api/books', [
            'title' => 'Test Book',
            'description' => 'This is a test book',
            'publish_date' => '2024-01-01',
            'author_id' => $author->id
        ]);

        $response->assertStatus(201);
    }

    /**
     * test update books
     */
    public function test_update_book()
    {
        $book = Book::inRandomOrder()->first();
        $author = Author::inRandomOrder()->first();
        $response = $this->put('/api/books/' . $book->id, [
            'title' => 'Test Book Updated',
            'description' => 'This is a test book updated',
            'publish_date' => '2024-01-01',
            'author_id' => $author->id
        ]);

        $response->assertStatus(200);
    }

    /**
     * test delete books
     */
    public function test_delete_book()
    {
        $book = Book::inRandomOrder()->first();

        $response = $this->delete('/api/books/' . $book->id);

        $response->assertStatus(200);
    }
}
