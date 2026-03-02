<?php

namespace Database\Seeders;

use App\Models\Template;
use Illuminate\Database\Seeder;

class ElegantGoldTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $preset = '{
            "design": {
                "title": {
                    "color": "#d4af37",
                    "font": "Great Vibes"
                },
                "content": {
                    "color": "#1a1a1a",
                    "font": "Montserrat"
                },
                "button": {
                    "color": "#ffffff",
                    "background": "#d4af37"
                },
                "background": "#f8f6f0"
            },
            "cover": {
                "name": {
                    "female": "Anna",
                    "male": "Boy",
                    "size": "60",
                    "style": "normal"
                },
                "content": "We invite you to celebrate our wedding",
                "button": "Open Invitation",
                "description": {
                    "top": "The Wedding Of",
                    "bottom": "Join us for our special day",
                    "image": {
                        "method": "asset",
                        "image": ""
                    }
                }
            },
            "profile": {
                "name": {
                    "female": "Anna Smith",
                    "male": "Boy Johnson"
                },
                "parent": {
                    "show": true,
                    "female": {
                        "childhood": "First",
                        "father": "Mr. Smith",
                        "mother": "Mrs. Smith"
                    },
                    "male": {
                        "childhood": "Second",
                        "father": "Mr. Johnson",
                        "mother": "Mrs. Johnson"
                    }
                },
                "photo": {
                    "female": {
                        "method": "asset",
                        "image": ""
                    },
                    "male": {
                        "method": "asset",
                        "image": ""
                    }
                },
                "instagram": {
                    "show": false,
                    "female": "",
                    "male": ""
                }
            },
            "detail": {
                "calendar": {
                    "date": "2024-12-31",
                    "time": "10:00",
                    "save": {
                        "show": true,
                        "content": "Save the date"
                    }
                },
                "location": {
                    "address": "Grand Hotel, New York",
                    "map": "https://maps.google.com"
                },
                "additional": {
                    "show": true,
                    "closing": "Thank you for your prayers",
                    "special": []
                }
            },
            "quote": {
                "show": true,
                "content": "Love is patient, love is kind."
            },
            "music": {
                "show": false,
                "url": ""
            },
            "rsvp": {
                "title": "RSVP",
                "content": "Please confirm your attendance",
                "yes": {
                    "option": "Yes, I will attend"
                },
                "no": {
                    "option": "Sorry, I cannot attend"
                }
            },
            "wishes": {
                "public": true,
                "title": "Wishes",
                "content": "Leave a message for the couple"
            },
            "gift": {
                "show": false,
                "title": "Gift",
                "content": "",
                "bank": {
                    "option": "",
                    "code": "",
                    "name": ""
                }
            }
        }';

        Template::create([
            'title'     => 'Elegant Gold',
            'slug'      => 'elegant-gold',
            'preset'    => $preset,
            'file'      => 'template/elegant-gold/cover.jpg', // Placeholder
            'file_type' => 'image',
            'url'       => 'elegant-gold',
            'grade'     => 'premium',
            'publish'   => 'publish'
        ]);
    }
}
