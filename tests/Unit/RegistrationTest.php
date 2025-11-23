<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Instructor;
use App\Models\Kelas;
use App\Models\Participant;
use App\Models\Registration;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_fillable_attributes()
    {
        $registration = new Registration();
        $fillable = $registration->getFillable();

        $this->assertEquals(['participant_id', 'kelas_id'], $fillable);
    }

    /** @test */
    public function it_can_create_registration()
    {
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

        $this->assertInstanceOf(Registration::class, $registration);
        $this->assertEquals($participant->id, $registration->participant_id);
        $this->assertEquals($kelas->id, $registration->kelas_id);
        $this->assertDatabaseHas('registrations', [
            'participant_id' => $participant->id,
            'kelas_id' => $kelas->id,
        ]);
    }

    /** @test */
    public function it_belongs_to_participant()
    {
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

        $this->assertInstanceOf(Participant::class, $registration->participant);
        $this->assertEquals($participant->id, $registration->participant->id);
        $this->assertEquals('Test Participant', $registration->participant->name);
    }

    /** @test */
    public function it_belongs_to_kelas()
    {
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

        $this->assertInstanceOf(Kelas::class, $registration->kelas);
        $this->assertEquals($kelas->id, $registration->kelas->id);
        $this->assertEquals('Test Kelas', $registration->kelas->name);
    }

    /** @test */
    public function it_has_timestamps()
    {
        $instructor = Instructor::create(['name' => 'Test Instructor']);
        $participant = Participant::create([
            'name' => 'Test',
            'email' => 'test@example.com',
        ]);
        $kelas = Kelas::create([
            'name' => 'Test',
            'instructor_id' => $instructor->id,
        ]);

        $registration = Registration::create([
            'participant_id' => $participant->id,
            'kelas_id' => $kelas->id,
        ]);

        $this->assertNotNull($registration->created_at);
        $this->assertNotNull($registration->updated_at);
    }
}
