<?php

namespace Database\Seeders;

use App\Models\Excursion;
use App\Models\ExcursionTranslation;
use App\Models\Language;
use App\Models\Place;
use Illuminate\Database\Seeder;

class ExcursionSeeder extends Seeder
{
    /**
     * Crée les 5 excursions liées au lieu "Rivière Noire d'Adjarra".
     */
    public function run(): void
    {
        $fr = Language::where('code', 'fr')->first();
        $en = Language::where('code', 'en')->first();

        // Récupérer le lieu Rivière Noire d'Adjarra
        $place = Place::where('slug', 'riviere-noire-adjarra')->first();

        if (! $place) {
            $this->command->error('Le lieu "riviere-noire-adjarra" est introuvable. Exécutez PlaceSeeder d\'abord.');

            return;
        }

        $excursions = [
            [
                'slug' => 'balade-en-pirogue',
                'price' => 0,
                'duration_minutes' => 120,
                'position' => 1,
                'fr_name' => 'Balade en Pirogue',
                'fr_description' => "Embarquez pour une promenade inoubliable à bord d'une pirogue traditionnelle sur les eaux sombres de la Rivière Noire. Pendant deux heures, vous glisserez entre les canaux de la mangrove, observant la faune et la flore uniques de cet écosystème. Votre guide local vous fera découvrir les secrets de la pêche traditionnelle, les plantes médicinales utilisées par les habitants et les légendes qui peuplent ces eaux mystérieuses.\n\nAu fil de la balade, vous apercevrez des crabes coureurs, des hérons, des Martins-pêcheurs et peut-être même des otaries qui fréquentent ces eaux poissonneuses. La sérénité du décor, ponctuée par le chant des oiseaux et le bruit léger des pagayes, fait de cette excursion une expérience de détente absolue.",
                'en_name' => 'Canoe Ride',
                'en_description' => "Set off on an unforgettable journey aboard a traditional canoe on the dark waters of the Black River. For two hours, you will glide through the mangrove channels, observing the unique fauna and flora of this ecosystem. Your local guide will reveal the secrets of traditional fishing, the medicinal plants used by the inhabitants, and the legends that populate these mysterious waters.\n\nAlong the way, you will spot running crabs, herons, kingfishers, and perhaps even otters that frequent these fish-rich waters. The serenity of the setting, punctuated by birdsong and the gentle sound of paddles, makes this excursion an absolute relaxation experience.",
            ],
            [
                'slug' => 'fabrication-sodabi',
                'price' => 0,
                'duration_minutes' => 90,
                'position' => 2,
                'fr_name' => 'Fabrication du Sodabi',
                'fr_description' => "Découvrez le processus ancestral de fabrication du sodabi, la boisson traditionnelle du Bénin distillée à partir du vin de palme. Au cours de cette expérience immersive, les artisans du village vous guideront à travers chaque étape de la production : la récolte de la sève de palme, la fermentation naturelle et la distillation dans des alambics artisanaux en cuivre.\n\nVous apprendrez l'importance culturelle du sodabi dans les cérémonies traditionnelles et la vie quotidienne des communautés locales. Cette visite est aussi l'occasion d'échanger avec les producteurs, de comprendre leur savoir-faire transmis de génération en génération et de déguster différentes variétés de cette boisson emblématique.\n\nL'atelier se déroule dans un cadre authentique, au cœur du village, permettant une véritable immersion dans la culture béninoise.",
                'en_name' => 'Sodabi Production',
                'en_description' => "Discover the ancestral process of making sodabi, the traditional Beninese drink distilled from palm wine. During this immersive experience, the village artisans will guide you through each step of production: palm sap harvesting, natural fermentation, and distillation in traditional copper stills.\n\nYou will learn about the cultural importance of sodabi in traditional ceremonies and the daily life of local communities. This visit is also an opportunity to exchange with the producers, understand their know-how passed down from generation to generation, and taste different varieties of this iconic drink.\n\nThe workshop takes place in an authentic setting, in the heart of the village, allowing for true immersion in Beninese culture.",
            ],
            [
                'slug' => 'atelier-vannerie',
                'price' => 0,
                'duration_minutes' => 60,
                'position' => 3,
                'fr_name' => 'Atelier de Vannerie',
                'fr_description' => "Plongez dans l'univers fascinant de la vannerie traditionnelle béninoise lors de cet atelier pratique animé par des artisans expérimentés. Vous apprendrez les techniques séculaires de tissage des fibres naturelles — raphia, paille de riz, feuilles de palmier — pour créer des paniers, des nattes et des objets du quotidien.\n\nChaque geste a un sens : le choix des fibres, les motifs traditionnels qui racontent des histoires, et les méthodes de tissage propres à chaque communauté. Les artisans vous révéleront le symbolisme des patterns et l'importance de cet artisanat dans l'économie locale.\n\nÀ la fin de l'atelier, vous repartirez avec votre propre création, un souvenir unique et authentique de votre passage à la Rivière Noire.",
                'en_name' => 'Basket Weaving Workshop',
                'en_description' => "Dive into the fascinating world of traditional Beninese basket weaving during this hands-on workshop led by experienced artisans. You will learn the centuries-old techniques of weaving natural fibers — raffia, rice straw, palm leaves — to create baskets, mats, and everyday objects.\n\nEvery gesture has meaning: the choice of fibers, the traditional patterns that tell stories, and the weaving methods specific to each community. The artisans will reveal the symbolism of patterns and the importance of this craft in the local economy.\n\nAt the end of the workshop, you will leave with your own creation, a unique and authentic souvenir of your visit to the Black River.",
            ],
            [
                'slug' => 'atelier-tambours',
                'price' => 0,
                'duration_minutes' => 60,
                'position' => 4,
                'fr_name' => 'Atelier de Tambours',
                'fr_description' => "Initiez-vous à l'art magique de la percussion traditionnelle béninoise lors de cet atelier animé par des maîtres tambourinaires. Le tambour occupe une place centrale dans la culture du Bénin : il accompagne les cérémonies vodoun, les festivals, les danses et les rituels de guérison.\n\nVous découvrirez les différents types de tambours utilisés au Bénin — l'agbadja, l'atonkin, le kplekple — et apprendrez les rythmes fondamentaux qui font danser les communautés entières. Les tambourinaires vous transmettront les techniques de frappe, les polyrythmies caractéristiques de la musique béninoise et l'art de jouer en harmonie avec le groupe.\n\nCet atelier est une explosion de rythmes et d'énergie qui vous permettra de repartir avec un nouveau regard sur la musique africaine.",
                'en_name' => 'Drum Workshop',
                'en_description' => "Discover the magical art of traditional Beninese percussion during this workshop led by master drummers. The drum holds a central place in Beninese culture: it accompanies vodoun ceremonies, festivals, dances, and healing rituals.\n\nYou will discover the different types of drums used in Benin — the agbadja, the atonkin, the kplekple — and learn the fundamental rhythms that make entire communities dance. The drummers will pass on striking techniques, the polyrhythms characteristic of Beninese music, and the art of playing in harmony with the group.\n\nThis workshop is an explosion of rhythms and energy that will give you a new perspective on African music.",
            ],
            [
                'slug' => 'observation-ornithologique',
                'price' => 0,
                'duration_minutes' => 180,
                'position' => 5,
                'fr_name' => 'Observation Ornithologique',
                'fr_description' => "Partez à la découverte de la riche avifaune de la mangrove de la Rivière Noire lors de cette excursion ornithologique de trois heures guidée par un expert local. La région abrite plus de 150 espèces d'oiseaux, dont des espèces migratrices venues d'Europe et d'Asie, faisant de ce site une destination de choix pour les observateurs d'oiseaux.\n\nArmé de jumelles et d'un carnet d'observation, vous parcourrez les zones humides, les mangroves et les berges de la rivière à la recherche des hérons pourpres, Martins-pêcheurs d'Europe, milans noirs, engoulevents et bien d'autres espèces. Le guide expert partagera ses connaissances sur le comportement, les habitudes migratoires et les enjeux de conservation de ces oiseaux.\n\nLe mieux est de partir à l'aube ou en fin de matinée pour profiter de la meilleure visibilité et observer les oiseaux dans leur activité naturelle. Une expérience qui marquera les amateurs de nature et de faune sauvage.",
                'en_name' => 'Bird Watching',
                'en_description' => "Discover the rich birdlife of the Black River mangrove during this three-hour ornithological excursion guided by a local expert. The region is home to over 150 bird species, including migratory species from Europe and Asia, making it a prime destination for birdwatchers.\n\nEquipped with binoculars and an observation notebook, you will traverse the wetlands, mangroves, and riverbanks in search of purple herons, European bee-eaters, black kites, nightjars, and many other species. The expert guide will share knowledge about the behavior, migratory habits, and conservation challenges of these birds.\n\nThe best time is early morning or late morning for optimal visibility and to observe the birds in their natural activity. An experience that will delight nature and wildlife enthusiasts.",
            ],
        ];

        foreach ($excursions as $index => $data) {
            $excursion = Excursion::updateOrCreate(
                ['slug' => $data['slug']],
                [
                    'place_id' => $place->id,
                    'price' => $data['price'],
                    'duration_minutes' => $data['duration_minutes'],
                    'status' => 'active',
                    'position' => $data['position'],
                ]
            );

            // Traduction FR
            ExcursionTranslation::updateOrCreate(
                ['excursion_id' => $excursion->id, 'language_id' => $fr->id],
                [
                    'name' => $data['fr_name'],
                    'description' => $data['fr_description'],
                ]
            );

            // Traduction EN
            ExcursionTranslation::updateOrCreate(
                ['excursion_id' => $excursion->id, 'language_id' => $en->id],
                [
                    'name' => $data['en_name'],
                    'description' => $data['en_description'],
                ]
            );
        }

        // ═══════════════════════════════════════════════════════════
        // EXCURSIONS PORTO-NOVO
        // ═══════════════════════════════════════════════════════════

        $portoNovo = Place::where('slug', 'porto-novo')->first();

        if (! $portoNovo) {
            $this->command->error('Le lieu "porto-novo" est introuvable. Exécutez PlaceSeeder d\'abord.');

            return;
        }

        $portoExcursions = [
            [
                'slug' => 'musee-honme-palais-royal',
                'price' => 0,
                'duration_minutes' => 60,
                'position' => 1,
                'fr_name' => 'Musée Honmè / Palais Royal',
                'fr_description' => "Visitez le Palais Royal restauré de Porto-Novo, un lieu chargé d'histoire abritant trônes royaux, objets sacrés et récits des anciens rois de la cité.\n\nC'est ici que vous comprendrez les racines Yoruba et Fon qui ont façonné l'identité de Porto-Novo. Le guide vous racontera l'histoire fascinante des rois du plateau et leur héritage culturel.\n\nUne immersion dans le cœur de l'histoire royale du Bénin.",
                'en_name' => 'Honmè Museum / Royal Palace',
                'en_description' => "Visit the restored Royal Palace of Porto-Novo, a place steeped in history housing royal thrones, sacred objects, and stories of the ancient kings of the city.\n\nThis is where you will understand the Yoruba and Fon roots that shaped the identity of Porto-Novo. The guide will tell you the fascinating story of the plateau kings and their cultural heritage.\n\nAn immersion into the heart of Benin's royal history.",
            ],
            [
                'slug' => 'musee-des-masques',
                'price' => 0,
                'duration_minutes' => 60,
                'position' => 2,
                'fr_name' => 'Musée des Masques',
                'fr_description' => "Découvrez la collection exceptionnelle de masques Guélédé, classés au patrimoine immatériel de l'UNESCO. Le musée présente également des statuettes, des instruments traditionnels et des objets rituels.\n\nL'exposition est super bien expliquée par des guides passionnés qui vous feront comprendre lesymbolisme de chaque masque et son rôle dans les cérémonies traditionnelles.\n\nUn rendez-vous incontournable pour comprendre l'art et la spiritualité béninoise.",
                'en_name' => 'Mask Museum',
                'en_description' => "Discover the exceptional collection of Gelede masks, listed as UNESCO intangible heritage. The museum also features statuettes, traditional instruments, and ritual objects.\n\nThe exhibition is beautifully explained by passionate guides who will help you understand the symbolism of each mask and its role in traditional ceremonies.\n\nA must-see appointment to understand Beninese art and spirituality.",
            ],
            [
                'slug' => 'quartier-afro-bresilien-musee-da-silva',
                'price' => 0,
                'duration_minutes' => 90,
                'position' => 3,
                'fr_name' => 'Quartier Afro-Brésilien + Musée da Silva',
                'fr_description' => "Promenez-vous dans les rues du « vieux Porto-Novo » et admirez les maisons colorées à deux étages avec leurs balcons en bois caractéristiques de l'architecture afro-brésilienne.\n\nLe Musée da Silva vous raconte l'histoire mouvementée des Aguda, ces anciens esclaves libérés qui sont revenus du Brésil pour s'installer dans cette ville portuaire. Le musée retrace leur parcours, leurs réussites et leur influence sur la culture locale.\n\nUne balade unique dans un patrimoine architectural méconnu.",
                'en_name' => 'Afro-Brazilian Quarter + da Silva Museum',
                'en_description' => "Walk through the streets of \"old Porto-Novo\" and admire the colorful two-story houses with wooden balconies characteristic of Afro-Brazilian architecture.\n\nThe da Silva Museum tells the eventful story of the Aguda, former slaves who returned from Brazil to settle in this port city. The museum traces their journey, their achievements, and their influence on local culture.\n\nA unique walk through an overlooked architectural heritage.",
            ],
            [
                'slug' => 'jardin-des-plantes-et-de-la-nature',
                'price' => 0,
                'duration_minutes' => 45,
                'position' => 4,
                'fr_name' => 'Jardin des Plantes et de la Nature',
                'fr_description' => "Respirez dans ce havre de paix, ancienne forêt sacrée transformée en jardin botanique. Au calme, parcourez les allées bordées de plantes médicinales, de statues et de végétaux rares.\n\nC'est un excellent spot pour souffler en milieu de journée, entre deux visites culturelles. Le jardin offre un contraste saisissant avec l'agitation de la ville.\n\nUn moment de ressourcement au cœur de la nature.",
                'en_name' => 'Botanical Garden and Nature',
                'en_description' => "Breathe in this haven of peace, an ancient sacred forest transformed into a botanical garden. Quietly walk along paths lined with medicinal plants, statues, and rare vegetation.\n\nIt's an excellent spot to take a break in the middle of the day, between cultural visits. The garden offers a striking contrast with the hustle and bustle of the city.\n\nA moment of reconnection with nature.",
            ],
            [
                'slug' => 'temple-vodoun-abessan',
                'price' => 0,
                'duration_minutes' => 60,
                'position' => 5,
                'fr_name' => 'Place Vodoun Temple Abessan',
                'fr_description' => "Plongez dans l'univers du vodoun à la Place du Temple Abessan, l'un des lieux les plus authentiques de Porto-Novo pour vivre cette spiritualité ancestrale.\n\nSi vous avez la chance de croiser une sortie de Zangbeto — le gardien de la nuit — c'est un moment véritablement fort et inoubliable. Le Zangbeto, figure centrale du vodoun, incarne la protection et la justice.\n\nUne expérience spirituelle unique au cœur de la culture béninoise.",
                'en_name' => 'Abessan Vodoun Temple',
                'en_description' => "Dive into the world of vodoun at the Abessan Temple Square, one of the most authentic places in Porto-Novo to experience this ancestral spirituality.\n\nIf you are lucky enough to witness a Zangbeto emergence — the guardian of the night — it is a truly powerful and unforgettable moment. The Zangbeto, a central figure of vodoun, embodies protection and justice.\n\nA unique spiritual experience at the heart of Beninese culture.",
            ],
        ];

        foreach ($portoExcursions as $index => $data) {
            $excursion = Excursion::updateOrCreate(
                ['slug' => $data['slug']],
                [
                    'place_id' => $portoNovo->id,
                    'price' => $data['price'],
                    'duration_minutes' => $data['duration_minutes'],
                    'status' => 'active',
                    'position' => $data['position'],
                ]
            );

            ExcursionTranslation::updateOrCreate(
                ['excursion_id' => $excursion->id, 'language_id' => $fr->id],
                [
                    'name' => $data['fr_name'],
                    'description' => $data['fr_description'],
                ]
            );

            ExcursionTranslation::updateOrCreate(
                ['excursion_id' => $excursion->id, 'language_id' => $en->id],
                [
                    'name' => $data['en_name'],
                    'description' => $data['en_description'],
                ]
            );
        }
    }
}
