<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UserProfileController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ServiceAdvantageController;
use App\Http\Controllers\Admin\ServiceFeatureController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServicePublicController;
use App\Http\Controllers\PortfolioPublicController;
use App\Http\Controllers\TeamPublicController;
use App\Http\Controllers\BlogPublicController;
use App\Http\Controllers\ContactPublicController;
use App\Http\Controllers\Admin\PortfolioController as AdminPortfolioController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\WebinarController;
use App\Http\Controllers\Admin\WebinarParticipantController;

// ===== HALAMAN PUBLIK (User) =====
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil', [HomeController::class, 'profile'])->name('profile');
Route::get('/layanan', [ServicePublicController::class, 'index'])->name('services');
Route::get('/layanan/{service:slug}', [ServicePublicController::class, 'show'])->name('services.show');
Route::get('/portofolio', [PortfolioPublicController::class, 'index'])->name('portfolios');
Route::get('/portofolio/{portfolio:slug}', [PortfolioPublicController::class, 'show'])->name('portfolios.show');
Route::get('/tim', [TeamPublicController::class, 'index'])->name('teams');
Route::get('/blog', [BlogPublicController::class, 'index'])->name('blog');
Route::get('/blog/{blogPost:slug}', [BlogPublicController::class, 'show'])->name('blog.show');
Route::get('/contact', [ContactPublicController::class, 'index'])->name('contact');
Route::post('/contact', [ContactPublicController::class, 'store'])->name('contact.store');

// ===== DASHBOARD BAWAAN BREEZE (redirect ke admin dashboard) =====
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ===== HALAMAN ADMIN =====
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('services', ServiceController::class);

    Route::prefix('services/{service}')->name('services.')->group(function () {
        Route::post('advantages', [ServiceAdvantageController::class, 'store'])->name('advantages.store');
        Route::put('advantages/{advantage}', [ServiceAdvantageController::class, 'update'])->name('advantages.update');
        Route::delete('advantages/{advantage}', [ServiceAdvantageController::class, 'destroy'])->name('advantages.destroy');

        Route::post('features', [ServiceFeatureController::class, 'store'])->name('features.store');
        Route::put('features/{feature}', [ServiceFeatureController::class, 'update'])->name('features.update');
        Route::delete('features/{feature}', [ServiceFeatureController::class, 'destroy'])->name('features.destroy');

        Route::post('complete', [ServiceController::class, 'complete'])->name('complete');
    });

    Route::resource('portfolios', PortfolioController::class);
    Route::resource('teams', TeamController::class);
    Route::resource('blog-posts', BlogPostController::class);
    Route::resource('testimonials', TestimonialController::class);
    Route::resource('contacts', ContactController::class)->only(['index', 'show', 'destroy']);

    // ===== PROFIL PERUSAHAAN (ProfileController) =====
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('profile/core-values', [ProfileController::class, 'storeCoreValue'])->name('profile.core-values.store');
    Route::put('profile/core-values/{coreValue}', [ProfileController::class, 'updateCoreValue'])->name('profile.core-values.update');
    Route::delete('profile/core-values/{coreValue}', [ProfileController::class, 'destroyCoreValue'])->name('profile.core-values.destroy');

    // ===== PROFIL SAYA / AKUN USER (UserProfileController) =====
    Route::prefix('account')->name('account.')->group(function () {
        Route::get('/', [UserProfileController::class, 'index'])->name('index');
        Route::get('/edit', [UserProfileController::class, 'edit'])->name('edit');
        Route::patch('/info', [UserProfileController::class, 'updateInfo'])->name('update-info');
        Route::post('/photo', [UserProfileController::class, 'updatePhoto'])->name('update-photo');
        Route::delete('/photo', [UserProfileController::class, 'deletePhoto'])->name('delete-photo');
        Route::put('/password', [UserProfileController::class, 'updatePassword'])->name('update-password');
    });

    Route::resource('portfolios', AdminPortfolioController::class);

    Route::get('testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');
    Route::get('testimonials/{testimonial}', [TestimonialController::class, 'show'])->name('testimonials.show');
    Route::get('testimonials/{testimonial}/edit', [TestimonialController::class, 'edit'])->name('testimonials.edit');
    Route::put('testimonials/{testimonial}', [TestimonialController::class, 'update'])->name('testimonials.update');
    Route::delete('testimonials/{testimonial}', [TestimonialController::class, 'destroy'])->name('testimonials.destroy');
    Route::resource('testimonials', AdminTestimonialController::class);

    Route::get('/pengaturan', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/pengaturan/preferences', [SettingController::class, 'updatePreferences'])->name('settings.preferences');
    Route::put('/pengaturan/password', [SettingController::class, 'updatePassword'])->name('settings.password');

    Route::resource('webinars', WebinarController::class);

    Route::prefix('webinars/{webinar}')->name('webinars.')->group(function () {
        Route::get('participants', [WebinarParticipantController::class, 'index'])->name('participants.index');
        Route::get('participants/{participant}', [WebinarParticipantController::class, 'show'])->name('participants.show');
        Route::get('participants-export', [WebinarParticipantController::class, 'export'])->name('participants.export');
    });
});

require __DIR__.'/auth.php';