<?php

use src\Controller;
use src\Controller\Admin;

return [
    ['GET', '/', [], Controller\HomeController::class, "index"],
    ['GET', '/home/get-photos/', ['\d+'], Controller\HomeController::class, "getPhotos"],
    ['GET', '/login', [], Controller\SecurityController::class, "login"],
    ['POST', '/login', [], Controller\SecurityController::class, "traitLogin"],
    ['GET', '/profile/profile', [], Controller\SecurityController::class, "getProfilesAfterLogin"],
    ['GET', '/admin/utilisateurs', [], Admin\AdminUserController::class, "index"],
    ['GET', '/admin/users', [], Admin\AdminUserController::class, "getAllUsers"],
    ['POST', '/admin/users/user', [], Admin\AdminUserController::class, "editUser"],
    ['DELETE', '/admin/users/user/', ['\d+'], Admin\AdminUserController::class, "deleteUser"],
    ['GET', '/admin/photos', [], Admin\AdminPhotoController::class, "displayPhotos"],
    ['GET', '/admin/photos/photos', [], Admin\AdminPhotoController::class, "getAllPhotos"],
    ['POST', '/admin/photos/photo', [], Admin\AdminPhotoController::class, "addPhoto"],
];

