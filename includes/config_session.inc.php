<?php   //Sessions handler

ini_set('session.use_only_cookie', 1);
ini_set('session.use_strict_mode', 1);

session_set_cookie_params([
    'lifetime' => 1800,
    'domain' => 'localhost',
    'path' => '/',
    'secure' => true,
    'httponly' => true
]);

session_start();


// if (isset($_SESSION["user_id"])) {//user is logged in
//     if (!isset($_SESSION["lastGen"])) {
//         genSessionIDLoggedIn();
//     } else {
//         $interval = 1800; //update session every 30 minutes
//         if (time() - $_SESSION["lastGen"] >= $interval) {
//             genSessionIDLoggedIn();
//         }
//     }
// } else {//user not logged in
    if (!isset($_SESSION["lastGen"])) {
        genSessionID();
    } else {
        $interval = 1800; //update session every 30 minutes
        if (time() - $_SESSION["lastGen"] >= $interval) {
            genSessionID();
        }
    }
// }


// function genSessionIDLoggedIn() {
//     session_regenerate_id(true);

//     $userID = $_SESSION["user_id"];
//     $newSessionID = session_create_id();
//     $sessionID = $newSessionID . "_" . $userID;
//     session_id($sessionID);

//     $_SESSION["lastGen"] = time();
// }

function genSessionID() {
    session_regenerate_id(true);
    $_SESSION["lastGen"] = time();
}