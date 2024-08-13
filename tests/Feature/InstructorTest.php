<?php

namespace Tests\Feature;

use App\Models\ClassType;
use App\Models\ScheduledClass;
use Tests\TestCase;
use App\Models\User;
use Database\Seeders\ClassTypeSeeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class property_managerTest extends TestCase
{
    use RefreshDatabase;

    public function test_property_manager_is_redirected_to_property_manager_dashboard() {
        $user = User::factory()->create([
            'role' => 'property_manager'
        ]);

        $response = $this->actingAs($user)
        ->get('/dashboard');

        $response->assertRedirectToRoute('property_manager.dashboard');

        $this->followRedirects($response)->assertSeeText("Hey property_manager");
    }

    public function test_property_manager_can_schedule_a_class() {
        //Given
        $user = User::factory()->create([
            'role' => 'property_manager'
        ]);
        $this->seed(ClassTypeSeeder::class);

        //When
        $response = $this->actingAs($user)
            ->post('property_manager/schedule', [
            'class_type_id' => ClassType::first()->id,
            'date' => '2023-04-20',
            'time' => '09:00:00'
        ]);

        //Then 

        $this->assertDatabaseHas('scheduled_classes',[
            'class_type_id' => ClassType::first()->id,
            'date_time' => '2023-04-20 09:00:00'
        ]);
        $response->assertRedirectToRoute('schedule.index');
    }

    public function test_property_manager_can_cancel_class() {
        // Given
        $user = User::factory()->create([
            'role' => 'property_manager'
        ]);
        $this->seed(ClassTypeSeeder::class);
        $scheduledClass = ScheduledClass::create([
            'property_manager_id' => $user->id,
            'class_type_id' => ClassType::first()->id,
            'date_time' => '2023-04-20 10:00:00'
        ]);

        // When
        $response = $this->actingAs($user)
            ->delete('/property_manager/schedule/'.$scheduledClass->id);

        // Then
        $this->assertDatabaseMissing('scheduled_classes',[
            'id' => $scheduledClass->id
        ]);
    }

    public function test_cannot_cancel_class_less_than_two_hours_before() {
        $user = User::factory()->create([
            'role' => 'property_manager'
        ]);
        $this->seed(ClassTypeSeeder::class);
        $scheduledClass = ScheduledClass::create([
            'property_manager_id' => $user->id,
            'class_type_id' => ClassType::first()->id,
            'date_time' => now()->addHours(1)->minutes(0)->seconds(0)
        ]);
        
        $response = $this->actingAs($user)
            ->get('property_manager/schedule');

        $response->assertDontSeeText('Cancel');

        $response = $this->actingAs($user)
            ->delete('/property_manager/schedule/'.$scheduledClass->id);

        $this->assertDatabaseHas('scheduled_classes',[
            'id' =>$scheduledClass->id
        ]);
    }
}
