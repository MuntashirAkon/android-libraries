<?php

const FILE = __DIR__ . '/../libs.json';
const VALID_FIELDS = ['version', 'id', 'exodus_id', 'etip_id', 'label', 'description', 'signatures', 'website', 'type',
    'tags', 'group_id', 'artifact_id', 'anti_features', 'license', 'dead_since', 'verified', 'last_update', 'comment'];
const VALID_SIGNATURE_FIELDS = ['code', 'network', 'solib', 'filename', 'file', 'meta'];

$libs = json_decode(file_get_contents(FILE), true);

$ids = array();
foreach ($libs as $lib) {
    if (in_array($lib['id'], $ids)) {
        echo "\e[31mError:\e[0m Duplicate ID {$lib['id']}\n";
    }
    $ids[] = $lib['id'];
    lint($lib);
}

function lint($lib) {
    // Required fields check
    if (!isset($lib['version'])) {
        echo "\e[31mError:\e[0m Missing required field: version for ID {$lib['id']}\n";
    }
    if (!isset($lib['id'])) {
        echo "\e[31mError:\e[0m Missing required field: id for ID {$lib['id']}\n";
    }
    if (!isset($lib['label'])) {
        echo "\e[31mError:\e[0m Missing required field: label for ID {$lib['id']}\n";
    }
    if (!isset($lib['signatures'])) {
        echo "\e[31mError:\e[0m Missing required field: signatures for ID {$lib['id']}\n";
    }
    if (!isset($lib['type'])) {
        echo "\e[31mError:\e[0m Missing required field: type for ID {$lib['id']}\n";
    }
    if (!isset($lib['last_update'])) {
        echo "\e[31mError:\e[0m Missing required field: last_update for ID {$lib['id']}\n";
    }
    // Invalid fields check
    foreach (array_keys($lib) as $key) {
        if (!in_array($key, VALID_FIELDS)) {
            echo "\e[31mError:\e[0m Invalid field: $key for ID {$lib['id']}\n";
        }
    }
    foreach (array_keys($lib['signatures']) as $key) {
        if (!in_array($key, VALID_SIGNATURE_FIELDS)) {
            echo "\e[31mError:\e[0m Invalid field: signatures.$key for ID {$lib['id']}\n";
        }
    }
}
