<?php

namespace Yudhi\Apigen\Enums;

enum GenerationTypeEnum
{
    case REPOSITORY;
    case ENTITY;
    case SERVICE;
    case CONTROLLER;
    case ROUTE;
    case REQUEST_BASE;
    case REQUEST_CREATE;
    case REQUEST_UPDATE;

}
