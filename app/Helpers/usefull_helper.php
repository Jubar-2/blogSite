<?php

use Config\Services;

function loggedIn()
{
    $session = Services::session();
    if ($session->get('user')) {
        return true;
    } else {
        return false;
    }
}

function other($userName)
{
    $session = Services::session();
    if ($user = $session->get('user')) {
        if ($user[0]['userName'] === $userName) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
