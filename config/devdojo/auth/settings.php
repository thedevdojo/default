<?php

// App-level overrides for devdojo/auth settings. The package merges its
// defaults underneath these, so we only specify what we change.
return [
    // Where visitors land after registering or logging in (when no
    // "intended" URL was captured). The dashboard is the app's home base.
    "redirect_after_auth" => "/dashboard",
];
