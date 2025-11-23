<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Instructor;
use App\Models\Kelas;
use App\Models\Participant;
use App\Models\Registration;
use Illuminate\Foundation\Testing\RefreshDatabase;
class ParticipantTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_fillable_attributes()
    {
        $participant = new Participant();
        $fillable = $participant->getFillable();

        $this->assertEquals(['name', 'email', 'phone', 'address'], $fillable);
    }

    /** @test */
    public function it_can_create_participant()
    {
        $participant = Participant::create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'phone' => '081234567890',
            'address' => 'Jakarta',
        ]);

        $this->assertInstanceOf(Participant::class, $participant);
        $this->assertEquals('Jane Doe', $participant->name);
        $this->assertEquals('jane@example.com', $participant->email);
        $this->assertEquals('081234567890', $participant->phone);
        $this->assertEquals('Jakarta', $participant->address);
        $this->assertDatabaseHas('participants', [
            'email' => 'jane@example.com',
        ]);
    }

    /** @test */
    public function it_can_create_participant_without_optional_fields()
    {
        $participant = Participant::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        $this->assertInstanceOf(Participant::class, $participant);
        $this->assertNull($participant->phone);
        $this->assertNull($participant->address);
    }

    /** @test */
    public function it_has_many_registrations()
    {
        $instructor = Instructor::create(['name' => 'Test Instructor']);
        $participant = Participant::create([
            'name' => 'Test Participant',
            'email' => 'test@example.com',
        ]);

        $kelas1 = Kelas::create([
            'name' => 'Kelas 1',
            'instructor_id' => $instructor->id,
        ]);
        $kelas2 = Kelas::create([
            'name' => 'Kelas 2',
            'instructor_id' => $instructor->id,
        ]);

        Registration::create([
            'participant_id' => $participant->id,
            'kelas_id' => $kelas1->id,
        ]);
        Registration::create([
            'participant_id' => $participant->id,
            'kelas_id' => $kelas2->id,
        ]);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $participant->registrations);
        $this->assertCount(2, $participant->registrations);
        $this->assertInstanceOf(Registration::class, $participant->registrations->first());
    }

    /** @test */
    public function it_belongs_to_many_classes()
    {
        $instructor = Instructor::create(['name' => 'Test Instructor']);
        $participant = Participant::create([
            'name' => 'Test Participant',
            'email' => 'test@example.com',
        ]);

        $kelas1 = Kelas::create([
            'name' => 'Kelas 1',
            'instructor_id' => $instructor->id,
        ]);
        $kelas2 = Kelas::create([
            'name' => 'Kelas 2',
            'instructor_id' => $instructor->id,
        ]);

        Registration::create([
            'participant_id' => $participant->id,
            'kelas_id' => $kelas1->id,
        ]);
        Registration::create([
            'participant_id' => $participant->id,
            'kelas_id' => $kelas2->id,
        ]);

        $classes = $participant->classes;

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $classes);
        $this->assertCount(2, $classes);
        $this->assertInstanceOf(Kelas::class, $classes->first());
    }

    /** @test */
    public function it_has_timestamps()
    {
        $participant = Participant::create([
            'name' => 'Test',
            'email' => 'test@example.com',
        ]);

        $this->assertNotNull($participant->created_at);
        $this->assertNotNull($participant->updated_at);
    }
}
