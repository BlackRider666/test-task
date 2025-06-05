<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *      title="TODO list API",
 *      version="1.0.0",
 *      description="TODO list API Documentation",
 *  ),
 * @OA\SecurityScheme(
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     securityScheme="bearerAuth"
 * )
 */

abstract class Controller
{
    use AuthorizesRequests;
}
