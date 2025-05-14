<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UloskitaController extends Controller
{
    // Data ulos dengan kategori (dalam implementasi sebenarnya, ini seharusnya berasal dari database)
    private function getUlosData()
    {
        return [
            [
                'name' => 'Ulos Antakantak',
                'slug' => 'antakantak',
                'category' => 'ulos',
                'short_description' => 'Ulos Antakantak adalah kain tenun yang berbentuk selendang dengan motif yang sederhana namun elegan.',
                'image' => 'ulos-atakanta.jpg',
                'description' => 'Ulos Antakantak adalah kain tenun yang berbentuk selendang dengan motif yang sederhana namun elegan. Biasanya, ulos ini memiliki warna dasar gelap dengan pola garis-garis atau geometris yang menarik.',
                'kegunaan' => 'Ulos Antakantak digunakan dalam berbagai upacara adat seperti pernikahan dan pemakaman. Ulos ini juga sering digunakan sebagai hadiah penghormatan kepada tamu istimewa.',
                'pembuatan' => 'Proses pembuatan Ulos Antakantak melibatkan teknik tenun tradisional menggunakan alat tenun bukan mesin (ATBM). Pembuatannya memerlukan ketelitian tinggi dan waktu yang cukup lama karena dibuat secara manual.'
            ],
            [
                'name' => 'Ulos Ragidup',
                'slug' => 'ragidup',
                'category' => 'ulos',
                'short_description' => 'Ulos Ragidup merupakan ulos paling sakral dalam tradisi Batak.',
                'image' => 'ulosragidup.jpg',
                'description' => 'Ulos Ragidup dianggap sebagai ulos yang paling sakral dalam tradisi Batak. Memiliki motif yang kompleks dengan warna-warna yang kaya dan beragam.',
                'kegunaan' => 'Ulos Ragidup digunakan dalam upacara pernikahan, khususnya diberikan oleh orang tua pengantin perempuan kepada pengantin. Ulos ini melambangkan doa dan harapan untuk kehidupan yang baik.',
                'pembuatan' => 'Pembuatan Ulos Ragidup sangat rumit dan membutuhkan waktu berbulan-bulan. Penenun harus menguasai teknik khusus dan memiliki pengalaman bertahun-tahun.'
            ],
              [
                'name' => 'Ulos Bintang Maratur',
                'slug' => 'bintang-maratur',
                'category' => 'ulos',
                'short_description' => 'Ulos Bintang Maratur adalah kain ulos khas Batak yang melambangkan keanggunan, kemakmuran, dan keharmonisan keluarga.',
                'image' => 'ulosbintangmaratur.jpg',
                'description' => 'Ulos Bintang Maratur memiliki motif jejeran bintang yang teratur dan simbol-simbol seperti zig-zag, ketupat, lingkaran, tugu, dan wajik yang berjejer. Motif ini melambangkan nilai ketaatan, kemakmuran, harmoni, persatuan keluarga, serta penghargaan dan prestise. Ulos ini sering digunakan dalam upacara adat Batak sebagai simbol berkat dan kabar baik.',
                'kegunaan' => 'Ulos ini biasanya diberikan dalam acara adat seperti pernikahan, kelahiran, atau sebagai tanda penghormatan dan doa agar penerima selalu diberkati dengan kemakmuran, keharmonisan, dan kesehatan.',
                'pembuatan' => 'Proses pembuatan Ulos Bintang Maratur dilakukan secara manual dengan tenunan rumit yang memakan waktu berminggu-minggu, menggunakan benang warna merah, hitam, putih, dan aksen benang emas atau perak untuk menghasilkan motif yang khas dan indah.'
       ],

            [
                'name' => 'Ulos Sadum',
                'slug' => 'sadum',
                'category' => 'ulos',
                'short_description' => 'Ulos Sadum dikenal dengan warna-warnanya yang cerah dan meriah.',
                'image' => 'ulossadum.jpg',
                'description' => 'Ulos Sadum memiliki ciri khas warna-warna cerah seperti merah, kuning, dan hijau dengan motif yang lebih bebas dan meriah dibandingkan ulos lainnya. Kain ini sering dihiasi dengan benang emas atau perak.',
                'kegunaan' => 'Ulos Sadum digunakan dalam acara-acara adat yang penuh sukacita, seperti pesta pernikahan atau kelahiran, dan sering diberikan sebagai hadiah kepada tamu penting.',
                'pembuatan' => 'Pembuatan Ulos Sadum membutuhkan keterampilan khusus untuk menggabungkan warna-warna cerah dan benang logam, dengan proses tenun yang cermat.'
            ],
            
        ];
    }

    // Menampilkan daftar semua jenis ulos berdasarkan kategori
    public function index()
    {
        $allData = $this->getUlosData();
        
        // Mengelompokkan data berdasarkan kategori
        $ulosData = array_filter($allData, function($item) {
            return $item['category'] === 'ulos';
        });
        
        $sortaliData = array_filter($allData, function($item) {
            return $item['category'] === 'sortali';
        });
        
        $topiData = array_filter($allData, function($item) {
            return $item['category'] === 'topi';
        });
        
        $mandarData = array_filter($allData, function($item) {
            return $item['category'] === 'mandar';
        });
        
        return view('users.uloskita', compact('ulosData', 'sortaliData', 'topiData', 'mandarData'));
    }

    public function indexcustomer()
    {
        $allData = $this->getUlosData();
        
        // Mengelompokkan data berdasarkan kategori
        $ulosData = array_filter($allData, function($item) {
            return $item['category'] === 'ulos';
        });
        
        $sortaliData = array_filter($allData, function($item) {
            return $item['category'] === 'sortali';
        });
        
        $topiData = array_filter($allData, function($item) {
            return $item['category'] === 'topi';
        });
        
        $mandarData = array_filter($allData, function($item) {
            return $item['category'] === 'mandar';
        });
        
        return view('customer.uloskita', compact('ulosData', 'sortaliData', 'topiData', 'mandarData'));
    }

    public function indexadmin()
    {
        $allData = $this->getUlosData();
        
        // Mengelompokkan data berdasarkan kategori
        $ulosData = array_filter($allData, function($item) {
            return $item['category'] === 'ulos';
        });
        
        $sortaliData = array_filter($allData, function($item) {
            return $item['category'] === 'sortali';
        });
        
        $topiData = array_filter($allData, function($item) {
            return $item['category'] === 'topi';
        });
        
        $mandarData = array_filter($allData, function($item) {
            return $item['category'] === 'mandar';
        });
        
        return view('admin.users.uloskita', compact('ulosData', 'sortaliData', 'topiData', 'mandarData'));
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
            abort(404, 'Item tidak ditemukan');
        }

        return view('users.uloskita-detail', compact('ulosDetail'));
    }
}