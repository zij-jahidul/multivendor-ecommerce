<?php

use App\Http\Controllers\AizUploadController;

//Upload
Route::group(['prefix' => 'seller', 'middleware' => ['seller', 'verified', 'user'], 'as' => 'seller.'], function () {
    Route::controller(AizUploadController::class)->group(function () {
        Route::any('/uploads', 'index')->name('uploaded-files.index');
        Route::any('/uploads/create', 'create')->name('uploads.create');
        Route::any('/uploads/file-info', 'file_info')->name('my_uploads.info');
        Route::get('/uploads/destroy/{id}', 'destroy')->name('my_uploads.destroy');
    });
});

Route::group(['namespace' => 'App\Http\Controllers\Seller', 'prefix' => 'seller', 'middleware' => ['seller', 'verified', 'user'], 'as' => 'seller.'], function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
    });

    // Product
    Route::controller(ProductController::class)->group(function () {
        Route::get('/products', 'index')->name('products');
        Route::get('/product/create', 'create')->name('products.create');
        Route::post('/products/store/', 'store')->name('products.store');
        Route::get('/product/{id}/edit', 'edit')->name('products.edit');
        Route::post('/products/update/{product}', 'update')->name('products.update');
        Route::get('/products/duplicate/{id}', 'duplicate')->name('products.duplicate');
        Route::post('/products/sku_combination', 'sku_combination')->name('products.sku_combination');
        Route::post('/seller/products/sku_combination2', 'sku_combination2')->name('products.sku_combimnation2');
        Route::post('/products/sku_combination_edit', 'sku_combination_edit')->name('products.sku_combination_edit');
        Route::post('/products/add-more-choice-option', 'add_more_choice_option')->name('products.add-more-choice-option');
        Route::post('/products/seller/featured', 'updateFeatured')->name('products.featured');
        Route::post('/products/published', 'updatePublished')->name('products.published');
        Route::get('/products/destroy/{id}', 'destroy')->name('products.destroy');
        Route::get('/seller/products/get/attributes', 'getSellerAttributes')->name('getSellerAttributes');
        Route::get('/products/get/seller/choice/optionsts', 'getChoiceOption')->name('products.get-seller-choice-option');
        Route::post('/seller/products/sku_combination_edit2', 'sku_combination_edit2')->name('products.sku_combination_edit2');
        Route::get('/seller/products/get/choice/optionsts', 'getChoiceOption')->name('products.get-choice-option');
    });

    // Product
    Route::controller(SellerDefaultProductController::class)->group(function () {
        Route::get('/admin-default-products', 'index')->name('default.products');
        Route::get('/admin-default-products-create/{id}', 'create')->name('default.products.create');
        Route::post('/admin-default-products-create', 'update')->name('default.products.update');
        Route::get('/seller/default/product/edit', 'editAttributes')->name('default_product.editAttributes');

        Route::post('/seller-default/product/add-more-choice-option', 'seller_add_more_choice_option')->name('seller_defaults_products.add-more-choice-option');
        Route::post('/seller-defaults/products/sku_combination', 'seller_sku_combination')->name('seller_defaults_products.sku_combination');
        Route::post('/seller-defaults/sku_combination_edit', 'seller_sku_combination_edit')->name('seller_defaults_products.sku_combination_edit');
        Route::get('/seller-defaults/products/get/sku', 'seller_getSku')->name('seller_defaults_products.getSku');

    });

    // Brand
    Route::resource('sellerbrands', SellerBrandController::class);
    Route::controller(SellerBrandController::class)->group(function () {
        Route::get('/sellerbrands/edit/{id}', 'edit')->name('sellerbrands.edit');
        Route::get('/sellerbrands/destroy/{id}', 'destroy')->name('sellerbrands.destroy');
    });

    //Pickup_Points
    Route::resource('pick_up_points', PickupPointController::class);
    Route::controller(PickupPointController::class)->group(function () {
        Route::get('/pick_up_points/edit/{id}', 'edit')->name('pick_up_points.edit');
        Route::get('/pick_up_points/destroy/{id}', 'destroy')->name('pick_up_points.destroy');
    });

     // Product Attribute
    Route::resource('sellerattributes', SellerAttributeController::class);
    Route::controller(SellerAttributeController::class)->group(function () {
        Route::get('/attributes/edit/{id}', 'edit')->name('attributes.edit');
        Route::get('/attributes/destroy/{id}', 'destroy')->name('attributes.destroy');
        // Attribute Value
        Route::post('/store-attribute-value', 'store_attribute_value')->name('store-attribute-value');
        Route::get('/edit-attribute-value/{id}', 'edit_attribute_value')->name('edit-attribute-value');
        Route::post('/update-attribute-value/{id}', 'update_attribute_value')->name('update-attribute-value');
        Route::get('/destroy-attribute-value/{id}', 'destroy_attribute_value')->name('destroy-attribute-value');
        //Colors
        Route::get('/colors', 'colors')->name('colors');
        Route::post('/colors/store', 'store_color')->name('colors.store');
        Route::get('/colors/edit/{id}', 'edit_color')->name('colors.edit');
        Route::post('/colors/update/{id}', 'update_color')->name('colors.update');
        Route::get('/colors/destroy/{id}', 'destroy_color')->name('colors.destroy');
    });

    // Product Bulk Upload
    Route::controller(ProductBulkUploadController::class)->group(function () {
        Route::get('/product-bulk-upload/index', 'index')->name('product_bulk_upload.index');
        Route::post('/product-bulk-upload/store', 'bulk_upload')->name('bulk_product_upload');
        Route::group(['prefix' => 'bulk-upload/download'], function() {
            Route::get('/category', 'pdf_download_category')->name('pdf.download_category');
            Route::get('/brand', 'pdf_download_brand')->name('pdf.download_brand');
        });
    });

    // Digital Product
    Route::controller(DigitalProductController::class)->group(function () {
        Route::get('/digitalproducts', 'index')->name('digitalproducts');
        Route::get('/digitalproducts/create', 'create')->name('digitalproducts.create');
        Route::post('/digitalproducts/store', 'store')->name('digitalproducts.store');
        Route::get('/digitalproducts/{id}/edit', 'edit')->name('digitalproducts.edit');
        Route::post('/digitalproducts/update/{id}', 'update')->name('digitalproducts.update');
        Route::get('/digitalproducts/destroy/{id}', 'destroy')->name('digitalproducts.destroy');
        Route::get('/digitalproducts/download/{id}', 'download')->name('digitalproducts.download');
    });

    //Coupon
    Route::resource('coupon', CouponController::class);
    Route::controller(CouponController::class)->group(function () {
        Route::post('/coupon/get_form', 'get_coupon_form')->name('coupon.get_coupon_form');
        Route::post('/coupon/get_form_edit', 'get_coupon_form_edit')->name('coupon.get_coupon_form_edit');
        Route::get('/coupon/destroy/{id}', 'destroy')->name('coupon.destroy');
    });

    //Order
    Route::resource('orders', OrderController::class);
    Route::controller(OrderController::class)->group(function () {
        Route::post('/orders/update_delivery_status', 'update_delivery_status')->name('orders.update_delivery_status');
        Route::post('/orders/update_payment_status', 'update_payment_status')->name('orders.update_payment_status');
    });

    Route::controller(InvoiceController::class)->group(function () {
        Route::get('/invoice/{order_id}', 'invoice_download')->name('invoice.download');
    });
    // Route::get('invoice/{order_id}',[InvoiceController::class, 'invoice_download'])->name('invoice.download');
    //Review
    Route::controller(ReviewController::class)->group(function () {
        Route::get('/reviews', 'index')->name('reviews');
    });
    // Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews');

    //Shop
    Route::controller(ShopController::class)->group(function () {
        Route::get('/shop', 'index')->name('shop.index');
        Route::post('/shop/update', 'update')->name('shop.update');
        Route::get('/shop/apply_for_verification', 'verify_form')->name('shop.verify');
        Route::post('/shop/verification_info_store', 'verify_form_store')->name('shop.verify.store');
    });

    //Payments
    Route::resource('payments', PaymentController::class);

    // Profile Settings
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'index')->name('profile.index');
        Route::post('/profile/update/{id}', 'update')->name('profile.update');
    });

    // Address
    Route::resource('addresses', AddressController::class);
    Route::controller(AddressController::class)->group(function () {
        Route::post('/get-states', 'getStates')->name('get-state');
        Route::post('/get-cities', 'getCities')->name('get-city');
        Route::post('/address/update/{id}', 'update')->name('addresses.update');
        Route::get('/addresses/destroy/{id}', 'destroy')->name('addresses.destroy');
        Route::get('/addresses/set_default/{id}', 'set_default')->name('addresses.set_default');
    });

    // Money Withdraw Requests
    Route::controller(SellerWithdrawRequestController::class)->group(function () {
        Route::get('/money-withdraw-requests', 'index')->name('money_withdraw_requests.index');
        Route::post('/money-withdraw-request/store', 'store')->name('money_withdraw_request.store');
    });

    // Commission History
    Route::controller(CommissionHistoryController::class)->group(function () {
        Route::get('/commission-history', 'index')->name('commission-history.index');
    });

    //Conversations
    Route::controller(ConversationController::class)->group(function () {
        Route::get('/conversations', 'index')->name('conversations.index');
        Route::get('/conversations/show/{id}', 'show')->name('conversations.show');
        Route::post('conversations/refresh', 'refresh')->name('conversations.refresh');
        Route::post('conversations/message/store', 'message_store')->name('conversations.message_store');
    });

    // product query (comments) show on seller panel
    Route::controller(ProductQueryController::class)->group(function () {
        Route::get('/product-queries', 'index')->name('product_query.index');
        Route::get('/product-queries/{id}', 'show')->name('product_query.show');
        Route::put('/product-queries/{id}', 'reply')->name('product_query.reply');
    });

    // Support Ticket
    Route::controller(SupportTicketController::class)->group(function () {
        Route::get('/support_ticket', 'index')->name('support_ticket.index');
        Route::post('/support_ticket/store', 'store')->name('support_ticket.store');
        Route::get('/support_ticket/show/{id}', 'show')->name('support_ticket.show');
        Route::post('/support_ticket/reply', 'ticket_reply_store')->name('support_ticket.reply_store');
    });

    // Notifications
    Route::controller(NotificationController::class)->group(function () {
        Route::get('/all-notification', 'index')->name('all-notification');
    });


    //shipping routes
    // Countries
    Route::resource('countries', SellerCountryController::class);
    Route::post('/countries/status', [SellerCountryController::class, 'updateStatus'])->name('countries.status');

    // States
    Route::resource('states', SellerStateController::class);
    Route::post('/states/status', [SellerStateController::class, 'updateStatus'])->name('states.status');

    // Zones
    Route::resource('zones', SellerZoneController::class);
    Route::get('/zones/destroy/{id}', [SellerZoneController::class, 'destroy'])->name('zones.destroy');

    Route::resource('cities', SellerCityController::class);
    Route::controller(SellerCityController::class)->group(function () {
        Route::get('/cities/edit/{id}', 'edit')->name('cities.edit');
        Route::get('/cities/editcost/{id}', 'eaditcost')->name('cities.editcost');
        Route::post('/cities/sellerupdate/{id}', 'updateSellerCost')->name('sellercities.update');
        Route::get('/cities/destroy/{id}', 'destroy')->name('cities.destroy');
        Route::post('/cities/status', 'updateStatus')->name('cities.status');
    });

});

