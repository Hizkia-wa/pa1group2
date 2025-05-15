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
                'name' => 'Ulos Mangiring',
                'slug' => 'mangiring',
                'category' => 'ulos',
                'short_description' => 'Ulos Mangiring dikenal sebagai simbol perlindungan dan keberkahan.',
                'image' => 'ulosmangiring.jpg',
                'description' => 'Ulos Mangiring memiliki motif garis-garis yang tersusun rapi dengan warna dominan merah, hitam, putih, dan kuning. Ulos ini melambangkan perlindungan dan keberkahan bagi penerimanya, sering diberikan kepada anak atau cucu sebagai doa agar selalu mendapat berkah dan perlindungan dari leluhur.',
                'kegunaan' => 'Ulos Mangiring biasanya diberikan kepada anak atau cucu yang baru lahir sebagai simbol doa untuk kehidupan yang penuh berkat dan perlindungan dari leluhur.',
                'pembuatan' => 'Proses pembuatan Ulos Mangiring melibatkan tenunan manual dengan teknik tradisional yang memerlukan ketelitian dan waktu cukup lama untuk menghasilkan motif yang rumit dan indah.'
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
                'name' => 'Ulos Sarum Tarutung',
                'slug' => 'sadum',
                'category' => 'ulos',
                'short_description' => 'Ulos Sadum dikenal dengan warna-warnanya yang cerah dan meriah.',
                'image' => 'ulossarumtarutung.jpg',
                'description' => 'Ulos Sadum memiliki ciri khas warna-warna cerah seperti merah, kuning, dan hijau dengan motif yang lebih bebas dan meriah dibandingkan ulos lainnya. Kain ini sering dihiasi dengan benang emas atau perak.',
                'kegunaan' => 'Ulos Sadum digunakan dalam acara-acara adat yang penuh sukacita, seperti pesta pernikahan atau kelahiran, dan sering diberikan sebagai hadiah kepada tamu penting.',
                'pembuatan' => 'Pembuatan Ulos Sadum membutuhkan keterampilan khusus untuk menggabungkan warna-warna cerah dan benang logam, dengan proses tenun yang cermat.'
            ],
                [
            'name' => 'Ulos Ragi Hotang',
            'slug' => 'ragi-hotang',
            'category' => 'ulos',
            'short_description' => 'Ulos Ragi Hotang adalah ulos yang melambangkan ikatan kasih sayang yang kuat, seperti rotan yang mengikat erat.',
            'image' => 'ulosragihotang.jpg',
            'description' => 'Ulos Ragi Hotang merupakan salah satu ulos khas Batak Toba yang digunakan dalam acara pesta adat pernikahan dan kematian. Ulos ini melambangkan kasih sayang, restu, dan harapan agar ikatan antara pengantin atau keluarga tetap kuat dan langgeng seperti ikatan rotan (hotang). Motif dan pewarnaan ulos ini memiliki makna filosofis mendalam yang berkaitan dengan nilai-nilai sosial dan religi masyarakat Batak.',
            'kegunaan' => 'Digunakan dalam upacara pernikahan adat Batak Toba, khususnya diberikan kepada pengantin sebagai simbol restu dan doa agar pernikahan mereka diberkati dan langgeng. Selain itu, ulos ini juga dipakai dalam acara kematian sebagai tanda penghormatan dan ikatan sosial.',
            'pembuatan' => 'Pembuatan Ulos Ragi Hotang dilakukan dengan teknik tenun tradisional yang memerlukan ketelitian tinggi. Motif-motifnya dirancang secara khusus untuk melambangkan nilai-nilai budaya dan filosofi Batak, dengan pewarnaan alami dan proses yang memakan waktu lama agar menghasilkan kain yang berkualitas dan bermakna.'
                ],


                [
                'name' => 'Ulos Suri-suri Ganjang',
                'slug' => 'suri-suri-ganjang',
                'category' => 'ulos',
                'short_description' => 'Ulos Suri-suri Ganjang adalah ulos yang memiliki motif seperti sisir memanjang dan berukuran lebih panjang dari ulos biasa.',
                'image' => 'ulossurisuriganjang.jpg',
                'description' => 'Ulos Suri-suri Ganjang merupakan ulos khas Batak Toba yang memiliki ciri khas raginya berbentuk sisir memanjang dan ukuran yang lebih panjang dibanding ulos lain. Ulos ini biasanya digunakan sebagai ulos hela dalam upacara pernikahan dan juga dipakai oleh pihak hula-hula saat margondang untuk memberkati pengantin perempuan. Ulos ini melambangkan berkat, dukungan, cinta, dan doa yang diwariskan turun-temurun dalam keluarga Batak.',
                'kegunaan' => 'Digunakan sebagai ulos hela dalam pesta pernikahan, serta sebagai ulos berkat oleh orang tua pihak istri saat margondang (memukul gendang) untuk mendoakan pengantin perempuan. Ulos ini juga dapat dipakai dengan cara dililit dua kali pada bahu kiri dan kanan sehingga tampak seperti memakai dua ulos sekaligus.',
                'pembuatan' => 'Pembuatan ulos ini memerlukan ketelitian tinggi dengan teknik tenun tradisional khas Batak, menghasilkan motif garis lurus sebanyak 33 garis yang melambangkan ciri khas orang Batak yang teguh dan diwariskan turun-temurun.'
            ]
            ,



            [
            'name' => 'Ulos Ragi Huting',
            'slug' => 'ragi-huting',
            'category' => 'ulos',
            'short_description' => 'Ulos Ragi Huting adalah kain ulos tradisional Batak Toba yang dipakai oleh gadis perawan sebagai simbol status dan identitas budaya.',
            'image' => 'ulosragihuting.jpg',
            'description' => 'Ulos Ragi Huting merupakan ulos khas Batak Toba yang dulu sering dipakai oleh gadis-gadis Batak sebagai pakaian sehari-hari, dililitkan di dada (hobahoba). Ulos ini melambangkan status seorang gadis perawan yang beradat serta memiliki nilai budaya dan simbolisme yang kuat dalam masyarakat Batak. Motif dan warna ulos ini khas dengan dominasi warna coklat dan hitam yang dibuat dengan teknik tenun tangan tradisional.',
            'kegunaan' => 'Biasanya dipakai oleh gadis Batak sebagai penanda status perawan dalam adat Batak Toba. Ulos ini juga digunakan dalam berbagai upacara adat yang melibatkan kaum perempuan, menegaskan identitas dan nilai sosial budaya Batak.',
            'pembuatan' => 'Pembuatan Ulos Ragi Huting dilakukan dengan teknik tenun tangan yang memerlukan ketelitian dan keahlian khusus. Pewarnaan menggunakan bahan alami dan proses tradisional yang diwariskan secara turun-temurun oleh pengrajin Batak.'
            ],

           [
            'name' => 'Ulos Sibolang',
            'slug' => 'dibollang',
            'category' => 'ulos',
            'short_description' => 'Ulos Sibolang adalah kain ulos khas Batak Toba yang memiliki motif seperti ombak, melambangkan tantangan hidup dan kekuatan pemakainya.',
            'image' => 'Ulos Sibolang.jpg',
            'description' => 'Ulos Sibolang merupakan salah satu ulos yang paling banyak digunakan dalam adat Batak Toba. Motifnya menyerupai ombak yang menggambarkan tantangan hidup sehingga mendorong pemakainya untuk mampu melewati berbagai rintangan. Ulos ini digunakan dalam berbagai acara adat, baik sukacita maupun duka cita, sehingga sangat familiar dan serbaguna dalam masyarakat Batak.',
            'kegunaan' => 'Ulos Sibolang dipakai dalam acara adat seperti pesta pernikahan, kelahiran, maupun upacara duka cita. Dalam acara duka, ulos ini biasanya berwarna dominan hitam dan digunakan sebagai ulos saput atau ulos tujung. Sedangkan dalam acara sukacita, ulos ini sering berwarna putih dan digunakan sebagai penutup atau selendang.',
            'pembuatan' => 'Pembuatan Ulos Sibolang menggunakan teknik tenun tradisional gedogan dengan bahan katun dan pewarna sintetis. Proses tenun dilakukan secara manual oleh para pengrajin yang mewarisi keterampilan ini secara turun-temurun.'
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