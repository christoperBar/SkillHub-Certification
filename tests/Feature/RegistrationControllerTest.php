<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Kelas;
use App\Models\Participant;
use App\Models\Registration;
use App\Models\Instructor;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_display_registrations_list()
    {
        // Arrange
        $instructor = Instructor::create(['name' => 'Test Instructor']);
        $participant = Participant::create([
            'name' => 'Test Participant',
            'email' => 'test@example.com',
        ]);
        $kelas = Kelas::create([
            'name' => 'Test Kelas',
            'instructor_id' => $instructor->id,
        ]);
        Registration::create([
            'participant_id' => $participant->id,
            'kelas_id' => $kelas->id,
        ]);

        // Act
        $response = $this->get(route('registrations.index'));

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('registrations.index');
        $response->assertViewHas('registrations');
    }

    /** @test */
    public function it_can_display_create_form()
    {
        $response = $this->get(route('registrations.create'));

        $response->assertStatus(200);
        $response->assertViewIs('registrations.create');
        $response->assertViewHas(['participants', 'kelas']);
    }

    /** @test */
    public function it_can_store_new_registration()
    {
        // Arrange
        $instructor = Instructor::create(['name' => 'Test Instructor']);
        $participant = Participant::create([
            'name' => 'Test Participant',
            'email' => 'test@example.com',
        ]);
        $kelas = Kelas::create([
            'name' => 'Test Kelas',
            'instructor_id' => $instructor->id,
        ]);

        $data = [
            'participant_id' => $participant->id,
            'kelas_id' => $kelas->id,
        ];

        // Act
        $response = $this->post(route('registrations.store'), $data);

        // Assert
        $response->assertRedirect(route('registrations.index'));
        $response->assertSessionHas('success', 'Registrasi berhasil ditambahkan');
        $this->assertDatabaseHas('registrations', [
            'participant_id' => $participant->id,
            'kelas_id' => $kelas->id,
        ]);
    }

    /** @test */
    public function it_validates_registration_required_fields()
    {
        $response = $this->post(route('registrations.store'), [
            'participant_id' => '',
            'kelas_id' => '',
        ]);

        $response->assertSessionHasErrors(['participant_id', 'kelas_id']);
    }

    /** @test */
    public function it_validates_participant_exists()
    {
        // Arrange
        $instructor = Instructor::create(['name' => 'Test Instructor']);
        $kelas = Kelas::create([
            'name' => 'Test Kelas',
            'instructor_id' => $instructor->id,
        ]);

        // Act
        $response = $this->post(route('registrations.store'), [
            'participant_id' => 99999, // Non-existent
            'kelas_id' => $kelas->id,
        ]);

        // Assert
        $response->assertSessionHasErrors('participant_id');
    }

    /** @test */
    public function it_can_delete_registration()
    {
        // Arrange
        $instructor = Instructor::create(['name' => 'Test Instructor']);
        $participant = Participant::create([
            'name' => 'Test Participant',
            'email' => 'test@example.com',
        ]);
        $kelas = Kelas::create([
            'name' => 'Test Kelas',
            'instructor_id' => $instructor->id,
        ]);
        $registration = Registration::create([
            'participant_id' => $participant->id,
            'kelas_id' => $kelas->id,
        ]);

        // Act
        $response = $this->delete(route('registrations.destroy', $registration));

        // Assert
        $response->assertRedirect(route('registrations.index'));
        $response->assertSessionHas('success', 'Registrasi berhasil dihapus');
        $this->assertDatabaseMissing('registrations', ['id' => $registration->id]);
    }

    /** @test */
    public function it_can_display_filter_page()
    {
        $response = $this->get(route('registrations.filter'));

        $response->assertStatus(200);
        $response->assertViewIs('registrations.filter');
        $response->assertViewHas(['kelasList', 'participants']);
    }

    /** @test */
    public function it_can_filter_by_kelas()
    {
        // Arrange
        $instructor = Instructor::create(['name' => 'Test Instructor']);
        $participant = Participant::create([
            'name' => 'Test Participant',
            'email' => 'test@example.com',
        ]);
        $kelas = Kelas::create([
            'name' => 'Test Kelas',
            'instructor_id' => $instructor->id,
        ]);
        Registration::create([
            'participant_id' => $participant->id,
            'kelas_id' => $kelas->id,
        ]);

        // Act
        $response = $this->get(route('registrations.filter', ['kelas_id' => $kelas->id]));

        // Assert
        $response->assertStatus(200);
        $response->assertViewHas('selectedKelas');
        $response->assertViewHas('result');
    }

    /** @test */
    public function it_can_filter_by_participant()
    {
        // Arrange
        $instructor = Instructor::create(['name' => 'Test Instructor']);
        $participant = Participant::create([
            'name' => 'Test Participant',
            'email' => 'test@example.com',
        ]);
        $kelas = Kelas::create([
            'name' => 'Test Kelas',
            'instructor_id' => $instructor->id,
        ]);
        Registration::create([
            'participant_id' => $participant->id,
            'kelas_id' => $kelas->id,
        ]);

        // Act
        $response = $this->get(route('registrations.filter', ['participant_id' => $participant->id]));

        // Assert
        $response->assertStatus(200);
        $response->assertViewHas('selectedParticipant');
        $response->assertViewHas('result');
    }
}
