<?php

namespace Tests\Feature\API\V1;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCasephp 
{
    
    use RefreshDatabase, WithFaker;

    public function test_tasks_index(): void
    {
        // Arrange: Create 2 tasks using the factory
        $task = Task::factory()->count(2)->create();
        
        // Act: Make a GET request to the tasks index endpoint
        $response = $this->getJson('/api/v1/tasks');

        //Assert: Check the response status and structure
        $response->assertStatus(200);

        $response->assertJsonCount(2, 'data'); // Assuming the response is paginated or has a 'data' key

        $response->assertJsonStructure([
            'data' => [
                ['id', 'name', 'is_completed']
            ]
        ]);
    }

    public function test_task_show(): void
    {
        // Arrange: Create a single task using the factory
        $task = Task::factory()->create();

        // Act: Make a GET request to the task show endpoint
        $response = $this->getJson("/api/v1/tasks/{$task->id}");

        // Assert: Check the response status and structure
            // Note: The response should return a single task resource
            $response->assertStatus(200);

            $response->assertJsonStructure([
                'data' => ['id', 'name', 'is_completed']
            ]);

            // Assert that the returned data matches the created task
            $response->assertJson([
                'data' => [
                    'id' => $task->id,
                    'name' => $task->name,
                    'is_completed' => $task->is_completed,
                ]
            ]);
    }
}
