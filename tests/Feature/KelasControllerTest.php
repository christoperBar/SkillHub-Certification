<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Kelas;
use App\Models\Instructor;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KelasControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_display_kelas_list()
    {
        // Arrange
        $instructor = Instructor::create(['name' => 'John Doe']);
        Kelas::create([
            'name' => 'Kelas 1',
            'instructor_id' => $instructor->id,
        ]);

        // Act
        $response = $this->get(route('kelas.index'));

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('kelas.index');
        $response->assertViewHas('kelas');
    }

    /** @test */
    public function it_can_display_create_form()
    {
        $response = $this->get(route('kelas.create'));

        $response->assertStatus(200);
        $response->assertViewIs('kelas.create');
        $response->assertViewHas('instructors');
    }

    /** @test */
    public function it_can_store_new_kelas()
    {
        // Arrange
        $instructor = Instructor::create(['name' => 'Test Instructor']);
        $data = [
            'name' => 'New Kelas',
            'instructor_id' => $instructor->id,
            'description' => 'Test description',
        ];

        // Act
        $response = $this->post(route('kelas.store'), $data);

        // Assert
        $response->assertRedirect(route('kelas.index'));
        $response->assertSessionHas('success', 'Kelas berhasil ditambah');
        $this->assertDatabaseHas('kelas', [
            'name' => 'New Kelas',
            'instructor_id' => $instructor->id,
        ]);
    }

    /** @test */
    public function it_validates_kelas_required_fields()
    {
        $response = $this->post(route('kelas.store'), [
            'name' => '',
            'instructor_id' => '',
        ]);

        $response->assertSessionHasErrors(['name', 'instructor_id']);
    }

    /** @test */
    public function it_can_display_kelas_details()
    {
        // Arrange
        $instructor = Instructor::create(['name' => 'Test Instructor']);
        $kelas = Kelas::create([
            'name' => 'Test Kelas',
            'instructor_id' => $instructor->id,
        ]);

        // Act
        $response = $this->get(route('kelas.show', $kelas));

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('kelas.show');
        $response->assertViewHas('kela');
    }

    /** @test */
    public function it_can_display_edit_form()
    {
        // Arrange
        $instructor = Instructor::create(['name' => 'Test Instructor']);
        $kelas = Kelas::create([
            'name' => 'Test Kelas',
            'instructor_id' => $instructor->id,
        ]);

        // Act
        $response = $this->get(route('kelas.edit', $kelas));

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('kelas.edit');
        $response->assertViewHas(['kela', 'instructors']);
    }

    /** @test */
    public function it_can_update_kelas()
    {
        // Arrange
        $instructor = Instructor::create(['name' => 'Test Instructor']);
        $kelas = Kelas::create([
            'name' => 'Old Name',
            'instructor_id' => $instructor->id,
        ]);

        $data = [
            'name' => 'Updated Name',
            'instructor_id' => $instructor->id,
            'description' => 'Updated description',
        ];

        // Act
        $response = $this->put(route('kelas.update', $kelas), $data);

        // Assert
        $response->assertRedirect(route('kelas.index'));
        $response->assertSessionHas('success', 'Kelas berhasil diperbarui');
        $this->assertDatabaseHas('kelas', [
            'id' => $kelas->id,
            'name' => 'Updated Name',
        ]);
    }

    /** @test */
    public function it_can_delete_kelas()
    {
        // Arrange
        $instructor = Instructor::create(['name' => 'Test Instructor']);
        $kelas = Kelas::create([
            'name' => 'Test Kelas',
            'instructor_id' => $instructor->id,
        ]);

        // Act
        $response = $this->delete(route('kelas.destroy', $kelas));

        // Assert
        $response->assertRedirect(route('kelas.index'));
        $response->assertSessionHas('success', 'Kelas berhasil dihapus');
        $this->assertDatabaseMissing('kelas', ['id' => $kelas->id]);
    }

}
