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
                'image' => 'ulos-atakanta.jpg',
                'description' => 'Ulos Antakantak adalah kain tenun yang berbentuk selendang dengan motif yang sederhana namun elegan. Biasanya, ulos ini memiliki warna dasar gelap dengan pola garis-garis atau geometris yang menarik.',
                'kegunaan' => 'Ulos Antakantak digunakan dalam berbagai upacara adat seperti pernikahan dan pemakaman. Ulos ini juga sering digunakan sebagai hadiah penghormatan kepada tamu istimewa.',
                'pembuatan' => 'Proses pembuatan Ulos Antakantak melibatkan teknik tenun tradisional menggunakan alat tenun bukan mesin (ATBM). Pembuatannya memerlukan ketelitian tinggi dan waktu yang cukup lama karena dibuat secara manual.'
            ],
            [
                'name' => 'Ulos Ragidup',
                'slug' => 'ragidup',
                'short_description' => 'Ulos Ragidup merupakan ulos paling sakral dalam tradisi Batak.',
                'image' => 'ulos-ragidup.jpg', // Sesuaikan dengan nama file yang benar
                'description' => 'Ulos Ragidup dianggap sebagai ulos yang paling sakral dalam tradisi Batak. Memiliki motif yang kompleks dengan warna-warna yang kaya dan beragam.',
                'kegunaan' => 'Ulos Ragidup digunakan dalam upacara pernikahan, khususnya diberikan oleh orang tua pengantin perempuan kepada pengantin. Ulos ini melambangkan doa dan harapan untuk kehidupan yang baik.',
                'pembuatan' => 'Pembuatan Ulos Ragidup sangat rumit dan membutuhkan waktu berbulan-bulan. Penenun harus menguasai teknik khusus dan memiliki pengalaman bertahun-tahun.'
            ],
            [
                'name' => 'Ulos Manggiring',
                'slug' => 'manggiring',
                'short_description' => 'Ulos Manggiring dikenal sebagai simbol perlindungan dan keberkahan.',
                'image' => 'ulos-atakanta.jpg',
                'description' => 'Ulos Manggiring memiliki motif yang kaya dengan simbol-simbol yang melambangkan perlindungan dan keberkahan. Kain ini sering memiliki kombinasi warna cerah seperti merah dan kuning.',
                'kegunaan' => 'Ulos ini biasanya diberikan kepada anak atau cucu sebagai simbol doa untuk kehidupan yang penuh berkat dan perlindungan dari leluhur.',
                'pembuatan' => 'Proses pembuatan Ulos Manggiring melibatkan tenunan manual dengan detail motif yang rumit, sering kali memakan waktu berminggu-minggu.'
            ],
            [
                'name' => 'Ulos Sadum',
                'slug' => 'sadum',
                'short_description' => 'Ulos Sadum dikenal dengan warna-warnanya yang cerah dan meriah.',
                'image' => 'ulos-atakanta.jpg',
                'description' => 'Ulos Sadum memiliki ciri khas warna-warna cerah seperti merah, kuning, dan hijau dengan motif yang lebih bebas dan meriah dibandingkan ulos lainnya. Kain ini sering dihiasi dengan benang emas atau perak.',
                'kegunaan' => 'Ulos Sadum digunakan dalam acara-acara adat yang penuh sukacita, seperti pesta pernikahan atau kelahiran, dan sering diberikan sebagai hadiah kepada tamu penting.',
                'pembuatan' => 'Pembuatan Ulos Sadum membutuhkan keterampilan khusus untuk menggabungkan warna-warna cerah dan benang logam, dengan proses tenun yang cermat.'
            ],
            [
                'name' => 'Ulos Bintang Maratur',
                'slug' => 'bintang-maratur',
                'short_description' => 'Ulos Bintang Maratur melambangkan harmoni dan tatanan hidup.',
               'image' => 'ulos-atakanta.jpg',
                'description' => 'Ulos Bintang Maratur memiliki motif bintang yang teratur, melambangkan harmoni dan tatanan dalam kehidupan masyarakat Batak. Warna utamanya biasanya merah, hitam, dan putih.',
                'kegunaan' => 'Ulos ini sering digunakan dalam upacara adat untuk menyampaikan pesan harmoni dan doa agar kehidupan berjalan dengan teratur dan seimbang.',
                'pembuatan' => 'Proses tenun Ulos Bintang Maratur membutuhkan ketelitian untuk membentuk motif bintang yang simetris, sering kali menggunakan alat tenun tradisional.'
            ],
         
            [
                'name' => 'Ulos Sibolang',
                'slug' => 'sibolang',
                'short_description' => 'Ulos Sibolang adalah ulos yang dikenal dengan motif garisnya yang khas.',
                'image' => 'ulos-atakanta.jpg',
                'description' => 'Ulos Sibolang memiliki motif dominan berupa garis tebal (bolang) yang memanjang pada permukaan kain. Biasanya berwarna merah tua, hitam, dan putih dengan aksen benang emas.',
                'kegunaan' => 'Ulos Sibolang digunakan dalam upacara kematian, terutama untuk menyelimuti jenazah atau diberikan kepada keluarga yang berduka sebagai simbol penghormatan terakhir.',
                'pembuatan' => 'Pembuatan Ulos Sibolang menggunakan teknik tenun tradisional dengan fokus pada pembentukan garis-garis tebal yang menjadi ciri khasnya. Proses ini membutuhkan ketepatan dalam menghitung benang dan konsistensi tekanan.'
            ],
            [
                'name' => 'Ulos Ragi Hotang',
                'slug' => 'ragi-hotang',
                'short_description' => 'Ulos Ragi Hotang melambangkan kekuatan dan keteguhan seperti rotan.',
               'image' => 'ulos-atakanta.jpg',
                'description' => 'Ulos Ragi Hotang memiliki motif yang terinspirasi dari rotan (hotang), yang melambangkan kekuatan dan keteguhan. Motifnya berupa garis-garis yang saling bersilangan membentuk pola tertentu.',
                'kegunaan' => 'Ulos ini biasanya digunakan dalam upacara adat yang membutuhkan simbol kekuatan, seperti upacara memasuki rumah baru atau pengukuhan pangkat adat.',
                'pembuatan' => 'Proses pembuatan Ulos Ragi Hotang memerlukan keahlian dalam menenun pola bersilangan yang teratur dan rapi, dengan teknik khusus untuk menghasilkan tekstur yang khas.'
            ],
            [
                'name' => 'Ulos Sitoluntuho',
                'slug' => 'sitoluntuho',
                'short_description' => 'Ulos Sitoluntuho dikenal dengan motif tiga warna yang melambangkan tiga elemen kehidupan.',
                'image' => 'ulos-sitoluntuho.jpg',
                'description' => 'Ulos Sitoluntuho memiliki tiga warna dasar yang melambangkan tiga elemen kehidupan dalam filosofi Batak: banua ginjang (dunia atas), banua tonga (dunia tengah), dan banua toru (dunia bawah). Warna-warna tersebut biasanya adalah putih, merah, dan hitam.',
                'kegunaan' => 'Ulos ini digunakan dalam upacara religius dan adat yang membutuhkan keseimbangan spiritual, seperti upacara syukuran atau tolak bala.',
                'pembuatan' => 'Pembuatan Ulos Sitoluntuho memerlukan teknik khusus untuk menciptakan transisi yang halus antara ketiga warna dasar, serta ketelitian dalam membentuk motif yang berulang.'
            ],
            [
                'name' => 'Ulos Jugia',
                'slug' => 'jugia',
                'short_description' => 'Ulos Jugia adalah ulos yang melambangkan kegembiraan dan kemakmuran.',
                'image' => 'ulos-jugia.jpg',
                'description' => 'Ulos Jugia memiliki motif yang dinamis dan warna-warna cerah yang melambangkan kegembiraan dan kemakmuran. Motifnya biasanya berupa kombinasi bentuk geometris dengan ornamen floral.',
                'kegunaan' => 'Ulos Jugia digunakan dalam acara-acara yang penuh kegembiraan seperti pesta panen, pernikahan, atau kelahiran anak. Ulos ini juga sering digunakan sebagai dekorasi dalam rumah tradisional Batak.',
                'pembuatan' => 'Pembuatan Ulos Jugia membutuhkan keterampilan dalam mengombinasikan berbagai warna dan motif. Proses tenunannya melibatkan teknik khusus yang memungkinkan terciptanya pola yang kompleks dan dinamis.'
            ],
            [
                'name' => 'Ulos Pinuncaan',
                'slug' => 'pinuncaan',
                'short_description' => 'Ulos Pinuncaan adalah ulos yang digunakan untuk upacara pengobatan tradisional.',
                'image' => 'ulos-pinuncaan.jpg',
                'description' => 'Ulos Pinuncaan memiliki motif khusus yang dipercaya memiliki kekuatan penyembuhan. Warna-warnanya cenderung gelap dengan sentuhan merah dan putih yang melambangkan elemen kehidupan.',
                'kegunaan' => 'Ulos Pinuncaan digunakan dalam upacara pengobatan tradisional Batak, terutama oleh dukun atau tabib. Ulos ini dipercaya dapat membantu mengusir roh jahat dan mendatangkan energi penyembuhan.',
                'pembuatan' => 'Pembuatan Ulos Pinuncaan melibatkan ritual khusus sebelum dan selama proses tenun. Penenun biasanya adalah orang yang memiliki pengetahuan tentang pengobatan tradisional dan simbol-simbol spiritual.'
            ],
            [
                'name' => 'Ulos Suri-suri',
                'slug' => 'suri-suri',
                'short_description' => 'Ulos Suri-suri melambangkan kebijaksanaan dan kecerdasan dalam kehidupan.',
                'image' => 'ulos-suri-suri.jpg',
                'description' => 'Ulos Suri-suri memiliki motif yang kompleks dan rumit, yang melambangkan kebijaksanaan dan kecerdasan. Warna-warnanya biasanya lebih gelap dengan kombinasi merah, hitam, dan biru tua.',
                'kegunaan' => 'Ulos Suri-suri sering digunakan dalam upacara adat yang berkaitan dengan pendidikan atau pentahbisan pemimpin adat. Ulos ini juga diberikan kepada orang yang dianggap bijaksana dalam komunitas.',
                'pembuatan' => 'Pembuatan Ulos Suri-suri membutuhkan keahlian tinggi dalam teknik tenun dan pemahaman mendalam tentang filosofi Batak. Prosesnya dapat memakan waktu berbulan-bulan untuk satu kain.'
            ],
            [
                'name' => 'Ulos Sibunga-bunga',
                'slug' => 'sibunga-bunga',
                'short_description' => 'Ulos Sibunga-bunga terkenal dengan motif bunga yang melambangkan keindahan dan kesuburan.',
                'image' => 'ulos-sibunga-bunga.jpg',
                'description' => 'Ulos Sibunga-bunga memiliki motif bunga yang menghias seluruh permukaan kain. Warna-warnanya cerah dan beragam, mencerminkan keindahan alam dan kesuburan tanah.',
                'kegunaan' => 'Ulos ini biasanya digunakan dalam upacara yang berkaitan dengan kesuburan, seperti pernikahan atau upacara kehamilan. Ulos Sibunga-bunga juga sering digunakan sebagai pakaian wanita dalam acara-acara adat yang meriah.',
                'pembuatan' => 'Pembuatan Ulos Sibunga-bunga memerlukan ketelitian dalam membentuk motif bunga yang detail. Teknik tenun yang digunakan melibatkan kombinasi warna yang harmonis untuk menciptakan kesan bunga yang hidup.'
            ],
            [
                'name' => 'Ulos Sitompi',
                'slug' => 'sitompi',
                'short_description' => 'Ulos Sitompi dikenal sebagai ulos untuk menggendong bayi, melambangkan kasih sayang dan perlindungan.',
                'image' => 'ulos-sitompi.jpg',
                'description' => 'Ulos Sitompi memiliki desain yang kuat namun lembut, dengan motif yang sederhana namun bermakna. Biasanya memiliki warna dasar yang hangat dengan aksen yang menenangkan.',
                'kegunaan' => 'Ulos Sitompi secara tradisional digunakan untuk menggendong bayi, memberikan kehangatan dan perlindungan. Ulos ini juga menjadi simbol kasih sayang orang tua dan diberikan sebagai hadiah kelahiran.',
                'pembuatan' => 'Pembuatan Ulos Sitompi memperhatikan aspek kenyamanan dan keamanan, dengan fokus pada tekstur yang lembut dan kuat. Teknik tenun yang digunakan menciptakan kain yang fleksibel namun kokoh.'
            ],
            [
                'name' => 'Ulos Harungguan',
                'slug' => 'harungguan',
                'short_description' => 'Ulos Harungguan melambangkan komunikasi dan hubungan yang baik antar manusia.',
                'image' => 'ulos-harungguan.jpg',
                'description' => 'Ulos Harungguan memiliki motif yang melambangkan komunikasi dan hubungan baik, sering digambarkan dengan pola-pola yang saling terhubung. Warna-warnanya biasanya cerah dan kontras.',
                'kegunaan' => 'Ulos ini digunakan dalam upacara perdamaian atau rekonsiliasi antara dua kelompok yang bertikai. Ulos Harungguan juga sering digunakan dalam upacara pertemuan adat besar.',
                'pembuatan' => 'Pembuatan Ulos Harungguan memerlukan pemahaman tentang simbol-simbol perdamaian dalam budaya Batak. Proses tenunannya melibatkan teknik khusus untuk menciptakan pola yang saling terhubung dengan harmonis.'
            ],
            [
                'name' => 'Ulos Padang Rusa',
                'slug' => 'padang-rusa',
                'short_description' => 'Ulos Padang Rusa terinspirasi dari keindahan alam dan kehidupan rusa di padang rumput.',
                'image' => 'ulos-padang-rusa.jpg',
                'description' => 'Ulos Padang Rusa memiliki motif yang terinspirasi dari kehidupan rusa di padang rumput. Motifnya biasanya berupa gambaran stilisasi rusa dan elemen alam dengan warna-warna yang menyerupai padang rumput: hijau, coklat, dan kuning.',
                'kegunaan' => 'Ulos ini biasanya digunakan dalam upacara yang berkaitan dengan alam, seperti upacara panen atau upacara meminta hujan. Ulos Padang Rusa juga digunakan oleh pemburu dalam ritual sebelum berburu.',
                'pembuatan' => 'Pembuatan Ulos Padang Rusa membutuhkan keahlian dalam menggambarkan elemen alam dalam bentuk tenun. Proses pembuatannya melibatkan studi tentang gerakan dan perilaku rusa yang kemudian diinterpretasikan dalam motif tenun.'
            ]
        ];
    }

    // Menampilkan daftar semua jenis ulos
    public function index()
    {
        $ulosData = $this->getUlosData();
        return view('users.uloskita', compact('ulosData'));
    }

    public function indexcustomer()
    {
        $ulosData = $this->getUlosData();
        return view('customer.uloskita', compact('ulosData'));
    }

    public function indexadmin()
    {
        $ulosData = $this->getUlosData();
        return view('admin.users.uloskita', compact('ulosData'));
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