<?php

namespace App\Http\Controllers\API\V1;

use Exception;
use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\Auth\LoginRequest;
use App\Http\Resources\API\V1\User\{BaseUserResource, TokenResource};
use OpenApi\Annotations as OA;

class AuthController extends Controller
{
    public function __construct(
        private readonly AuthService $authService,
    )
    {}

    /**
     * @OA\Post(
     *      path="/api/v1/auth/login",
     *      summary="Log in a user",
     *      tags={"Auth"},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/LoginRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful login",
     *          @OA\JsonContent(ref="#/components/schemas/TokenResource")
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Invalid credentials",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Invalid email or password")
     *          )
     *      ),
     *      @OA\Response(
     *           response=422,
     *           description="Validation Error",
     *           @OA\JsonContent(
     *               @OA\Property(property="message", type="string", example="Invalid email type")
     *           )
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal error",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Something went wrong")
     *          )
     *      )
     *  )
     *
     * @param LoginRequest $request
     * @return JsonResponse|TokenResource
     */
    public function login(LoginRequest $request): JsonResponse|TokenResource
    {
        try {
            $user = $this->authService->login($request->toDTO());
        } catch (Exception $exception) {
            return new JsonResponse([
                'message' => $exception->getMessage(),
            ], !is_int($exception->getCode()) || $exception->getCode() === 0 ? 500 : $exception->getCode());
        }

        return new TokenResource($user);
    }

    /**
     * @OA\Get(
     *        path="/api/v1/auth/user",
     *        summary="Get User Info",
     *        tags={"Auth"},
     *        security={{"bearerAuth":{}}},
     *        @OA\Response(
     *            response=200,
     *            description="User info",
     *            @OA\JsonContent(ref="#/components/schemas/BaseUserResource")
     *        ),
     *        @OA\Response(
     *            response=401,
     *            description="Unauthorized",
     *            @OA\JsonContent(
     *                @OA\Property(property="message", type="string", example="Unauthenticated.")
     *            )
     *        ),
     *        @OA\Response(
     *            response=500,
     *            description="Internal error",
     *            @OA\JsonContent(
     *                @OA\Property(property="message", type="string", example="Something went wrong")
     *            )
     *        )
     *    )
     * @param Request $request
     * @return BaseUserResource
     */
    public function user(Request $request): BaseUserResource
    {
        $user = $request->user('api');

        return new BaseUserResource($user);
    }

    /**
     * @OA\Post(
     *       path="/api/v1/auth/logout",
     *       summary="Logout user",
     *       tags={"Auth"},
     *       security={{"bearerAuth":{}}},
     *       @OA\Response(
     *           response=200,
     *           description="Successful logout",
     *           @OA\JsonContent(
     *                @OA\Property(property="message", type="string", example="Logged out successfully.")
     *            )
     *       ),
     *       @OA\Response(
     *           response=401,
     *           description="Unauthorized",
     *           @OA\JsonContent(
     *               @OA\Property(property="message", type="string", example="Unauthenticated.")
     *           )
     *       ),
     *       @OA\Response(
     *           response=500,
     *           description="Internal error",
     *           @OA\JsonContent(
     *               @OA\Property(property="message", type="string", example="Something went wrong")
     *           )
     *       )
     *   )
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        try {
            $this->authService->logout($request->user());
        } catch (Exception $exception) {
            return new JsonResponse([
                'message' => $exception->getMessage(),
            ], !is_int($exception->getCode()) || $exception->getCode() === 0 ? 500 : $exception->getCode());
        }

        return new JsonResponse([
            'message' => 'Logged out successfully.',
        ]);
    }
}
