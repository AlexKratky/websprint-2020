<?php
class TotalAdminController
{
    private static $handler;
    private static $authModel;
    private static $auth;
    private static $totalAdminModel;

    public static function main($handler) {
        self::$handler = $handler;
        self::$authModel = new AuthModel();
        self::$auth = $GLOBALS["auth"];
        self::$totalAdminModel = new TotalAdminModel();

        if (Route::getAlias() !== null) {

            switch(Route::getAlias()) {
                case 'view-roles':
                    self::roles();  
                    break;
                case 'view-permissions':
                    self::permissions();
                    break;
                case 'view-users':
                    self::users();
                    break;
                case 'view-users-edit':
                    self::edit();
                break;
                default:
                    self::def();

            }
        }
    }

    public static function roles() {
        self::$handler::setParameters([
            'roles'=>self::$totalAdminModel->selectAllRoles(),
        ]);
    }

    public static function permissions() {
        self::$handler::setParameters([
            'permissions'=>self::$totalAdminModel->selectAllPermissions(),
        ]);
    }

    public static function users() {
        self::$handler::setParameters([
            'users'=>self::$totalAdminModel->selectUsers(),
        ]);
    }

    public static function edit() {
        self::$handler::setParameters([
            'user'=>self::$totalAdminModel->selectUser(Route::getValue("ID")),
            'permissions'=>self::$totalAdminModel->selectAllPermissions(),
        ]);
    }

    public static function def() {
        
    }
}
