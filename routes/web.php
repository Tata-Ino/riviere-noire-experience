<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ExcursionController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PlaceController as AdminPlaceController;
use App\Http\Controllers\Admin\ExcursionController as AdminExcursionController;
use App\Http\Controllers\Admin\RestaurantController as AdminRestaurantController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\ReservationController as AdminReservationController;
use App\Http\Controllers\Admin\SiteContactController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;

// Changement de langue
Route::get('/language/{locale}', [LanguageController::class, 'switch'])
    ->name('language.switch');

// Routes publiques (front-office)
Route::middleware(['locale'])->group(function () {

    // Page d'accueil
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Page à propos
    Route::get('/a-propos', function () {
        return view('pages.about');
    })->name('about');

    // Lieux / Destinations
    Route::get('/lieux', [PlaceController::class, 'index'])->name('places.index');
    Route::get('/lieux/{slug}', [PlaceController::class, 'show'])->name('places.show');

    // Excursions
    Route::get('/excursions', [ExcursionController::class, 'index'])->name('excursions.index');
    Route::get('/excursions/{slug}', [ExcursionController::class, 'show'])->name('excursions.show');

    // Galerie
    Route::get('/galerie', [GalleryController::class, 'index'])->name('gallery.index');

    // Réservation
    Route::get('/reservation', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservation', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/reservation/paiement/{id}', [ReservationController::class, 'payment'])->name('reservations.payment');
    Route::get('/reservation/confirmation/{id}', [ReservationController::class, 'confirmation'])->name('reservations.confirmation');
    Route::post('/reservation/callback', [ReservationController::class, 'callback'])->name('reservations.callback');

    // Contact
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');

    // Témoignage
    Route::post('/temoignage', [TestimonialController::class, 'store'])->name('testimonials.store');
});

// Authentification Breeze (register désactivé)
Route::middleware(['guest', 'locale'])->group(function () {
    require __DIR__.'/auth.php';
});

// Back-office (admin)
Route::middleware(['auth', 'admin', 'locale'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD Lieux
    Route::resource('places', AdminPlaceController::class)->except(['show']);

    // CRUD Excursions
    Route::resource('excursions', AdminExcursionController::class)->except(['show']);

    // CRUD Restaurant
    Route::resource('restaurant', AdminRestaurantController::class)->except(['show']);

    // Gestion des médias
    Route::post('/media/store', [MediaController::class, 'store'])->name('media.store');
    Route::delete('/media/{id}', [MediaController::class, 'destroy'])->name('media.destroy');

    // Réservations
    Route::get('reservations', [AdminReservationController::class, 'index'])->name('reservations.index');
    Route::get('reservations/{id}', [AdminReservationController::class, 'show'])->name('reservations.show');
    Route::post('reservations/{id}/status', [AdminReservationController::class, 'updateStatus'])->name('reservations.status');

    // Paramètres du site
    Route::get('settings/contact', [SiteContactController::class, 'edit'])->name('settings.contact');
    Route::put('settings/contact', [SiteContactController::class, 'update'])->name('settings.contact.update');

    // Témoignages
    Route::get('testimonials', [AdminTestimonialController::class, 'index'])->name('testimonials.index');
    Route::get('testimonials/{testimonial}', [AdminTestimonialController::class, 'show'])->name('testimonials.show');
    Route::post('testimonials/{testimonial}/toggle', [AdminTestimonialController::class, 'togglePublish'])->name('testimonials.toggle');
    Route::delete('testimonials/{testimonial}', [AdminTestimonialController::class, 'destroy'])->name('testimonials.destroy');
});
