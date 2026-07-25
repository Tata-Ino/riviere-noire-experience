@extends('layouts.app')

@section('title', 'À propos - Rivière Noire Experience')
@section('navbar_class', 'force-scrolled')

@section('content')

    {{-- Hero Section --}}
    <section class="position-relative d-flex align-items-center" style="min-height: 50vh; background: linear-gradient(135deg, var(--c-dark) 0%, var(--c-primary-dark) 100%);">
        <div class="container text-white text-center py-5" style="padding-top: 8rem !important;">
            <div class="row justify-content-center">
                <div class="col-lg-8 reveal">
                    <span class="section-badge" style="background:rgba(249,168,37,0.15); color:var(--c-accent); border:1px solid rgba(249,168,37,0.25);"><i class="bi bi-info-circle"></i> @if(App::getLocale() == 'en') About @elseif(App::getLocale() == 'pt') Sobre @else À propos @endif</span>
                    <h1 class="section-title mt-3 mb-3" style="color:#fff; font-size:clamp(2rem,4vw,3.5rem);">
                        @if(App::getLocale() == 'en') About the Black River
                        @elseif(App::getLocale() == 'pt') Sobre o Rio Negro
                        @else À propos de la Rivière Noire
                        @endif
                    </h1>
                    <div class="section-divider mx-auto" style="background:linear-gradient(90deg, var(--c-accent), var(--c-accent-light));"></div>
                    <p class="mt-3" style="opacity:0.8; font-size:1.1rem;">
                        @if(App::getLocale() == 'en') History, biodiversity and cultural heritage of an exceptional natural site.
                        @elseif(App::getLocale() == 'pt') História, biodiversidade e patrimônio cultural de um sítio natural excepcional.
                        @else Histoire, biodiversité et patrimoine culturel d'un site naturel exceptionnel.
                        @endif
                    </p>
                </div>
            </div>
        </div>
        <div class="position-absolute bottom-0 start-0 w-100" style="height:80px; background:linear-gradient(to top, var(--c-bg), transparent);"></div>
    </section>

    {{-- Histoire --}}
    <section class="py-5">
        <div class="container py-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <span class="badge rounded-pill px-3 py-2 mb-3" style="background-color: rgba(46, 125, 50, 0.1); color: var(--color-primary);">
                        <i class="bi bi-book me-1"></i>
                        @if(App::getLocale() == 'en') History
                        @elseif(App::getLocale() == 'pt') História
                        @else Histoire
                        @endif
                    </span>
                    <h2 class="fw-bold mb-4" style="color: var(--color-primary);">
                        @if(App::getLocale() == 'en') A Centuries-Old History
                        @elseif(App::getLocale() == 'pt') Uma História Secular
                        @else Une Histoire Séculaire
                        @endif
                    </h2>
                    <p style="line-height: 1.9;">
                        @if(App::getLocale() == 'en')
                            The Black River of Adjarra has been at the heart of local life for centuries. Named for the dark color of its waters, rich in organic matter from surrounding forests, this waterway has served as a vital transportation route, a source of livelihood for fishing communities, and a sacred site for traditional ceremonies.
                        @elseif(App::getLocale() == 'pt')
                            O Rio Negro de Adjarra está no centro da vida local há séculos. Batizado pela cor escura de suas águas, ricas em matéria orgânica das florestas circundantes, essa via aquática serviu como rota vital de transporte, fonte de sustento para comunidades de pescadores e local sagrado para cerimônias tradicionais.
                        @else
                            La Rivière Noire d'Adjarra est au cœur de la vie locale depuis des siècles. Nommée pour la couleur sombre de ses eaux, riches en matière organique provenant des forêts environnantes, cette voie d'eau a servi de route de transport vitale, de source de subsistance pour les communautés de pêcheurs et de lieu sacré pour les cérémonies traditionnelles.
                        @endif
                    </p>
                    <p style="line-height: 1.9;">
                        @if(App::getLocale() == 'en')
                            The villages along its banks have preserved ancestral know-how in boat building, fishing techniques and the management of aquatic resources. Today, the Rivière Noire continues to play a central role in the daily life of the people of Adjarra.
                        @elseif(App::getLocale() == 'pt')
                            As vilas ao longo de suas margens preservaram saberes ancestrais na construção de barcos, técnicas de pesca e gestão dos recursos aquáticos. Hoje, o Rio Negro continua desempenhando um papel central na vida diária do povo de Adjarra.
                        @else
                            Les villages le long de ses rives ont préservé des savoir-faire ancestraux en construction de pirogues, techniques de pêche et gestion des ressources aquatiques. Aujourd'hui, la Rivière Noire continue de jouer un rôle central dans la vie quotidienne des Adjarrois.
                        @endif
                    </p>
                </div>
                <div class="col-lg-6">
                    <div class="gradient-placeholder" style="min-height: 380px; border-radius: 20px; background: linear-gradient(135deg, #1565C0, #2E7D32);">
                        <i class="bi bi-historic" style="font-size: 4rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Biodiversité --}}
    <section class="py-5" style="background-color: #f0f7f0;">
        <div class="container py-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 order-lg-2">
                    <span class="badge rounded-pill px-3 py-2 mb-3" style="background-color: rgba(21, 101, 192, 0.1); color: var(--color-secondary);">
                        <i class="bi bi-tree me-1"></i>
                        @if(App::getLocale() == 'en') Biodiversity
                        @elseif(App::getLocale() == 'pt') Biodiversidade
                        @else Biodiversité
                        @endif
                    </span>
                    <h2 class="fw-bold mb-4" style="color: var(--color-secondary);">
                        @if(App::getLocale() == 'en') Exceptional Biodiversity
                        @elseif(App::getLocale() == 'pt') Biodiversidade Excepcional
                        @else Biodiversité Exceptionnelle
                        @endif
                    </h2>
                    <p style="line-height: 1.9;">
                        @if(App::getLocale() == 'en')
                            The Black River ecosystem is home to an incredible diversity of flora and fauna. Over 80 species of birds have been recorded in the area, including kingfishers, herons, and the majestic African fish eagle. The river itself is home to numerous fish species, including tilapia, catfish and the famous Nile perch.
                        @elseif(App::getLocale() == 'pt')
                            O ecossistema do Rio Negro abriga uma incrível diversidade de flora e fauna. Mais de 80 espécies de aves foram registradas na região, incluindo guardas-rios, garças e a majestosa águia-pescadora africana. O próprio rio abriga numerousas espécies de peixes, incluindo tilápia, peixe-gato e o famoso bagre do Nilo.
                        @else
                            L'écosystème de la Rivière Noire abrite une incroyable diversité de faune et de flore. Plus de 80 espèces d'oiseaux ont été recensées dans la zone, dont les martins-pêcheurs, les hérons et le majestueux pygargue vocifère. La rivière elle-même abrite de nombreuses espèces de poissons, dont la tilapia, le poisson-chat et le célèbre perche du Nil.
                        @endif
                    </p>
                    <p style="line-height: 1.9;">
                        @if(App::getLocale() == 'en')
                            The surrounding mangroves and riparian forests provide shelter for monkeys, otters, and various reptile species. The aquatic vegetation, including water lilies and papyrus, adds to the natural beauty and ecological richness of this unique site.
                        @elseif(App::getLocale() == 'pt')
                            As manguezais e florestas ribeirinhas circundantes oferecem abrigo para macacos, lontras e várias espécies de répteis. A vegetação aquática, incluindo lírios d'água e papiro, contribui para a beleza natural e riqueza ecológica desse local único.
                        @else
                            Les mangroves et forêts riveraines environnantes offrent un abri aux singes, loutres et diverses espèces de reptiles. La végétation aquatique, incluant nénuphars et papyrus, contribue à beauté naturelle et à la richesse écologique de ce site unique.
                        @endif
                    </p>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="gradient-placeholder" style="min-height: 380px; border-radius: 20px; background: linear-gradient(135deg, #2E7D32, #F9A825);">
                        <i class="bi bi-flower1" style="font-size: 4rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Importance Culturelle --}}
    <section class="py-5">
        <div class="container py-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <span class="badge rounded-pill px-3 py-2 mb-3" style="background-color: rgba(249, 168, 37, 0.15); color: #c58a00;">
                        <i class="bi bi-music-note-beamed me-1"></i>
                        @if(App::getLocale() == 'en') Cultural Heritage
                        @elseif(App::getLocale() == 'pt') Patrimônio Cultural
                        @else Patrimoine Culturel
                        @endif
                    </span>
                    <h2 class="fw-bold mb-4" style="color: var(--color-primary);">
                        @if(App::getLocale() == 'en') Cultural Significance
                        @elseif(App::getLocale() == 'pt') Importância Cultural
                        @else Importance Culturelle
                        @endif
                    </h2>
                    <p style="line-height: 1.9;">
                        @if(App::getLocale() == 'en')
                            The Rivière Noire is much more than a natural site. It is a living cultural heritage, deeply rooted in the traditions and spiritual practices of the Adjarra people. Traditional fishing ceremonies, boat blessings, and water rituals are still practiced today, keeping alive a tradition that dates back centuries.
                        @elseif(App::getLocale() == 'pt')
                            O Rio Negro é muito mais do que um sítio natural. É um patrimônio cultural vivo, profundamente enraizado nas tradições e práticas espirituais do povo de Adjarra. Cerimônias tradicionais de pesca, bênçãos de barcos e rituais aquáticos ainda são praticados hoje, mantendo viva uma tradição que remonta a séculos.
                        @else
                            La Rivière Noire est bien plus qu'un site naturel. C'est un patrimoine culturel vivant, profondément ancré dans les traditions et pratiques spirituelles du peuple Adjarra. Des cérémonies de pêche traditionnelles, des bénédictions de bateaux et des rituels aquatiques sont encore pratiqués aujourd'hui, perpétuant une tradition séculaire.
                        @endif
                    </p>
                    <p style="line-height: 1.9;">
                        @if(App::getLocale() == 'en')
                            Local artisans create beautiful crafts inspired by river motifs, while traditional musicians keep alive the rhythms and songs that have accompanied fishing trips for generations. A visit to the Rivière Noire is an immersion in living Beninese culture.
                        @elseif(App::getLocale() == 'pt')
                            Artesãos locais criam belas artesanatos inspirados nos motivos do rio, enquanto músicos tradicionais mantêm vivos os ritmos e canções que acompanharam pescarias por gerações. Uma visita ao Rio Negro é uma imersão na cultura viva do Benin.
                        @else
                            Les artisans locaux créent de beaux objets inspirés par les motifs de la rivière, tandis que les musiciens traditionnels maintiennent vivants les rythmes et chants qui ont accompagné les sorties de pêche depuis des générations. Une visite à la Rivière Noire est une immersion dans la culture béninoise vivante.
                        @endif
                    </p>
                </div>
                <div class="col-lg-6">
                    <div class="gradient-placeholder" style="min-height: 380px; border-radius: 20px; background: linear-gradient(135deg, #F9A825, #2E7D32);">
                        <i class="bi bi-masks" style="font-size: 4rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Guide Touristique --}}
    <section class="py-5" style="background-color: #f0f4f8;">
        <div class="container py-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 order-lg-2">
                    <span class="badge rounded-pill px-3 py-2 mb-3" style="background-color: rgba(46, 125, 50, 0.1); color: var(--color-primary);">
                        <i class="bi bi-person-badge me-1"></i>
                        @if(App::getLocale() == 'en') Your Guide
                        @elseif(App::getLocale() == 'pt') Seu Guia
                        @else Votre Guide
                        @endif
                    </span>
                    <h2 class="fw-bold mb-4" style="color: var(--color-primary);">
                        @if(App::getLocale() == 'en') Meet Your Tourist Guide
                        @elseif(App::getLocale() == 'pt') Conheça Seu Guia Turístico
                        @else Découvrez votre Guide Touristique
                        @endif
                    </h2>
                    <p style="line-height: 1.9;">
                        @if(App::getLocale() == 'en')
                            Passionate about the nature and culture of Benin, your guide has been leading visitors along the Black River for over 10 years. Initiated in local traditions and holder of a diploma in eco-tourism, he will share with you the hidden secrets of this exceptional region.
                        @elseif(App::getLocale() == 'pt')
                            Apaixonado pela natureza e cultura do Benin, seu guia conduz visitantes ao longo do Rio Negro há mais de 10 anos. Iniciado nas tradições locais e portador de diploma em ecoturismo, ele compartilhará com você os segredos ocultos desta região excepcional.
                        @else
                            Passionné par la nature et la culture du Bénin, votre guide accompagne les visiteurs le long de la Rivière Noire depuis plus de 10 ans. Initié aux traditions locales et titulaire d'un diplôme en éco-tourisme, il vous dévoilera les secrets cachés de cette région exceptionnelle.
                        @endif
                    </p>
                    <div class="row g-3 mt-4">
                        <div class="col-6">
                            <div class="d-flex align-items-center gap-3 p-3 rounded-3" style="background: rgba(46, 125, 50, 0.06);">
                                <i class="bi bi-translate fs-4" style="color: var(--color-primary);"></i>
                                <div>
                                    <div class="fw-bold">Français, English, Port.</div>
                                    <small class="text-muted">
                                        @if(App::getLocale() == 'en') Languages
                                        @elseif(App::getLocale() == 'pt') Idiomas
                                        @else Langues
                                        @endif
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center gap-3 p-3 rounded-3" style="background: rgba(21, 101, 192, 0.06);">
                                <i class="bi bi-award fs-4" style="color: var(--color-secondary);"></i>
                                <div>
                                    <div class="fw-bold">10+ ans</div>
                                    <small class="text-muted">
                                        @if(App::getLocale() == 'en') Experience
                                        @elseif(App::getLocale() == 'pt') Experiência
                                        @else Expérience
                                        @endif
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center gap-3 p-3 rounded-3" style="background: rgba(249, 168, 37, 0.1);">
                                <i class="bi bi-people fs-4" style="color: var(--color-accent-dark);"></i>
                                <div>
                                    <div class="fw-bold">5 000+</div>
                                    <small class="text-muted">
                                        @if(App::getLocale() == 'en') Visitors guided
                                        @elseif(App::getLocale() == 'pt') Visitantes guiados
                                        @else Visiteurs guidés
                                        @endif
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center gap-3 p-3 rounded-3" style="background: rgba(46, 125, 50, 0.06);">
                                <i class="bi bi-shield-check fs-4" style="color: var(--color-primary);"></i>
                                <div>
                                    <div class="fw-bold">Certifié</div>
                                    <small class="text-muted">
                                        @if(App::getLocale() == 'en') Eco-tourism diploma
                                        @elseif(App::getLocale() == 'pt') Diploma em ecoturismo
                                        @else Diplôme éco-tourisme
                                        @endif
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="position-relative">
                        <div class="gradient-placeholder" style="min-height: 420px; border-radius: 20px; background: linear-gradient(135deg, var(--color-primary), var(--color-accent));">
                            <div class="text-center">
                                <i class="bi bi-person-badge" style="font-size: 5rem;"></i>
                                <p class="mt-3 fw-bold" style="color: rgba(255,255,255,0.8); font-size: 1.1rem;">Guide Certifié</p>
                            </div>
                        </div>
                        <div class="position-absolute" style="bottom: -20px; right: -20px; background: var(--color-accent); color: #1a1a1a; padding: 1rem 1.5rem; border-radius: 12px; font-weight: 700; box-shadow: 0 4px 15px rgba(249, 168, 37, 0.4);">
                            <i class="bi bi-star-fill me-1"></i> 4.9/5
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Mission --}}
    <section class="py-5" style="background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));">
        <div class="container py-5 text-center">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h2 class="display-5 fw-bold mb-4" style="color: #000;">
                        @if(App::getLocale() == 'en') Our Mission
                        @elseif(App::getLocale() == 'pt') Nossa Missão
                        @else Notre Mission
                        @endif
                    </h2>
                    <p class="lead" style="color: #000; line-height: 1.8;">
                        @if(App::getLocale() == 'en')
                            We are committed to promoting sustainable tourism that respects the environment and local communities. Our goal is to share the beauty and cultural richness of the Rivière Noire while contributing to its preservation for future generations.
                        @elseif(App::getLocale() == 'pt')
                            Estamos comprometidos em promover o turismo sustentável que respeita o meio ambiente e as comunidades locais. Nosso objetivo é compartilhar a beleza e a riqueza cultural do Rio Negro, contribuindo para sua preservação para as futuras gerações.
                        @else
                            Nous nous engageons à promouvoir un tourisme respectueux de l'environnement et des communautés locales. Notre objectif est de partager la beauté et la richesse culturelle de la Rivière Noire tout en contribuant à sa préservation pour les générations futures.
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </section>

@endsection
