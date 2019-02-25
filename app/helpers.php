<?php

//允许针对某个也没做页面样式定制
function route_class() 
{
    return str_replace('.', '-', Route::CurrentRouteName());
}

