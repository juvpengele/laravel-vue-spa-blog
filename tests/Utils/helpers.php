<?php

function create($model, $attributes = [], $times = null) {
    return factory($model, $times)->create($attributes);
}

function make($model, $attributes = [], $times = null) {
    return factory($model, $times)->make($attributes);
}

function raw($model, $attributes = [], $times = null) {
    return factory($model, $times)->raw($attributes);
}