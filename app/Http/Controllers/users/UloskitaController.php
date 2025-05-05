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
                'image' => 'ulos-ragidup.jpg',
                'description' => 'Ulos Ragidup dianggap sebagai ulos yang paling sakral dalam tradisi Batak. Memiliki motif yang kompleks dengan warna-warna yang kaya dan beragam.',
                'kegunaan' => 'Ulos Ragidup digunakan dalam upacara pernikahan, khususnya diberikan oleh orang tua pengantin perempuan kepada pengantin. Ulos ini melambangkan doa dan harapan untuk kehidupan yang baik.',
                'pembuatan' => 'Pembuatan Ulos Ragidup sangat rumit dan membutuhkan waktu berbulan-bulan. Penenun harus menguasai teknik khusus dan memiliki pengalaman bertahun-tahun.'
            ],
            [
                'name' => 'Ulos Manggiring',
                'slug' => 'manggiring',
                'category' => 'ulos',
                'short_description' => 'Ulos Manggiring dikenal sebagai simbol perlindungan dan keberkahan.',
                'image' => 'ulos-atakanta.jpg',
                'description' => 'Ulos Manggiring memiliki motif yang kaya dengan simbol-simbol yang melambangkan perlindungan dan keberkahan. Kain ini sering memiliki kombinasi warna cerah seperti merah dan kuning.',
                'kegunaan' => 'Ulos ini biasanya diberikan kepada anak atau cucu sebagai simbol doa untuk kehidupan yang penuh berkat dan perlindungan dari leluhur.',
                'pembuatan' => 'Proses pembuatan Ulos Manggiring melibatkan tenunan manual dengan detail motif yang rumit, sering kali memakan waktu berminggu-minggu.'
            ],
            [
                'name' => 'Ulos Sadum',
                'slug' => 'sadum',
                'category' => 'ulos',
                'short_description' => 'Ulos Sadum dikenal dengan warna-warnanya yang cerah dan meriah.',
                'image' => 'ulos-atakanta.jpg',
                'description' => 'Ulos Sadum memiliki ciri khas warna-warna cerah seperti merah, kuning, dan hijau dengan motif yang lebih bebas dan meriah dibandingkan ulos lainnya. Kain ini sering dihiasi dengan benang emas atau perak.',
                'kegunaan' => 'Ulos Sadum digunakan dalam acara-acara adat yang penuh sukacita, seperti pesta pernikahan atau kelahiran, dan sering diberikan sebagai hadiah kepada tamu penting.',
                'pembuatan' => 'Pembuatan Ulos Sadum membutuhkan keterampilan khusus untuk menggabungkan warna-warna cerah dan benang logam, dengan proses tenun yang cermat.'
            ],
            [
                'name' => 'Gorga Simeol-meol',
                'slug' => 'gorga-simeol-meol',
                'category' => 'sortali',
                'short_description' => 'Gorga Simeol-meol adalah motif ukiran khas Batak yang melambangkan kesuburan.',
                'image' => 'gorga-simeol.jpg',
                'description' => 'Gorga Simeol-meol adalah ukiran kayu tradisional dengan motif bergelombang yang melambangkan gerak ular melata. Motif ini memiliki makna filosofis tentang kesuburan dan keberlanjutan hidup.',
                'kegunaan' => 'Gorga ini biasanya diukir pada rumah adat Batak sebagai simbol harapan kesuburan dan kesejahteraan bagi penghuni rumah.',
                'pembuatan' => 'Pembuatan Gorga Simeol-meol membutuhkan keahlian khusus dalam seni ukir tradisional Batak, dengan teknik yang diwariskan secara turun-temurun.'
            ],
            [
                'name' => 'Adat Sipatuloda',
                'slug' => 'adat-sipatuloda',
                'category' => 'sortali',
                'short_description' => 'Adat Sipatuloda adalah serangkaian ritual yang dilakukan dalam upacara pernikahan Batak.',
                'image' => 'adat-sipatuloda.jpg',
                'description' => 'Adat Sipatuloda merupakan bagian penting dari tradisi pernikahan Batak yang melibatkan rangkaian ritual khusus dan pemberian ulos sebagai simbol restu dan doa.',
                'kegunaan' => 'Tradisi ini dilaksanakan untuk meminta restu dari leluhur dan menjaga keharmonisan hubungan antar keluarga besar yang baru terbentuk.',
                'pembuatan' => 'Pelaksanaan adat ini memerlukan persiapan yang matang dan pemahaman mendalam tentang nilai-nilai budaya Batak.'
            ],
            [
                'name' => 'Topi Batak Tradisional',
                'slug' => 'topi-batak-tradisional',
                'category' => 'topi',
                'short_description' => 'Topi tradisional Batak yang digunakan dalam upacara adat.',
                'image' => 'topi-batak.jpg',
                'description' => 'Topi Batak tradisional memiliki bentuk unik dan biasanya dibuat dari anyaman bambu atau rotan dengan hiasan kain ulos pada bagian tertentu.',
                'kegunaan' => 'Topi ini dikenakan oleh tetua adat atau pemimpin upacara dalam berbagai ritual tradisional Batak.',
                'pembuatan' => 'Pembuatan topi melibatkan teknik anyaman tradisional yang telah diwariskan selama berabad-abad dalam budaya Batak.'
            ],
            [
                'name' => 'Sarung Sutra Mandar',
                'slug' => 'sarung-sutra-mandar',
                'category' => 'mandar',
                'short_description' => 'Sarung Sutra Mandar adalah kain tenun tradisional dari Sulawesi Barat.',
                'image' => 'sarung-mandar.jpg',
                'description' => 'Sarung Sutra Mandar merupakan kain tenun tradisional yang berasal dari suku Mandar di Sulawesi Barat. Kain ini terkenal karena kehalusan dan kualitas sutranya yang tinggi.',
                'kegunaan' => 'Sarung ini digunakan dalam berbagai upacara adat Mandar dan juga sebagai pakaian tradisional sehari-hari.',
                'pembuatan' => 'Proses pembuatan sarung sutra Mandar melibatkan pemeliharaan ulat sutra hingga proses tenun yang rumit menggunakan alat tradisional.'
            ]
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