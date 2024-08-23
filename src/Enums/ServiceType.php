<?php

namespace FutureStation\KeyGuard\Enums;

enum ServiceType: string
{
    case OPENAI  = 'openai';
    case GITHUB  = 'github';
    case SHOPIFY = 'shopify';
    case GEMINI  = 'gemini';
}
