<?php

namespace Yudhi\Apigen\Enums;

enum HttpCodeEnum: int
{
    case OK = 200;
    case CREATED = 201;
    case BAD_REQUEST = 400;
    case NOT_FOUND = 404;
    case INTERNAL_SERVER_ERROR = 500;
}
