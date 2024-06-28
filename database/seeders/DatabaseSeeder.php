<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\FotoProperti;
use App\Models\KategoriProperti;
use App\Models\Properti;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345'),
            'phone' => '1234567890',
            'role' => 'admin'
        ]);

        \App\Models\User::factory()->create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('12345'),
            'phone' => '1234567890',
            'role' => 'user'
        ]);

        KategoriProperti::create([
            'nama' => 'New Taman Tenera Indah',
            'deskripsi' => 'Perumahan New Taman Tenera Indah hadir untuk memberikan desain rumah yang
elegan dengan harga terjangkau dan berada di lokasi yang strategis, memiliki lingkungan yang
masih asri dan alami memberikan kenyamanan yang tak tertandingi bagi setiap keluarga tercinta.',
            'alamat' => 'Jl. Karya Wisata Ujung, Kec. Namorambe, Kabupaten Deli Serdang, Sumatera Utara 20145'
        ]);

        $data = json_decode(file_get_contents(database_path('seeders/properti.json')), true);
        foreach ($data as $item) {
            $properti = Properti::create($item);
            for ($i = 1; $i <= 3; $i++) {
                FotoProperti::create([
                    'properti_id' => $properti->id,
                    'foto' => 'aG6zKHIFmnOcduyqnJw6XU9LK8nyNhmAFOIfdbHi.jpg',
                    'is_banner' => $i === 1 ? 1 : 0
                ]);
            }
        }

    }
}
