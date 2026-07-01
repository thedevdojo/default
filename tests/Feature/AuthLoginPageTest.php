<?php

test('the login page renders without a Volt fragment path error', function () {
    $this->get('/auth/login')->assertOk();
});
