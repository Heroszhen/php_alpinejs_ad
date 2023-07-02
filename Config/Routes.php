<?php

use src\Controller;
use src\Controller\Admin;

return [
    ['GET', '/', [], Controller\HomeController::class, "index"],
    ['GET', '/maintenance', [], Controller\HomeController::class, "maintenance"],
    ['GET', '/home/get-photos/', ['\d+'], Controller\HomeController::class, "getPhotos"],
    ['GET', '/videos', [], Controller\HomeController::class, "videosPage"],
    ['GET', '/home/get-videos/', ['\d+'], Controller\HomeController::class, "getVideos"],
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
    ['DELETE', '/admin/photos/photo/', ['\d+'], Admin\AdminPhotoController::class, "deletePhoto"],
    ['GET', '/admin/videos', [], Admin\AdminVideoController::class, "displayVideos"],
    ['GET', '/admin/videos/videos', [], Admin\AdminVideoController::class, "getAllVideos"],
    ['POST', '/admin/videos/video', [], Admin\AdminVideoController::class, "addVideo"],
    ['DELETE', '/admin/videos/video/', ['\d+'], Admin\AdminVideoController::class, "deleteVideo"],
    ['POST', '/admin/videos/video/', ['\d+'], Admin\AdminVideoController::class, "updateVideo"],
];

