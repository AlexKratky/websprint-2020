<?php
Route::set('/_admin', "TotalAdmin/create_main_admin.latte")->setLocalOnly()->setMiddleware(["TotalAdminMiddleware"]);
Route::set('/_admin/save', function() {
    $am = new AuthModel();
    if($am->setRoleByName($_POST["username"], 1)) {
        redirect('/_admin');//?
    } else {
        // display err?
        redirect('/_admin');
    }
}, ["POST"])->setLocalOnly()->setMiddleware(["TotalAdminMiddleware"])->setAlias("main-admin-save")->setRequiredParameters([], ["username"]);



Route::set('/_admin/view', "TotalAdmin/view.latte")->setMiddleware(["IsTotalAdminMiddleware"])->setAlias("view-roles")->setController("TotalAdminController");
Route::set('/_admin/view/save', function() {
    $am = new AuthModel();
    $request = $GLOBALS["request"];
    $am->createRole($request->getPost("name"), $request->getPost("value"), $request->getPost("landing"));
    redirect("/_admin/view");
}, ["POST"])->setMiddleware(["IsTotalAdminMiddleware"])->setAlias("view-roles-save")->setRequiredParameters([], ["name", "value"]);
Route::set('/_admin/view/delete/{ID}', function() {
    $am = new AuthModel();
    $am->deleteRole(Route::getValue("ID"));
    redirect("/_admin/view");
})->setMiddleware(["IsTotalAdminMiddleware"])->setAlias("view-roles-delete");



Route::set('/_admin/view/permissions', "TotalAdmin/view-permissions.latte")->setMiddleware(["IsTotalAdminMiddleware"])->setAlias("view-permissions")->setController("TotalAdminController");
Route::set('/_admin/view/permissions/save', function() {
    $am = new AuthModel();
    $request = $GLOBALS["request"];
    $am->createPermission($request->getPost("permission"));
    redirect("/_admin/view/permissions");
}, ["POST"])->setMiddleware(["IsTotalAdminMiddleware"])->setAlias("view-permissions-save")->setRequiredParameters([], ["permission"]);
Route::set('/_admin/view/permissions/delete/{ID}', function() {
    $am = new AuthModel();
    $am->deletePermission(Route::getValue("ID"));
    redirect("/_admin/view/permissions");
})->setMiddleware(["IsTotalAdminMiddleware"])->setAlias("view-permissions-delete");


Route::set('/_admin/view/users', "TotalAdmin/view-users.latte")->setMiddleware(["IsTotalAdminMiddleware"])->setAlias("view-users")->setController("TotalAdminController");
Route::set('/_admin/view/users/search', function() {
    $tam = new TotalAdminModel();
    $request = $GLOBALS["request"];
    if(empty($request->getPost("query"))) {
        $r = $tam->selectUsers();
    } else {
        $r = $tam->searchUsers($request->getPost("query"));
    }
    echo json(json_encode($r));
    //redirect("/_admin/view/permissions");
})->setMiddleware(["IsTotalAdminMiddleware"])->setAlias("view-users-search");
Route::set('/_admin/view/users/edit/{ID}', "TotalAdmin/view-users-edit.latte")->setMiddleware(["IsTotalAdminMiddleware"])->setAlias("view-users-edit")->setController("TotalAdminController");
Route::set('/_admin/view/users/edit/{ID}/save', function() {
    $am = new AuthModel();
    $request = $GLOBALS["request"];
    $am->setPermissions(Route::getValue("ID"), $request->getPost("permissions"));
    if($request->getPost("role") > 1 && $request->getPost("role") < 101)
    $am->setRole(Route::getValue("ID"), $request->getPost("role"));
    redirect("/_admin/view/users/edit/".Route::getValue("ID"));
}, ["POST"])->setMiddleware(["IsTotalAdminMiddleware"])->setAlias("view-users-edit-save")->setRequiredParameters([], ["role"]);
