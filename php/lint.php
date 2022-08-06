<?php

require_once __DIR__ . '/anti_features.php';
require_once __DIR__ . '/library_types.php';
require_once __DIR__ . '/tags.php';

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

function lint($lib): void {
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
    // Invalid type check
    if (!in_array($lib['type'], LIBRARY_TYPES)) {
        echo "\e[31mError:\e[0m Invalid type {$lib['type']} for ID {$lib['id']}\n";
    }
    // Invalid anti-feature check
    if (isset($lib['anti_features'])) {
        foreach ($lib['anti_features'] as $anti_feature) {
            if (!in_array($anti_feature, ANTI_FEATURES)) {
                echo "\e[31mError:\e[0m Invalid anti-feature $anti_feature for ID {$lib['id']}\n";
            }
        }
    }
    // Invalid tags check
    if (isset($lib['tags'])) {
        foreach ($lib['tags'] as $tag) {
            if (!in_array($tag, TAGS)) {
                echo "\e[31mError:\e[0m Invalid tag $tag for ID {$lib['id']}\n";
            }
        }
    }
}
