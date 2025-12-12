<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Employee; // Pastikan Anda mengimpor model Employee

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Nama model yang sesuai dengan factory ini.
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state (Definisi status default model).
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $positions = ['Manager', 'Staff', 'Senior Developer', 'Junior Analyst', 'HR Specialist'];
        $departments = ['IT', 'Finance', 'Human Resources', 'Marketing', 'Operations'];

        return [
            'nama_lengkap' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'nomor_telepon' => $this->faker->phoneNumber,
            'department_id' => \App\Models\Department::inRandomOrder()->first()?->id ?? 1,
            'position_id' => \App\Models\Position::inRandomOrder()->first()?->id ?? 1,
            'tanggal_lahir' => $this->faker->date(),
            'alamat' => $this->faker->address,
            'tanggal_masuk' => $this->faker->date(),
            'status' => $this->faker->randomElement(['aktif', 'nonaktif']),
        ];
    }
}