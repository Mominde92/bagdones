<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\HomeController;
use Auth;
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

Route::get('ecommerce', [FrontendController::class, 'index']);


Route::get('privacy-policy', [PrivacyController::class, 'index']);
Route::get('terms-condition ', [PrivacyController::class, 'terms']);
Route::get('about-us', [AboutController::class, 'index']);

Auth::routes();
Route::post("/login",[UserController::class,'login']);
 Route::get("/login",[UserController::class,'index'])->name('login');

Route::group(['middleware' => 'auth'], function()
{
Route::get('/', 'PagesController@index');

// Demo routes
Route::get('/datatables', 'PagesController@datatables');
Route::get('/ktdatatables', 'PagesController@ktDatatables');
Route::get('/select2', 'PagesController@select2');
Route::get('/jquerymask', 'PagesController@jQueryMask');
Route::get('/icons/custom-icons', 'PagesController@customIcons');
Route::get('/icons/flaticon', 'PagesController@flaticon');
Route::get('/icons/fontawesome', 'PagesController@fontawesome');
Route::get('/icons/lineawesome', 'PagesController@lineawesome');
Route::get('/icons/socicons', 'PagesController@socicons');
Route::get('/icons/svg', 'PagesController@svg');

// Quick search dummy route to display html elements in search dropdown (header search)
Route::get('/quick-search', 'PagesController@quickSearch')->name('quick-search');

 //Country Routes
Route::get('country', [CountryController::class, 'index'])->name('country.index');
Route::get('country/create', [CountryController::class, 'create'])->name('country.create');
Route::post('country', [CountryController::class, 'store'])->name('country.store');
Route::get('country/{country}', [CountryController::class, 'show'])->name('country.show');
Route::get('country/edit/{country}', [CountryController::class, 'edit'])->name('country.edit');
Route::put('country/{country}', [CountryController::class, 'update'])->name('country.update');
Route::post('country/{country}', [CountryController::class, 'destroy'])->name('country.destroy');

//State Routes
Route::get('state', [StateController::class, 'index'])->name('state.index');
Route::get('state/create', [StateController::class, 'create'])->name('state.create');
Route::post('state', [StateController::class, 'store'])->name('state.store');
Route::get('state/{state}', [StateController::class, 'show'])->name('state.show');
Route::get('state/edit/{state}', [StateController::class, 'edit'])->name('state.edit');
Route::put('state/{state}', [StateController::class, 'update'])->name('state.update');
Route::post('state/{state}', [StateController::class, 'destroy'])->name('state.destroy');
// Route::post('/dataAjax', [StateController::class, 'dataAjax'])->name('dataAjax');

//City Routes
Route::get('city', [CityController::class, 'index'])->name('city.index');
Route::get('city/create', [CityController::class, 'create'])->name('city.create');
Route::post('city', [CityController::class, 'store'])->name('city.store');
Route::get('city/{city}', [CityController::class, 'show'])->name('city.show');
Route::get('city/edit/{city}', [CityController::class, 'edit'])->name('city.edit');
Route::put('city/{city}', [CityController::class, 'update'])->name('city.update');
Route::post('city/{city}', [CityController::class, 'destroy'])->name('city.destroy');
Route::post('city/dataAjax', [CityController::class, 'dataAjax'])->name('city.dataAjax');
Route::post('/dataAjax', [CityController::class, 'dataAjax'])->name('dataAjax');


//Area Routes
Route::get('area', [AreaController::class, 'index'])->name('area.index');
Route::get('area/create', [AreaController::class, 'create'])->name('area.create');
Route::post('area', [AreaController::class, 'store'])->name('area.store');
Route::get('area/{area}', [AreaController::class, 'show'])->name('area.show');
Route::get('area/edit/{area}', [AreaController::class, 'edit'])->name('area.edit');
Route::put('area/{area}', [AreaController::class, 'update'])->name('area.update');
Route::post('area/{area}', [AreaController::class, 'destroy'])->name('area.destroy');



//Language Routes
Route::get('language', [LanguageController::class, 'index'])->name('language.index');
Route::get('language/create', [LanguageController::class, 'create'])->name('language.create');
Route::post('language', [LanguageController::class, 'store'])->name('language.store');
Route::get('language/{language}', [LanguageController::class, 'show'])->name('language.show');
Route::get('language/edit/{language}', [LanguageController::class, 'edit'])->name('language.edit');
Route::put('language/{language}', [LanguageController::class, 'update'])->name('language.update');
Route::post('language/{language}', [LanguageController::class, 'destroy'])->name('language.destroy');



//Category Routes
Route::get('category', [CategoryController::class, 'index']);
Route::get('category/create', [CategoryController::class, 'create']);
Route::post('category/store', [CategoryController::class, 'store']);
Route::get('category/{category}', [CategoryController::class, 'show']);
Route::get('category/edit/{category}', [CategoryController::class, 'edit']);
Route::put('category/update/{category}', [CategoryController::class, 'update']);//
Route::post('category/{category}', [CategoryController::class, 'destroy']);
Route::post('category/dataAjax', [CategoryController::class, 'dataAjax']);
// Route::post('category/test', [CategoryController::class, 'test']);
Route::get('category/dumpsql', [CategoryController::class, 'mysqldump']);
//subCategory Routes
Route::get('subCategory', [SubCategoryController::class, 'index'])->name('subCategory.index');
Route::get('subCategory/create', [SubCategoryController::class, 'create']);
Route::post('subCategory/store', [SubCategoryController::class, 'store'])->name('subCategory.store');
Route::get('subCategory/{category}', [SubCategoryController::class, 'show']);
Route::get('subCategory/edit/{category}', [SubCategoryController::class, 'edit']);
Route::put('subCategory/update/{category}', [SubCategoryController::class, 'update']);
Route::post('subCategory/delete', [SubCategoryController::class, 'destroy']);
// Route::post('category/dataAjax', [CategoryController::class, 'dataAjax']);
// Route::post('category/test', [CategoryController::class, 'test']);

// Route::post('/dataAjax', [CategoryController::class, 'dataAjax'])->name('dataAjax');


//content_type Routes
Route::get('content_type', [ContentTypeController::class, 'index']);
Route::get('content_type/create', [ContentTypeController::class, 'create']);
Route::post('content_type', [ContentTypeController::class, 'store']);
Route::get('content_type/{content_type}', [ContentTypeController::class, 'show']);
Route::get('content_type/edit/{content_type}', [ContentTypeController::class, 'edit']);
Route::put('content_type/update/{content_type}', [ContentTypeController::class, 'update']);
Route::post('content_type/destroy/{content_type}', [ContentTypeController::class, 'destroy']);

//appearance Routes
Route::get('appearance', [AppearanceController::class, 'index']);
Route::get('appearance/create', [AppearanceController::class, 'create']);
Route::post('appearance', [AppearanceController::class, 'store']);
Route::get('appearance/{appearance}', [AppearanceController::class, 'show']);
Route::get('appearance/edit/{apperance}', [AppearanceController::class, 'edit']);
Route::put('appearance/update/{appearance}', [AppearanceController::class, 'update']);
Route::post('appearance/destroy/{appearance}', [AppearanceController::class, 'destroy']);


//Home Routes
Route::get('home', [HomeController::class, 'index']);
Route::get('home/create', [HomeController::class, 'create']);
Route::post('home', [HomeController::class, 'store']);
Route::get('home/{home}', [HomeController::class, 'show']);
Route::get('home/edit/{home}', [HomeController::class, 'edit']);
Route::put('home/update/{home}', [HomeController::class, 'update']);
Route::post('home/delete', [HomeController::class, 'destroy']);


//Store Routes
Route::get('store', [StoreController::class, 'index']);
Route::get('store/create', [StoreController::class, 'create']);
Route::post('store', [StoreController::class, 'store']);
Route::get('store/{store}', [StoreController::class, 'show']);
Route::get('store/edit/{store}', [StoreController::class, 'edit']);
Route::put('store/update/{store}', [StoreController::class, 'update']);
Route::post('store/delete', [StoreController::class, 'destroy']);

Route::get('items', [ItemController::class, 'index']);
Route::get('items/create', [ItemController::class, 'create']);
Route::post('items', [ItemController::class, 'store']);
Route::get('items/edit/{item}', [ItemController::class, 'edit']);
Route::put('items/update/{item}', [ItemController::class, 'update']);
Route::post('items/delete', [ItemController::class, 'destroy']);

Route::post('delete_image', [ItemController::class, 'delete_image']);


Route::get('Itemimage/{id}', [ItemimageController::class, 'index']);
Route::get('Itemimage/datatable/{id}', [ItemimageController::class, 'DataTable']);

Route::get('Itemimage/create', [ItemimageController::class, 'create']);
Route::post('Itemimage', [ItemimageController::class, 'store']);
Route::post('Itemimage/delete', [ItemimageController::class, 'destroy']);

//Attributes Routes
Route::get('attribute', [AttributeController::class, 'index']);
Route::get('attribute/create', [AttributeController::class, 'create']);
Route::post('attribute', [AttributeController::class, 'store']);
Route::get('attribute/{attribute}', [AttributeController::class, 'show']);
Route::get('attribute/edit/{attribute}', [AttributeController::class, 'edit']);
Route::put('attribute/update/{attribute}', [AttributeController::class, 'update']);
Route::post('attribute/delete', [AttributeController::class, 'destroy']);

//compulsory_choice Routes
Route::get('compulsory_choice', [CompulsoryChoiceController::class, 'index']);
Route::get('compulsory_choice/create', [CompulsoryChoiceController::class, 'create']);
Route::post('compulsory_choice', [CompulsoryChoiceController::class, 'store']);
Route::get('compulsory_choice/{compulsory_choice}', [CompulsoryChoiceController::class, 'show']);
Route::get('compulsory_choice/edit/{compulsory_choice}', [CompulsoryChoiceController::class, 'edit']);
Route::put('compulsory_choice/update/{compulsory_choice}', [CompulsoryChoiceController::class, 'update']);
Route::post('compulsory_choice/delete', [CompulsoryChoiceController::class, 'destroy']);

//multipule_choice Routes
Route::get('multiple_choice', [MultipleChoiceController::class, 'index']);
Route::get('multiple_choice/create', [MultipleChoiceController::class, 'create']);
Route::post('multiple_choice', [MultipleChoiceController::class, 'store']);
Route::get('multiple_choice/{multiple_choice}', [MultipleChoiceController::class, 'show']);
Route::get('multiple_choice/edit/{multiple_choice}', [MultipleChoiceController::class, 'edit']);
Route::put('multiple_choice/update/{multiple_choice}', [MultipleChoiceController::class, 'update']);
Route::post('multiple_choice/delete', [MultipleChoiceController::class, 'destroy']);

//Oders Routes
Route::get('orders', [OrderController::class, 'index'])->name('orders');
Route::get('orders/{order}', [OrderController::class, 'show']);
Route::post('orders/change_status', [OrderController::class, 'change_status']);

Route::get('sendnotification', [NotificationController::class, 'index'])->name('sendnotificationview');
Route::post('sendNotification', [NotificationController::class, 'sendNotification'])->name('sendNotification');


Route::get('itemnotification', [NotificationController::class, 'itemnotification'])->name('itemnotification');
Route::post('senditemnotification', [NotificationController::class, 'senditemnotification'])->name('senditemnotification');


Route::get('specificnotification', [NotificationController::class, 'specificnotification'])->name('specificnotification');
Route::post('sendspecificnotification', [NotificationController::class, 'sendspecificnotification'])->name('sendspecificnotification');


Route::get('Users', [UsersController::class, 'index']);
Route::get('Users/create', [UsersController::class, 'create']);
Route::post('Users', [UsersController::class, 'store']);
Route::get('Users/edit/{item}', [UsersController::class, 'edit']);
Route::put('Users/update/{item}', [UsersController::class, 'update']);
Route::post('Users/delete', [UsersController::class, 'destroy']);


Route::get('Address', [AddressController::class, 'index']);
Route::get('Address/create', [AddressController::class, 'create']);
Route::post('Address', [AddressController::class, 'store']);
Route::get('Address/edit/{item}', [AddressController::class, 'edit']);
Route::put('Address/update/{item}', [AddressController::class, 'update']);
Route::post('Address/delete', [AddressController::class, 'destroy']);

});

Auth::routes();
