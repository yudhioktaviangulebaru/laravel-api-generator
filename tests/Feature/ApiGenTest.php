<?php

beforeEach(function () {});

afterEach(function () {});

test('test', function () {
    $this->assertTrue(true);
});
test('init class ApiGenerator', function () {
    $generator = createApiGen();
    $generator->generateAll();
    $this->assertTrue(true);
});
