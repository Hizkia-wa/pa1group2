<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UloskitaController extends Controller
{
    // Data ulos (dalam implementasi sebenarnya, ini seharusnya berasal dari database)
    private function getUlosData()
    {
        return [
            [
                'name' => 'Ulos Antakantak',
                'slug' => 'antakantak',
                'short_description' => 'Ulos Antakantak adalah kain tenun yang berbentuk selendang dengan motif yang sederhana namun elegan.',
                'image' => 'ulos-antakantak.jpg',
                'description' => 'Ulos Antakantak adalah kain tenun yang berbentuk selendang dengan motif yang sederhana namun elegan. Biasanya, ulos ini memiliki warna dasar gelap dengan pola garis-garis atau geometris yang menarik.',
                'kegunaan' => 'Ulos Antakantak digunakan dalam berbagai upacara adat seperti pernikahan dan pemakaman. Ulos ini juga sering digunakan sebagai hadiah penghormatan kepada tamu istimewa.',
                'pembuatan' => 'Proses pembuatan Ulos Antakantak melibatkan teknik tenun tradisional menggunakan alat tenun bukan mesin (ATBM). Pembuatannya memerlukan ketelitian tinggi dan waktu yang cukup lama karena dibuat secara manual.'
            ],
            // Tambahkan jenis ulos lainnya di sini
            [
                
                'name' => 'Ulos Ragidup',
                'slug' => 'ragidup',
                'short_description' => 'Ulos Ragidup merupakan ulos paling sakral dalam tradisi Batak.',
                'image' => 'images/default-profile.png',
                'description' => 'Ulos Ragidup dianggap sebagai ulos yang paling sakral dalam tradisi Batak. Memiliki motif yang kompleks dengan warna-warna yang kaya dan beragam.',
                'kegunaan' => 'Ulos Ragidup digunakan dalam upacara pernikahan, khususnya diberikan oleh orang tua pengantin perempuan kepada pengantin. Ulos ini melambangkan doa dan harapan untuk kehidupan yang baik.',
                'pembuatan' => 'Pembuatan Ulos Ragidup sangat rumit dan membutuhkan waktu berbulan-bulan. Penenun harus menguasai teknik khusus dan memiliki pengalaman bertahun-tahun.'
            ],
            
            // Tambahkan jenis ulos lainnya sesuai kebutuhan
        ];
    }

    // Menampilkan daftar semua jenis ulos
    public function index()
    {
        $ulosData = $this->getUlosData();
        return view('users.uloskita', compact('ulosData'));
    }

    // Menampilkan detail ulos berdasarkan jenis
    public function detail($jenis)
    {
        $ulosData = $this->getUlosData();
        $ulosDetail = null;

        foreach ($ulosData as $ulos) {
            if ($ulos['slug'] === $jenis) {
                $ulosDetail = $ulos;
                break;
            }
        }

        if (!$ulosDetail) {
            abort(404, 'Ulos tidak ditemukan');
        }

        return view('users.uloskita-detail', compact('ulosDetail'));
    }
}