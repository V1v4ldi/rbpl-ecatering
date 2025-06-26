<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\product as ProductModels;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class product extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductModels::insert([
           ['nama' => 'Acar', 
           'harga' => 5000, 
           'Deskripsi' => 'Sensasi segar dan renyah dari Acar spesial kami. Rasa asam, manis, dan sedikit pedas berpadu sempurna, membangkitkan selera makan Anda.', 
            'image_url' => 'https://res.cloudinary.com/darloizya/image/upload/v1750963434/Acar_if5pah.jpg',
            'public_id' => 'Acar_if5pah',
           'created_at' => NOW(),
            'updated_at' => NOW(),],
           ['nama' => 'Ayam Bakar', 
           'harga' => 5000, 
           'Deskripsi' => '', 
            'image_url' => 'https://res.cloudinary.com/darloizya/image/upload/v1750963442/Ayam_Bakar_i0t0u4.jpg',
            'public_id' => 'Ayam_Bakar_i0t0u4',
           'created_at' => NOW(),
            'updated_at' => NOW(),],
           ['nama' => 'Ayam Balado', 
           'harga' => 5000, 
           'Deskripsi' => 'Pedasnya nampol, lezatnya bikin nagih! Ayam Balado dengan bumbu merah meresap sempurna, cocok untuk Anda pecinta pedas.', 
            'image_url' => 'https://res.cloudinary.com/darloizya/image/upload/v1750963436/Ayam_Balado_fsvckm.jpg',
            'public_id' => 'Ayam_Balado_fsvckm',
            'created_at' => NOW(),
            'updated_at' => NOW(),],
            ['nama' => 'Ayam Kecap', 
            'harga' => 5000, 
            'Deskripsi' => 'Sajian klasik Ayam Kecap dengan rasa manis gurih yang medok. Cocok untuk semua lidah, terutama bagi Anda yang suka cita rasa autentik.', 
            'image_url' => 'https://res.cloudinary.com/darloizya/image/upload/v1750963435/Ayam_Kecap_raodjf.jpg',
            'public_id' => 'Ayam_Kecap_raodjf',
            'created_at' => NOW(),
            'updated_at' => NOW(),],
           ['nama' => 'Capcay', 
           'harga' => 5000, 
           'Deskripsi' => 'Capcay segar penuh nutrisi! Beragam sayuran pilihan dimasak dengan saus gurih yang lezat, pilihan sehat yang tetap nikmat.', 
            'image_url' => 'https://res.cloudinary.com/darloizya/image/upload/v1750963434/Capcay_geav17.jpg',
            'public_id' => 'Capcay_geav17',
           'created_at' => NOW(),
            'updated_at' => NOW(),],
           ['nama' => 'Kentang Balado', 
           'harga' => 5000, 
           'Deskripsi' => 'Camilan sekaligus lauk yang pas! Kentang Balado dengan bumbu balado khas yang pedas, manis, dan sedikit gurih. Nikmat disajikan bersama nasi.', 
            'image_url' => 'https://res.cloudinary.com/darloizya/image/upload/v1750963447/Kentang_Balado_qm91zf.jpg',
            'public_id' => 'Kentang_Balado_qm91zf',
           'created_at' => NOW(),
            'updated_at' => NOW(),],
           ['nama' => 'Mie Kuning', 
           'harga' => 5000, 
           'Deskripsi' => 'Kelezatan Mie Kuning goreng yang praktis dan mengenyangkan! Kombinasi mie dengan bumbu khas dan topping lezat untuk sajian lengkap.', 
            'image_url' => 'https://res.cloudinary.com/darloizya/image/upload/v1750963435/Mie_Kuning_xpdrpe.jpg',
            'public_id' => 'Mie_Kuning_xpdrpe',
           'created_at' => NOW(),
            'updated_at' => NOW(),],
           ['nama' => 'Rendang', 
           'harga' => 5000, 
           'Deskripsi' => 'Mahakarya kuliner Rendang! Daging sapi empuk dimasak perlahan dengan rempah pilihan hingga bumbu meresap sempurna. Kelezatan yang tak terlupakan.', 
            'image_url' => 'https://res.cloudinary.com/darloizya/image/upload/v1750963444/Rendang_kzky2z.jpg',
            'public_id' => 'Rendang_kzky2z',
           'created_at' => NOW(),
            'updated_at' => NOW(),],
           ['nama' => 'Sayur Lodeh', 
           'harga' => 5000, 
           'Deskripsi' => 'Lodeh creamy dan kaya rasa! Sajian sayuran komplit dalam kuah santan gurih yang pas di lidah, hidangan tradisional yang selalu dirindukan.', 
            'image_url' => 'https://res.cloudinary.com/darloizya/image/upload/v1750963434/Sayur_Lodeh_wrtuj2.jpg',
            'public_id' => 'Sayur_Lodeh_wrtuj2',
           'created_at' => NOW(),
            'updated_at' => NOW(),],
           ['nama' => 'Sayur Asem', 
           'harga' => 5000, 
           'Deskripsi' => 'Segarnya Sayur Asem yang bikin ketagihan! Paduan sayuran dan bumbu asem segar yang nikmat, cocok sebagai teman nasi hangat.', 
            'image_url' => 'https://res.cloudinary.com/darloizya/image/upload/v1750963435/Sayur_Asem_ef5imf.jpg',
            'public_id' => 'Sayur_Asem_ef5imf',
           'created_at' => NOW(),
            'updated_at' => NOW(),],
        ]);
    }
}
