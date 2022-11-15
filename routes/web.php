<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{DashboardController, KategoriController, UserController, RoleController, KabupatenController, WisataController, KecamatanController, KelurahanController, MapsController};

Route::get('/', function () {
	return view('welcome');
});

Route::get('/maps', [MapsController::class, 'index'])->name('maps');
Route::get('/titik', [MapsController::class, 'titik'])->name('titik');
Route::get('/titik/{id}', [MapsController::class, 'titik'])->name('titik');


Route::group([
	'middleware' => 'auth',
	'prefix' => 'admin',
	'as' => 'admin.'
], function () {
	Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

	Route::get('/logs', [DashboardController::class, 'activity_logs'])->name('logs');
	Route::post('/logs/delete', [DashboardController::class, 'delete_logs'])->name('logs.delete');

	// Settings menu
	Route::view('/settings', 'admin.settings')->name('settings');
	Route::post('/settings', [DashboardController::class, 'settings_store'])->name('settings');

	// Profile menu
	Route::view('/profile', 'admin.profile')->name('profile');
	Route::post('/profile', [DashboardController::class, 'profile_update'])->name('profile');
	Route::post('/profile/upload', [DashboardController::class, 'upload_avatar'])
		->name('profile.upload');

	// Member menu
	Route::get('/member', [UserController::class, 'index'])->name('member');
	Route::get('/member/create', [UserController::class, 'create'])->name('member.create');
	Route::post('/member/create', [UserController::class, 'store'])->name('member.create');
	Route::get('/member/{id}/edit', [UserController::class, 'edit'])->name('member.edit');
	Route::post('/member/{id}/update', [UserController::class, 'update'])->name('member.update');
	Route::post('/member/{id}/delete', [UserController::class, 'destroy'])->name('member.delete');

	// Roles menu
	Route::get('/roles', [RoleController::class, 'index'])->name('roles');
	Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
	Route::post('/roles/create', [RoleController::class, 'store'])->name('roles.create');
	Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
	Route::post('/roles/{id}/update', [RoleController::class, 'update'])->name('roles.update');
	Route::post('/roles/{id}/delete', [RoleController::class, 'destroy'])->name('roles.delete');

	// kategori menu
	Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
	Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
	Route::post('/kategori/create', [KategoriController::class, 'store'])->name('kategori.create');
	Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
	Route::post('/kategori/{id}/update', [KategoriController::class, 'update'])->name('kategori.update');
	Route::post('/kategori/{id}/delete', [KategoriController::class, 'destroy'])->name('kategori.delete');

	// Daftar wisata
	Route::get('/wisata', [WisataController::class, 'index'])->name('wisata');
	Route::get('/wisata/create', [WisataController::class, 'create'])->name('wisata.create');
	Route::post('/wisata/create', [WisataController::class, 'store'])->name('wisata.create');
	Route::get('/wisata/{id}/edit', [WisataController::class, 'edit'])->name('wisata.edit');
	Route::post('/wisata/{id}/update', [WisataController::class, 'update'])->name('wisata.update');
	Route::post('/wisata/{id}/delete', [WisataController::class, 'destroy'])->name('wisata.delete');

	// kabupaten
	Route::get('/kabupaten', [KabupatenController::class, 'index'])->name('kabupaten');
	Route::get('/kabupaten/create', [KabupatenController::class, 'create'])->name('kabupaten.create');
	Route::post('/kabupaten/create', [KabupatenController::class, 'store'])->name('kabupaten.create');
	Route::get('/kabupaten/{id}/edit', [KabupatenController::class, 'edit'])->name('kabupaten.edit');
	Route::post('/kabupaten/{id}/update', [KabupatenController::class, 'update'])->name('kabupaten.update');
	Route::post('/kabupaten/{id}/delete', [KabupatenController::class, 'destroy'])->name('kabupaten.delete');

	// Kecamatan
	Route::get('/kecamatan', [KecamatanController::class, 'index'])->name('kecamatan');
	Route::get('/kecamatan/create', [KecamatanController::class, 'create'])->name('kecamatan.create');
	Route::post('/kecamatan/create', [KecamatanController::class, 'store'])->name('kecamatan.create');
	Route::get('/kecamatan/{id}/edit', [KecamatanController::class, 'edit'])->name('kecamatan.edit');
	Route::post('/kecamatan/{id}/update', [KecamatanController::class, 'update'])->name('kecamatan.update');
	Route::post('/kecamatan/{id}/delete', [KecamatanController::class, 'destroy'])->name('kecamatan.delete');

	// Kelurahan
	Route::get('/kelurahan', [kelurahanController::class, 'index'])->name('kelurahan');
	Route::get('/kelurahan/create', [KelurahanController::class, 'create'])->name('kelurahan.create');
	Route::post('/kelurahan/create', [KelurahanController::class, 'store'])->name('kelurahan.create');
	Route::get('/kelurahan/{id}/edit', [KelurahanController::class, 'edit'])->name('kelurahan.edit');
	Route::post('/kelurahan/{id}/update', [KelurahanController::class, 'update'])->name('kelurahan.update');
	Route::post('/kelurahan/{id}/delete', [KelurahanController::class, 'destroy'])->name('kelurahan.delete');
});


require __DIR__ . '/auth.php';
