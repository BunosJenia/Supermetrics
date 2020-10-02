<?php

declare(strict_types = 1);

require_once __DIR__ . '/src/config/config.php';

require_once __DIR__ . '/src/bootstrap.php';

/*
function getRequestId() {

    $post = [
        'client_id' => 'ju16a6m81mhid5ue1z3v2g0uh',
        'email'   => 'your@email.address',
        'name' => 'Your name',
    ];

    $ch = curl_init('https://api.supermetrics.com/assignment/register');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

    $response = curl_exec($ch);
    curl_close($ch);

    $responseObj = json_decode($response, true);

    return $responseObj['data']['sl_token'];
}

function getPosts() {
    $requestId = getRequestId();
    $allPosts = [];

    $start = microtime(true);

    for($i = 1; $i < 4; $i++) {
        $url = sprintf(
            "https://api.supermetrics.com/assignment/posts?sl_token=%s&page=%s",
            $requestId,
            $i
        );

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        //$responseObj = json_decode($response, true);

        //$allPosts = array_merge($allPosts, $responseObj['data']['posts']);
        //$allPosts = $responseObj['data']['posts'];
    }

    //curl_close($ch);

    return $allPosts;
}

$posts = getPosts();
*/

