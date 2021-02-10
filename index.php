<?php

include 'src/autoload.php';


$config = [
    'callback' => 'https://bookofurls.com/api/fb-signin',
    'keys' => [
        'key' => '77xlampl13diw3',
        'secret' => 'NwNCmkM92jCWJ8tX',
    ],
];

try 
{

    $twitter = new Arifauth\Provider\LinkedIn($config);

    $twitter->authenticate();

    $accessToken = $twitter->getAccessToken();
    $userProfile = $twitter->getUserProfile();

    var_dump($userProfile);
}
catch (\Exception $e) {
    echo 'Oops, we ran into an issue! ' . $e->getMessage();
}

