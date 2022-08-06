<?php

const ANTI_FEATURES = [
    "NonFreeDep",           // The library depends on a non-free application (e.g. Google Play Services) or library (e.g. MLKit).",
    "Ads",                  // The library promotes or depends on advertising
//    "ApplicationDebuggable",// Irrelevant for libraries
    "NonFreeAdd",           // The library promotes non-free add-ons, such that the library is effectively an advert for other non-free software and such software is not clearly labelled as such.",
    "Tracking",             // The library tracks and reports your activity to somewhere, usually either without your consent, or by default (i.e. you'd have to actively disable it). It's commonly used for when developers obtain crash logs without the user's consent, or when an app is useless without some kind of authentication.
    "NonFreeNet",           // The library promotes or depends a non-Free network service.
    "NonFreeAssets",        // The library contains and makes use of non-free assets. The most common case is libraries using artwork - images, sounds, music, etc - under a non-commercial license.
//    "UpstreamNonFree",      // Irrelevant for libraries
//    "DisabledAlgorithm",    // Irrelevant for libraries
    "KnownVuln",            // The library has a known security vulnerability.
    "NoSourceSince",        // Upstream source for the library is no longer available. Either it went commercial, the repo was dropped, or it has moved to a location currently unknown to us.
];
