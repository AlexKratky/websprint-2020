<?php

class TotalAdminMiddleware {

    public static function handle() {

        $a = new AuthModel();
        return !($a->isMainAdminSet());
    }


    public static function error() {
        redirect('/login');
    }
}