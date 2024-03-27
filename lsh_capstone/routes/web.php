<?php

use App\Http\Controllers\Admin\AdminAmenityController;
use App\Http\Controllers\Admin\AdminPageController;
use App\Http\Controllers\Admin\AdminFaqController;
use App\Http\Controllers\Admin\AdminFeatureController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminPhotoController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminRoomController;
use App\Http\Controllers\Admin\AdminSlideController;
use App\Http\Controllers\Admin\AdminSubscriberController;
use App\Http\Controllers\Admin\AdminTestimonialController;
use App\Http\Controllers\Admin\AdminVideoController;
use App\Http\Controllers\Front\AboutController;
use App\Http\Controllers\Front\BlogController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\FaqController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\PhotoController;
use App\Http\Controllers\Front\PrivacyController;
use App\Http\Controllers\Front\SubscriberController;
use App\Http\Controllers\Front\TermsController;
use App\Http\Controllers\Front\VideoController;
use App\Models\Video;
// use App\Http\Controllers\Customer\WebsiteController;
use Illuminate\Support\Facades\Route;


/* Front */
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::get('/blog', [BlogController::class, 'index'])->name('blog');

Route::get('/post/{id}', [BlogController::class, 'single_post'])->name('single_post');

Route::get('/photo-gallery', [PhotoController::class, 'index'])->name('photo_gallery');

Route::get('/video-gallery', [VideoController::class, 'index'])->name('video_gallery');

Route::get('/faq', [FaqController::class, 'index'])->name('faq');

Route::get('/terms-and-conditions', [TermsController::class, 'index'])->name('terms');

Route::get('/privacy-policy', [PrivacyController::class, 'index'])->name('privacy');


Route::get('/contact', [ContactController::class, 'index'])->name('contact');

Route::post('/contact/send-email', [ContactController::class, 'send_email'])->name('contact_send_email');

Route::post('/subscriber/send-email', [SubscriberController::class, 'send_email'])->name('subscriber_send_email');

Route::get('/subscriber/verify/{email}/{token}', [SubscriberController::class, 'verify'])->name('subscriber_verify');

/* Sample Customer Login Routes */ 
// Route::get('/', [WebsiteController::class, 'index'])->name('home');

// Route::get('/register', [WebsiteController::class, 'register'])->name('register');

// Route::get('/login', [WebsiteController::class, 'login'])->name('login');

/* Admin Routes */

Route::get('/admin/home', [AdminHomeController::class, 'index'])->name('admin_home')->middleware('admin:admin');

Route::get('/admin/login', [AdminLoginController::class, 'index'])->name('admin_login');

Route::get('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin_logout');

Route::post('/admin/login-submit', [AdminLoginController::class, 'loginSubmit'])->name('admin_login_submit');

Route::get('/admin/forget-password', [AdminLoginController::class, 'forgetPassword'])->name('admin_forget_password');

Route::post('/admin/forget-password-submit', [AdminLoginController::class, 'forgetPasswordSubmit'])->name('admin_forget_password_submit');

Route::get('/admin/reset-password/{token}/{email}', [AdminLoginController::class, 'resetPassword'])->name('admin_reset_password');

Route::post('/admin/reset-password-submit', [AdminLoginController::class, 'resetPasswordSubmit'])->name('admin_reset_password_submit');


Route::get('/admin/edit-profile', [AdminProfileController::class, 'index'])->middleware('admin:admin')->name('admin_profile');

Route::post('/admin/edit-profile-submit', [AdminProfileController::class, 'profileSubmit'])->middleware('admin:admin')->name('admin_profile_submit');



Route::get('/admin/slide/view', [AdminSlideController::class, 'index'])->name('admin_slide_view')->middleware('admin:admin');

Route::get('/admin/slide/add', [AdminSlideController::class, 'add'])->name('admin_slide_add')->middleware('admin:admin');

Route::post('/admin/slide/store', [AdminSlideController::class, 'store'])->name('admin_slide_store')->middleware('admin:admin');

Route::get('/admin/slide/edit/{id}', [AdminSlideController::class, 'edit'])->name('admin_slide_edit')->middleware('admin:admin');

Route::post('/admin/slide/update/{id}', [AdminSlideController::class, 'update'])->name('admin_slide_update')->middleware('admin:admin');

Route::get('/admin/slide/delete/{id}', [AdminSlideController::class, 'delete'])->name('admin_slide_delete')->middleware('admin:admin');



Route::get('/admin/feature/view', [AdminFeatureController::class, 'index'])->name('admin_feature_view')->middleware('admin:admin');

Route::get('/admin/feature/add', [AdminFeatureController::class, 'add'])->name('admin_feature_add')->middleware('admin:admin');

Route::post('/admin/feature/store', [AdminFeatureController::class, 'store'])->name('admin_feature_store')->middleware('admin:admin');

Route::get('/admin/feature/edit/{id}', [AdminFeatureController::class, 'edit'])->name('admin_feature_edit')->middleware('admin:admin');

Route::post('/admin/feature/update/{id}', [AdminFeatureController::class, 'update'])->name('admin_feature_update')->middleware('admin:admin');

Route::get('/admin/feature/delete/{id}', [AdminFeatureController::class, 'delete'])->name('admin_feature_delete')->middleware('admin:admin');



Route::get('/admin/testimonial/view', [AdminTestimonialController::class, 'index'])->name('admin_testimonial_view')->middleware('admin:admin');

Route::get('/admin/testimonial/add', [AdminTestimonialController::class, 'add'])->name('admin_testimonial_add')->middleware('admin:admin');

Route::post('/admin/testimonial/store', [AdminTestimonialController::class, 'store'])->name('admin_testimonial_store')->middleware('admin:admin');

Route::get('/admin/testimonial/edit/{id}', [AdminTestimonialController::class, 'edit'])->name('admin_testimonial_edit')->middleware('admin:admin');

Route::post('/admin/testimonial/update/{id}', [AdminTestimonialController::class, 'update'])->name('admin_testimonial_update')->middleware('admin:admin');

Route::get('/admin/testimonial/delete/{id}', [AdminTestimonialController::class, 'delete'])->name('admin_testimonial_delete')->middleware('admin:admin');



Route::get('/admin/post/view', [AdminPostController::class, 'index'])->name('admin_post_view')->middleware('admin:admin');

Route::get('/admin/post/add', [AdminPostController::class, 'add'])->name('admin_post_add')->middleware('admin:admin');

Route::post('/admin/post/store', [AdminPostController::class, 'store'])->name('admin_post_store')->middleware('admin:admin');

Route::get('/admin/post/edit/{id}', [AdminPostController::class, 'edit'])->name('admin_post_edit')->middleware('admin:admin');

Route::post('/admin/post/update/{id}', [AdminPostController::class, 'update'])->name('admin_post_update')->middleware('admin:admin');

Route::get('/admin/post/delete/{id}', [AdminPostController::class, 'delete'])->name('admin_post_delete')->middleware('admin:admin');



Route::get('/admin/photo/view', [AdminPhotoController::class, 'index'])->name('admin_photo_view')->middleware('admin:admin');

Route::get('/admin/photo/add', [AdminPhotoController::class, 'add'])->name('admin_photo_add')->middleware('admin:admin');

Route::post('/admin/photo/store', [AdminPhotoController::class, 'store'])->name('admin_photo_store')->middleware('admin:admin');

Route::get('/admin/photo/edit/{id}', [AdminPhotoController::class, 'edit'])->name('admin_photo_edit')->middleware('admin:admin');

Route::post('/admin/photo/update/{id}', [AdminPhotoController::class, 'update'])->name('admin_photo_update')->middleware('admin:admin');

Route::get('/admin/photo/delete/{id}', [AdminPhotoController::class, 'delete'])->name('admin_photo_delete')->middleware('admin:admin');



Route::get('/admin/video/view', [AdminVideoController::class, 'index'])->name('admin_video_view')->middleware('admin:admin');

Route::get('/admin/video/add', [AdminVideoController::class, 'add'])->name('admin_video_add')->middleware('admin:admin');

Route::post('/admin/video/store', [AdminVideoController::class, 'store'])->name('admin_video_store')->middleware('admin:admin');

Route::get('/admin/video/edit/{id}', [AdminVideoController::class, 'edit'])->name('admin_video_edit')->middleware('admin:admin');

Route::post('/admin/video/update/{id}', [AdminVideoController::class, 'update'])->name('admin_video_update')->middleware('admin:admin');

Route::get('/admin/video/delete/{id}', [AdminVideoController::class, 'delete'])->name('admin_video_delete')->middleware('admin:admin');


Route::get('/admin/faq/view', [AdminFaqController::class, 'index'])->name('admin_faq_view')->middleware('admin:admin');

Route::get('/admin/faq/add', [AdminFaqController::class, 'add'])->name('admin_faq_add')->middleware('admin:admin');

Route::post('/admin/faq/store', [AdminFaqController::class, 'store'])->name('admin_faq_store')->middleware('admin:admin');

Route::get('/admin/faq/edit/{id}', [AdminFaqController::class, 'edit'])->name('admin_faq_edit')->middleware('admin:admin');

Route::post('/admin/faq/update/{id}', [AdminFaqController::class, 'update'])->name('admin_faq_update')->middleware('admin:admin');

Route::get('/admin/faq/delete/{id}', [AdminFaqController::class, 'delete'])->name('admin_faq_delete')->middleware('admin:admin');


Route::get('/admin/page/about', [AdminPageController::class, 'about'])->name('admin_about_page')->middleware('admin:admin');

Route::post('/admin/page/about/update', [AdminPageController::class, 'about_update'])->name('admin_about_page_update')->middleware('admin:admin');

Route::get('/admin/page/terms', [AdminPageController::class, 'terms'])->name('admin_terms_page')->middleware('admin:admin');

Route::post('/admin/page/terms/update', [AdminPageController::class, 'terms_update'])->name('admin_terms_page_update')->middleware('admin:admin');

Route::get('/admin/page/privacy', [AdminPageController::class, 'privacy'])->name('admin_privacy_page')->middleware('admin:admin');

Route::post('/admin/page/privacy/update', [AdminPageController::class, 'privacy_update'])->name('admin_privacy_page_update')->middleware('admin:admin');







Route::get('/admin/page/contact', [AdminPageController::class, 'contact'])->name('admin_contact_page')->middleware('admin:admin');

Route::post('/admin/page/contact/update', [AdminPageController::class, 'contact_update'])->name('admin_contact_page_update')->middleware('admin:admin');


Route::get('/admin/page/photo-gallery', [AdminPageController::class, 'photo_gallery'])->name('admin_photo_gallery_page')->middleware('admin:admin');

Route::post('/admin/page/photo-gallery/update', [AdminPageController::class, 'photo_gallery_update'])->name('admin_photo_gallery_page_update')->middleware('admin:admin');

Route::get('/admin/page/video-gallery', [AdminPageController::class, 'video_gallery'])->name('admin_video_gallery_page')->middleware('admin:admin');

Route::post('/admin/page/video-gallery/update', [AdminPageController::class, 'video_gallery_update'])->name('admin_video_gallery_page_update')->middleware('admin:admin');


Route::get('/admin/page/faq', [AdminPageController::class, 'faq'])->name('admin_faq_page')->middleware('admin:admin');

Route::post('/admin/page/faq/update', [AdminPageController::class, 'faq_update'])->name('admin_faq_page_update')->middleware('admin:admin');


Route::get('/admin/page/blog', [AdminPageController::class, 'blog'])->name('admin_blog_page')->middleware('admin:admin');

Route::post('/admin/page/blog/update', [AdminPageController::class, 'blog_update'])->name('admin_blog_page_update')->middleware('admin:admin');


Route::get('/admin/page/cart', [AdminPageController::class, 'cart'])->name('admin_cart_page')->middleware('admin:admin');

Route::post('/admin/page/cart/update', [AdminPageController::class, 'cart_update'])->name('admin_cart_page_update')->middleware('admin:admin');


Route::get('/admin/page/checkout', [AdminPageController::class, 'checkout'])->name('admin_checkout_page')->middleware('admin:admin');

Route::post('/admin/page/checkout/update', [AdminPageController::class, 'checkout_update'])->name('admin_checkout_page_update')->middleware('admin:admin');

Route::get('/admin/page/payment', [AdminPageController::class, 'payment'])->name('admin_payment_page')->middleware('admin:admin');

Route::post('/admin/page/payment/update', [AdminPageController::class, 'payment_update'])->name('admin_payment_page_update')->middleware('admin:admin');


Route::get('/admin/page/signup', [AdminPageController::class, 'signup'])->name('admin_signup_page')->middleware('admin:admin');

Route::post('/admin/page/signup/update', [AdminPageController::class, 'signup_update'])->name('admin_signup_page_update')->middleware('admin:admin');


Route::get('/admin/page/signin', [AdminPageController::class, 'signin'])->name('admin_signin_page')->middleware('admin:admin');

Route::post('/admin/page/signin/update', [AdminPageController::class, 'signin_update'])->name('admin_signin_page_update')->middleware('admin:admin');


Route::get('/admin/subscriber/show', [AdminSubscriberController::class, 'index'])->name('admin_subscriber_show')->middleware('admin:admin');

Route::get('/admin/subscriber/send-email', [AdminSubscriberController::class, 'send_email'])->name('admin_subscriber_send_email')->middleware('admin:admin');

Route::post('/admin/subscriber/send-email-submit', [AdminSubscriberController::class, 'submit_email'])->name('admin_subscriber_submit_email')->middleware('admin:admin');




Route::get('/admin/amenity/view', [AdminAmenityController::class, 'index'])->name('admin_amenity_view')->middleware('admin:admin');

Route::get('/admin/amenity/add', [AdminAmenityController::class, 'add'])->name('admin_amenity_add')->middleware('admin:admin');

Route::post('/admin/amenity/store', [AdminAmenityController::class, 'store'])->name('admin_amenity_store')->middleware('admin:admin');

Route::get('/admin/amenity/edit/{id}', [AdminAmenityController::class, 'edit'])->name('admin_amenity_edit')->middleware('admin:admin');

Route::post('/admin/amenity/update/{id}', [AdminAmenityController::class, 'update'])->name('admin_amenity_update')->middleware('admin:admin');

Route::get('/admin/amenity/delete/{id}', [AdminAmenityController::class, 'delete'])->name('admin_amenity_delete')->middleware('admin:admin');




Route::get('/admin/room/view', [AdminRoomController::class, 'index'])->name('admin_room_view')->middleware('admin:admin');

Route::get('/admin/room/add', [AdminRoomController::class, 'add'])->name('admin_room_add')->middleware('admin:admin');

Route::post('/admin/room/store', [AdminRoomController::class, 'store'])->name('admin_room_store')->middleware('admin:admin');

Route::get('/admin/room/edit/{id}', [AdminRoomController::class, 'edit'])->name('admin_room_edit')->middleware('admin:admin');

Route::post('/admin/room/update/{id}', [AdminRoomController::class, 'update'])->name('admin_room_update')->middleware('admin:admin');

Route::get('/admin/room/delete/{id}', [AdminRoomController::class, 'delete'])->name('admin_room_delete')->middleware('admin:admin');

Route::get('/admin/room/gallery/edit/{id}', [AdminRoomController::class, 'gallery'])->name('admin_room_gallery')->middleware('admin:admin');

Route::post('/admin/room/gallery/store/{id}', [AdminRoomController::class, 'gallery_store'])->name('admin_room_gallery_store')->middleware('admin:admin');

Route::get('/admin/room/gallery/delete/{id}', [AdminRoomController::class, 'gallery_delete'])->name('admin_room_gallery_delete')->middleware('admin:admin');