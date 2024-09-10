<?php

use Yudhi\Apigen\Helpers\DirHelper;

test("Stub Directory", function () {
    $data = DirHelper::stubDir();
    $fileExist = file_exists($data);
    $this->assertTrue($fileExist);
});