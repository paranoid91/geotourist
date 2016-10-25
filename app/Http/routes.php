<?php

//main pages
Route::get("/", "PagesController@index");
Route::post("/", "PagesController@saveMail");
Route::get("contact", "PagesController@contact");
Route::get("tours-gallery", "PagesController@toursGallery");
Route::get("events-gallery", "PagesController@eventsGallery");
Route::get("gallery", "PagesController@showWholeGallery");
Route::get("about", "PagesController@about");
Route::post("contact", "PagesController@sendEmail");

//events
Route::get("events", "EventsController@index");
Route::get("events/{id}", "EventsController@show");
Route::post("events/{id}", "Auth\AuthController@handleComment");
Route::get("events/category/{id}", "EventsController@showCatgories");


//tours pages
Route::get("tours", "ToursController@showAllTours");
Route::get("tours-regular", "ToursController@showTours");
Route::get("tours-exclusive", "ToursController@showExTours");
Route::get("tours/{id}","ToursController@show");
Route::post("tours/{id}","Auth\AuthController@handleComment");


//cars
Route::get("cars", "CarsController@index");
Route::get("cars-list/{id}", "CarsController@showList");
Route::get("cars/{id}", "CarsController@show");

//login, logout to admin panel
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');

//login to facebook
Route::get('facebook', 'Auth\AuthController@redirectToProvider');
Route::get('callback', 'Auth\AuthController@handleProviderCallback');
//Route::get('social-login', 'Auth\AuthController@handleComment');

//login to vk
Route::get("vk-callback", "Auth\AuthController@authVK");

//admin panel

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
//Route::group(['prefix' => 'admin'], function () {
    Route::get("/","AdminController@index");
    //tours
    Route::get("tours","AdminToursController@index");
    Route::get("add","AdminToursController@create");
    Route::get("tours/{id}/edit/removeTourImage/{img}", 'AdminToursController@removeTourImage');
    Route::get("tours/{id}/edit/removeGalleryPic/{pics}", 'AdminToursController@removeGalleryPic');
    Route::get("tours/{id}/edit/removeVideo/{links}", 'AdminToursController@removeVideo');
    Route::get("tours/{id}/edit/addToGallery/{gallery}/{data_type}", 'AdminToursController@addToGallery');
    Route::get("tours/{id}/edit","AdminToursController@edit");

    Route::post("tours", "AdminToursController@store");
    Route::post("tours/{id}/update", "AdminToursController@update");
    Route::get("tours/delete/{id}", "AdminToursController@destroy");

    Route::post("tours-image", "AdminToursController@storeImages");

    //filter comments
    Route::get("filter-tours", "AdminToursController@showAllToursFilter");
    Route::get("filter-tours/show/","AdminToursController@showFilter");
    Route::get("filter-tours/remove/{id}","AdminToursController@removeCommment");

    //page editor
    //main page
    Route::get("pages/main", "AdminController@mainPage");
    Route::get("pages/main/slider/delete/{id}", "AdminController@removeSliderPic");
    Route::post("pages/main", "AdminController@addSliderImage");
    Route::get("pages/main/texts", "AdminController@mainTexts");
    Route::post("pages/main/texts", "AdminController@updateTexts");

    //gallery
    Route::get("pages/gallery", "AdminController@galleryPage");
    Route::get("pages/gallery/tours-gallery", "AdminController@showToursGallery");
    Route::get("pages/gallery/events-gallery", "AdminController@showEventsGallery");
    Route::get("pages/gallery/tours-gallery/{gallery}/{data_type}", "AdminController@removeFromToursGallery");
    Route::get("pages/gallery/events-gallery/{gallery}/{data_type}", "AdminController@removeFromEventsGallery");

    Route::get("pages/about", "AdminController@aboutPage");
    Route::post("pages/about", "AdminController@updateAboutText");

    //events
    Route::get("events","AdminEventsController@index");
    Route::get("events/categories","AdminEventsController@categories");
    Route::get("events/add","AdminEventsController@create");
    Route::get("events/text","AdminEventsController@mainText");
    Route::post("events/text","AdminEventsController@saveText");
    Route::post("events/add","AdminEventsController@store");
    Route::post("events-image", "AdminEventsController@storeImagez");
    Route::get("events/{id}/edit/removeTourImage/{img}", 'AdminEventsController@removeTourImage');
    Route::get("events/{id}/edit/removeGalleryPic/{pics}", 'AdminEventsController@removeGalleryPic');
    Route::get("events/{id}/edit/addToGallery/{gallery}/{data_type}", 'AdminEventsController@addToGallery');
    Route::get("events/{id}/edit/removeVideo/{links}", 'AdminEventsController@removeVideo');
    Route::get("events/delete/{id}", "AdminEventsController@destroy");
    Route::get("events/{id}/edit","AdminEventsController@edit");
    Route::get("events/slider", "AdminEventsController@showEventsSlider");
    Route::post("events/slider", "AdminEventsController@addSliderImg");
    Route::get("events/slider/remove/{id}", "AdminEventsController@removeSliderImg");

    //filter comments
    Route::get("filter-events", "AdminEventsController@showAllToursFilter");
    Route::get("filter-events/show/","AdminEventsController@showFilter");
    Route::get("filter-events/remove/{id}","AdminEventsController@removeCommment");

    Route::post("events/{id}/update", "AdminEventsController@update");

    //event categories
    Route::post("events/categories", "AdminEventsController@catAdd");
    Route::get("events/categories/{id}", "AdminEventsController@catShow");
    Route::get("events/categories/update/{id}/remove-image", "AdminEventsController@removeCatImage");
    Route::post("events/categories/update/{id}", "AdminEventsController@catUpdate");
    Route::get("events/categories/delete-rem/{id}", "AdminEventsController@catDelete");

    //cars
    Route::get("cars", "AdminCarsController@index");

    Route::get("cars/removeBG", "AdminCarsController@removeBG");
    Route::post("cars/updateBG", "AdminCarsController@updateBG");

    Route::get("cars/add", "AdminCarsController@create");
    Route::post("cars/add", "AdminCarsController@store");
    Route::post("cars-image", "AdminCarsController@storeImage");
    Route::get("cars/edit/{id}", "AdminCarsController@edit");
    Route::get("cars/delete/{id}", "AdminCarsController@destroy");
    Route::post("cars/edit/{id}", "AdminCarsController@update");
    Route::get("cars/edit/{id}/removeImg", "AdminCarsController@removeCarImage");
    Route::get("cars/{id}/edit/removeGalleryPic/{gallery}", "AdminCarsController@removeGalleryPic");
        //categories
    Route::get("cars/categories", "AdminCarsController@categories");
    Route::post("cars/categories", "AdminCarsController@catAdd");
    Route::get("cars/categories/edit/{id}/removeCatImg", "AdminCarsController@removeCatImg");
    Route::get("cars/categories/edit/{id}", "AdminCarsController@catShow");
    Route::post("cars/categories/edit/{id}", "AdminCarsController@catUpdate");
    Route::get("events/categories/delete/{id}", "AdminCarsController@catDelete");

    //places
    Route::get("places", "AdminController@placesIndex");
    Route::get("places/add", "AdminController@placesAdd");
    Route::post("places/add","AdminController@placesStore");
    Route::get("places/delete/{id}","AdminController@placesDestroy");
    Route::get("places/edit/{id}","AdminController@placesEdit");
    Route::get("places/edit/remove/{id}","AdminController@placesRemoveImg");
    Route::post("places/edit/{id}","AdminController@placesUpdate");


    Route::get("places/mails","AdminController@showMails");
    Route::get("places/mails-send","AdminController@sendMail");
    Route::post("places/mails-send","AdminController@sendMessage");
    Route::get("places/mails/{id}/delete","AdminController@removeMail");
});
