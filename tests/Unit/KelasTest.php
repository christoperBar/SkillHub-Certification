<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Instructor;
use App\Models\Kelas;
use App\Models\Participant;
use App\Models\Registration;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KelasTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_fillable_attributes()
    {
        $kelas = new Kelas();
        $fillable = $kelas->getFillable();

        $this->assertEquals(['name', 'description', 'instructor_id'], $fillable);
    }

    /** @test */
    public function it_can_create_kelas()
    {
        $instructor = Instructor::create(['name' => 'Test Instructor']);

        $kelas = Kelas::create([
            'name' => 'Laravel Basics',
            'description' => 'Learn Laravel from scratch',
            'instructor_id' => $instructor->id,
        ]);

        $this->assertInstanceOf(Kelas::class, $kelas);
        $this->assertEquals('Laravel Basics', $kelas->name);
        $this->assertEquals('Learn Laravel from scratch', $kelas->description);
        $this->assertDatabaseHas('kelas', [
            'name' => 'Laravel Basics',
            'instructor_id' => $instructor->id,
        ]);
    }

    /** @test */
    public function it_belongs_to_instructor()
    {
        $instructor = Instructor::create(['name' => 'Test Instructor']);
        $kelas = Kelas::create([
            'name' => 'Test Kelas',
            'instructor_id' => $instructor->id,
        ]);

        $this->assertInstanceOf(Instructor::class, $kelas->instructor);
        $this->assertEquals($instructor->id, $kelas->instructor->id);
        $this->assertEquals('Test Instructor', $kelas->instructor->name);
    }

    /** @test */
    public function it_has_many_registrations()
    {
        $instructor = Instructor::create(['name' => 'Test Instructor']);
        $kelas = Kelas::create([
            'name' => 'Test Kelas',
            'instructor_id' => $instructor->id,
        ]);

        $participant1 = Participant::create([
            'name' => 'Participant 1',
            'email' => 'p1@example.com',
        ]);
        $participant2 = Participant::create([
            'name' => 'Participant 2',
            'email' => 'p2@example.com',
        ]);

        Registration::create([
            'participant_id' => $participant1->id,
            'kelas_id' => $kelas->id,
        ]);
        Registration::create([
            'participant_id' => $participant2->id,
            'kelas_id' => $kelas->id,
        ]);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $kelas->registrations);
        $this->assertCount(2, $kelas->registrations);
        $this->assertInstanceOf(Registration::class, $kelas->registrations->first());
    }

    /** @test */
    public function it_belongs_to_many_participants()
    {
        $instructor = Instructor::create(['name' => 'Test Instructor']);
        $kelas = Kelas::create([
            'name' => 'Test Kelas',
            'instructor_id' => $instructor->id,
        ]);

        $participant1 = Participant::create([
            'name' => 'Participant 1',
            'email' => 'p1@example.com',
        ]);
        $participant2 = Participant::create([
            'name' => 'Participant 2',
            'email' => 'p2@example.com',
        ]);

        Registration::create([
            'participant_id' => $participant1->id,
            'kelas_id' => $kelas->id,
        ]);
        Registration::create([
            'participant_id' => $participant2->id,
            'kelas_id' => $kelas->id,
        ]);

        $participants = $kelas->participants;

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $participants);
        $this->assertCount(2, $participants);
        $this->assertInstanceOf(Participant::class, $participants->first());
    }

    /** @test */
    public function it_has_timestamps()
    {
        $instructor = Instructor::create(['name' => 'Test']);
        $kelas = Kelas::create([
            'name' => 'Test',
            'instructor_id' => $instructor->id,
        ]);

        $this->assertNotNull($kelas->created_at);
        $this->assertNotNull($kelas->updated_at);
    }
}
