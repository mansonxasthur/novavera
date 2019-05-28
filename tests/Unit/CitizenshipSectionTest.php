<?php

namespace Tests\Unit;

use App\Citizenship;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CitizenshipSectionTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function can_add_sections_to_citizenship()
    {
        $citizenship = factory('App\Citizenship')->create();
        $sections = [
            [
                'section_id' => 'test',
                'content' => $this->faker->text,
                'after' => 'intro',
                'translation' => [
                    'content' => $this->faker->text,
                ]
            ]
        ];

        $citizenship->addSections($sections);
        $translation = $sections[0]['translation'];
        unset($sections[0]['translation']);
        $this->assertDatabaseHas('citizenship_sections', $sections[0]);
        $this->assertDatabaseHas('citizenship_section_translations', $translation);
    }
}
