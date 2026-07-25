<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Place;
use App\Models\PlaceTranslation;
use Illuminate\Database\Seeder;

class PlaceSeeder extends Seeder
{
    /**
     * Crée les 4 lieux principaux avec leurs traductions FR et EN.
     */
    public function run(): void
    {
        $fr = Language::where('code', 'fr')->first();
        $en = Language::where('code', 'en')->first();

        // ─── Rivière Noire d'Adjarra ────────────────────────────────
        $place1 = Place::updateOrCreate(
            ['slug' => 'riviere-noire-adjarra'],
            [
                'price' => 10000,
                'is_featured' => true,
                'status' => 'active',
            ]
        );

        PlaceTranslation::updateOrCreate(
            ['place_id' => $place1->id, 'language_id' => $fr->id],
            [
                'name' => "Rivière Noire d'Adjarra",
                'short_description' => 'Une balade en pirogue au cœur de la mangrove sacrée, entre légendes vaudoun et rencontres artisanales authentiques.',
                'description' => "La Rivière Noire serpente sur plusieurs kilomètres à travers la commune d'Adjarra, dans l'Ouémé, au milieu d'une mangrove luxuriante bordée de palmiers raphia. Bien plus qu'un simple cours d'eau, elle est depuis toujours un lieu sacré pour les communautés locales, associée à des croyances vaudoun et à des esprits protecteurs qui veillent sur ses eaux.\n\nEmbarquez à bord d'une pirogue traditionnelle pour une navigation paisible à travers les méandres de la rivière : chants d'oiseaux, reflets du soleil sur l'eau, scènes de pêche transmises de génération en génération. Une halte vous permettra de découvrir un temple vodun et les rites qui entourent ce lieu chargé de spiritualité, avant de rejoindre un atelier d'artisans où vannerie et fabrication de tambours traditionnels n'auront plus de secret pour vous.\n\nAdjarra, c'est aussi la terre du sodabi, l'alcool de palme distillé selon un savoir-faire ancestral — une dégustation qui clôture l'expérience en beauté. Une immersion rare, loin des sentiers battus, à quelques kilomètres seulement de Cotonou.\n\nPlaces limitées par embarcation — réservez votre créneau dès aujourd'hui pour vivre cette expérience au rythme de l'eau.",
            ]
        );

        PlaceTranslation::updateOrCreate(
            ['place_id' => $place1->id, 'language_id' => $en->id],
            [
                'name' => 'Adjarra Black River',
                'short_description' => 'A canoe ride through the sacred mangrove, between Vodun legends and authentic artisan encounters.',
                'description' => "The Black River winds for several kilometers through the commune of Adjarra, in the Ouémé department, through a lush mangrove bordered by raffia palms. Far more than a simple waterway, it has always been a sacred place for local communities, associated with Vodun beliefs and protective spirits watching over its waters.\n\nBoard a traditional pirogue for a peaceful navigation through the river's meanders: birdsong, sunlight reflecting on the water, fishing scenes passed down from generation to generation. A stop will allow you to discover a Vodun temple and the rites surrounding this place steeped in spirituality, before joining an artisan workshop where basketry and traditional drum making will hold no more secrets for you.\n\nAdjarra is also the land of sodabi, palm alcohol distilled according to an ancestral know-how — a tasting that closes the experience beautifully. A rare immersion, off the beaten path, just a few kilometers from Cotonou.\n\nLimited seats per boat — book your slot today to experience this journey at the pace of the water.",
            ]
        );

        // ─── Ouidah ─────────────────────────────────────────────────
        $place2 = Place::updateOrCreate(
            ['slug' => 'ouidah'],
            [
                'price' => 15000,
                'is_featured' => true,
                'status' => 'active',
            ]
        );

        PlaceTranslation::updateOrCreate(
            ['place_id' => $place2->id, 'language_id' => $fr->id],
            [
                'name' => 'Ouidah - Cité de l\'histoire',
                'short_description' => 'Plongez dans l\'histoire du commerce transatlantique, capitale spirituelle du vaudou au Bénin.',
                'description' => "Ancien port négrier parmi les plus actifs d'Afrique de l'Ouest entre le XVIIe et le XIXe siècle, Ouidah porte la mémoire de centaines de milliers de captifs déportés vers les Amériques. La Route des Esclaves, longue de 4 km, relie la place Tchacha à la Porte du Non-Retour sur la plage — un mémorial érigé en 1995 sous l'égide de l'UNESCO, jalonné de statues colorées racontant cette page douloureuse de l'histoire.\n\nMais Ouidah est aussi la capitale spirituelle du vaudou béninois. La Forêt Sacrée de Kpassè, sanctuaire aux arbres centenaires peuplé de statues de divinités, et le Temple des Pythons témoignent d'une tradition religieuse toujours vivante. Le Musée d'Histoire de Ouidah, installé dans l'ancien fort portugais, complète ce voyage entre mémoire et spiritualité.\n\nUne visite guidée à Ouidah, c'est comprendre physiquement ce que les livres d'histoire ne suffisent pas à transmettre — un lieu de recueillement autant que de découverte.\n\nRéservez votre guide francophone pour une journée complète riche en histoire et en émotion.",
            ]
        );

        PlaceTranslation::updateOrCreate(
            ['place_id' => $place2->id, 'language_id' => $en->id],
            [
                'name' => 'Ouidah - City of History',
                'short_description' => 'Dive into the history of the transatlantic trade, spiritual capital of Vodun in Benin.',
                'description' => "Among the most active slave ports in West Africa between the 17th and 19th centuries, Ouidah carries the memory of hundreds of thousands of captives deported to the Americas. The Route des Esclaves, stretching 4 km, connects Place Tchacha to the Door of No Return on the beach — a memorial erected in 1995 under the auspices of UNESCO, lined with colorful statues telling this painful chapter of history.\n\nBut Ouidah is also the spiritual capital of Beninese Vodun. The Sacred Forest of Kpassè, a sanctuary of centenarian trees populated with deity statues, and the Python Temple testify to a religious tradition still alive today. The Ouidah History Museum, housed in the former Portuguese fort, completes this journey between memory and spirituality.\n\nA guided tour of Ouidah means physically understanding what history books cannot fully convey — a place of both remembrance and discovery.\n\nBook your French-speaking guide for a full day rich in history and emotion.",
            ]
        );

        // ─── Abomey ─────────────────────────────────────────────────
        $place3 = Place::updateOrCreate(
            ['slug' => 'abomey'],
            [
                'price' => 20000,
                'is_featured' => true,
                'status' => 'active',
            ]
        );

        PlaceTranslation::updateOrCreate(
            ['place_id' => $place3->id, 'language_id' => $fr->id],
            [
                'name' => 'Abomey - Palais Royaux',
                'short_description' => 'Les splendeurs du royaume du Dahomey, classées au patrimoine mondial de l\'UNESCO depuis 1985.',
                'description' => "Fondée au XVIIe siècle par le roi Houegbadja, Abomey fut la capitale du puissant royaume du Dahomey pendant près de trois siècles, résidence de douze monarques successifs. Le site des palais royaux, classé au patrimoine mondial de l'UNESCO depuis 1985, s'étend sur 47 hectares et rassemble les palais fortifiés de chaque souverain, entourés de murailles et organisés autour de cours cérémonielles.\n\nL'élément le plus fascinant reste les bas-reliefs qui ornent les murs : de véritables chroniques visuelles où chaque motif (lion, oiseau, requin) raconte les exploits d'un roi précis. Le Musée Historique d'Abomey, installé dans les palais des rois Guézo et Glèlè, expose des trônes royaux, des autels portatifs (asin) et des objets ayant appartenu aux fameuses Agoodjié, les guerrières d'élite du royaume rebaptisées \"Amazones\" par les Européens.\n\nLe dernier roi, Béhanzin, résista à la colonisation française jusqu'en 1894 — une histoire de résistance et de grandeur qui continue de fasciner les visiteurs du monde entier.\n\nRéservez dès maintenant pour explorer ce chapitre unique de l'histoire ouest-africaine avec un guide passionné.",
            ]
        );

        PlaceTranslation::updateOrCreate(
            ['place_id' => $place3->id, 'language_id' => $en->id],
            [
                'name' => 'Abomey - Royal Palaces',
                'short_description' => 'The splendors of the Kingdom of Dahomey, UNESCO World Heritage since 1985.',
                'description' => "Founded in the 17th century by King Houegbadja, Abomey was the capital of the powerful Kingdom of Dahomey for nearly three centuries, home to twelve successive monarchs. The Royal Palaces site, classified as a UNESCO World Heritage Site since 1985, spans 47 hectares and brings together the fortified palaces of each sovereign, surrounded by walls and organized around ceremonial courtyards.\n\nThe most fascinating element remains the bas-reliefs adorning the walls: true visual chronicles where each motif (lion, bird, shark) tells the exploits of a specific king. The Abomey Historical Museum, housed in the palaces of Kings Guézo and Glèlè, displays royal thrones, portable altars (asin), and objects that belonged to the famous Agojié, the kingdom's elite warriors renamed \"Amazones\" by the Europeans.\n\nThe last king, Béhanzin, resisted French colonization until 1894 — a story of resistance and grandeur that continues to fascinate visitors from around the world.\n\nBook now to explore this unique chapter of West African history with a passionate guide.",
            ]
        );

        // ─── Porto-Novo ─────────────────────────────────────────────
        $place4 = Place::updateOrCreate(
            ['slug' => 'porto-novo'],
            [
                'price' => 20000,
                'is_featured' => true,
                'status' => 'active',
            ]
        );

        PlaceTranslation::updateOrCreate(
            ['place_id' => $place4->id, 'language_id' => $fr->id],
            [
                'name' => 'Porto-Novo - Capitale',
                'short_description' => 'Une journée immersive dans la capitale du Bénin, entre héritage royal et influence afro-brésilienne.',
                'description' => "Capitale officielle du Bénin, Porto-Novo séduit par son mélange unique d'histoire royale et d'héritage afro-brésilien. Le Musée Honmè, installé dans l'ancien palais du roi Toffa, retrace la vie des souverains du royaume de Hogbonou à travers plus de 230 objets : instruments de musique, poteries rituelles, autels portatifs et photographies de familles royales.\n\nÀ quelques rues de là, le Musée Da Silva, aménagé dans une maison de 1890 ayant appartenu à une famille afro-brésilienne, raconte le retour au Bénin des descendants d'esclaves affranchis d'Amérique latine — une histoire incarnée aussi par la Grande Mosquée de style brésilien, construite au cœur du grand marché de la ville. La Cathédrale Notre-Dame de l'Immaculée Conception et le Jardin des Plantes et de la Nature, ancienne forêt sacrée du royaume, complètent cette parenthèse verdoyante en plein centre urbain.\n\nUne ville à taille humaine, riche en récits et en surprises architecturales, à découvrir à pied au fil de ses ruelles.\n\nRéservez votre visite guidée et laissez-vous surprendre par les multiples facettes de la capitale béninoise.",
            ]
        );

        PlaceTranslation::updateOrCreate(
            ['place_id' => $place4->id, 'language_id' => $en->id],
            [
                'name' => 'Porto-Novo - Capital City',
                'short_description' => 'An immersive day in the capital of Benin, between royal heritage and Afro-Brazilian influence.',
                'description' => "The official capital of Benin, Porto-Novo delights with its unique blend of royal history and Afro-Brazilian heritage. The Honmè Museum, housed in the former palace of King Toffa, traces the life of the sovereigns of the Kingdom of Hogbonou through more than 230 objects: musical instruments, ritual pottery, portable altars, and photographs of royal families.\n\nA few streets away, the Da Silva Museum, set up in an 1890 house that belonged to an Afro-Brazilian family, tells the story of the return to Benin of descendants of slaves freed from Latin America — a history also embodied by the Grande Mosquée of Brazilian style, built in the heart of the city's grand market. The Cathédrale Notre-Dame de l'Immaculée Conception and the Jardin des Plantes et de la Nature, the kingdom's former sacred forest, complete this green parenthesis in the heart of the urban center.\n\nA human-sized city, rich in stories and architectural surprises, to be discovered on foot along its alleys.\n\nBook your guided tour and let yourself be surprised by the many facets of the Beninese capital.",
            ]
        );

        // ─── Ganvié ─────────────────────────────────────────────
        $place5 = Place::updateOrCreate(
            ['slug' => 'ganvie'],
            [
                'price' => 0,
                'is_featured' => true,
                'status' => 'active',
            ]
        );

        PlaceTranslation::updateOrCreate(
            ['place_id' => $place5->id, 'language_id' => $fr->id],
            [
                'name' => 'Ganvié - La Venise de l\'Afrique',
                'short_description' => 'Le village lacustre sur pilotis au cœur du lac Nokoué, symbole de résistance et d\'ingéniosité.',
                'description' => "Surnommée la « Venise de l'Afrique », Ganvié est née au XVIIIe siècle d'un acte de survie : fuyant les razzias esclavagistes menées par le royaume du Dahomey, le peuple Tofinu trouva refuge sur les eaux du lac Nokoué, sachant que les croyances de leurs assaillants leur interdisaient d'y pénétrer. Le nom \"Ganvié\" signifierait ainsi \"communauté sauvée\" ou \"nous avons survécu\" en langue fon.\n\nAujourd'hui, plusieurs dizaines de milliers d'habitants vivent toujours entièrement sur pilotis, dans des maisons de bois reliées par des rues d'eau bordées de jacinthes. Écoles, lieux de culte et marché flottant animent cette cité unique, où les pirogues restent le seul moyen de transport. Naviguer entre les habitations, observer les vendeuses circuler de maison en maison avec leurs marchandises, ou simplement contempler ce mode de vie façonné par l'eau depuis trois siècles : c'est une expérience qui ne ressemble à aucune autre en Afrique de l'Ouest.\n\nUne visite empreinte de respect pour un peuple qui a transformé une fuite en un art de vivre.\n\nRéservez votre traversée en pirogue vers l'un des villages lacustres les plus fascinants du continent.",
            ]
        );

        PlaceTranslation::updateOrCreate(
            ['place_id' => $place5->id, 'language_id' => $en->id],
            [
                'name' => 'Ganvié - The Venice of Africa',
                'short_description' => 'The stilted lake village on Lake Nokoué, a symbol of resistance and ingenuity.',
                'description' => "Nicknamed \"The Venice of Africa\", Ganvié was born in the 18th century from an act of survival: fleeing the slave raids conducted by the Kingdom of Dahomey, the Tofinu people found refuge on the waters of Lake Nokoué, knowing that their attackers' beliefs forbade them from setting foot there. The name \"Ganvié\" is said to mean \"saved community\" or \"we survived\" in the Fon language.\n\nToday, several tens of thousands of inhabitants still live entirely on stilts, in wooden houses connected by waterways lined with water hyacinths. Schools, places of worship, and a floating market animate this unique city, where pirogues remain the only means of transport. Navigating between homes, watching vendors move from house to house with their goods, or simply contemplating this way of life shaped by water for three centuries: it is an experience unlike any other in West Africa.\n\nA visit imbued with respect for a people who transformed a flight into an art of living.\n\nBook your pirogue crossing to one of the most fascinating lake villages on the continent.",
            ]
        );
    }
}
