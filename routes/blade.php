<?php
Blade::if('check', function () {
    return auth()->user() ? true : false;
});