<?php
const FILE = __DIR__ . '/../libs.json';

$libs = json_decode(file_get_contents(FILE), true);

usort($libs, function ($o1, $o2) {
    return $o1['id'] <=> $o2['id'];
});

file_put_contents(FILE, json_encode($libs, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
