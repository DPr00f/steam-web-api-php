<?php
namespace SteamApi\Exceptions;


class ApiArgumentRequiredException extends \Exception {

    public function __construct()
    {
        parent::__construct(sprintf('Arguments are required for this service.'));
    }
}