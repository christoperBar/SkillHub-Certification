<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Instructor;
use App\Models\Kelas;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InstructorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_fillable_attributes()
    {
        $instructor = new Instructor();
        $fillable = $instructor->getFillable();

        $this->assertEquals(['name'], $fillable);
    }

    /** @test */
    public function it_can_create_instructor()
    {
        $instructor = Instructor::create([
            'name' => 'John Doe',
        ]);

        $this->assertInstanceOf(Instructor::class, $instructor);
        $this->assertEquals('John Doe', $instructor->name);
        $this->assertDatabaseHas('instructors', [
            'name' => 'John Doe',
        ]);
    }

    /** @test */
    public function it_has_many_kelas()
    {
        $instructor = Instructor::create(['name' => 'Test Instructor']);

        Kelas::create([
            'name' => 'Kelas 1',
            'instructor_id' => $instructor->id,
        ]);
        Kelas::create([
            'name' => 'Kelas 2',
            'instructor_id' => $instructor->id,
        ]);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $instructor->kelas);
        $this->assertCount(2, $instructor->kelas);
        $this->assertInstanceOf(Kelas::class, $instructor->kelas->first());
    }

    /** @test */
    public function it_has_timestamps()
    {
        $instructor = Instructor::create(['name' => 'Test']);

        $this->assertNotNull($instructor->created_at);
        $this->assertNotNull($instructor->updated_at);
    }
}
