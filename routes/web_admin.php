<?php

use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


Route::get('/', 'HomeController@index');

Route::group(['middleware' => ['auth']], function () {

    Route::resource('roles', RoleController::class);

    Route::resource('users', UserController::class);

    Route::resource('contact-details', ContactDetailsController::class);

    //subscribers routes
    Route::resource('subscribers', SubscribersController::class);
    Route::post('/subscribers/getData', 'BookingsFailedController@show')->name('subscribers.getData');

    //brands routes

    Route::resource('brands', BrandsController::class);
    Route::post('/brands/order/update', 'BrandsController@updateOrder')->name('brandsOrderUpdate');


    //about us routes

    Route::resource('general', GeneralController::class);
    Route::post('/general/order/update', 'GeneralController@updateOrder')->name('generalOrderUpdate');



    //banners routes

    Route::resource('banners', BannersController::class);
    Route::post('/banners/order/update', 'BannersController@updateOrder')->name('bannersOrderUpdate');

    //sticky images routes
    Route::resource('sticky-images', StickyImagesController::class);
    Route::get('/sticky-images/delete/{id}', 'StickyImagesController@delete')->name('sticky-images.delete');

    //featured products routes
    Route::resource('featured-products', FeaturedProductsController::class);
    Route::post('/featured-products/order/update', 'FeaturedProductsController@updateOrder')->name('featProOrderUpdate');


    //display products routes
    Route::resource('display-products', DisplayProductsController::class);
    Route::post('/display-products/order/update', 'DisplayProductsController@updateOrder')->name('displayProductsOrderUpdate');
    Route::get('/display-products/{id}/products/list', 'DisplayProductsController@productsList')->name('displayProductsList.index');
    Route::get('/display-products/{id}/products/create', 'DisplayProductsController@displayProductsCreate')->name('displayProducts.create');
    Route::post('/display-products/{id}/products/store', 'DisplayProductsController@displayProductsStore')->name('displayProducts.store');
    Route::post('/display-products/{id}/order/update', 'DisplayProductsController@dpUpdateOrder')->name('dpOrderUpdate');
    Route::delete('/display-products/{id}/products/delete', 'DisplayProductsController@deleteDisplayProduct')->name('displayProducts.delete');
    Route::get('/display-products/{id}/products/edit', 'DisplayProductsController@displayProductsEdit')->name('displayProducts.edit');
    Route::patch('/display-products/{id}/products/update', 'DisplayProductsController@displayProductsUpdate')->name('displayProducts.update');
    //blog categories routes
    Route::resource('blog_cat', BlogCategoriesController::class);
    Route::post('/blog_categories/order/update', 'BlogCategoriesController@updateOrder')->name('blogCategoriesOrderUpdate');


    //blogs routes
    Route::resource('blogs', BlogsController::class);
    Route::post('/blogs/order/update', 'BlogsController@updateOrder')->name('blogsOrderUpdate');


    //blogs section routes
    Route::get('/blogs/blogs_section/{blog_id}', 'BlogSectionsController@index')->name('blogs.sections');
    Route::post('/blogs_section/{blog_id}/order/update', 'BlogSectionsController@updateOrder')->name('blogsSectionsOrderUpdate');
    Route::get('/blogs/{blog_id}/section/create', 'BlogSectionsController@create')->name('blogs.sections.create');
    Route::patch('/blogs/{blog_id}/section/submit', 'BlogSectionsController@store')->name('blogs.sections.submit');
    Route::get('/blogs/{blog_id}/section/{section_id}/edit', 'BlogSectionsController@edit')->name('blogs.sections.edit');
    Route::patch('/blogs/{blog_id}/section/{section_id}/update', 'BlogSectionsController@update')->name('blogs.sections.update');
    Route::delete('/blogs/{blog_id}/section/{section_id}/delete', 'BlogSectionsController@destroy')->name('blogs.sections.delete');


    //product categories routes
    Route::resource('categories', CategoriesController::class);
    Route::post('/categories/order/update', 'CategoriesController@updateOrder')->name('categoriesOrderUpdate');


    //Solution Routes
    Route::resource('solutions', SolutionsController::class);
    Route::post('/solutions/order/update', 'SolutionsController@updateOrder')->name('solutionOrderUpdate');


    //product routes
    Route::resource('products', ProductsController::class);
    Route::post('/products/order/update', 'ProductsController@updateOrder')->name('productsOrderUpdate');



    //product items routes
    Route::resource('product-items', ProductItemsController::class);
    Route::post('/product-items/order/update', 'ProductItemsController@updateOrder')->name('productItemsOrderUpdate');
    Route::get('product-items/show-images/{item_id}', 'ProductItemsController@showImages')->name('items.showImages');
    Route::get('product-items/add-images/{item_id}', 'ProductItemsController@addImages')->name('items.addImages');
    Route::post('product-items/save-images/{item_id}', 'ProductItemsController@saveImages')->name('items.saveImages');
    Route::get('product-items/remove-images/{id}', 'ProductItemsController@remImages')->name('items.remImages');
    Route::post('/product-items/images/order/update', 'ProductItemsController@updateImageOrder')->name('itemsImagesOrderUpdate');

    //review routes
    Route::post('/product-items/review-list', 'ProductItemsController@show')->name('items.review');
    Route::get('/product-items/review-edit/{id}', 'ProductItemsController@editReview')->name('review.edit');
    Route::post('/product-items/review-update/{id}', 'ProductItemsController@updateReview')->name('review.update');
    Route::delete('/product-items/review-destroy/{id}', 'ProductItemsController@deleteReview')->name('review.destroy');



    //testimonials routes
    Route::resource('testimonials', TestimonialsController::class);
    Route::post('/testimonials/order/update', 'TestimonialsController@updateOrder')->name('TOrderUpdate');



    Route::resource('meta-tags', MetaTagsController::class, ['only' => ['index', 'showTable', 'edit', 'update']]);
    Route::get('/meta-tags/show-table', 'MetaTagsController@showTable')->name('meta-tags.showTable');


    Route::get('/meta-tags/category', 'CategoriesMetaTagsController@index')->name('meta-tags.category');
    Route::get('/meta-tags/category/create', 'CategoriesMetaTagsController@create')->name('meta-tags.category.create');
    Route::post('/meta-tags/category/store', 'CategoriesMetaTagsController@store')->name('meta-tags.category.store');
    Route::get('/meta-tags/category/show-table', 'CategoriesMetaTagsController@showTable')->name('meta-tags.category.showTable');
    Route::get('/meta-tags/category/edit/{id}', 'CategoriesMetaTagsController@edit')->name('meta-tags.category.edit');
    Route::patch('/meta-tags/category/update/{id}', 'CategoriesMetaTagsController@update')->name('meta-tags.category.update');



    Route::get('/meta-tags/item', 'ItemMetaTagsController@index')->name('meta-tags.item');
    Route::get('/meta-tags/item/create', 'ItemMetaTagsController@create')->name('meta-tags.item.create');
    Route::post('/meta-tags/item/store', 'ItemMetaTagsController@store')->name('meta-tags.item.store');
    Route::get('/meta-tags/item/show-table', 'ItemMetaTagsController@showTable')->name('meta-tags.item.showTable');
    Route::get('/meta-tags/item/edit/{id}', 'ItemMetaTagsController@edit')->name('meta-tags.item.edit');
    Route::patch('/meta-tags/item/update/{id}', 'ItemMetaTagsController@update')->name('meta-tags.item.update');

    // artist category
    Route::get('/meta-tags/artist-category', 'ArtistCategoryMetaTagsController@index')->name('meta-tags.artist-category');
    Route::get('/meta-tags/artist-category/create', 'ArtistCategoryMetaTagsController@create')->name('meta-tags.artist-category.create');
    Route::post('/meta-tags/artist-category/store', 'ArtistCategoryMetaTagsController@store')->name('meta-tags.artist-category.store');
    Route::get('/meta-tags/artist-category/show-table', 'ArtistCategoryMetaTagsController@showTable')->name('meta-tags.artist-category.showTable');
    Route::get('/meta-tags/artist-category/edit/{id}', 'ArtistCategoryMetaTagsController@edit')->name('meta-tags.artist-category.edit');
    Route::patch('/meta-tags/artist-category/update/{id}', 'ArtistCategoryMetaTagsController@update')->name('meta-tags.artist-category.update');

    //blog
    Route::get('/meta-tags/blog', 'BlogMetaTagsController@index')->name('meta-tags.blog');
    Route::get('/meta-tags/blog/create', 'BlogMetaTagsController@create')->name('meta-tags.blog.create');
    Route::post('/meta-tags/blog/store', 'BlogMetaTagsController@store')->name('meta-tags.blog.store');
    Route::get('/meta-tags/blog/show-table', 'BlogMetaTagsController@showTable')->name('meta-tags.blog.showTable');
    Route::get('/meta-tags/blog/edit/{id}', 'BlogMetaTagsController@edit')->name('meta-tags.blog.edit');
    Route::patch('/meta-tags/blog/update/{id}', 'BlogMetaTagsController@update')->name('meta-tags.blog.update');


    //blog category
    Route::get('/meta-tags/blog-category', 'BlogCategoriesMetaTagsController@index')->name('meta-tags.blog-category');
    Route::get('/meta-tags/blog-category/create', 'BlogCategoriesMetaTagsController@create')->name('meta-tags.blog-category.create');
    Route::post('/meta-tags/blog-category/store', 'BlogCategoriesMetaTagsController@store')->name('meta-tags.blog-category.store');
    Route::get('/meta-tags/blog-category/show-table', 'BlogCategoriesMetaTagsController@showTable')->name('meta-tags.blog-category.showTable');
    Route::get('/meta-tags/blog-category/edit/{id}', 'BlogCategoriesMetaTagsController@edit')->name('meta-tags.blog-category.edit');
    Route::patch('/meta-tags/blog- category/update/{id}', 'BlogCategoriesMetaTagsController@update')->name('meta-tags.blog-category.update');

    //enquiry routes
    Route::resource('enquiry', EnquiryController::class);
    Route::post('/enquiry/getData', 'EnquiryController@show')->name('enquiry.getData');

    //careers routes
    Route::get('/careers/applications', 'CareersController@applications')->name('careers.applications');
    Route::post('/careers/order/update', 'CareersController@updateOrder')->name('careersOrderUpdate');
    Route::resource('careers', CareersController::class);
});
