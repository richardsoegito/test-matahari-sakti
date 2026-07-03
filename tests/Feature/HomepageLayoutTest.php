<?php

it('renders the bootstrap based layout on the homepage', function () {
    $response = $this->get('/');

    $response->assertOk();
    $response->assertSee('https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', false);
    $response->assertSee('Welcome to My App');
});
