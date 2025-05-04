<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition()
    {
        return [
            'last_name'      => $this->faker->lastName,
            'first_name'     => $this->faker->firstName,
            'gender'         => $this->faker->randomElement([1, 2, 3]), // 男:1 女:2 その他:3
            'email'          => $this->faker->unique()->safeEmail,
            'tel'            => $this->faker->numerify('0##########'),
            'address'        => $this->faker->address,
            'category_id'    => $this->faker->numberBetween(1, 5),
            'content'        => $this->faker->realText(100),
            'created_at'     => now(),
            'updated_at'     => now(),
        ];
    }
}
