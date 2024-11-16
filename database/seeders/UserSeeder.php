<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'username' => 'superadmin',
            'telp' => '081111111111',
            'alamat' => 'Jl. Super Admin, No.1, Jakarta Selatan',
            'image' => 'superadmin.jpg',
            'password' => 'superadmin',
            'email_verified_at' => now(),
            'role' => 'super_admin',
        ]);

        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'username' => 'adminuser',
            'telp' => '082222222222',
            'alamat' => 'Jl. Admin, No.2, Jakarta Barat',
            'image' => 'admin.jpg',
            'password' => 'admin',
            'email_verified_at' => now(),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Dr. John Doe',
            'email' => 'johndoe@example.com',
            'username' => '1987567890123',
            'telp' => '083333333333',
            'alamat' => 'Jl. Dosen, No.3, Bandung',
            'image' => 'dosen.jpg',
            'password' => 'dosen',
            'email_verified_at' => now(),
            'role' => 'dosen',
        ]);

        User::create([
            'name' => 'Prof. Jane Doe',
            'email' => 'kaprodi@example.com',
            'username' => '1974567890123',
            'telp' => '084444444444',
            'alamat' => 'Jl. Kaprodi, No.4, Surabaya',
            'image' => 'kaprodi.jpg',
            'prodi' => 'Teknologi Rekayasa Perangkat Lunak',
            'password' => 'kaprodi',
            'email_verified_at' => now(),
            'role' => 'kaprodi',
        ]);

        User::create([
            'name' => 'Student One',
            'email' => 'mahasiswa@example.com',
            'username' => '1234567890',
            'telp' => '085555555555',
            'alamat' => 'Jl. Mahasiswa, No.5, Yogyakarta',
            'image' => 'mahasiswa.jpg',
            'semester' => 3,
            'prodi' => 'Teknologi Rekayasa Perangkat Lunak',
            'password' => 'mahasiswa',
            'email_verified_at' => now(),
            'role' => 'mahasiswa',
        ]);

        User::create([
            'name' => 'pentol',
            'email' => 'pentol@gmail.com',
            'username' => '362258302039',
            'telp' => '0855558',
            'alamat' => 'Jl. Mahasiswa, No.5, Yogyakarta',
            'image' => 'mahasiswa.jpg',
            'semester' => 3,
            'prodi' => 'Teknologi Rekayasa Perangkat Lunak',
            'password' => 'mahasiswa',
            'email_verified_at' => now(),
            'role' => 'mahasiswa',
        ]);


        User::create([
            'name' => 'Mpaik',
            'email' => 'jaya@gmail.com',
            'username' => '2241780036',
            'telp' => '0855555555556225',
            'alamat' => 'Jl. pentol, Yogyakarta',
            'image' => 'mahasiswa.jpg',
            'semester' => 3,
            'prodi' => 'Teknologi Rekayasa Perangkat Lunak',
            'password' => 'manusiaku',
            'email_verified_at' => now(),
            'role' => 'mahasiswa',
        ]);

        User::create([
            'name' => 'andi',
            'email' => 'andi@gmail.com',
            'username' => '727279132',
            'telp' => '0855555555556225',
            'alamat' => 'Jl. pentol, Yogyakarta',
            'image' => 'mahasiswa.jpg',
            'semester' => 3,
            'prodi' => 'Teknologi Rekayasa Perangkat Lunak',
            'password' => 'mahasiswakugila',
            'email_verified_at' => now(),
            'role' => 'mahasiswa',
        ]);

        User::create([
            'name' => 'uan',
            'email' => 'uahya@gmail.com',
            'username' => '32323232',
            'telp' => '0855555555556225',
            'alamat' => 'Jl. pentol, Yogyakarta',
            'image' => 'mahasiswa.jpg',
            'semester' => 3,
            'prodi' => 'Teknologi Rekayasa Perangkat Lunak',
            'password' => 'hai',
            'email_verified_at' => now(),
            'role' => 'mahasiswa',
        ]);
        User::create([
            'name' => 'andikuaya',
            'email' => 'hua@gmail.com',
            'username' => '12345678',
            'telp' => '0855555555556225',
            'alamat' => 'Jl. pentol, Yogyakarta',
            'image' => 'mahasiswa.jpg',
            'semester' => 3,
            'prodi' => 'Teknologi Rekayasa Perangkat Lunak',
            'password' => 'mahasisswi',
            'email_verified_at' => now(),
            'role' => 'mahasiswa',
        ]);
    }
}
