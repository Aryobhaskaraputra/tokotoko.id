<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//guest
Route::middleware(['isGuest'])->group(function(){
    //landing
    Route::get('/', [HomeController::class, 'index'])->name('Landing');
    //register
    Route::get('/register', [RegisterController::class, 'openRegisterPage'])->name('guest.viewRegistration');
    Route::post('/register', [RegisterController::class, 'registration'])->name('guest.method.register');
    //login
    Route::get('/login', [LoginController::class, 'loginindex'])->name('guest.viewLogin');
    Route::post('/login-user', [LoginController::class, 'login'])->name('guest.method.login');
    //password reset
    Route::get('/forgotpassword', [ResetPasswordController::class, 'indexforgot'])->name('guest.viewForgotPassword');
    Route::post('/forgotpassword/check', [ResetPasswordController::class, 'confirmEmail'])->name('guest.method.checkEmail');
    Route::patch('/forgot/password/change', [ResetPasswordController::class, 'updatePassword'])->name('guest.method.updatePassword');
});

Route::middleware(['auth'])->group(function(){
    //logout
    Route::get('/user-logout', [LoginController::class, 'logout'])->name('user.method.logout');
});

//member
Route::middleware(['auth'])->group(function(){
    Route::middleware(['isMember'])->group(function(){
        //homepage
        Route::get('/member/homepage', [HomeController::class, 'indexmember'])->name('member.viewPage');
        //profile
        Route::get('/member/profile', [ProfileController::class, 'showprofilemember'])->name('Member Profile Page');
        Route::get('/member/profileupdate/{id}', [ProfileController::class, 'updateprofilememberindex'])->name('View Update Profile Member');
        Route::put('/member/updateprofile/{id}', [ProfileController::class,'updateprofilemember'])->name('Edit Profile Member');
        Route::get('/member/passwordupdate/{id}', [ProfileController::class, 'updatepasswordmemberindex'])->name('View Update Profile Member');
        Route::post('/member/passwordupdate',  [ProfileController::class, 'updatepasswordmember'])->name('Update Password Member');
        //character + tier list
        Route::get('/member/character', [CharacterController::class, 'charaindexmember'])->name('Member Character Page');
        Route::get('/member/character/search', [CharacterController::class, 'searchformember'])->name('Search Character Member');
        Route::get('/member/character/{id}', [CharacterController::class, 'showcharamember'])->name('View Character Member');
        Route::get('/member/tierlist', [CharacterController::class, 'tierlistmember'])->name('Member Tier List Page');
        //news
        Route::get('/member/news', [NewsController::class, 'newsindexmember'])->name('Member News Page');
        Route::get('/member/news/{id}', [NewsController::class, 'shownewsmember'])->name('View News Member');
        //guide
        Route::get('/member/guide', [GuideController::class, 'guideindexmember'])->name('Member Guide Page');
        Route::get('/member/guide/{id}', [GuideController::class, 'showguidemember'])->name('View Guide Member');
        //blog
        Route::get('/member/blog/search', [BlogController::class, 'searchblogmember'])->name('Search Blog Member');
        Route::post('/member/blog/create', [BlogController::class, 'createnewblog'])->name('Create Blog');
        Route::get('/member/blog/create', [BlogController::class, 'createnewblogpage'])->name('Create Blog Page');
        Route::get('/member/blog', [BlogController::class, 'blogindexmember'])->name('Member Blog Page');
        Route::get('/member/blog/{id}', [BlogController::class, 'showblogmember'])->name('View Blog Member');
        Route::patch('/member/blog/edit/{id}', [BlogController::class, 'editblog'])->name('Edit Blog');
        Route::get('/member/blog/edit/{id}', [BlogController::class, 'editblogpage'])->name('Edit Blog Page');
        Route::delete('/member/blog/{id}/delete', [BlogController::class, 'deleteblogmember'])->name('Delete Blog Member');
    });
});

//admin
Route::middleware(['auth'])->group(function(){
    Route::middleware(['isAdmin'])->group(function(){
        //homepage
        Route::get('/admin/homepage', [HomeController::class, 'indexadmin'])->name('admin.viewAdmin');
        //profile
        Route::get('/admin/profile', [ProfileController::class, 'showprofileadmin'])->name('Admin Profile Page');
        Route::get('/admin/profileupdate/{id}', [ProfileController::class, 'updateprofileadminindex'])->name('View Update Profile Admin');
        Route::put('/admin/updateprofile/{id}', [ProfileController::class,'updateprofileadmin'])->name('Edit Profile Admin');
        Route::get('/admin/passwordupdate/{id}', [ProfileController::class, 'updatepasswordadminindex'])->name('View Update Profile Admin');
        Route::post('/admin/passwordupdate',  [ProfileController::class, 'updatepasswordadmin'])->name('Update Password Admin');
        //user management
        Route::get('/admin/usermanagement', [UserController::class, 'usermanagementindex'])->name('User Management Page');
        Route::delete('/admin/usermanagement/delete/{id}', [UserController::class, 'destroy'])->name('Delete User');
        //character + tier list
        Route::get('/admin/character', [CharacterController::class, 'charaindexadmin'])->name('Admin Character Page');
        Route::get('/admin/character/search', [CharacterController::class, 'searchforadmin'])->name('Search Character Admin');
        Route::get('/admin/character/{id}', [CharacterController::class, 'showcharaadmin'])->name('View Character Admin');
        Route::get('/admin/tierlist', [CharacterController::class, 'tierlistadmin'])->name('Admin Tier List Page');
        Route::get('/admin/characterstore', [CharacterController::class,'charastoreindex'])->name('View Add Character');
        Route::post('/admin/characterstore', [CharacterController::class,'store'])->name('Add Character');
        Route::delete('/admin/character/{id}/delete', [CharacterController::class, 'destroy'])->name('Delete Character');
        Route::get('/admin/characterupdate/{id}', [CharacterController::class,'updatecharaindex'])->name('View Update Character');
        Route::put('/admin/update/{id}', [CharacterController::class,'update'])->name('Edit Character');
        //news
        Route::get('/admin/news', [NewsController::class, 'newsindexadmin'])->name('Admin News Page');
        Route::get('/admin/news/{id}', [NewsController::class, 'shownewsadmin'])->name('View News Admin');
        Route::get('/admin/newsstore', [NewsController::class,'newsstoreindex'])->name('View Add News');
        Route::post('/admin/newsstore', [NewsController::class,'store'])->name('Add News');
        Route::delete('/admin/news/{id}/delete', [NewsController::class, 'destroy'])->name('Delete News');
        Route::get('/admin/newsupdate/{id}', [NewsController::class,'updatenewsindex'])->name('View Update News');
        Route::put('/admin/updatenews/{id}', [NewsController::class,'update'])->name('Edit News');
        //guide
        Route::get('/admin/guide', [GuideController::class, 'guideindexadmin'])->name('Admin Guide Page');
        Route::get('/admin/guide/{id}', [GuideController::class, 'showguideadmin'])->name('View Guide Admin');
        Route::get('/admin/guidestore', [GuideController::class,'guidestoreindex'])->name('View Add Guide');
        Route::post('/admin/guidestore', [GuideController::class,'store'])->name('Add Guide');
        Route::delete('/admin/guide/{id}/delete', [GuideController::class, 'destroy'])->name('Delete Guide');
        Route::get('/admin/guideupdate/{id}', [GuideController::class,'updateguideindex'])->name('View Update Guide');
        Route::put('/admin/updateguide/{id}', [GuideController::class,'update'])->name('Edit Guide');
        //blog
        Route::get('/admin/blog/search', [BlogController::class, 'searchblogadmin'])->name('Search Blog Admin');
        Route::get('/admin/blog', [BlogController::class, 'blogindexadmin'])->name('Admin Blog Page');
        Route::get('/admin/blog/{id}', [BlogController::class, 'showblogadmin'])->name('View Blog Admin');
        Route::delete('/admin/blog/{id}/delete', [BlogController::class, 'deleteblogadmin'])->name('Delete Blog Admin');
    });
});


