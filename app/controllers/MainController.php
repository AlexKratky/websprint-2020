<?php
class MainController {
    private static $handler;

    public static function main($handler)
    {
        self::$handler = $handler;
    }

    public static function list() {
        self::$handler::setParameters([
            "teachers" => db::multipleSelect("SELECT `ID`, `USERNAME`, `EMAIL`, `FIRSTNAME`, `LASTNAME`, `PHONE`, `SKILL`, `DESCRIBE`, `PRICE`, `AVATAR` FROM `users` WHERE `ROLE`=50"),
        ]);
    }

    public static function detail() {
        self::$handler::setParameters([
            "teacher" => db::select("SELECT `ID`, `USERNAME`, `EMAIL`, `FIRSTNAME`, `LASTNAME`, `PHONE`, `SKILL`, `DESCRIBE`, `PRICE`, `AVATAR` FROM `users` WHERE `ROLE`=50 AND `ID`=?", array(Route::getValue('ID'))),
        ]);
    }

    public static function contact() {
        self::$handler::setParameters([
            "teacher" => db::select("SELECT `ID`, `USERNAME`, `EMAIL`, `FIRSTNAME`, `LASTNAME`, `PHONE`, `SKILL`, `DESCRIBE`, `PRICE`, `AVATAR` FROM `users` WHERE `ROLE`=50 AND `ID`=?", array(Route::getValue('ID'))),
        ]);
    }

    public static function contactSend() {
        $GLOBALS["request"]->workWith("POST", ["name", "email", "message"]);
        if(db::count("SELECT COUNT(*) FROM `users` WHERE `ID`=?", array(Route::getValue('ID'))) < 1) {
            error(404);
        }
        $mail = db::select("SELECT `EMAIL` FROM `users` WHERE `ID`=?", array(Route::getValue('ID')));
        db::query("INSERT INTO `contacts` (`USER_ID`, `NAME`, `EMAIL`, `MESSAGE`) VALUES (?,?,?,?)", array(Route::getValue('ID'), $GLOBALS["request"]->getPost("name"), $GLOBALS["request"]->getPost("email"), $GLOBALS["request"]->getPost("message")));
        
        mail($mail["EMAIL"], "Nový zájemce o učení", "Máte nového zájemce o učení, zkontrolujte si účet.");
        aliasredirect('list_detail', Route::getValue('ID'), "sent");
    }

    public static function candidates() {
        self::$handler::setParameters([
            "candidates" => db::multipleSelect("SELECT * FROM `contacts` WHERE `USER_ID`=? ORDER BY `ID` DESC", array($GLOBALS["auth"]->user('id'))),
        ]);
    }
}