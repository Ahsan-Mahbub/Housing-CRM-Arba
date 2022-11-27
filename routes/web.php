<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DatagetController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProjectController;

use App\Http\Controllers\FlatController;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\CustomerTypeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AssignFlatController;

use App\Http\Controllers\FundCategoryController;
use App\Http\Controllers\FundUserController;
use App\Http\Controllers\FundController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StockClearController;

use App\Http\Controllers\TransactionController;
use App\Http\Controllers\FundWithdrawController;
use App\Http\Controllers\OfficeExpenseController;

use App\Http\Controllers\CustomerReportController;
use App\Http\Controllers\FundReportController;
use App\Http\Controllers\WithdrawReportController;
use App\Http\Controllers\ExpenseReportController;
use App\Http\Controllers\StockReportController;

Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard')->middleware('auth');
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    /*
    |--------------------------------------------------------------------------
    | Global Routes
    |--------------------------------------------------------------------------
    */

    //Profile Update Route
    Route::post('/profile-store', [App\Http\Controllers\HomeController::class, 'store'])->name('profile.store');
    //Notification
    Route::group(['prefix' => 'notification'], function () {
        Route::get('/list', [NotificationController::class, 'notificationList'])->name('notification.list');
    });
    //Dataget Route
    Route::get('/project/{id}', [DatagetController::class, 'flotNameGet']);
    Route::get('/method/{id}', [DatagetController::class, 'accountNameGet']);
    Route::get('/item/{id}', [DatagetController::class, 'itemNameGet']);
    Route::get('/user-info/{id}', [DatagetController::class, 'userInfoGet']);
    Route::get('/purchase-code/{id}', [DatagetController::class, 'stockPurchaseCode']);
    //Role Route
    Route::group(['prefix' => 'role'], function () {
        Route::get('/list', [RoleController::class, 'index'])->name('role.list');
        Route::post('store', [RoleController::class, 'store'])->name('role.store');
        Route::get('status/{id}', [RoleController::class, 'status'])->name('role.status');
        Route::get('edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
        Route::post('update/{id}', [RoleController::class, 'update'])->name('role.update');
    });
    //User Create Route
    Route::group(['prefix' => 'user'], function () {
        Route::get('/list', [UserController::class, 'index'])->name('user.list');
        Route::post('store', [UserController::class, 'store'])->name('user.store');
        Route::get('status/{id}', [UserController::class, 'status'])->name('user.status');
        Route::get('edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::post('update/{id}', [UserController::class, 'update'])->name('user.update');
        Route::delete('delete/{id}', [UserController::class, 'destroy'])->name('user.delete');
    });
    //Project Route
    Route::group(['prefix' => 'projects'], function () {
        Route::get('/list', [ProjectController::class, 'index'])->name('project.list');
        Route::post('store', [ProjectController::class, 'store'])->name('project.store');
        Route::get('status/{id}', [ProjectController::class, 'status'])->name('project.status');
        Route::get('edit/{id}', [ProjectController::class, 'edit']);
        Route::post('update', [ProjectController::class, 'update'])->name('project.update');
        Route::delete('delete/{id}', [ProjectController::class, 'destroy'])->name('project.delete');
    });

    /*
    |--------------------------------------------------------------------------
    | CRM Routes
    |--------------------------------------------------------------------------
    */

    //Flat Route
    Route::group(['prefix' => 'flat'], function () {
        Route::get('/list', [FlatController::class, 'index'])->name('flat.list');
        Route::post('store', [FlatController::class, 'store'])->name('flat.store');
        Route::get('status/{id}', [FlatController::class, 'status'])->name('flat.status');
        Route::get('edit/{id}', [FlatController::class, 'edit']);
        Route::post('update', [FlatController::class, 'update'])->name('flat.update');
        Route::delete('delete/{id}', [FlatController::class, 'destroy'])->name('flat.delete');
        Route::get('/under-project-flat-list/{id}', [FlatController::class, 'ProjectFlat'])->name('project.flat.list');
    });
    //Reference Route
    Route::group(['prefix' => 'reference'], function () {
        Route::get('/list', [ReferenceController::class, 'index'])->name('reference.list');
        Route::post('store', [ReferenceController::class, 'store'])->name('reference.store');
        Route::get('status/{id}', [ReferenceController::class, 'status'])->name('reference.status');
        Route::get('edit/{id}', [ReferenceController::class, 'edit']);
        Route::post('update', [ReferenceController::class, 'update'])->name('reference.update');
        Route::delete('delete/{id}', [ReferenceController::class, 'destroy'])->name('reference.delete');
    });
    //Customer Type Status Route
    Route::group(['prefix' => 'customer-status'], function () {
        Route::get('/list', [CustomerTypeController::class, 'index'])->name('customer-status.list');
        Route::post('store', [CustomerTypeController::class, 'store'])->name('customer-status.store');
        Route::get('status/{id}', [CustomerTypeController::class, 'status'])->name('customer-status.status');
        Route::get('edit/{id}', [CustomerTypeController::class, 'edit'])->name('customer-status.edit');
        Route::post('update/{id}', [CustomerTypeController::class, 'update'])->name('customer-status.update');
        Route::delete('delete/{id}', [CustomerTypeController::class, 'destroy'])->name('customer-status.delete');
    });
    //Customer Route
    Route::group(['prefix' => 'customer'], function () {
        Route::get('/list', [CustomerController::class, 'index'])->name('customer.list');
        Route::post('store', [CustomerController::class, 'store'])->name('customer.store');
        Route::get('show/{id}', [CustomerController::class, 'show'])->name('customer.show');
        Route::get('edit/{id}', [CustomerController::class, 'edit'])->name('customer.edit');
        Route::post('update/{id}', [CustomerController::class, 'update'])->name('customer.update');
        Route::delete('delete/{id}', [CustomerController::class, 'destroy'])->name('customer.delete');
        Route::post('note-store', [CustomerController::class, 'noteStore'])->name('note.store');
    });
    //Flat Assign Route
    Route::group(['prefix' => 'flat-assign'], function () {
        Route::get('/list', [AssignFlatController::class, 'index'])->name('flat-assign.list');
        Route::post('store', [AssignFlatController::class, 'store'])->name('flat-assign.store');
        Route::get('show/{id}', [AssignFlatController::class, 'show'])->name('flat-assign.show');
        Route::get('status/{id}', [AssignFlatController::class, 'status'])->name('flat-assign.status');
        Route::delete('delete/{id}', [AssignFlatController::class, 'destroy'])->name('flat-assign.delete');
    });

    /*
    |--------------------------------------------------------------------------
    | Construction Routes
    |--------------------------------------------------------------------------
    */

    //Fund Category Route
    Route::group(['prefix' => 'fund-category'], function () {
        Route::get('/list', [FundCategoryController::class, 'index'])->name('fund-category.list');
        Route::post('store', [FundCategoryController::class, 'store'])->name('fund-category.store');
        Route::get('status/{id}', [FundCategoryController::class, 'status'])->name('fund-category.status');
        Route::get('edit/{id}', [FundCategoryController::class, 'edit']);
        Route::post('update', [FundCategoryController::class, 'update'])->name('fund-category.update');
        Route::delete('delete/{id}', [FundCategoryController::class, 'destroy'])->name('fund-category.delete');
    });
    //Fund User Route
    Route::group(['prefix' => 'fund-user'], function () {
        Route::get('/list', [FundUserController::class, 'index'])->name('fund-user.list');
        Route::post('store', [FundUserController::class, 'store'])->name('fund-user.store');
        Route::get('status/{id}', [FundUserController::class, 'status'])->name('fund-user.status');
        Route::get('edit/{id}', [FundUserController::class, 'edit']);
        Route::post('update', [FundUserController::class, 'update'])->name('fund-user.update');
        Route::delete('delete/{id}', [FundUserController::class, 'destroy'])->name('fund-user.delete');
        Route::get('show/{id}', [FundUserController::class, 'show'])->name('fund-user.show');
    });
    //Fund Controller
    Route::group(['prefix' => 'fund'], function () {
        Route::get('/list', [FundController::class, 'index'])->name('fund.list');
        Route::post('store', [FundController::class, 'store'])->name('fund.store');
        Route::delete('delete/{id}', [FundController::class, 'destroy'])->name('fund.delete');
    });
    //Unit Route
    Route::group(['prefix' => 'unit'], function () {
        Route::get('/list', [UnitController::class, 'index'])->name('unit.list');
        Route::post('store', [UnitController::class, 'store'])->name('unit.store');
        Route::get('status/{id}', [UnitController::class, 'status'])->name('unit.status');
        Route::get('edit/{id}', [UnitController::class, 'edit']);
        Route::post('update', [UnitController::class, 'update'])->name('unit.update');
        Route::delete('delete/{id}', [UnitController::class, 'destroy'])->name('unit.delete');
    });
    //Unit Route
    Route::group(['prefix' => 'items'], function () {
        Route::get('/list', [ItemController::class, 'index'])->name('item.list');
        Route::post('store', [ItemController::class, 'store'])->name('item.store');
        Route::get('status/{id}', [ItemController::class, 'status'])->name('item.status');
        Route::get('edit/{id}', [ItemController::class, 'edit'])->name('item.edit');
        Route::post('update/{id}', [ItemController::class, 'update'])->name('item.update');
        Route::delete('delete/{id}', [ItemController::class, 'destroy'])->name('item.delete');
    });
    //Supplier Route
    Route::group(['prefix' => 'supplier'], function () {
        Route::get('/list', [SupplierController::class, 'index'])->name('supplier.list');
        Route::post('store', [SupplierController::class, 'store'])->name('supplier.store');
        Route::get('status/{id}', [SupplierController::class, 'status'])->name('supplier.status');
        Route::get('edit/{id}', [SupplierController::class, 'edit']);
        Route::post('update', [SupplierController::class, 'update'])->name('supplier.update');
        Route::delete('delete/{id}', [SupplierController::class, 'destroy'])->name('supplier.delete');
    });
    //Payment Method Route
    Route::group(['prefix' => 'methods'], function () {
        Route::get('/list', [PaymentMethodController::class, 'index'])->name('method.list');
        Route::post('store', [PaymentMethodController::class, 'store'])->name('method.store');
        Route::get('status/{id}', [PaymentMethodController::class, 'status'])->name('method.status');
        Route::get('edit/{id}', [PaymentMethodController::class, 'edit']);
        Route::post('update', [PaymentMethodController::class, 'update'])->name('method.update');
        Route::delete('delete/{id}', [PaymentMethodController::class, 'destroy'])->name('method.delete');
    });
    //Account Route
    Route::group(['prefix' => 'account'], function () {
        Route::get('/list', [AccountController::class, 'index'])->name('account.list');
        Route::post('store', [AccountController::class, 'store'])->name('account.store');
        Route::get('status/{id}', [AccountController::class, 'status'])->name('account.status');
        Route::get('edit/{id}', [AccountController::class, 'edit'])->name('account.edit');
        Route::post('update/{id}', [AccountController::class, 'update'])->name('account.update');
        Route::delete('delete/{id}', [AccountController::class, 'destroy'])->name('account.delete');
        Route::get('show/{id}', [AccountController::class, 'show'])->name('account.show');
    });
    //Stock Route
    Route::group(['prefix' => 'stock'], function () {
        Route::get('/list', [StockController::class, 'index'])->name('stock.list');
        Route::get('/create', [StockController::class, 'create'])->name('stock.create');
        Route::post('store', [StockController::class, 'store'])->name('stock.store');
        Route::get('show/{id}', [StockController::class, 'show'])->name('stock.show');
    });

    //Stock Clear Route
    Route::group(['prefix' => 'stock-clear'], function () {
        Route::get('/list', [StockClearController::class, 'index'])->name('stock.clear.list');
        Route::get('/create', [StockClearController::class, 'create'])->name('stock.clear.create');
        Route::get('/find-invoice', [StockClearController::class, 'findInvoice'])->name('stock.clear.invoice');
        Route::post('store', [StockClearController::class, 'store'])->name('stock.clear.store');
    });

    /*
    |--------------------------------------------------------------------------
    | Expense Routes
    |--------------------------------------------------------------------------
    */

    //Transaction Route
    Route::group(['prefix' => 'transaction'], function () {
        Route::get('/list', [TransactionController::class, 'index'])->name('transaction.list');
        Route::get('/create', [TransactionController::class, 'create'])->name('transaction.create');
        Route::get('/supplier', [TransactionController::class, 'supplierTransection'])->name('transaction.supplier');
        Route::post('store', [TransactionController::class, 'store'])->name('transaction.store');
    });
    //Fund Withdraw Route
    Route::group(['prefix' => 'fund-withdraw'], function () {
        Route::get('/list', [FundWithdrawController::class, 'index'])->name('fund-withdraw.list');
        Route::get('/create', [FundWithdrawController::class, 'create'])->name('fund-withdraw.create');
        Route::post('store', [FundWithdrawController::class, 'store'])->name('fund-withdraw.store');
        Route::delete('delete/{id}', [FundWithdrawController::class, 'destroy'])->name('fund-withdraw.delete');
    });
    //Office Expense Route
    Route::group(['prefix' => 'office-expense'], function () {
        Route::get('/list', [OfficeExpenseController::class, 'index'])->name('office-expense.list');
        Route::get('/create', [OfficeExpenseController::class, 'create'])->name('office-expense.create');
        Route::post('store', [OfficeExpenseController::class, 'store'])->name('office-expense.store');
    });

    /*
    |--------------------------------------------------------------------------
    | Report Routes
    |--------------------------------------------------------------------------
    */

    //Customer Report Route
    Route::group(['prefix' => 'report'], function () {
        //Index Route
        Route::get('/customer-report', [CustomerReportController::class, 'index'])->name('customer.report.index');
        Route::get('/sold-report', [CustomerReportController::class, 'index'])->name('sold.report.index');
        Route::get('/status-report', [CustomerReportController::class, 'index'])->name('status.report.index');
        Route::get('/user-report', [CustomerReportController::class, 'index'])->name('user.report.index');
        //List Route
        Route::get('/find-flat', [CustomerReportController::class, 'findFlat'])->name('report.find-flat');
        Route::get('/find-sold-flat', [CustomerReportController::class, 'findSoldFlat'])->name('report.find-sold-flat');
        Route::get('/find-status-customer', [CustomerReportController::class, 'findStatusCustomer'])->name('report.find-status-customer');
        Route::get('/find-user-type-customer', [CustomerReportController::class, 'findUserStatusCustomer'])->name('report.find-user-status-customer');
    });
    //Fund Report Route
    Route::group(['prefix' => 'report'], function () {
        //Index Route
        Route::get('/fund-report', [FundReportController::class, 'index'])->name('fund.report.index');
        Route::get('/user-fund-report', [FundReportController::class, 'index'])->name('user.fund.report.index');
        //List Route
        Route::get('/find-fund-report', [FundReportController::class, 'findFund'])->name('report.fund');
        Route::get('/find-user-fund-report', [FundReportController::class, 'findUserFund'])->name('report.user.fund');
    });
    //Withdraw Report Route
    Route::group(['prefix' => 'report'], function () {
        //Index Route
        Route::get('/withdraw-report', [WithdrawReportController::class, 'index'])->name('withdraw.report.index');
        Route::get('/user-withdraw-report', [WithdrawReportController::class, 'index'])->name('user.withdraw.report.index');
        //List Route
        Route::get('/find-withdraw-report', [WithdrawReportController::class, 'findWithdraw'])->name('report.withdraw');
        Route::get('/find-user-withdraw-report', [WithdrawReportController::class, 'findUserWithdraw'])->name('report.user.withdraw');
    });
    //Expense Report Route
    Route::group(['prefix' => 'report'], function () {
        //Index Route
        Route::get('/expense-report', [ExpenseReportController::class, 'index'])->name('expense.report.index');
        //List Route
        Route::get('/find-expense-report', [ExpenseReportController::class, 'findExpense'])->name('report.expense');
    });
    //Stock Report Route
    Route::group(['prefix' => 'report'], function () {
        //Index Route
        Route::get('/project-stock-report', [StockReportController::class, 'index'])->name('project.stock.report.index');
        Route::get('/supplier-stock-report', [StockReportController::class, 'index'])->name('supplier.stock.report.index');
        //List Route
        Route::get('/find-withdrawproject-stock-report', [StockReportController::class, 'findProjectStock'])->name('report.project.stock');
        Route::get('/find-supplier-stock-report', [StockReportController::class, 'findSupplierStock'])->name('report.supplier.stock');
    });
});
