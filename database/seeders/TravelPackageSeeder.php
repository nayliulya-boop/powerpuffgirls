<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Package;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TravelPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create Sample Users
        $user1 = User::firstOrCreate(
            ['email' => 'pelanggan@azurevoyage.com'],
            [
                'name' => 'Nur Izzati',
                'phone' => '+60 12-345 6789',
                'address' => 'No. 18, Jalan Diplomatik, Presint 15, Putrajaya',
                'password' => Hash::make('password123'),
            ]
        );

        $user2 = User::firstOrCreate(
            ['email' => 'traveler@azurevoyage.com'],
            [
                'name' => 'Ahmad Farhan',
                'phone' => '+60 19-876 5432',
                'address' => 'No. 45, Lorong Damai, Shah Alam, Selangor',
                'password' => Hash::make('password123'),
            ]
        );

        // 2. Create Packages
        $packages = [
            // Pakej Pulau
            [
                'title' => 'Pakej Pulau Redang Crystal Snorkeling & Beachfront Resort',
                'slug' => 'pakej-pulau-redang-crystal-snorkeling',
                'category' => 'Pakej Pulau',
                'destination' => 'Pulau Redang, Terengganu',
                'duration' => '3 Hari 2 Malam',
                'price_adult' => 850.00,
                'price_child' => 450.00,
                'featured_image' => 'images/travel/maldives.jpg',
                'is_featured' => true,
                'description' => 'Nikmati keindahan pasir putih dan air laut membiru jernih di Pulau Redang. Pakej lengkap merangkumi penginapan tepi pantai bertaraf 4-bintang, 3 sesi snorkeling bersama penyu di Marine Park, dan makanan buffet penuh.',
                'itinerary' => [
                    ['day' => 1, 'title' => 'Ketibaan & Daftar Masuk', 'detail' => 'Bertolak dari Jeti Merang ke Pulau Redang dengan bot laju. Minuman selamat datang dan daftar masuk bilik. Santai di pantai pasir putih dan makan malam buffet BBQ.'],
                    ['day' => 2, 'title' => 'Eksplorasi Snorkeling Laut Dalam & Penyu', 'detail' => 'Sarapan pagi. Bertolak ke Marine Park untuk aktiviti snorkeling melihat terumbu karang dan penyu laut. Makan tengah hari di resort dan sambung snorkeling di Teluk Dalam.'],
                    ['day' => 3, 'title' => 'Matahari Terbit & Perjalanan Pulang', 'detail' => 'Menyaksikan matahari terbit di pantai, sarapan pagi dan masa lapang untuk membeli cenderahati. Daftar keluar dan bertolak pulang ke Jeti Merang.'],
                ],
                'included' => [
                    'Tiket bot laju dua hala dari Jeti Merang',
                    'Penginapan 3H2M di bilik berhawa dingin tepi pantai',
                    'Makan penuh: 2 Sarapan, 2 Makan Tengah Hari, 1 Makan Malam, 1 BBQ Dinner',
                    '3 Sesi snorkeling berserta peralatan & jaket keselamatan',
                    'Insurans perlindungan penumpang bot',
                ],
                'excluded' => [
                    'Yuran pemuliharaan Taman Laut (Marine Park Fee RM5)',
                    'Pengangkutan darat ke Jeti Merang',
                    'Perbelanjaan peribadi & sewaan kamera bawah air',
                ],
                'terms' => 'Deposit 30% diperlukan semasa tempahan. Pembatalan 14 hari sebelum tarikh perjalanan layak mendapat pemulangan 100% bayaran balik.',
            ],
            [
                'title' => 'Pakej Pulau Langkawi Luxury Cable Car & Island Hopping',
                'slug' => 'pakej-pulau-langkawi-luxury',
                'category' => 'Pakej Pulau',
                'destination' => 'Pulau Langkawi, Kedah',
                'duration' => '4 Hari 3 Malam',
                'price_adult' => 750.00,
                'price_child' => 390.00,
                'featured_image' => 'images/travel/yacht.jpg',
                'is_featured' => false,
                'description' => 'Terokai keajaiban Geopark UNESCO Langkawi dengan lawatan menaiki SkyCab Cable Car, SkyBridge, Mangrove Kilim Geoforest Safari, serta island hopping ke Tasik Dayang Bunting.',
                'itinerary' => [
                    ['day' => 1, 'title' => 'Ketibaan di Langkawi & Pantai Cenang', 'detail' => 'Pengambilan di Lapangan Terbang Langkawi / Jeti Kuah. Daftar masuk hotel 4-bintang di Pantai Cenang. Makan malam seafood segar.'],
                    ['day' => 2, 'title' => 'Island Hopping & Tasik Dayang Bunting', 'detail' => 'Aktiviti bot melawat Tasik Dayang Bunting, memberi makan burung helang di Pulau Singa Besar, dan mandi laut di Pulau Beras Basah.'],
                    ['day' => 3, 'title' => 'SkyCab, SkyBridge & Kilim Mangrove Tour', 'detail' => 'Menaiki kereta kabel SkyCab tertinggi di Gunung Machinchang. Safari bot menyusuri paya bakau Kilim Geoforest dan Gua Kelawar.'],
                    ['day' => 4, 'title' => 'Membeli-belah Bebas Cukai & Pulang', 'detail' => 'Masa bebas membeli-belah coklat dan pinggan mangkuk bebas cukai di Kuah sebelum dihantar ke airport/jeti.'],
                ],
                'included' => [
                    'Penginapan 4H3M di Resort Pantai Cenang',
                    'Kereta sewa pandu sendiri / Pengangkutan persiaran berhawa dingin',
                    'Tiket Express SkyCab & SkyBridge',
                    'Pakej bot persendirian Island Hopping & Kilim Mangrove',
                    'Sarapan harian di resort',
                ],
                'excluded' => [
                    'Tiket penerbangan / feri ke Langkawi',
                    'Makan tengah hari dan makan malam',
                ],
                'terms' => 'Pemandu kereta sewa perlu memiliki lesen memandu sah Malaysia / Antarabangsa.',
            ],
            [
                'title' => 'Pakej Pulau Maldives Overwater Villa & Lagoon Escape',
                'slug' => 'pakej-pulau-maldives-overwater-villa',
                'category' => 'Pakej Pulau',
                'destination' => 'Male, Maldives',
                'duration' => '5 Hari 4 Malam',
                'price_adult' => 4200.00,
                'price_child' => 2100.00,
                'featured_image' => 'images/travel/maldives.jpg',
                'is_featured' => true,
                'description' => "Impian syurga tropika di vila terapung atas air laut biru pirus Maldives. Pakej 'all-inclusive' lengkap dengan penerbangan hidroplan persendirian, jamuan atas kapal layar, dan urutan spa tepi laut.",
                'itinerary' => [
                    ['day' => 1, 'title' => 'Ketibaan Male & Seaplane Flight', 'detail' => 'Ketibaan di Velana International Airport Male, disambut oleh wakil AzureVoyage dan menaiki pesawat hidroplan ke resort pulau peribadi.'],
                    ['day' => 2, 'title' => 'Santai di Overwater Villa & Terumbu Karang', 'detail' => 'Turun terus dari tangga balkoni villa anda ke dalam lagun air jernih. Snorkeling dan pelayaran melihat ikan lumba-lumba.'],
                    ['day' => 3, 'title' => 'Makan Tengah Hari Bawah Air & Spa Retreat', 'detail' => 'Menikmati makan tengah hari di restoran kaca bawah laut 5 meter. Rawatan aromaterapi spa pasangan percuma.'],
                    ['day' => 4, 'title' => 'Pelayaran Kapal Layar Katamaran Matahari Terbenam', 'detail' => 'Pelayaran eksklusif menaiki katamaran sambil menikmati jamuan mocktail dan canapes.'],
                    ['day' => 5, 'title' => 'Daftar Keluar & Perjalanan Pulang', 'detail' => 'Sarapan terapung (floating breakfast) di kolam peribadi villa sebelum menaiki seaplane pulang ke Male.'],
                ],
                'included' => [
                    'Penginapan 5H4M di Luxury Overwater Villa dengan kolam renang peribadi',
                    'Pemindahan Seaplane pergi-balik dari Male Airport',
                    'Pakej All-Inclusive Makanan & Minuman Mewah (Sarapan, Makan Tengah Hari, Makan Malam)',
                    'Pelayaran katamaran matahari terbenam bersama dolphin cruise',
                    'Peralatan sukan air bukan bermotor (kayak, paddleboard, snorkel)',
                ],
                'excluded' => [
                    'Tiket penerbangan antarabangsa KUL - Male (Boleh dibantu tempah)',
                    'Tip kru resort & insurans perjalanan luar negara',
                ],
                'terms' => 'Passport sah laku sekurang-kurangnya 6 bulan diperlukan.',
            ],

            // Pakej Umrah / Haji
            [
                'title' => 'Pakej Umrah Rahmah VIP & Ziarah Madinah Makkah 12 Hari',
                'slug' => 'pakej-umrah-rahmah-vip-12-hari',
                'category' => 'Pakej Umrah/Haji',
                'destination' => 'Makkah & Madinah, Arab Saudi',
                'duration' => '12 Hari 10 Malam',
                'price_adult' => 8990.00,
                'price_child' => 6500.00,
                'featured_image' => 'images/travel/santorini.jpg',
                'is_featured' => true,
                'description' => 'Ibadah umrah yang tenang, selesa, dan dibimbing sepenuhnya oleh Mutawwif bertauliah. Hotel bertaraf 5-bintang terletak hanya 50 meter dari Masjidil Haram dan Masjid Nabawi.',
                'itinerary' => [
                    ['day' => 1, 'title' => 'Penerbangan KUL ke Madinah Munawwarah', 'detail' => 'Berkumpul di KLIA. Penerbangan terus ke Madinah. Daftar masuk hotel Madinah dan ziarah dalaman Masjid Nabawi & Raudhah.'],
                    ['day' => 2, 'title' => 'Ziarah Kota Madinah', 'detail' => 'Melawat Masjid Quba, Jabal Uhud, Masjid Qiblatain dan Ladang Kurma. Pengisian rohani oleh Mutawwif.'],
                    ['day' => 3, 'title' => 'Hari Ibadah di Masjid Nabawi', 'detail' => 'Memperbanyakkan ibadah iktikaf, solat fardu berjemaah dan ziarah Makam Rasulullah SAW.'],
                    ['day' => 4, 'title' => 'Bertolak ke Makkah Al-Mukarramah & Umrah Pertama', 'detail' => 'Memakai ihram dan berniat di Miqat Bir Ali. Menaiki kereta api laju Haramain ke Makkah. Menyempurnakan tawaf, saie, dan tahallul.'],
                    ['day' => 5, 'title' => 'Rehat & Ibadah di Masjidil Haram', 'detail' => 'Solat berjemaah menghadap Kaabah dan majlis tazkirah santai bersama mutawwif.'],
                    ['day' => 6, 'title' => 'Ziarah Makkah & Miqat Umrah Kedua', 'detail' => 'Melawat Jabal Tsur, Padang Arafah, Jabal Rahmah, Muzdalifah dan Mina. Berniat umrah kedua di Jaaranah.'],
                    ['day' => 7, 'title' => 'Ibadah Bebas di Masjidil Haram', 'detail' => 'Masa lapang untuk memperbanyakkan tawaf sunat dan doa di Hijir Ismail serta Multazam.'],
                    ['day' => 8, 'title' => 'Ziarah Hudaibiyah & Muzium Dua Masjid Suci', 'detail' => 'Lawatan sejarah ke Hudaibiyah dan peluang berniat umrah ketiga.'],
                    ['day' => 9, 'title' => 'Tawaf Wada & Perjalanan Pulang', 'detail' => 'Menyempurnakan Tawaf Wada sebelum bertolak ke Lapangan Terbang Antarabangsa Jeddah.'],
                    ['day' => 10, 'title' => 'Penerbangan Balik & Tiba di KLIA', 'detail' => 'Ketibaan di Lapangan Terbang Antarabangsa Kuala Lumpur dengan bekalan air zamzam.'],
                ],
                'included' => [
                    'Tiket penerbangan terus pergi-balik (Saudi Airlines / Malaysia Airlines)',
                    'Penginapan 5-Bintang: Movenpick Madinah & Clock Tower Makkah',
                    'Pengangkutan bas VIP berhawa dingin & tiket Bullet Train Haramain',
                    'Makan penuh 3 kali sehari sajian Melayu / Antarabangsa',
                    'Visa Umrah pelancongan & Insurans perubatan di Arab Saudi',
                    'Bimbingan Mutawwif berpengalaman & set beg pakaian eksklusif',
                    'Air Zamzam 5 liter percuma seorang',
                ],
                'excluded' => [
                    'Perbelanjaan peribadi, dobi & panggilan telefon',
                    'Dam / Badal Haji / Qurban persendirian',
                ],
                'terms' => 'Pemeriksaan kesihatan & suntikan vaksin Meningococcal ACWY diwajibkan mengikut syarat Kementerian Kesihatan Arab Saudi.',
            ],
            [
                'title' => 'Pakej Umrah Syawal Ziarah Taif Bimbingan Mutawwif',
                'slug' => 'pakej-umrah-syawal-ziarah-taif',
                'category' => 'Pakej Umrah/Haji',
                'destination' => 'Makkah, Madinah & Taif, Arab Saudi',
                'duration' => '14 Hari 12 Malam',
                'price_adult' => 9800.00,
                'price_child' => 7200.00,
                'featured_image' => 'images/travel/santorini.jpg',
                'is_featured' => false,
                'description' => 'Keberkatan sambutan hari raya di tanah suci bersama lawatan istimewa ke Kota Sejuk Taif, melawat Masjid Abdullah Ibn Abbas, kilang minyak wangi mawar ros, dan menaiki kereta kabel Taif.',
                'itinerary' => [
                    ['day' => 1, 'title' => 'Penerbangan ke Jeddah & Bertolak ke Makkah', 'detail' => 'Penerbangan terus. Ketibaan dan terus menyempurnakan ibadah Umrah pertama di Masjidil Haram.'],
                    ['day' => 2, 'title' => 'Ibadah di Masjidil Haram', 'detail' => 'Solat fardu berjemaah dan pengisian kuliah subuh.'],
                    ['day' => 3, 'title' => 'Lawatan Khas Kota Pergunungan Taif', 'detail' => 'Menaiki bas melalui laluan berbukit ke Taif. Melawat ladang bunga mawar dan merasai buah-buahan segar pergunungan.'],
                    ['day' => 4, 'title' => 'Bertolak ke Kota Madinah', 'detail' => 'Menaiki tren laju ke Madinah. Daftar masuk hotel dekat Masjid Nabawi.'],
                ],
                'included' => [
                    'Penerbangan terus kelas ekonomi',
                    'Hotel 5-Bintang jarak jalan kaki ke masjid',
                    'Lawatan penuh ke Kota Sejuk Taif berserta makan siang',
                    'Visa Umrah rasmi & sim kad data Saudi percuma',
                ],
                'excluded' => [
                    'Kelebihan bagasi penerbangan melebihi 30kg',
                ],
                'terms' => 'Slot terhad kepada 40 jemaah bagi memastikan bimbingan mutawwif yang berkualiti.',
            ],

            // Honeymoon
            [
                'title' => 'Pakej Honeymoon Santorini Caldera & Sunset Yacht Cruise',
                'slug' => 'pakej-honeymoon-santorini-caldera',
                'category' => 'Honeymoon',
                'destination' => 'Santorini, Greece',
                'duration' => '6 Hari 5 Malam',
                'price_adult' => 6500.00,
                'price_child' => 0.00,
                'featured_image' => 'images/travel/santorini.jpg',
                'is_featured' => true,
                'description' => 'Percutian bulan madu terindah di dunia dengan pemandangan kubah biru dan rumah putih di tebing Oia. Termasuk penginapan di Cave Suite dengan kolam jakuzi peribadi dan makan malam di atas kapal layar katamaran.',
                'itinerary' => [
                    ['day' => 1, 'title' => 'Ketibaan di Santorini & Oia Cliff Sunset', 'detail' => 'Pengambilan peribadi dengan kereta mewah Mercedes ke hotel Cave Suite di Oia. Menikmati matahari terbenam pertama dari balkoni peribadi.'],
                    ['day' => 2, 'title' => 'Sesi Fotografi Bulan Madu Profesional', 'detail' => 'Jurugambar profesional membawa pasangan ke sudut paling ikonik kubah biru Oia untuk sesi fotografi kenangan.'],
                    ['day' => 3, 'title' => 'Pelayaran Kapal Layar Katamaran Matahari Terbenam', 'detail' => 'Berenang di Hot Springs gunung berapi, snorkeling di Red Beach & White Beach, dan makan malam romantik Greek atas kapal.'],
                    ['day' => 4, 'title' => 'Meneroka Perkampungan Tradisional Megalochori & Fira', 'detail' => 'Kereta sewa MINI Cooper disediakan untuk pasangan meneroka kafe estetik dan galeri seni tempatan.'],
                    ['day' => 5, 'title' => 'Makan Malam Lilin Tepi Tebing Caldera', 'detail' => 'Makan malam 4-course eksklusif dengan pemandangan lampu-lampu malam tebing Santorini.'],
                    ['day' => 6, 'title' => 'Sarapan Mewah & Penerbangan Pulang', 'detail' => 'Sarapan pagi dihantar ke bilik dan dihantar ke lapangan terbang Santorini.'],
                ],
                'included' => [
                    'Penginapan 6H5M di Luxury Cliffside Cave Suite dengan kolam jakuzi luar',
                    'Sesi penggambaran profesional 2 jam (100 keping foto diedit)',
                    'Pelayaran peribadi Katamaran Sunset berserta makan malam & minuman',
                    'Kereta sewa santai sepanjang penginapan',
                    'Makan malam romantik Candlelight Dinner di restoran terkemuka',
                ],
                'excluded' => [
                    'Tiket penerbangan antarabangsa KUL - Athena - Santorini',
                    'Cukai bandar perbandaran Greece (anggaran €4 semalam)',
                ],
                'terms' => 'Khusus untuk pasangan suami isteri / pengantin baharu.',
            ],
            [
                'title' => 'Pakej Honeymoon Kundasang & Semporna Water Chalet',
                'slug' => 'pakej-honeymoon-kundasang-semporna',
                'category' => 'Honeymoon',
                'destination' => 'Sabah (Kundasang & Semporna), Malaysia',
                'duration' => '5 Hari 4 Malam',
                'price_adult' => 2800.00,
                'price_child' => 0.00,
                'featured_image' => 'images/travel/swiss_alps.jpg',
                'is_featured' => false,
                'description' => 'Gabungan udara dingin New Zealand Malaysia di Kundasang dan kejernihan air laut gred dunia di calet atas air Semporna. Pakej bulan madu tempatan paling popular!',
                'itinerary' => [
                    ['day' => 1, 'title' => 'Kota Kinabalu ke Kundasang', 'detail' => 'Tiba di KKIA, bertolak ke Kundasang melawat Jambatan Tamparuli dan Desa Dairy Farm. Penginapan chalet menghadap Gunung Kinabalu.'],
                    ['day' => 2, 'title' => 'Canopy Walk Poring & Penerbangan ke Tawau', 'detail' => 'Mandi kolam air panas Poring, balik ke KK dan terbang ke Tawau. Bermalam di Semporna.'],
                    ['day' => 3, 'title' => 'Daftar Masuk Calet Atas Air Semporna', 'detail' => 'Menaiki bot laju ke calet atas air peribadi. Snorkeling bersama hidupan laut terus dari tangga calet.'],
                    ['day' => 4, 'title' => 'Island Hopping Pulau Bohey Dulang & Sibuan', 'detail' => 'Mendaki ke puncak Bohey Dulang untuk pemandangan kawah lagun gunung berapi dan bergambar di Pulau Sibuan.'],
                    ['day' => 5, 'title' => 'Membeli Cenderahati Laut & Pulang', 'detail' => 'Membeli ikan bilis mata biru dan mutiara asli sebelum dihantar ke Lapangan Terbang Tawau.'],
                ],
                'included' => [
                    'Penginapan 1 malam di Kundasang & 3 malam di Calet Atas Air Semporna',
                    'Semua pengangkutan darat berhawa dingin & bot laju berjadual',
                    'Tiket masuk Desa Farm, Poring Hot Spring, dan permit pulau marin',
                    'Pakej makanan lengkap dan candle light dinner',
                ],
                'excluded' => [
                    'Tiket penerbangan KUL - BKI / TWU - KUL',
                    'Sewa sirip renang (fins)',
                ],
                'terms' => 'Tempahan awal 30 hari digalakkan bagi menjamin kekosongan calet atas air.',
            ],

            // Day Trip
            [
                'title' => 'Pakej Day Trip Genting SkyWorlds Theme Park & Awana SkyWay',
                'slug' => 'pakej-day-trip-genting-skyworlds',
                'category' => 'Day Trip',
                'destination' => 'Genting Highlands, Pahang',
                'duration' => '1 Hari (Pagi hingga Petang)',
                'price_adult' => 220.00,
                'price_child' => 160.00,
                'featured_image' => 'images/travel/swiss_alps.jpg',
                'is_featured' => false,
                'description' => 'Percutian sehari penuh keseronokan di taman tema pergunungan antarabangsa Genting SkyWorlds berserta tiket kereta kabel Awana SkyWay dengan lantai kaca.',
                'itinerary' => [
                    ['day' => 1, 'title' => 'Jadual Penuh Lawatan Sehari', 'detail' => '07:30 AM: Berkumpul di stesen KL Sentral. 08:30 AM: Tiba di Awana SkyWay dan menaiki kereta kabel ke Resorts World Genting. 10:00 AM: Masuk ke Genting SkyWorlds Outdoor Theme Park dan nikmati lebih 26 permainan menarik. 04:30 PM: Singgah membeli-belah di Genting Highlands Premium Outlets (GPO). 07:00 PM: Bertolak pulang ke Kuala Lumpur.'],
                ],
                'included' => [
                    'Pengangkutan bas persiaran VIP pergi-balik dari Kuala Lumpur',
                    'Tiket masuk tanpa had 1-Hari Genting SkyWorlds Outdoor Theme Park',
                    'Tiket pergi-balik Awana SkyWay Cable Car Glass Floor',
                    'Baucar makan tengah hari RM30',
                ],
                'excluded' => [
                    'Tiket Skytropolis Indoor Theme Park',
                    'Perbelanjaan membeli-belah di GPO',
                ],
                'terms' => 'Kanak-kanak bawah ketinggian 90cm masuk secara percuma.',
            ],
            [
                'title' => 'Pakej Day Trip Melaka Historical Heritage & River Cruise',
                'slug' => 'pakej-day-trip-melaka-historical-heritage',
                'category' => 'Day Trip',
                'destination' => 'Bandaraya Bersejarah Melaka',
                'duration' => '1 Hari (Pagi hingga Malam)',
                'price_adult' => 180.00,
                'price_child' => 120.00,
                'featured_image' => 'images/travel/yacht.jpg',
                'is_featured' => false,
                'description' => 'Kembara warisan sejarah dunia UNESCO Melaka. Lawati A Famosa, Stadthuys, Jonker Walk, menaiki bot Melaka River Cruise, dan mencuba makanan tradisional Baba Nyonya serta Asam Pedas Claypot.',
                'itinerary' => [
                    ['day' => 1, 'title' => 'Eksplorasi Sejarah & Santai Sungai Melaka', 'detail' => '08:00 AM: Bertolak dari KL. 10:00 AM: Melawat Bangunan Merah Stadthuys, Gereja St. Paul dan Kota A Famosa. 12:30 PM: Makan tengah hari masakan Peranakan Nyonya asli. 02:30 PM: Menaiki Melaka River Cruise menyusuri lukisan mural bersejarah. 04:30 PM: Berjalan di Jonker Street & membeli kuih Cendol Durian. 07:00 PM: Makan malam Asam Pedas Kota Laksamana sebelum pulang.'],
                ],
                'included' => [
                    'Pengangkutan bas persiaran berhawa dingin dari Kuala Lumpur pergi-balik',
                    'Pemandu pelancong berlesen mesra keluarga',
                    'Tiket menaiki Melaka River Cruise',
                    'Makan tengah hari Asam Pedas / Nyonya Authentic',
                ],
                'excluded' => [
                    'Makan malam & cenderahati persendirian',
                    'Menaiki beca berhias lampu LED (pilihan sendiri)',
                ],
                'terms' => 'Sesuai untuk semua lapisan umur dan warga emas.',
            ],
        ];

        foreach ($packages as $pkgData) {
            Package::updateOrCreate(
                ['slug' => $pkgData['slug']],
                $pkgData
            );
        }

        // 3. Create Sample Bookings for User 1
        $redangPkg = Package::where('slug', 'pakej-pulau-redang-crystal-snorkeling')->first();
        $umrahPkg = Package::where('slug', 'pakej-umrah-rahmah-vip-12-hari')->first();
        $santoriniPkg = Package::where('slug', 'pakej-honeymoon-santorini-caldera')->first();

        if ($redangPkg) {
            Booking::updateOrCreate(
                ['booking_code' => 'AZV-2026-8091'],
                [
                    'user_id' => $user1->id,
                    'package_id' => $redangPkg->id,
                    'trip_date' => now()->addDays(20)->format('Y-m-d'),
                    'adult_count' => 2,
                    'child_count' => 1,
                    'total_price' => (850.00 * 2) + 450.00,
                    'contact_name' => 'Nur Izzati',
                    'contact_email' => 'pelanggan@azurevoyage.com',
                    'contact_phone' => '+60 12-345 6789',
                    'participants' => [
                        ['name' => 'Nur Izzati', 'ic_passport' => '990512-10-5678', 'phone' => '+60 12-345 6789', 'type' => 'Dewasa'],
                        ['name' => 'Mohd Azlan', 'ic_passport' => '980315-14-6789', 'phone' => '+60 19-234 5678', 'type' => 'Dewasa'],
                        ['name' => 'Aisyah Azlan', 'ic_passport' => '201210-10-1234', 'phone' => '-', 'type' => 'Kanak-kanak'],
                    ],
                    'special_notes' => 'Sila sediakan bilik tingkat bawah untuk kemudahan anak kecil.',
                    'payment_method' => 'toyyibpay',
                    'payment_status' => 'paid',
                    'payment_receipt' => null,
                    'status' => 'Confirmed',
                ]
            );
        }

        if ($umrahPkg) {
            Booking::updateOrCreate(
                ['booking_code' => 'AZV-2026-7422'],
                [
                    'user_id' => $user1->id,
                    'package_id' => $umrahPkg->id,
                    'trip_date' => now()->addDays(60)->format('Y-m-d'),
                    'adult_count' => 2,
                    'child_count' => 0,
                    'total_price' => 8990.00 * 2,
                    'contact_name' => 'Nur Izzati',
                    'contact_email' => 'pelanggan@azurevoyage.com',
                    'contact_phone' => '+60 12-345 6789',
                    'participants' => [
                        ['name' => 'Nur Izzati', 'ic_passport' => 'A56781234', 'phone' => '+60 12-345 6789', 'type' => 'Dewasa'],
                        ['name' => 'Hajah Mariam', 'ic_passport' => 'A98765432', 'phone' => '+60 11-123 4567', 'type' => 'Dewasa'],
                    ],
                    'special_notes' => 'Kerusi roda disediakan semasa tawaf.',
                    'payment_method' => 'manual_receipt',
                    'payment_status' => 'pending',
                    'payment_receipt' => 'receipts/sample_slip.jpg',
                    'status' => 'Pending',
                ]
            );
        }

        if ($santoriniPkg) {
            Booking::updateOrCreate(
                ['booking_code' => 'AZV-2026-6105'],
                [
                    'user_id' => $user1->id,
                    'package_id' => $santoriniPkg->id,
                    'trip_date' => now()->subDays(45)->format('Y-m-d'),
                    'adult_count' => 2,
                    'child_count' => 0,
                    'total_price' => 6500.00 * 2,
                    'contact_name' => 'Nur Izzati',
                    'contact_email' => 'pelanggan@azurevoyage.com',
                    'contact_phone' => '+60 12-345 6789',
                    'participants' => [
                        ['name' => 'Nur Izzati', 'ic_passport' => 'A56781234', 'phone' => '+60 12-345 6789', 'type' => 'Dewasa'],
                        ['name' => 'Mohd Azlan', 'ic_passport' => 'A87654321', 'phone' => '+60 19-234 5678', 'type' => 'Dewasa'],
                    ],
                    'special_notes' => 'Sambutan ulang tahun perkahwinan pertama.',
                    'payment_method' => 'stripe',
                    'payment_status' => 'paid',
                    'status' => 'Completed',
                ]
            );
        }

        // 4. Create Sample Reviews
        $reviews = [
            [
                'author_name' => 'Datin Sofia & Keluarga',
                'rating' => 5,
                'trip_category' => 'Pakej Pulau',
                'review_text' => 'Pakej Pulau Redang memang luar biasa! Dari feri sampai resort, bilik berhadapan pantai sangat bersih. Pemandu pelancong sangat membantu anak-anak snorkeling dengan selamat.',
            ],
            [
                'author_name' => 'Haji Mustapha & Isteri',
                'rating' => 5,
                'trip_category' => 'Pakej Umrah/Haji',
                'review_text' => 'Alhamdulillah, pengalaman umrah bersama AzureVoyage amat memuaskan hati. Hotel Makkah Clock Tower sangat dekat dengan dataran Kaabah, tak penat untuk mak ayah yang berumur.',
            ],
            [
                'author_name' => 'Aisha & Farhan',
                'rating' => 5,
                'trip_category' => 'Honeymoon',
                'review_text' => 'Pelayaran kapal layar matahari terbenam di Santorini adalah momen paling romantik dalam hidup kami! Sesi bergambar profesional menghasilkan foto yang sangat memukau.',
            ],
            [
                'author_name' => 'Megat Radzi',
                'rating' => 5,
                'trip_category' => 'Day Trip',
                'review_text' => 'Perjalanan day trip ke Genting SkyWorlds sangat teratur. Tiket Awana Skyway dan tiket masuk sudah siap sedia, tak perlu beratur panjang langsung.',
            ],
        ];

        foreach ($reviews as $rev) {
            Review::create($rev);
        }
    }
}
