<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Welcome\WelcomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

// Route::get('/', [
//     'uses' => 'Welcome\WelcomeController@welcome',
//     'as' => 'welcome.welcome'
// ]);

Route::post("post-comment-store" , [WelcomeController::class , "postCommentStore"])->name('postCommentStore');


Route::get('/', [
    'uses' => 'Welcome\WelcomeController@home1',
    'as' => 'welcome.home1'
]);

Route::get('/sub-category/2/product/{cat}/{sl}', [
    'uses' => 'Welcome\WelcomeController@homeCat',
    'as' => 'homeCat'
]);

Route::get('/terms/conditions', [
    'uses' => 'Welcome\WelcomeController@terms',
    'as' => 'terms'
]);

Route::get('/sub-category/product/{cat}', [
    'uses' => 'Welcome\WelcomeController@homeCat2',
    'as' => 'homeCat2'
]);

Route::get('/category/product/{cat}', [
    'uses' => 'Welcome\WelcomeController@catAds',
    'as' => 'catAds'
]);

Route::get('/blogs', [
    'uses' => 'Welcome\WelcomeController@blogs',
    'as' => 'blogs'
]);

Route::get('/area-wise/product', [
    'uses' => 'Welcome\WelcomeController@areaSearch',
    'as' => 'areaSearch'
]);


Route::get('/all/ads', [
    'uses' => 'Welcome\WelcomeController@allAds',
    'as' => 'allAds'
]);

Route::get('/primary-category/{id}' , [WelcomeController::class , 'primaryCategoryWishProduct'])->name('primaryCategoryWishProduct');

Route::post('/search/ads', [
    'uses' => 'Welcome\WelcomeController@addSearch',
    'as' => 'addSearch'
]);

Route::get('/ads/{ad}', [
    'uses' => 'Welcome\WelcomeController@adDetails',
    'as' => 'adDetails'
]);


Route::post('/load_thana/fetch', [
    'uses' => 'Welcome\WelcomeController@load_thanaFetch',
    'as' => 'load_thana.fetch'
]);

Route::post('/subcat.fetch', [
    'uses' => 'Welcome\WelcomeController@subCatFetch',
    'as' => 'subcat.fetch'
]);

Route::get("/blog/details/{id}" , [WelcomeController::class, 'blogDetails'])->name('blogDetails');

Route::get('/post/details/{post}', [
    'uses' => 'Welcome\WelcomeController@postDetails',
    'as' => 'postDetails'
]);
Route::get('ewa', function () {
    return 'sajiblink.ewa';
});

Route::get('embassy', function () {
    return 'sajiblink.embassy';
});

Route::get('visa', function () {
    return 'sajiblink.visa';
});

Route::get('koly', function () {
    return 'sajiblink.koly';
});

Route::get('nafiz', function () {
    return 'sajiblink.nafiz';
});

Route::get('ridoy', function () {
    return 'sajiblink.ridoy';
});

Route::get('sabrin', function () {
    return 'sajiblink.sabrin';
});

Route::get('sajib', function () {
    return 'sajiblink.sajib';
});

Route::get('shaon', function () {
    return 'sajiblink.shaon';
});

Route::get('tuhin', function () {
    return 'sajiblink.tuhin';
});

Route::get('fahim', function () {
    return 'sajiblink.fahim';
});
// Route::get('/demo', function () {
//     return 'welcome.demoVideos';
// });

Route::get('/faq', [
    'uses' => 'Welcome\WelcomeController@faq',
    'as' => 'welcome.faq'
]);

Route::get('/demo', [
    'uses' => 'Welcome\WelcomeController@demoVideos',
    'as' => 'welcome.demoVideos'
]);


Route::get('/demo/{sub}', [
    'uses' => 'Welcome\WelcomeController@demoPage',
    'as' => 'welcome.demoPage'
]);

Route::get('/course/page', [
    'uses' => 'Welcome\WelcomeController@coursePage',
    'as' => 'welcome.coursePage'
]);

Route::get('/java/page', [
    'uses' => 'Welcome\WelcomeController@javaPage',
    'as' => 'welcome.javaPage'
]);

Route::get('/java/post', [
    'uses' => 'Welcome\WelcomeController@javaPost',
    'as' => 'welcome.javaPost'
]);

Route::get('/selenium', [
    'uses' => 'Welcome\WelcomeController@selenium',
    'as' => 'welcome.selenium'
]);

Route::get('/contact', [
    'uses' => 'Welcome\WelcomeController@contactPage',
    'as' => 'welcome.contactPage'
]);



Route::get('/basic/getAttribute', [
    'uses' => 'Welcome\WelcomeController@getAttribute',
    'as' => 'welcome.getAttribute'
]);



Route::get('/packeges', [
    'uses' => 'Welcome\WelcomeController@packages',
    'as' => 'welcome.packeges'
]);


Route::get('/basic/getText', [
    'uses' => 'Welcome\WelcomeController@getText',
    'as' => 'welcome.getText'
]);

Route::get('/basic/click', [
    'uses' => 'Welcome\WelcomeController@click',
    'as' => 'welcome.click'
]);

Route::get('/basic/type', [
    'uses' => 'Welcome\WelcomeController@type',
    'as' => 'welcome.type'
]);

Route::get('/basic/ridoy', [
    'uses' => 'Welcome\WelcomeController@ridoy',
    'as' => 'welcome.ridoy'
]);

// JavaPage
Route::get('/basic/java_001', [
    'uses' => 'Welcome\WelcomeController@java_001',
    'as' => 'welcome.java_001'
]);

Route::get('/basic/java_002', [
    'uses' => 'Welcome\WelcomeController@java_002',
    'as' => 'welcome.java_002'
]);


Route::get('/basic/java_003', [
    'uses' => 'Welcome\WelcomeController@java_003',
    'as' => 'welcome.java_003'
]);

Route::get('/basic/java_004', [
    'uses' => 'Welcome\WelcomeController@java_004',
    'as' => 'welcome.java_004'
]);

Route::get('/basic/java_005', [
    'uses' => 'Welcome\WelcomeController@java_005',
    'as' => 'welcome.java_005'
]);

Route::get('/basic/java_006', [
    'uses' => 'Welcome\WelcomeController@java_006',
    'as' => 'welcome.java_006'
]);

Route::get('/basic/java_007', [
    'uses' => 'Welcome\WelcomeController@java_007',
    'as' => 'welcome.java_007'
]);

Route::get('/basic/java_008', [
    'uses' => 'Welcome\WelcomeController@java_008',
    'as' => 'welcome.java_008'
]);


Route::get('/basic/java_009', [
    'uses' => 'Welcome\WelcomeController@java_009',
    'as' => 'welcome.java_009'
]);

Route::get('/basic/java_010', [
    'uses' => 'Welcome\WelcomeController@java_010',
    'as' => 'welcome.java_010'
]);



//JavaPage
Route::get('/basic/auth', [
    'uses' => 'Welcome\WelcomeController@basicAuth',
    'as' => 'welcome.basicAuth'
]);



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/class', 'HomeController@class')->name('class');



Route::get('/subject/{subject_id}', 'HomeController@subjectClasses')->name('subjectClasses');
Route::get('/subject/classes/subject/{class}', 'HomeController@subjectClasses2')->name('subjectClasses2');
Route::get('/subject/categories/subject/{category}', 'HomeController@subjectClasses3')->name('subjectClasses3');

Route::get('/class/posts/subject/{subject}/class/{class}', 'HomeController@classPosts')->name('classPosts');

Route::get('/watch/{post}', 'HomeController@watch')->name('watch');




Route::get('select/user', [
    'uses' => 'HomeController@selectUser',
    'as' => 'home.selectUser',
]);

//admin
Route::group(['middleware' => ['role:admin','auth'] ,'prefix' => 'admin'], function () {

 	Route::get('dashboard', [
    'uses' =>'Admin\AdminController@dashboard',
    'as' => 'admin.dashboard'
    ]);

    Route::get('all/sliders', [
        'uses' =>'Admin\AdminController@allsliders',
        'as' => 'admin.allsliders'
        ]);

        Route::get('delete/sliders/{slide}', [
            'uses' =>'Admin\AdminController@sliderdelete',
            'as' => 'admin.sliderdelete'
            ]);

            Route::get('updateStatus/sliders/{slide}', [
                'uses' =>'Admin\AdminController@updateStatus',
                'as' => 'admin.updateStatus'
                ]);

        Route::post('all/sliderPost', [
            'uses' =>'Admin\AdminController@sliderPost',
            'as' => 'admin.sliderPost'
            ]);
    Route::get('all/pending/payments', [
        'uses' => 'Admin\AdminController@allPendingPayments',
        'as' => 'admin.allPendingPayments'
    ]);

    Route::post('pending/payment/update/post/{payment}', [
        'uses' => 'Admin\AdminController@pendingPaymentUpdatePost',
        'as' => 'admin.pendingPaymentUpdatePost'
    ]);


    Route::get('payment/delete/{payment}', [
        'uses' => 'Admin\AdminController@paymentDelete',
        'as' => 'admin.paymentDelete'
    ]);
    Route::get('companies/all', [
        'uses' =>'Admin\AdminController@companiesAll',
        'as' => 'admin.companiesAll'
    ]);

    Route::get('company/add/new', [
        'uses' =>'Admin\AdminController@companyAddNew',
        'as' => 'admin.companyAddNew'
    ]);

    Route::get('company/edit/company/{company}', [
        'uses' =>'Admin\AdminController@companyEdit',
        'as' => 'admin.companyEdit'
    ]);

    Route::post('company/update/company/{company}', [
        'uses' =>'Admin\AdminController@companyUpdate',
        'as' => 'admin.companyUpdate'
    ]);

    Route::get('company/details/company/{company}', [
        'uses' =>'Admin\AdminController@companyDetails',
        'as' => 'admin.companyDetails'
    ]);

    Route::get('company/delete/company/{company}', [
        'uses' =>'Admin\AdminController@companyDelete',
        'as' => 'admin.companyDelete'
    ]);

    Route::get('company/change/status/company/{company}', [
        'uses' =>'Admin\AdminController@companyChangeStatus',
        'as' => 'admin.companyChangeStatus'
    ]);


    Route::get('users/all', [
        'uses' =>'Admin\AdminController@usersAll',
        'as' => 'admin.usersAll'
    ]);


    Route::get('company/owner/add/company/{company}', [
        'uses' =>'Admin\AdminController@companyOwnerAdd',
        'as' => 'admin.companyOwnerAdd'
    ]);

// learn with sajib
    Route::get('new/catagory/create', [
        'uses' =>'Admin\AdminController@newCatagoryCreate',
        'as' => 'admin.newCatagoryCreate'
    ]);

    Route::post('new/catagory/create/post', [
        'uses' =>'Admin\AdminController@newCatagoryCreatePost',
        'as' => 'admin.newCatagoryCreatePost'
    ]);

    Route::get('new/sub/catagory/create', [
        'uses' =>'Admin\AdminController@newSUbCatagoryCreate',
        'as' => 'admin.newSubCatagoryCreate'
    ]);

    Route::post('new/sub/catagory/create/post', [
        'uses' =>'Admin\AdminController@newSubCatagoryCreatePost',
        'as' => 'admin.newSubCatagoryCreatePost'
    ]);

    Route::get('class/edit/class/{class}', [
        'uses' =>'Admin\AdminController@classEdit',
        'as' => 'admin.classEdit'
    ]);

    Route::post('class/update/class/{class}', [
        'uses' =>'Admin\AdminController@classUpdate',
        'as' => 'admin.classUpdate'
    ]);

    // learn post edit

    Route::get('post/edit/post/{post}', [
        'uses' =>'Admin\AdminController@postEdit',
        'as' => 'admin.postEdit'
    ]);

    // Route::post('post/update/post/{post}', [
    //     'uses' =>'Admin\AdminController@postUpdate',
    //     'as' => 'admin.postUpdate'
    // ]);

    Route::post('/post/update/{id}' , [AdminController::class , 'postUpdate'])->name('admin.postUpdate');

    Route::get('catagory/edit/catagory/{catagory}', [
        'uses' =>'Admin\AdminController@catagoryEdit',
        'as' => 'admin.catagoryEdit'
    ]);

    // Route::post('catagory/update/catagory/{catagory}', [
    //     'uses' =>'Admin\AdminController@catagoryUpdate',
    //     'as' => 'admin.catagoryUpdate'
    // ]);

    Route::post('/category/update/{id}' , [AdminController::class , 'catagoryUpdate'])->name('admin.catagoryUpdate');

    Route::get('subject/edit/subject/{subject}', [
        'uses' =>'Admin\AdminController@subjectEdit',
        'as' => 'admin.subjectEdit'
    ]);

    Route::post('subject/update/subject/{subject}', [
        'uses' =>'Admin\AdminController@subjectUpdate',
        'as' => 'admin.subjectUpdate'
    ]);

    Route::get('catagory/delete/catagory/{cat}', [
        'uses' =>'Admin\AdminController@catagorydelete',
        'as' => 'admin.catagorydelete'
    ]);
    Route::get('sub/catagory/delete/catagory/{cat}', [
        'uses' =>'Admin\AdminController@subcatagorydelete',
        'as' => 'admin.subcatagorydelete'
    ]);

    Route::get('catagories/all', [
        'uses' =>'Admin\AdminController@catagoriesAll',
        'as' => 'admin.catagoriesAll'
    ]);

    Route::get('sub/catagories/all', [
        'uses' =>'Admin\AdminController@subcatagoriesAll',
        'as' => 'admin.subcatagoriesAll'
    ]);

    Route::get('new/class/create', [
        'uses' =>'Admin\AdminController@newClassCreate',
        'as' => 'admin.newClassCreate'
    ]);

    Route::post('new/class/create/post', [
        'uses' =>'Admin\AdminController@newClassCreatePost',
        'as' => 'admin.newClassCreatePost'
    ]);

    Route::get('class/delete/class/{class}', [
        'uses' =>'Admin\AdminController@classdelete',
        'as' => 'admin.classdelete'
    ]);

    Route::get('classes/all', [
        'uses' =>'Admin\AdminController@classesAll',
        'as' => 'admin.classesAll'
    ]);

    Route::get('new/subject/create', [
        'uses' =>'Admin\AdminController@newSubjectCreate',
        'as' => 'admin.newSubjectCreate'
    ]);

    Route::get('new/demo/create', [
        'uses' =>'Admin\AdminController@newDemoCreate',
        'as' => 'admin.newDemoCreate'
    ]);

    Route::post('new/subject/create/post', [
        'uses' =>'Admin\AdminController@newSubjectCreatePost',
        'as' => 'admin.newSubjectCreatePost'
    ]);


    Route::post('new/demo/create/post', [
        'uses' =>'Admin\AdminController@newDemoCreatePost',
        'as' => 'admin.newDemoCreatePost'
    ]);

    Route::get('subject/delete/subject/{subject}', [
        'uses' =>'Admin\AdminController@subjectdelete',
        'as' => 'admin.subjectdelete'
    ]);

    Route::get('demo/edit/demo/{demo}', [
        'uses' =>'Admin\AdminController@demoEdit',
        'as' => 'admin.demoEdit'
    ]);

    Route::post('demo/update/demo/{demo}', [
        'uses' =>'Admin\AdminController@demoUpdate',
        'as' => 'admin.demoUpdate'
    ]);

    Route::get('demo/delete/demo/{demo}', [
        'uses' =>'Admin\AdminController@demodelete',
        'as' => 'admin.demodelete'
    ]);

    Route::get('subjects/all', [
        'uses' =>'Admin\AdminController@subjectsAll',
        'as' => 'admin.subjectsAll'
    ]);

    Route::get('demo/all', [
        'uses' =>'Admin\AdminController@demoAll',
        'as' => 'admin.demoAll'
    ]);

    Route::get('new/post/create', [
        'uses' =>'Admin\AdminController@newPostCreate',
        'as' => 'admin.newPostCreate'
    ]);

    Route::post('new/post/create/post', [
        'uses' =>'Admin\AdminController@newPostCreatePost',
        'as' => 'admin.newPostCreatePost'
    ]);

    Route::get('post/delete/post/{post}', [
        'uses' =>'Admin\AdminController@postdelete',
        'as' => 'admin.postdelete'
    ]);

    Route::get('posts/all', [
        'uses' =>'Admin\AdminController@postsAll',
        'as' => 'admin.postsAll'
    ]);

    Route::get('new/user/create', [
        'uses' =>'Admin\AdminController@newUserCreate',
        'as' => 'admin.newUserCreate'
    ]);

    Route::get('user/delete/{user}', [
        'uses' =>'Admin\AdminController@userDelete',
        'as' => 'admin.userDelete'
    ]);





    Route::post('new/user/create/post', [
        'uses' =>'Admin\AdminController@newUserCreatePost',
        'as' => 'admin.newUserCreatePost'
    ]);

    Route::get('user/edit/user/{user}', [
        'uses' =>'Admin\AdminController@userEdit',
        'as' => 'admin.userEdit'
    ]);

    Route::post('user/update/user/{user}', [
        'uses' =>'Admin\AdminController@userUpdate',
        'as' => 'admin.userUpdate'
    ]);

    Route::get('user/companies/user/{user}', [
        'uses' =>'Admin\AdminController@userCompanies',
        'as' => 'admin.userCompanies'
    ]);

    Route::get('company/products/company/{company}', [
        'uses' =>'Admin\AdminController@companyProducts',
        'as' => 'admin.companyProducts'
    ]);


    Route::get('product/status/company/{company}/device/{macid}', [
        'uses' =>'Admin\AdminController@productStatus',
        'as' => 'admin.productStatus'
    ]);



    Route::get('new/package', [
        'uses' =>'Admin\AdminController@packageCreate',
        'as' => 'admin.packageCreate'
    ]);



    Route::post('membership/package/add/new/post', [
        'uses' => 'Admin\AdminController@membershipPackageAddNewPost',
        'as' => 'admin.membershipPackageAddNewPost'
    ]);

    Route::get('all/membership/packages', [
        'uses' => 'Admin\AdminController@allMembershipPackages',
        'as' => 'admin.allMembershipPackages'
    ]);

    Route::get('all/pendings/user/ads', [
        'uses' => 'Admin\AdminController@allpendingUserAds',
        'as' => 'admin.allpendingUserAds'
    ]);

    Route::get('all/approve/user/ads', [
        'uses' => 'Admin\AdminController@allapproveUserAds',
        'as' => 'admin.allapproveUserAds'
    ]);

    Route::post('post/approve/value/{post}', [
        'uses' => 'Admin\AdminController@postPpPosition',
        'as' => 'postPpPosition'
    ]);

    Route::post('cat/approve/value/{cat}', [
        'uses' => 'Admin\AdminController@catPpPosition',
        'as' => 'catPpPosition'
    ]);

    Route::get('{post}/approve/user/ads', [
        'uses' => 'Admin\AdminController@approveEdit',
        'as' => 'admin.approveEdit'
    ]);


    Route::get('{post}/delete/user/ads', [
        'uses' => 'Admin\AdminController@adsdelete',
        'as' => 'admin.adsdelete'
    ]);

    Route::get('product/settings/company/{company}/device/{macid}', [
        'uses' =>'Admin\AdminController@productSettings',
        'as' => 'admin.productSettings'
    ]);

    Route::get('membership/package/edit/{package}', [
        'uses' => 'Admin\AdminController@membershipPackageEdit',
        'as' => 'admin.membershipPackageEdit'
    ]);

    Route::get('product/version/company/{company}/device/{macid}', [
        'uses' =>'Admin\AdminController@productVersion',
        'as' => 'admin.productVersion'
    ]);
    Route::get('notifications', [
        'uses' =>'Admin\AdminController@allNotifications',
        'as' => 'admin.allNotifications'
    ]);

    Route::post('notifications/post', [
        'uses' =>'Admin\AdminController@notificationPost',
        'as' => 'notificationPost'
    ]);

    Route::get('notifications/delete/{notification}', [
        'uses' =>'Admin\AdminController@NotificationDelete',
        'as' => 'admin.NotificationDelete'
    ]);


    Route::get('mail/{user}', [
        'uses' =>'Admin\AdminController@mail1',
        'as' => 'admin.mail1'
    ]);

    Route::get('mail2/{user}', [
        'uses' =>'Admin\AdminController@mail2',
        'as' => 'admin.mail2'
    ]);

    Route::get('mail3/{user}', [
        'uses' =>'Admin\AdminController@mail3',
        'as' => 'admin.mail3'
    ]);


});

Route::group(['middleware' => ['auth'] ,'prefix' => 'user'], function () {


    Route::get('{post}/update/user/ads', [
        'uses' => 'UserController@approveUpdate',
        'as' => 'admin.approveUpdate'
    ]);

    Route::post('{post}/updatPost/user/ads', [
        'uses' => 'UserController@updatPost',
        'as' => 'user.updatPost'
    ]);
    Route::get('imgDelete/{img}', [
        'uses' => 'UserController@imgDelete',
        'as' => 'imgDelete'
    ]);
    Route::get('files', [
        'uses' =>'UserController@files',
        'as' => 'files'
    ]);


    Route::get('my-posts', [
        'uses' =>'UserController@myPost',
        'as' => 'user.myPost'
    ]);



    Route::get('pay-now/', [
        'uses' => 'UserController@payNow',
        'as' => 'payNow',
    ]);


    Route::post('pay/now/post', [
        'uses' => 'UserController@payNowPost',
        'as' => 'user.payNowPost',
    ]);
    Route::post('ad/post', [
        'uses' => 'UserController@adsPost',
        'as' => 'user.adsPost',
    ]);

    Route::post('ad/pay/{ads}/{title}', [
        'uses' => 'UserController@adsPay',
        'as' => 'ads.Pay',
    ]);

    Route::get('{userAds}/userAdsPost', [
        'uses' => 'UserController@userAdsPost',
        'as' => 'userAdsPost',
    ]);

    Route::get('adsCatPay/{id}/{title}', [
        'uses' => 'UserController@adsCatPay',
        'as' => 'adsCatPay',
    ]);
    Route::get('dashboard', [
        'uses' => 'UserController@dashboard',
        'as' => 'user.dashboard',
    ]);
    Route::get('myAds', [
        'uses' => 'UserController@myAds',
        'as' => 'user.myAds',
    ]);

    Route::get('ads', [
        'uses' => 'UserController@userAds',
        'as' => 'user.ads',
    ]);
});

//company
Route::group(['middleware' => ['role:company','auth'] ,'prefix' => 'company'], function () {

    Route::get('dashboard/company/{company}', [
        'uses' =>'Company\CompanyDashboardController@dashboard',
        'as' => 'company.dashboard'
    ]);

    Route::get('services/all/company/{company}', [
        'uses' =>'Company\CompanyDashboardController@servicesAll',
        'as' => 'company.servicesAll'
    ]);

    Route::get('product/status/company/{company}/device/{macid}', [
        'uses' =>'Company\CompanyDashboardController@productStatus',
        'as' => 'company.productStatus'
    ]);

    Route::get('product/settings/company/{company}/device/{macid}', [
        'uses' =>'Company\CompanyDashboardController@productSettings',
        'as' => 'company.productSettings'
    ]);

    Route::get('product/version/company/{company}/device/{macid}', [
        'uses' =>'Company\CompanyDashboardController@productVersion',
        'as' => 'company.productVersion'
    ]);

    Route::get('company/details/company/{company}', [
        'uses' =>'Company\CompanyDashboardController@companyDetails',
        'as' => 'company.companyDetails'
    ]);


    Route::get('company/details/update/{company}', [
        'uses' =>'Company\CompanyDashboardController@companyDetailsUpdate',
        'as' => 'company.companyDetailsUpdate'
    ]);
    Route::post('company/details/update/post/{company}', [
        'uses' =>'Company\CompanyDashboardController@companyDetailsUpdatePost',
        'as' => 'company.companyDetailsUpdatePost'
    ]);


    Route::get('edit/user/details/company/{company}', [
        'uses' =>'Company\CompanyDashboardController@editUserDetails',
        'as' => 'company.editUserDetails'
    ]);

    Route::post('update/user/details/company/{company}', [
        'uses' =>'Company\CompanyDashboardController@updateUserDetails',
        'as' => 'company.updateUserDetails'
    ]);

    Route::get('edit/user/password/company/{company}', [
        'uses' =>'Company\CompanyDashboardController@editUserPassword',
        'as' => 'company.editUserPassword'
    ]);

    Route::post('update/user/password/company/{company}', [
        'uses' =>'Company\CompanyDashboardController@updateUserPassword',
        'as' => 'company.updateUserPassword'
    ]);

});



