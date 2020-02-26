<?php
class TotalAdminModel {
    public function selectAllRoles() {
        return db::multipleSelect("SELECT * FROM `roles`");
    }

    public function selectAllPermissions() {
        return db::multipleSelect("SELECT * FROM `permissions`");
    }

    public function selectUsers() {
        return db::multipleSelect("SELECT ID, USERNAME, EMAIL, VERIFIED, `ROLE`, `PERMISSIONS`, `CREATED_AT`, `EDITED_AT` FROM `users` LIMIT 1000");
    }

    public function selectUser($id) {
        return db::select("SELECT ID, USERNAME, EMAIL, VERIFIED, `ROLE`, `PERMISSIONS`, `CREATED_AT`, `EDITED_AT` FROM `users` WHERE ID=?", array($id));
    }

    public function searchUsers($q) {
        $q = strtolower("%$q%");
        return db::multipleSelect("SELECT ID, USERNAME, EMAIL, VERIFIED, `ROLE`, `PERMISSIONS`, `CREATED_AT`, `EDITED_AT` FROM `users` WHERE ID LIKE ? OR USERNAME LIKE ? OR EMAIL LIKE ? OR `PERMISSIONS` LIKE ? LIMIT 1000", array($q, $q, $q, $q));
    }
}
