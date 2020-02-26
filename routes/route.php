<?php
Route::set('/', "home.latte")->setTitle("NAUČ.MĚ")->setAlias('home');
Route::set('/list', "list.latte")->setTitle("Procházení lektorů")->setAlias('list')->setController("MainController#list");
Route::set('/list/detail/{ID}', "list_detail.latte")->setTitle("Detail")->setAlias('list_detail')->setController("MainController#detail");
Route::set('/list/detail/{ID}/contact', "list_contact.latte")->setTitle("Kontakt")->setAlias('list_contact')->setController("MainController#contact");
Route::set('/list/detail/{ID}/send', null)->setAlias('list_contact_send')->setController("MainController#contactSend");
Route::set('/canditates', "candidates.latte")->setTitle("Procházení zájemců")->setAlias('canditates')->setController("MainController#candidates")->setMiddleware(["AuthMiddleware"]);
