<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition(): array
    {
        return [
            'last_name'   => $this->faker->lastName,
            'first_name'  => $this->faker->firstName,
            'gender'      => $this->faker->numberBetween(0, 2),
            'email'       => $this->faker->unique()->safeEmail,
            'tel'         => $this->faker->numerify('0#########'),
            'address'     => $this->faker->address,
            'category_id' => Category::inRandomOrder()->first()->id ?? 1,
            'content'     => $this->faker->realText(100),
        ];
    }
}


