<?php
/*-----VIDA-----*/
Route::get('admin/vi/content/list/{nav}/{action}/{id_retailer_product}', [
    'as' => 'admin.vi.content.list',
    'uses' => 'Admin\ContentAdminController@index_vi'
]);

Route::get('admin/vi/content/edit/{nav}/{action}/{id_retailer_product}/{id_content}', [
    'as' => 'admin.vi.content.edit',
    'uses' => 'Admin\ContentAdminController@edit_vi'
]);

Route::get('admin/vi/content/new/{nav}/{action}/{id_retailer_product}', [
    'as' => 'admin.vi.content.new',
    'uses' => 'Admin\ContentAdminController@index_vi'
]);

Route::post('admin/vi/content/edit', [
    'as' => 'update_content_vi',
    'uses' => 'Admin\ContentAdminController@update_vi'
]);

Route::post('admin/vi/content/new', [
    'as' => 'create_content_vi',
    'uses' => 'Admin\ContentAdminController@store_vi'
]);

/*--------DESGRAVAMEN----------*/
Route::get('admin/de/content/list/{nav}/{action}/{id_retailer_product}', [
    'as' => 'admin.de.content.list',
    'uses' => 'Admin\ContentAdminController@index_de'
]);

Route::get('admin/de/content/edit/{nav}/{action}/{id_retailer_product}/{id_content}', [
    'as' => 'admin.de.content.edit',
    'uses' => 'Admin\ContentAdminController@edit_de'
]);

Route::get('admin/de/content/new/{nav}/{action}/{id_retailer_product}', [
    'as' => 'admin.de.content.new',
    'uses' => 'Admin\ContentAdminController@index_de'
]);

Route::post('admin/de/content/edit', [
    'as' => 'update_content_de',
    'uses' => 'Admin\ContentAdminController@update_de'
]);

Route::post('admin/de/content/new', [
    'as' => 'create_content_de',
    'uses' => 'Admin\ContentAdminController@store_de'
]);

/*---------AUTOMOTORES---------*/
Route::get('admin/au/content/list/{nav}/{action}/{id_retailer_product}', [
    'as' => 'admin.au.content.list',
    'uses' => 'Admin\ContentAdminController@index_au'
]);

Route::get('admin/au/content/new/{nav}/{action}/{id_retailer_product}', [
    'as' => 'admin.au.content.new',
    'uses' => 'Admin\ContentAdminController@index_au'
]);

Route::get('admin/au/content/edit/{nav}/{action}/{id_retailer_product}/{id_content}', [
    'as' => 'admin.au.content.edit',
    'uses' => 'Admin\ContentAdminController@edit_au'
]);


Route::post('admin/au/content/new', [
    'as' => 'create_content_au',
    'uses' => 'Admin\ContentAdminController@store_au'
]);

Route::post('admin/au/content/edit', [
    'as' => 'update_content_au',
    'uses' => 'Admin\ContentAdminController@update_au'
]);

/*-----------MULTIRIESGO-----------*/
Route::get('admin/td/content/list/{nav}/{action}/{id_retailer_product}', [
    'as' => 'admin.td.content.list',
    'uses' => 'Admin\ContentAdminController@index_mr'
]);

Route::get('admin/td/content/new/{nav}/{action}/{id_retailer_product}', [
    'as' => 'admin.td.content.new',
    'uses' => 'Admin\ContentAdminController@index_mr'
]);

Route::get('admin/td/content/edit/{nav}/{action}/{id_retailer_product}/{id_content}', [
    'as' => 'admin.td.content.edit',
    'uses' => 'Admin\ContentAdminController@edit_mr'
]);

Route::post('admin/td/content/new', [
    'as' => 'create_content_mr',
    'uses' => 'Admin\ContentAdminController@store_mr'
]);

Route::post('admin/td/content/edit', [
    'as' => 'update_content_mr',
    'uses' => 'Admin\ContentAdminController@update_mr'
]);