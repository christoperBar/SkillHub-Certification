<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Instructor;
use Illuminate\Foundation\Testing\RefreshDatabase;


class InstructorControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_display_instructors_list()
    {
        // Arrange
        Instructor::create(['name' => 'Instructor 1']);
        Instructor::create(['name' => 'Instructor 2']);

        // Act
        $response = $this->get(route('instructors.index'));

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('instructors.index');
        $response->assertViewHas('instructors');
    }

    /** @test */
    public function it_can_display_create_form()
    {
        $response = $this->get(route('instructors.create'));

        $response->assertStatus(200);
        $response->assertViewIs('instructors.create');
    }

    /** @test */
    public function it_can_store_new_instructor()
    {
        // Arrange
        $data = [
            'name' => 'New Instructor',
        ];

        // Act
        $response = $this->post(route('instructors.store'), $data);

        // Assert
        $response->assertRedirect(route('instructors.index'));
        $response->assertSessionHas('success', 'Instruktur berhasil ditambah');
        $this->assertDatabaseHas('instructors', ['name' => 'New Instructor']);
    }

    /** @test */
    public function it_validates_instructor_name_is_required()
    {
        $response = $this->post(route('instructors.store'), [
            'name' => '',
        ]);

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function it_can_delete_instructor()
    {
        // Arrange
        $instructor = Instructor::create(['name' => 'Test Instructor']);

        // Act
        $response = $this->delete(route('instructors.destroy', $instructor));

        // Assert
        $response->assertRedirect(route('instructors.index'));
        $response->assertSessionHas('success', 'Instruktur berhasil dihapus');
        $this->assertDatabaseMissing('instructors', ['id' => $instructor->id]);
    }
}
