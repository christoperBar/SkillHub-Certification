<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Participant;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipantControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_display_participants_list()
    {
        // Arrange
        Participant::create([
            'name' => 'Participant 1',
            'email' => 'participant1@example.com',
        ]);

        // Act
        $response = $this->get(route('participants.index'));

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('participants.index');
        $response->assertViewHas('participants');
    }

    /** @test */
    public function it_can_display_create_form()
    {
        $response = $this->get(route('participants.create'));

        $response->assertStatus(200);
        $response->assertViewIs('participants.create');
    }

    /** @test */
    public function it_can_store_new_participant()
    {
        // Arrange
        $data = [
            'name' => 'New Participant',
            'email' => 'new@example.com',
            'phone' => '081234567890',
            'address' => 'Jakarta',
        ];

        // Act
        $response = $this->post(route('participants.store'), $data);

        // Assert
        $response->assertRedirect(route('participants.index'));
        $response->assertSessionHas('success', 'Peserta berhasil ditambah');
        $this->assertDatabaseHas('participants', [
            'name' => 'New Participant',
            'email' => 'new@example.com',
        ]);
    }

    /** @test */
    public function it_validates_participant_required_fields()
    {
        $response = $this->post(route('participants.store'), [
            'name' => '',
            'email' => '',
        ]);

        $response->assertSessionHasErrors(['name', 'email']);
    }

    /** @test */
    public function it_validates_email_is_unique()
    {
        // Arrange
        Participant::create([
            'name' => 'Existing',
            'email' => 'existing@example.com',
        ]);

        // Act
        $response = $this->post(route('participants.store'), [
            'name' => 'New',
            'email' => 'existing@example.com',
        ]);

        // Assert
        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function it_can_display_participant_details()
    {
        // Arrange
        $participant = Participant::create([
            'name' => 'Test Participant',
            'email' => 'test@example.com',
        ]);

        // Act
        $response = $this->get(route('participants.show', $participant));

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('participants.show');
        $response->assertViewHas('participant');
    }

    /** @test */
    public function it_can_display_edit_form()
    {
        // Arrange
        $participant = Participant::create([
            'name' => 'Test Participant',
            'email' => 'test@example.com',
        ]);

        // Act
        $response = $this->get(route('participants.edit', $participant));

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('participants.edit');
        $response->assertViewHas('participant');
    }

    /** @test */
    public function it_can_update_participant()
    {
        // Arrange
        $participant = Participant::create([
            'name' => 'Old Name',
            'email' => 'old@example.com',
        ]);

        $data = [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'phone' => '081234567890',
            'address' => 'Updated Address',
        ];

        // Act
        $response = $this->put(route('participants.update', $participant), $data);

        // Assert
        $response->assertRedirect(route('participants.index'));
        $response->assertSessionHas('success', 'Peserta berhasil diperbarui');
        $this->assertDatabaseHas('participants', [
            'id' => $participant->id,
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
        ]);
    }

    /** @test */
    public function it_allows_same_email_when_updating_own_record()
    {
        // Arrange
        $participant = Participant::create([
            'name' => 'Test',
            'email' => 'test@example.com',
        ]);

        $data = [
            'name' => 'Updated Name',
            'email' => 'test@example.com', // Same email
        ];

        // Act
        $response = $this->put(route('participants.update', $participant), $data);

        // Assert
        $response->assertRedirect(route('participants.index'));
        $response->assertSessionHasNoErrors();
    }

    /** @test */
    public function it_can_delete_participant()
    {
        // Arrange
        $participant = Participant::create([
            'name' => 'Test Participant',
            'email' => 'test@example.com',
        ]);

        // Act
        $response = $this->delete(route('participants.destroy', $participant));

        // Assert
        $response->assertRedirect(route('participants.index'));
        $response->assertSessionHas('success', 'Peserta berhasil dihapus');
        $this->assertDatabaseMissing('participants', ['id' => $participant->id]);
    }

}
