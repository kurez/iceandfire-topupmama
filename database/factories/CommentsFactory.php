<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CommentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $books = [
            'A Game of Thrones',
            'A Clash of Kings',
            'A Storm of Swords',
            'The Hedge Knight',
            'A Feast for Crows',
            'The Sworn Sword',
            'The Mystery Knight',
            'A Dance with Dragons',
            'The Princess and the Queen',
            'The Rogue Prince',
            'The World of Ice and Fire',
            'A Knight of the Seven Kingdoms',
        ];
        return [
            'client_ip' => $this->faker->ipv4(),
            'book_name' => $this->faker->randomElement($books),
            'comment' => $this->faker->text($maxNbChars = 500),
            'created_at' => $this->faker->dateTime($max = 'now', $timezone = null),
            'updated_at' => $this->faker->dateTime($max = 'now', $timezone = null),
        ];
    }
}
