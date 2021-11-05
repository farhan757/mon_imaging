<?php

use Illuminate\Support\Facades\Route;

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

  

Route::get('/render/{cycle}/{nopolis}/{nmfile}','PDFNSBController@viewpdf')->name('viewpdflangsung');
Route::get('/viewpdf/{cycle}/{nopolis}/{nmfile}/{depart?}','PDFNSBController@viewpdf'); 

Auth::routes();

Route::group(['middleware' => 'auth'], function(){

    Route::get('/','HomeController@index');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/getrange/{per}/{info?}/{start?}/{end?}','HomeController@getrange');
    Route::get('/get-doc','HomeController@getDoc');
    Route::get('/get-pages','HomeController@getPage');
    Route::get('/get-viewpdf','HomeController@getViewPDF');
    Route::get('/getlogactivity','HomeController@getLogActivity')->name('getlogactivity');
    Route::post('/getset','Controller@Mailgetset')->name('getset');

    Route::group(['prefix'=>'imaging'], function(){
        Route::get('/list-upload-imaging','Imaging\UploadController@index')->name('imaging.listupload');
        Route::post('/save-filelist-imaging','Imaging\UploadController@uploadlist')->name('imaging.listupload.savefile');
        Route::post('/delete-filelist-imaging','Imaging\UploadController@delete')->name('imaging.listupload.delete');
        Route::get('/detail-filelist-imaging/{id}','Imaging\UploadController@detail')->name('imaging.listupload.detail');
        Route::get('/view-pdf-imaging/{id}/{nmfile}','Imaging\UploadController@viewpdf')->name('imaging.listupload.viewpdf'); 
        Route::get('/render-pdf-imaging/{id}/{nmfile}','Imaging\UploadController@renderView')->name('imaging.listupload.renderView'); 
        Route::get('/cetak/{id}','Imaging\UploadController@cetakList')->name('imaging.listupload.cetak');

        Route::get('/nb/list','Imaging\NBController@index')->name('imaging.nb.list');
        Route::post('/nb/delete','Imaging\NBController@delete')->name('imaging.nb.delete');
        Route::get('/nb/detail-filelist-imaging/{id}/{nopol}','Imaging\NBController@detail')->name('imaging.nb.detail');
        Route::get('/claim/list','Imaging\CLAIMController@index')->name('imaging.claim.list');
        Route::post('/claim/delete','Imaging\CLAIMController@delete')->name('imaging.claim.delete');
        Route::get('/claim/detail-filelist-imaging/{id}/{nopol}','Imaging\CLAIMController@detail')->name('imaging.claim.detail');
        Route::get('/pos/list','Imaging\POSController@index')->name('imaging.pos.list');
        Route::post('/pos/delete','Imaging\POSController@delete')->name('imaging.pos.delete');
        //Route::get('/pos/detail-filelist-imaging/{id}/{nopol}','Imaging\POSController@detail')->name('imaging.pos.detail');
        Route::get('/pos/detail-filelist-imaging/{id}/{nopol}/{kriteria}/{kriterias}','Imaging\POSController@getPerKriteria')->name('imaging.pos.detail');
    });

    Route::group(['prefix'=>'report'], function(){
        Route::get('/list-report-imaging','Report\ReportController@listDetail')->name('report.list');
        Route::get('/summary-report-imaging','Report\ReportController@summary')->name('report.summary');
        Route::get('/cetak','Report\ReportController@cetakList')->name('report.summary.cetaklist');
    });

    Route::group(['prefix'=>'mutation'], function(){
        Route::get('/form','Mutation\MutationController@index')->name('mutation.form');
        Route::post('/form','Mutation\MutationController@save');
        Route::get('/cetak/{no_bast}','Mutation\MutationController@cetak')->name('mutation.cetak');
        Route::get('/list','Mutation\ListController@index')->name('mutation.list');
    });

    Route::group(['prefix'=>'profile'], function(){
        Route::get('/form-changepass','Profile\ProfileController@index')->name('profile.changepass');
        Route::get('/cekoldpass','Profile\ProfileController@check_old_pass')->name('profile.check_old_pass');
        Route::get('/ceknewpass','Profile\ProfileController@check_new_pass')->name('profile.check_new_pass');
        Route::post('/save-changepass','Profile\ProfileController@save_form_c_pass')->name('profile.save_form_c_pass');
    });

    Route::group(['prefix'=>'master'], function(){
        Route::get('/users','Master\UsersController@index')->name('master.users');
        Route::get('/form-user','Master\UsersController@formuser')->name('master.form');
        Route::post('/form-user','Master\UsersController@adduser');
        Route::get('/edit-user/{id}','Master\UsersController@edituser')->name('master.edit');
        Route::post('/edit-user','Master\UsersController@saveuser')->name('master.saveuser');
        Route::get('/delete-user/{id}','Master\UsersController@deleteuser')->name('master.del.user');
        Route::get('/users/menu/{id}','Master\UsersController@showmenuform');
        Route::post('/users/menu/{id}','Master\UsersController@replacemenu')->name('user.menu');

        Route::get('/customer','Master\CustomerController@index')->name('master.customer');
        Route::get('/form-cust','Master\CustomerController@formcust')->name('master.form.cust');
        Route::post('/form-cust','Master\CustomerController@addcust');
        Route::get('/edit-cust/{id}','Master\CustomerController@editcust')->name('master.cust.edit');
        Route::post('/edit-cust','Master\CustomerController@savecust')->name('master.cust.savecust');
        Route::get('/delete-cust/{id}','Master\CustomerController@deletecust')->name('master.del.cust');

        Route::get('/product','Master\ProductController@index')->name('master.product');
        Route::get('/form-prod','Master\ProductController@formprod')->name('master.form.prod');
        Route::post('/form-prod','Master\ProductController@addprod');
        Route::get('/edit-prod/{id}','Master\ProductController@editprod')->name('master.prod.edit');
        Route::post('/edit-prod','Master\ProductController@saveprod')->name('master.prod.saveprod');
        Route::get('/delete-prod/{id}','Master\ProductController@deleteprod')->name('master.del.prod');

        Route::get('/pos-location','Master\PosLocController@index')->name('master.posloc');
        Route::get('/form-pos','Master\PosLocController@formpos')->name('master.form.pos');
        Route::post('/form-pos','Master\PosLocController@addpos');
        Route::get('/edit-pos/{id}','Master\PosLocController@editpos')->name('master.pos.edit');
        Route::post('/edit-pos','Master\PosLocController@savepos')->name('master.pos.savepos');
        Route::get('/delete-pos/{id}','Master\PosLocController@deletepos')->name('master.del.pos');        
    });

    Route::group(['prefix' => 'mailblast'], function(){
        Route::group(['prefix' => 'startmail'], function(){
            Route::get('/listmail','MailBlast\StartMail\UploadController@index')->name('startmail.list');
            Route::post('/uploadlist','MailBlast\StartMail\UploadController@upload')->name('startmail.upload');
            Route::post('/delete-list','MailBlast\StartMail\UploadController@delete')->name('startmail.delete');
            Route::get('/detail-list/{id}','MailBlast\StartMail\UploadController@detail')->name('startmail.detail');
        });

        Route::group(['prefix' => 'progress'], function(){
            Route::get('/listprogress','MailBlast\Progress\ProgressController@index')->name('progress.list');
            Route::get('/detail-list/{id}','MailBlast\Progress\ProgressController@detail')->name('progress.detail');
            Route::post('/form-resend','MailBlast\Progress\ProgressController@getInfoResend')->name('progress.formresend');
            Route::post('/resend','MailBlast\Progress\ProgressController@resend')->name('progress.resend');
        });

        Route::group(['prefix' => 'settings'], function(){
            Route::get('/bodyemail','MailBlast\Settings\BodyMailController@index')->name('settings.bodyemail');
            Route::post('/bodyemail','MailBlast\Settings\BodyMailController@save')->name('settings.bodyemail.save');
            Route::get('/bodyemail/show','MailBlast\Settings\BodyMailController@show')->name('settings.bodyemail.show');
            Route::get('/bodyemail/{id}','MailBlast\Settings\BodyMailController@showid')->name('settings.bodyemail.showid'); 
            Route::post('/bodyemail/delete','MailBlast\Settings\BodyMailController@delete')->name('settings.bodyemail.delete');           
            Route::post('/bodyemail/{id}','MailBlast\Settings\BodyMailController@update')->name('settings.bodyemail.update');            

            Route::get('/variablefield','MailBlast\Settings\VariableController@index')->name('settings.variablefield');
            Route::get('/variablefield/form','MailBlast\Settings\VariableController@newForm')->name('settings.variablefield.newform');
            Route::get('/variablefield/addform', 'MailBlast\Settings\VariableController@addform')->name('settings.variablefield.addform');
            Route::post('/variablefield/submit','MailBlast\Settings\VariableController@addmastervariable')->name('settings.variablefield.submit');
            Route::post('/variablefield/save','MailBlast\Settings\VariableController@savemastervariable')->name('settings.variablefield.save');
            Route::get('/variablefield/edit/{id}','MailBlast\Settings\VariableController@edit')->name('settings.variablefield.edit');
            Route::post('/variablefield/delete','MailBlast\Settings\VariableController@delete')->name('settings.variablefield.delete');
        });
    });
});

Route::get('/logout','Auth\LoginController@logout');
Route::get('/genpdf','Imaging\UploadController@genpdf');