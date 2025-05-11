<?php

use App\Models\otentikasi;
use Firebase\JWT\JWT;

function getJWT($otentikasiHeader)
{
    if (is_null($otentikasiHeader)){
        throw new Exception("Otentikasi JWT Gagal");
    }
    return explode("", $otentikasiHeader)[1];
}

function validateJWT($encodedToken)
{
    $key = getenv('JWT_SECRET_KEY');
    $decodedToken = JWT::decode ($encodedToken, $key, ['HS256']);
    $modelOtentikasi = NEW otentikasi();

    $modelOtentikasi ->getEmail($decodedToken->email);
}

function CreateJWT($email)
{
    $waktuRequest = time();
    $waktuToken = getenv('JWT_TIME_TO_LIVE');
    $waktuExpire = $waktuRequest + $waktuToken;
    $payload = [
        'email' => $email,
        'iat' => $waktuRequest,
        'exp' => $waktuExpired
    ];
    $jwt = JWT::encode($payload, getenv('JWT_SECRET_KEY'));
    return $jwt;
}