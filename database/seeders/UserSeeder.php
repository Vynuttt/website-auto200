<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        
        // Password yang sama untuk semua user test: "password"
        $password = Hash::make('password');

        // Insert Users
        $users = [
            // 1. Owner
            [
                'id' => 1,
                'name' => 'Owner Auto2000',
                'email' => 'owner@auto2000.test',
                'role_id' => 1, // Owner
                'email_verified_at' => $now,
                'password' => $password,
                'phone' => '081234567801',
                'employee_number' => 'OWN001',
                'address' => 'Jl. Sudirman No. 1, Jakarta',
                'birthdate' => '1980-01-01',
                'gender' => 'Male',
                'emergency_contact' => '081234567802',
                'avatar' => null,
                'is_active' => true,
                'is_on_duty' => false,
                'remember_token' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            // 2. Admin
            [
                'id' => 2,
                'name' => 'Admin Auto2000',
                'email' => 'admin@auto2000.test',
                'role_id' => 2, // Admin
                'email_verified_at' => $now,
                'password' => $password,
                'phone' => '081234567811',
                'employee_number' => 'ADM001',
                'address' => 'Jl. Thamrin No. 10, Jakarta',
                'birthdate' => '1985-05-15',
                'gender' => 'Female',
                'emergency_contact' => '081234567812',
                'avatar' => null,
                'is_active' => true,
                'is_on_duty' => true,
                'remember_token' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            // 3. Mechanic
            [
                'id' => 3,
                'name' => 'Budi Mekanik',
                'email' => 'mechanic@auto2000.test',
                'role_id' => 3, // Mechanic
                'email_verified_at' => $now,
                'password' => $password,
                'phone' => '081234567821',
                'employee_number' => 'MECH001',
                'address' => 'Jl. Gatot Subroto No. 5, Jakarta',
                'birthdate' => '1990-08-20',
                'gender' => 'Male',
                'emergency_contact' => '081234567822',
                'avatar' => null,
                'is_active' => true,
                'is_on_duty' => true,
                'remember_token' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            // 4. Customer
            [
                'id' => 4,
                'name' => 'Customer Test',
                'email' => 'customer@auto2000.test',
                'role_id' => 4, // Customer
                'email_verified_at' => $now,
                'password' => $password,
                'phone' => '081234567831',
                'employee_number' => null,
                'address' => 'Jl. Kuningan No. 15, Jakarta',
                'birthdate' => '1995-12-10',
                'gender' => 'Male',
                'emergency_contact' => '081234567832',
                'avatar' => null,
                'is_active' => true,
                'is_on_duty' => false,
                'remember_token' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('users')->insert($users);

        // Insert User-Role relationships (many-to-many)
        $userRoles = [
            ['user_id' => 1, 'role_id' => 1], // Owner
            ['user_id' => 2, 'role_id' => 2], // Admin
            ['user_id' => 3, 'role_id' => 3], // Mechanic
            ['user_id' => 4, 'role_id' => 4], // Customer
        ];

        DB::table('user_roles')->insert($userRoles);

        $this->command->info('✅ Test users created successfully!');
        $this->command->line('');
        $this->command->warn('📧 Login Credentials (password: "password"):');
        $this->command->line('   Owner:    owner@auto2000.test');
        $this->command->line('   Admin:    admin@auto2000.test');
        $this->command->line('   Mechanic: mechanic@auto2000.test');
        $this->command->line('   Customer: customer@auto2000.test');
    }
}