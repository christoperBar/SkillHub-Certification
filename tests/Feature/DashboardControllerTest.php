<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Kelas;
use App\Models\Instructor;
use App\Models\Participant;
use App\Models\Registration;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_display_dashboard()
    {
        // Arrange
        $instructor = Instructor::create(['name' => 'John Doe']);
        $participant = Participant::create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
        ]);
        $kelas = Kelas::create([
            'name' => 'Laravel Basics',
            'instructor_id' => $instructor->id,
        ]);
        Registration::create([
            'participant_id' => $participant->id,
            'kelas_id' => $kelas->id,
        ]);

        // Act
        $response = $this->get(route('dashboard'));

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('dashboard');
        $response->assertViewHas('totalParticipants', 1);
        $response->assertViewHas('totalKelas', 1);
        $response->assertViewHas('totalRegistrations', 1);
    }
}
