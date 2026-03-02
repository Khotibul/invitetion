<?php

namespace Database\Seeders;

use App\Models\Template;
use Illuminate\Database\Seeder;

class TheWeddingTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $preset = '{
            "design": {
                "title": {
                    "color": "#bf9b73",
                    "font": "Sacramento"
                },
                "content": {
                    "color": "#828282",
                    "font": "Didact Gothic"
                },
                "button": {
                    "color": "#ffffff",
                    "background": "#bf9b73"
                },
                "background": "#ffffff"
            },
            "cover": {
                "name": {
                    "female": "Juliet",
                    "male": "Romeo",
                    "size": "60",
                    "style": "normal"
                },
                "content": "Kami berharap Anda menjadi bagian dari hari istimewa kami!",
                "button": "Buka Undangan",
                "description": {
                    "top": "The Wedding Of",
                    "bottom": "Kami Mengundang Anda Untuk Hadir Di Acara Pernikahan Kami.",
                    "image": {
                        "method": null,
                        "image": null
                    }
                }
            },
            "profile": {
                "name": {
                    "female": "Nama Mempelai Wanita",
                    "male": "Nama Mempelai Pria"
                },
                "parent": {
                    "show": true,
                    "female": {
                        "childhood": "Kedua",
                        "father": "Bapak Mempelai Wanita",
                        "mother": "Ibu Mempelai Wanita"
                    },
                    "male": {
                        "childhood": "Keempat",
                        "father": "Bapak Mempelai Pria",
                        "mother": "Ibu Mempelai Pria"
                    }
                },
                "photo": {
                    "female": {
                        "method": null,
                        "image": null
                    },
                    "male": {
                        "method": null,
                        "image": null
                    }
                },
                "instagram": {
                    "show": true,
                    "female": "instagram_wanita",
                    "male": "instagram_pria"
                }
            },
            "detail": {
                "calendar": {
                    "date": "2024-12-31",
                    "time": "09:00",
                    "save": {
                        "show": true,
                        "content": "Save the date"
                    }
                },
                "location": {
                    "address": "Lokasi Pernikahan, Kota, Provinsi",
                    "map": "https://goo.gl/maps/placeholder"
                },
                "additional": {
                    "show": true,
                    "closing": "Merupakan suatu kehormatan dan kebahagiaan bagi kami, apabila Bapak/Ibu/Saudara/i berkenan hadir dan memberikan doa restu. Atas kehadiran dan doa restunya, kami mengucapkan terima kasih.",
                    "special": []
                }
            },
            "quote": {
                "show": true,
                "content": "Dan di antara tanda-tanda kekuasaan-Nya lah Dia menciptakan untukmu istri-istri dari jenismu sendiri, supaya kamu cenderung dan merasa tenteram kepadanya, dan dijadikan-Nya diantaramu rasa kasih dan sayang. Sesungguhnya pada yang demikian itu benar-benar terdapat tanda-tanda bagi kaum yang berfikir. - Q.S Ar Rum : 21 -"
            },
            "music": {
                "show": true,
                "url": "https://ngodingsolusi.github.io/the-wedding-of-rehan-maulidan/music/Beautiful%20In%20White.mp3"
            },
            "rsvp": {
                "title": "Konfirmasi Kehadiran",
                "content": "Mohon konfirmasi kehadiran Anda",
                "yes": {
                    "option": "Hadir"
                },
                "no": {
                    "option": "Tidak Hadir"
                }
            },
            "wishes": {
                "public": true,
                "title": "Buku Tamu & Ucapan",
                "content": "Doa Restu Anda merupakan karunia yang sangat berarti bagi kami."
            },
            "gift": {
                "show": false,
                "title": "Kirim Hadiah",
                "content": "Tanpa mengurangi rasa hormat, bagi anda yang ingin memberikan tanda kasih untuk kami, dapat melalui:",
                "bank": {
                    "option": "Bank",
                    "code": "1234567890",
                    "name": "Nama Pemilik Rekening"
                }
            }
        }';

        Template::create([
            'title'     => 'The Wedding',
            'slug'      => 'the-wedding',
            'preset'    => $preset,
            'file'      => 'template/the-wedding/images/readme/half%20circle-200.png',
            'file_type' => 'image',
            'url'       => 'the-wedding',
            'grade'     => 'basic',
            'publish'   => 'publish'
        ]);
    }
}
