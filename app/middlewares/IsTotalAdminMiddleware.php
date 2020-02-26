<?php

class IsTotalAdminMiddleware {

    public static function handle() {

        return ($GLOBALS["auth"]->user("role") == 1);
    }


    public static function error() {
        error(403);
    }
}