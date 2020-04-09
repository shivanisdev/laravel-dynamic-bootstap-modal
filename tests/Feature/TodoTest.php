<?php

namespace Tests\Feature;

use App\Todo;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class TodoTest extends TestCase
{
    use DatabaseMigrations;

    public function create_todo($args = [], $num = null)
    {
        return factory(Todo::class, $num)->create($args);
    }

    /** @test */
    public function user_can_get_all_todo()
    {
        $todo = $this->create_todo();
        $this->get(route('todo.index'))
            ->assertOk()
            ->assertSee($todo->title);
    }
    
    /** @test */
    public function user_can_see_create_page_of_todo()
    {
        $this->get(route('todo.create'))
            ->assertOk()
            ->assertSee('Create Todo');
    }

    /** @test */
    public function user_can_store_new_todo()
    {
        $todo = factory(Todo::class)->make(['title'=>'Laravel']);
        $this->post(route('todo.store'), $todo->toArray())
        ->assertRedirect(route('todo.index'))
        ->assertSessionHas(['message']);
        $this->assertDatabaseHas('todos', ['title'=>'Laravel']);
    }

    /** @test */
    public function user_can_see_single_todo()
    {
        $todo = $this->create_todo();
        $this->get(route('todo.show', $todo->id))
        ->assertSee($todo->title);
    }
    
    /** @test */
    public function user_can_visit_todo_update_page()
    {
        $todo = $this->create_todo();
        $this->get(route('todo.edit', $todo->id))
        ->assertSee('Edit Todo');
    }

    /** @test */
    public function user_can_update_todo()
    {
        $todo = $this->create_todo();
        $this->put(route('todo.update', $todo->id), ['title'=>'UpdatedValue'])
        ->assertRedirect(route('todo.index'))
        ->assertSessionHas(['message']);
        $this->assertDatabaseHas('todos', ['title'=>'UpdatedValue']);
    }

    /** @test */
    public function user_can_delete_todo()
    {
        $todo = $this->create_todo();
        $this->delete(route('todo.destroy', $todo->id))->assertStatus(302)
        ->assertRedirect(route('todo.index'))
        ->assertSessionHas(['message']);
        $this->assertDatabaseMissing('todos',['title'=>$todo->title]);
    }
}
