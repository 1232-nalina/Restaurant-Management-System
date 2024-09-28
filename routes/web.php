<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\IndexController;
use App\Http\Controllers\Backend\ClassController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\SectionsController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Backend\AdminsController;
use App\Http\Controllers\Backend\ClientController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\DomainController;
use App\Http\Controllers\Backend\HostingCategoryController;
use App\Http\Controllers\Backend\HostingController;
use App\Http\Controllers\Backend\MenuCategoryController;
use App\Http\Controllers\Backend\MenuItemController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PaymentController;
use App\Http\Controllers\Backend\SystemSettingsController;
use App\Http\Controllers\Backend\TableController;
use App\Http\Controllers\Backend\TeamController;
use App\Http\Controllers\Backend\ReservationbookedController;
use App\Http\Controllers\ExpensesCategoryController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\IncomeCategory;
use App\Http\Controllers\LocalizationController;
use App\Models\Expenses;
use App\Models\MenuItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IngredientsController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\KitchenController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\Frontend\CartController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', [FrontendController::class, 'index'])->name('home.index');

Route::get("/", [FrontendController::class, 'index'])->name('index');
Route::get("/redirects", [FrontendController::class, 'redirects']);
Route::get('/team', [FrontendController::class, 'Team'])->name('frontend.team');
Route::get('/about', [FrontendController::class, 'About'])->name('frontend.about');
Route::post('/book', [ReservationController::class, 'index'])->name('book');
Route::get('/menu', [FrontendController::class, 'Menu'])->name('frontend.menu');
Route::post('/reservation', [ReservationController::class, 'Reservation'])->name('frontend.resrevation');
Route::get('/cart', [CartController::class, 'index'])->name('frontend.cart');
Route::get('/add-to-cart', [CartController::class, 'addtocart'])->name('frontend.addtocart');
Route::get('/checkout', [CartController::class, 'checkout'])->name('frontend.checkout');
Route::get('/thanku', [CartController::class, 'thanku'])->name('frontend.thanku');

Route::get('/dashboard', [IndexController::class, 'index'])->name('dashboard');

Auth::routes();
// login routes
Route::get('admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login/submit', [LoginController::class, 'login'])->name('admin.login.submit');

//localization routes

Route::get('locale/{lang}', [LocalizationController::class, 'setLang'])->name('set.lang');

// admin routes
Route::middleware(['auth:admin'])->group(function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);
        Route::resource('admin', AdminsController::class);
        Route::resource('income_category', IncomeCategory::class);
        Route::resource('expenses_category', ExpensesCategoryController::class);
        Route::resource('expenses', ExpensesController::class);
        Route::resource('about', AboutController::class);
        Route::resource('team', TeamController::class);
        Route::resource('contact', ContactController::class);
        Route::resource('inventories', InventoryController::class);
        Route::resource('stock', StockController::class);
        Route::post('/expenses/report', [ExpensesController::class, 'GenerateExpensesReport'])->name('expenses.report');
        Route::get('/expenses/report/view', [ExpensesController::class, 'ExpensesReportView'])->name('expenses.report.view');
        Route::get('/change-password-page', [ExpensesController::class, 'ChangePasswordPage'])->name('changepassword.page');
        Route::post('/change-password', [ExpensesController::class, 'ChangePassword'])->name('changepassword');
        Route::get('/map-admin', [AdminsController::class, 'getAllUsers'])->name('mapadmin.index');

        Route::resource('systemsetting', SystemSettingsController::class);
        Route::resource('about', AboutController::class);

        //rms routes
        Route::resource('table', TableController::class);
        Route::resource('menucategory', MenuCategoryController::class);
        Route::resource('menuitem', MenuItemController::class);
        Route::resource('menuitemingredients', IngredientsController::class);
        Route::resource('kitchen', KitchenController::class);

        Route::get('/reservation', [ReservationbookedController::class, 'index'])->name('reservation.index');

        //rms order routes
        Route::get('/order', [OrderController::class, 'index'])->name('order.take');
        Route::get('/order-view', [OrderController::class, 'ViewOrder'])->name('order.view');
        Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
        Route::post('/order/update/{id}', [OrderController::class, 'update'])->name('order.update');

        Route::get('/order/edit/{id}', [OrderController::class, 'edit'])->name('order.edit');
        Route::post('/order-item/delete', [OrderController::class, 'DeleteOrderItems'])->name('order.delete');

        Route::post('/payment/store', [PaymentController::class, 'store'])->name('payment.store');


        // logout routes
        Route::post('/logout/submit', [LoginController::class, 'logout'])->name('admin.logout.submit');
        //  Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

        //Forget Password Routes
        Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.password.reset');
        Route::post('/passwordreset/submit', [LoginController::class, 'reset'])->name('admin.password.update');
    });
});
