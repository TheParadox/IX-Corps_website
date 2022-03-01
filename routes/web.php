<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Pages\AwardController;
use App\Http\Controllers\Pages\OobController;
use App\Http\Controllers\Pages\EngageController;
use App\Http\Controllers\Pages\RanksController;


use App\Http\Controllers\Unit\IndividualController;
use App\Http\Controllers\Unit\RegimentController;
use App\Http\Controllers\Unit\CompanyController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\Processing\MemberFormController;
use App\Http\Controllers\Processing\AwardFormController;
use App\Http\Controllers\Processing\RegimentFormController;
use App\Http\Controllers\Processing\CompanyFormController;
use App\Http\Controllers\Processing\RanksFormController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pages.landing');
})->name('home');

Route::get('/oob', [OobController::class, 'index'])->name('oob');
Route::get('/engage', [EngageController::class, 'index'])->name('engage');


Route::get('/member/{memberID}', [IndividualController::class, 'index'])->name('member');
//post version for updating
Route::get('/reg/{regimentID}', [RegimentController::class, 'index'])->name('regiment');
//post version for updating
Route::get('/comp/{companyID}', [CompanyController::class, 'index'])->name('company');
//post version for updating
Route::get('/awards', [AwardController::class, 'index'])->name('listAwards');
Route::get('/awards/{awardID}', [AwardController::class, 'specific'])->name('specificAward');

Route::get('/ranks', [RanksController::class, 'index'])->name('listRanks');
Route::get('/ranks/{rankID}', [RanksController::class, 'specific'])->name('specificRank');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'index']);

//////////////////////

Route::get('/procMember', [MemberFormController::class, 'index'])->name('newMember');
Route::post('/procMember', [MemberFormController::class, 'store']);
Route::get('/procMember/{memberID}', [MemberFormController::class, 'edit'])->name('editMember');
Route::post('/procMember/{memberID}', [MemberFormController::class, 'update']);

Route::get('/procAward', [AwardFormController::class, 'index'])->name('newAward');
Route::post('/procAward', [AwardFormController::class, 'store']);
Route::get('/procAward/{awardID}', [AwardFormController::class, 'edit'])->name('editAward');
Route::post('/procAward/{awardID}', [AwardFormController::class, 'update']);

Route::get('/procReg', [RegimentFormController::class, 'index'])->name('newRegiment');
Route::post('/procReg', [RegimentFormController::class, 'store']);
Route::get('/procReg/{regimentID}', [RegimentFormController::class, 'edit'])->name('editRegiment');
Route::post('/procReg/{regimentID}', [RegimentFormController::class, 'update']);

Route::get('/procCompany', [CompanyFormController::class, 'index'])->name('newCompany');
Route::post('/procCompany', [CompanyFormController::class, 'store']);
Route::get('/procCompany/{companyID}', [CompanyFormController::class, 'edit'])->name('editCompany');
Route::post('/procCompany/{companyID}', [CompanyFormController::class, 'update']);

Route::get('/procRank', [RanksFormController::class, 'index'])->name('newRank');
Route::post('/procRank', [RanksFormController::class, 'store']);
Route::get('/procRank/{rankID}', [RanksFormController::class, 'edit'])->name('editRank');
Route::post('/procRank/{rankID}', [RanksFormController::class, 'update']);
