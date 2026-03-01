<?php

namespace Database\Seeders;

use App\Models\Template;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NewTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $templates = [
            [
                'title'     => 'Modern Elegant',
                'slug'      => 'modern-elegant',
                'preset'    => '{"design":{"title":{"color":"#2d7a4f","font":"Playfair Display"},"content":{"color":"#1d5a3f","font":"Poppins"},"button":{"color":"#ffffff","background":"#2d7a4f"},"background":"#f8faf9","template":"modern-elegant"},"cover":{"name":{"female":"Bride","male":"Groom","size":"48","style":"elegant"},"content":"We are getting married","button":"Open Invitation","description":{"top":"With joy in our hearts","bottom":"We invite you to celebrate our wedding","image":{"method":"photo","image":"couple-modern.jpg"}}},"profile":{"instagram":{"male":"groom","female":"bride","show":true},"parent":{"male":{"father":"Father","mother":"Mother","childhood":"1"},"female":{"father":"Father","mother":"Mother","childhood":"2"},"show":true},"name":{"male":"Groom Name","female":"Bride Name"},"photo":{"male":{"method":"photo","frame":"elegant","image":"groom.jpg"},"female":{"method":"photo","frame":"elegant","image":"bride.jpg"}}},"detail":{"calendar":{"save":{"content":"Save the Date","show":true},"date":"2026-12-31","time":"10:00","timezone":"wib"},"countdown":{"show":true,"style":"modern"},"location":{"address":"Wedding Venue Address","map":"https://maps.google.com/"},"additional":{"closing":"Thank you for being part of our special day","special":[],"show":true}},"quote":{"content":"Love is composed of a single soul inhabiting two bodies - Aristotle"},"music":{"title":"Wedding Song","url":"","show":true},"rsvp":{"title":"RSVP","content":"Please confirm your attendance","date":"2026-12-25","yes":{"option":"Yes, I will attend","content":"Thank you for confirming"},"no":{"option":"Sorry, I cannot attend","content":"We understand"}},"gift":{"show":true,"title":"Wedding Gift","content":"Your presence is the greatest gift","bank":{"name":"Bank Account","code":"1234567890","option":"bca"}},"wishes":{"title":"Send Wishes","content":"Thank you for your wishes","public":true}}',
                'file'      => 'modern-elegant-preview.jpg',
                'url'       => 'modern-elegant',
                'grade'     => 'premium',
                'publish'   => 'publish'
            ],
            [
                'title'     => 'Minimalist Green',
                'slug'      => 'minimalist-green',
                'preset'    => '{"design":{"title":{"color":"#6b8e6f","font":"Cormorant Garamond"},"content":{"color":"#4a5f4d","font":"Montserrat"},"button":{"color":"#ffffff","background":"#6b8e6f"},"background":"#f5f8f5","template":"minimalist-green"},"cover":{"name":{"female":"Bride","male":"Groom","size":"44","style":"minimal"},"content":"Join us as we say I do","button":"View Invitation","description":{"top":"Together with our families","bottom":"We request the honor of your presence","image":{"method":"photo","image":"couple-minimal.jpg"}}},"profile":{"instagram":{"male":"groom","female":"bride","show":true},"parent":{"male":{"father":"Father","mother":"Mother","childhood":"1"},"female":{"father":"Father","mother":"Mother","childhood":"2"},"show":true},"name":{"male":"Groom Name","female":"Bride Name"},"photo":{"male":{"method":"photo","frame":"minimal","image":"groom.jpg"},"female":{"method":"photo","frame":"minimal","image":"bride.jpg"}}},"detail":{"calendar":{"save":{"content":"Add to Calendar","show":true},"date":"2026-12-31","time":"11:00","timezone":"wib"},"countdown":{"show":true,"style":"minimal"},"location":{"address":"Garden Venue","map":"https://maps.google.com/"},"additional":{"closing":"With love and gratitude","special":[],"show":true}},"quote":{"content":"In all the world, there is no heart for me like yours"},"music":{"title":"Love Song","url":"","show":true},"rsvp":{"title":"Attendance","content":"Kindly respond by","date":"2026-12-20","yes":{"option":"Attending","content":"See you there"},"no":{"option":"Unable to attend","content":"You will be missed"}},"gift":{"show":true,"title":"Gift","content":"Your love and support mean the world","bank":{"name":"Account Name","code":"9876543210","option":"mandiri"}},"wishes":{"title":"Wishes","content":"Thank you","public":true}}',
                'file'      => 'minimalist-green-preview.jpg',
                'url'       => 'minimalist-green',
                'grade'     => 'premium',
                'publish'   => 'publish'
            ],
            [
                'title'     => 'Luxury Botanical',
                'slug'      => 'luxury-botanical',
                'preset'    => '{"design":{"title":{"color":"#1a4d2e","font":"Cinzel"},"content":{"color":"#2d5f3f","font":"Lato"},"button":{"color":"#ffffff","background":"#1a4d2e"},"background":"#faf9f6","template":"luxury-botanical"},"cover":{"name":{"female":"Bride","male":"Groom","size":"52","style":"luxury"},"content":"Celebrate with us","button":"Enter","description":{"top":"An elegant celebration of love","bottom":"Join us for an unforgettable day","image":{"method":"photo","image":"couple-luxury.jpg"}}},"profile":{"instagram":{"male":"groom","female":"bride","show":true},"parent":{"male":{"father":"Father","mother":"Mother","childhood":"1"},"female":{"father":"Father","mother":"Mother","childhood":"2"},"show":true},"name":{"male":"Groom Name","female":"Bride Name"},"photo":{"male":{"method":"photo","frame":"luxury","image":"groom.jpg"},"female":{"method":"photo","frame":"luxury","image":"bride.jpg"}}},"detail":{"calendar":{"save":{"content":"Save Date","show":true},"date":"2026-12-31","time":"14:00","timezone":"wib"},"countdown":{"show":true,"style":"luxury"},"location":{"address":"Luxury Venue","map":"https://maps.google.com/"},"additional":{"closing":"With warmest regards","special":[],"show":true}},"quote":{"content":"Two souls with but a single thought, two hearts that beat as one"},"music":{"title":"Classical Wedding","url":"","show":true},"rsvp":{"title":"Please RSVP","content":"Respond by","date":"2026-12-15","yes":{"option":"Delighted to attend","content":"Looking forward"},"no":{"option":"Regretfully decline","content":"Best wishes"}},"gift":{"show":true,"title":"Wedding Registry","content":"Your presence is present enough","bank":{"name":"Registry","code":"1122334455","option":"bni"}},"wishes":{"title":"Guest Book","content":"Thank you","public":true}}',
                'file'      => 'luxury-botanical-preview.jpg',
                'url'       => 'luxury-botanical',
                'grade'     => 'exclusive',
                'publish'   => 'publish'
            ],
            [
                'title'     => 'Romantic Garden',
                'slug'      => 'romantic-garden',
                'preset'    => '{"design":{"title":{"color":"#d4567d","font":"Alex Brush"},"content":{"color":"#6b8e6f","font":"Raleway"},"button":{"color":"#ffffff","background":"#d4567d"},"background":"#fff5f8","template":"romantic-garden"},"cover":{"name":{"female":"Bride","male":"Groom","size":"50","style":"romantic"},"content":"Love blooms here","button":"Open","description":{"top":"A garden celebration","bottom":"Join us in the garden of love","image":{"method":"photo","image":"couple-garden.jpg"}}},"profile":{"instagram":{"male":"groom","female":"bride","show":true},"parent":{"male":{"father":"Father","mother":"Mother","childhood":"1"},"female":{"father":"Father","mother":"Mother","childhood":"2"},"show":true},"name":{"male":"Groom Name","female":"Bride Name"},"photo":{"male":{"method":"photo","frame":"floral","image":"groom.jpg"},"female":{"method":"photo","frame":"floral","image":"bride.jpg"}}},"detail":{"calendar":{"save":{"content":"Remember","show":true},"date":"2026-12-31","time":"15:00","timezone":"wib"},"countdown":{"show":true,"style":"romantic"},"location":{"address":"Garden Venue","map":"https://maps.google.com/"},"additional":{"closing":"Love always","special":[],"show":true}},"quote":{"content":"Where there is love there is life - Gandhi"},"music":{"title":"Romantic Song","url":"","show":true},"rsvp":{"title":"Will you join us","content":"Please let us know","date":"2026-12-18","yes":{"option":"Yes with joy","content":"Wonderful"},"no":{"option":"Sadly no","content":"Understood"}},"gift":{"show":true,"title":"Gifts","content":"Your love is the best gift","bank":{"name":"Account","code":"5544332211","option":"bri"}},"wishes":{"title":"Messages","content":"Thanks","public":true}}',
                'file'      => 'romantic-garden-preview.jpg',
                'url'       => 'romantic-garden',
                'grade'     => 'premium',
                'publish'   => 'publish'
            ],
            [
                'title'     => 'Tropical Paradise',
                'slug'      => 'tropical-paradise',
                'preset'    => '{"design":{"title":{"color":"#00a8cc","font":"Pacifico"},"content":{"color":"#005f73","font":"Open Sans"},"button":{"color":"#ffffff","background":"#00a8cc"},"background":"#f0f8ff","template":"tropical-paradise"},"cover":{"name":{"female":"Bride","male":"Groom","size":"46","style":"beach"},"content":"Beach wedding celebration","button":"Dive In","description":{"top":"Paradise awaits","bottom":"Join us by the sea","image":{"method":"photo","image":"couple-beach.jpg"}}},"profile":{"instagram":{"male":"groom","female":"bride","show":true},"parent":{"male":{"father":"Father","mother":"Mother","childhood":"1"},"female":{"father":"Father","mother":"Mother","childhood":"2"},"show":true},"name":{"male":"Groom Name","female":"Bride Name"},"photo":{"male":{"method":"photo","frame":"tropical","image":"groom.jpg"},"female":{"method":"photo","frame":"tropical","image":"bride.jpg"}}},"detail":{"calendar":{"save":{"content":"Save","show":true},"date":"2026-12-31","time":"16:00","timezone":"wib"},"countdown":{"show":true,"style":"beach"},"location":{"address":"Beach Resort","map":"https://maps.google.com/"},"additional":{"closing":"Aloha","special":[],"show":true}},"quote":{"content":"Love is like the ocean, endless and deep"},"music":{"title":"Island Song","url":"","show":true},"rsvp":{"title":"RSVP","content":"Let us know","date":"2026-12-10","yes":{"option":"Count me in","content":"Great"},"no":{"option":"Cannot make it","content":"No worries"}},"gift":{"show":true,"title":"Gifts","content":"Your presence matters most","bank":{"name":"Account","code":"6677889900","option":"cimb"}},"wishes":{"title":"Wishes","content":"Mahalo","public":true}}',
                'file'      => 'tropical-paradise-preview.jpg',
                'url'       => 'tropical-paradise',
                'grade'     => 'premium',
                'publish'   => 'publish'
            ],
            [
                'title'     => 'Vintage Rustic',
                'slug'      => 'vintage-rustic',
                'preset'    => '{"design":{"title":{"color":"#8b6f47","font":"Crimson Text"},"content":{"color":"#5d4e37","font":"Lora"},"button":{"color":"#ffffff","background":"#8b6f47"},"background":"#f5f1e8","template":"vintage-rustic"},"cover":{"name":{"female":"Bride","male":"Groom","size":"48","style":"vintage"},"content":"A rustic celebration","button":"View","description":{"top":"Vintage charm meets modern love","bottom":"Join us for a rustic celebration","image":{"method":"photo","image":"couple-vintage.jpg"}}},"profile":{"instagram":{"male":"groom","female":"bride","show":true},"parent":{"male":{"father":"Father","mother":"Mother","childhood":"1"},"female":{"father":"Father","mother":"Mother","childhood":"2"},"show":true},"name":{"male":"Groom Name","female":"Bride Name"},"photo":{"male":{"method":"photo","frame":"vintage","image":"groom.jpg"},"female":{"method":"photo","frame":"vintage","image":"bride.jpg"}}},"detail":{"calendar":{"save":{"content":"Mark Date","show":true},"date":"2026-12-31","time":"13:00","timezone":"wib"},"countdown":{"show":true,"style":"vintage"},"location":{"address":"Barn Venue","map":"https://maps.google.com/"},"additional":{"closing":"With love","special":[],"show":true}},"quote":{"content":"Grow old with me, the best is yet to be"},"music":{"title":"Country Song","url":"","show":true},"rsvp":{"title":"Kindly RSVP","content":"Please respond","date":"2026-12-12","yes":{"option":"Will be there","content":"Perfect"},"no":{"option":"Cannot attend","content":"Thanks anyway"}},"gift":{"show":true,"title":"Registry","content":"Your love is enough","bank":{"name":"Account","code":"9988776655","option":"permata"}},"wishes":{"title":"Well Wishes","content":"Appreciated","public":true}}',
                'file'      => 'vintage-rustic-preview.jpg',
                'url'       => 'vintage-rustic',
                'grade'     => 'premium',
                'publish'   => 'publish'
            ]
        ];

        foreach ($templates as $template) {
            Template::updateOrCreate(
                ['slug' => $template['slug']],
                $template
            );
        }
    }
}
