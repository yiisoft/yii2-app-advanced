<?php

if (!is_dir(dirname(__DIR__) . '/runtime/sessions')) {
    mkdir(dirname(__DIR__) . '/runtime/sessions', 0700, true);
}
