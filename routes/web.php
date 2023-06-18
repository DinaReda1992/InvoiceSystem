<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\InvoiceDetailsController;
use App\Http\Controllers\InvoicesReportController;
use App\Http\Controllers\CustomersReportController;
use App\Http\Controllers\InvoiceAttachmentsController;


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
    return view('auth.login');
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/{page}', [AdminController::class, 'index']);
//Route::resource('invoices', InvoicesController::class);

//Invoices

Route::get('invoices/index',[InvoicesController::class, 'index'])->name('invoices');
Route::get('invoices/indexArchived',[InvoicesController::class, 'indexArchived'])->name('indexArchived');
Route::get('invoices/create',[InvoicesController::class, 'create'])->name('invoices.create');
Route::post('invoices/update',[InvoicesController::class, 'update'])->name('invoices.update');
Route::get('/edit_invoice/{id}', [InvoicesController::class, 'edit'])->name('invoices.edit');
Route::delete('invoices', [InvoicesController::class, 'destroy'])->name('invoices.destroy');
Route::patch('invoices/restore', [InvoicesController::class, 'archiveUpdate'])->name('invoices.restore');
Route::get('invoices/export/', [InvoicesController::class, 'export'])->name('invoicesExport');
Route::get('invoices/import/', [InvoicesController::class, 'import'])->name('invoicesImport');


Route::get('invoices/paidInvoices', [InvoicesController::class, 'Invoice_Paid'])->name('invoices.paid');
Route::get('invoices/unPaidInvoices', [InvoicesController::class, 'Invoice_unPaid'])->name('invoices.unPpaid');
Route::get('invoices/PartiallyPaidInvoices', [InvoicesController::class, 'Invoice_Partial'])->name('invoices.partiallyPaid');
Route::get('invoices/Print/{id}', [InvoicesController::class, 'Print_invoice'])->name('invoices.printInvoice');
Route::post('invoices/store',[InvoicesController::class, 'store'])->name('invoices.store');
Route::get('/section/{id}',[InvoicesController::class, 'getProducts'])->name('getProducts');

Route::get('/Status_show/{id}', [InvoicesController::class , 'show'])->name('Status_show');

Route::post('/Status_Update/{id}', [InvoicesController::class , 'Status_Update'])->name('Status_Update');

//InvoiceDetails
Route::get('/invoiceDetials/{id}',[InvoiceDetailsController::class, 'edit'])->name('invoiceDetials');
Route::post('delete_file', [InvoiceDetailsController::class, 'destroy'])->name('delete_file');
Route::get('View_file/{invoice_number}/{file_name}',[InvoiceDetailsController::class, 'open_file'] )->name('openFile');
Route::get('download/{invoice_number}/{file_name}',[InvoiceDetailsController::class, 'get_file'] )->name('download');

//InvoiceAttachments

Route::resource('InvoiceAttachments', InvoiceAttachmentsController::class);



//Sections

Route::get('sections/index',[SectionsController::class, 'index'])->name('sections');
Route::post('sections/{section}',[SectionsController::class, 'update'])->name('sections.update');
Route::post('sections/{section}',[SectionsController::class, 'destroy'])->name('sections.destroy');
Route::resource('sections', SectionsController::class);
//Route::post('sections/store',[SectionsController::class,'store'])->name('section.store');


//Products

// Route::resource('items',ItemsController::class);
Route::get('items/index', [ItemsController::class, 'index'])->name('items');
Route::post('items/store',[ItemsController::class, 'store'])->name('items.store');
Route::delete('items/{id}', [ItemsController::class, 'destroy'])->name('items.destroy');
Route::post('items/{item}/update',[ItemsController::class, 'update'])->name('items.update');
//Route::resource('items', ItemsController::class);

Route::group(['middleware' => ['auth']], function() {
// Route::resource('roles','RoleController');
Route::get('roles/index', [RoleController::class, 'index'])->name('roles.index');
Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
Route::post('roles/store', [RoleController::class, 'store'])->name('roles.store');
Route::get('roles/{id}/show', [RoleController::class , 'show'])->name('roles.show');
Route::get('roles/{id}', [RoleController::class, 'edit'])->name('roles.edit');
Route::post('roles/{id}/update',[RoleController::class, 'update'])->name('roles.update');
Route::delete('roles', [RoleController::class, 'destroy'])->name('roles.destroy');


Route::get('users/index', [UserController::class, 'index'])->name('users.index');
Route::get('users/create', [UserController::class, 'create'])->name('users.create');
Route::post('users/store', [UserController::class, 'store'])->name('users.store');
Route::get('users/{id}', [UserController::class , 'show'])->name('users.show');
Route::get('users/{id}', [UserController::class, 'edit'])->name('users.edit');
Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

Route::post('users/{id}/update',[UserController::class, 'update'])->name('users.update');



Route::get('invoices/invoices_report', [InvoicesReportController::class, 'index']);

Route::post('Search_invoices', [InvoicesReportController::class,'Search_invoices']);

Route::get('invoices/customers_report', [CustomersReportController::class,'index'])->name("customers_report");

Route::post('Search_customers', [CustomersReportController::class,'Search_customers']);



});




