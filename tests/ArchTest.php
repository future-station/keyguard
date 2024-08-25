<?php

it('will not use debugging functions')
    ->expect(['dd', 'dump', 'var_dump'])
    ->not->toBeUsed();

it('will only have interfaces in the Contracts namespace')
    ->expect('src\Contracts')
    ->toBeInterfaces();

it('will only have enums in the Enums namespace')
    ->expect('src\Enums')
    ->toBeEnums();

it('will only have exceptions in the Exceptions namespace')
    ->expect('src\Exceptions')
    ->toExtend('Exception');

it('will only implement validator interfaces in the Validators namespace')
    ->expect('src\Validators')
    ->toOnlyImplement(['ValidatorInterface', 'HMACValidatorInterface']);
