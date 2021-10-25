<?php

function is_logged() {
    if (!empty($_SESSION['login'])) {                  
        return true;
    }
    return false;
}

function is_admin() {
    if (!empty($_SESSION['login'])) {  
        if ($_SESSION['login']['admin'] === 'oui') {
            return true;
        }                
    }
    return false;
}