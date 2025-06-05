<?php

namespace App\Http\Controllers\API\V1;

use Exception;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Resources\API\V1\Task\{BaseTaskResource, TaskResource};
use OpenApi\Annotations as OA;
use App\Http\Requests\API\V1\Task\{SearchTaskRequest, StoreTaskRequest, UpdateTaskRequest};

class TaskController extends Controller
{
    public function __construct(
        private readonly TaskService $taskService,
    )
    {}

    /**
     * @OA\Get(
     *        path="/api/v1/tasks",
     *        summary="Tasks list",
     *        tags={"Tasks"},
     *        security={{"bearerAuth":{}}},
     *       @OA\Parameter(
     *         name="status",
     *         in="query",
     *         @OA\Schema(
     *           type="string",
     *           enum={"todo","done"}
     *         ),
     *        ),
     *        @OA\Parameter(
     *          name="priority",
     *          in="query",
     *          @OA\Schema(
     *            type="integer",
     *            minimum=1,
     *            maximum=5,
     *            example="1"
     *          ),
     *        ),
     *        @OA\Parameter(
     *         name="q",
     *         in="query",
     *         @OA\Schema(
     *             type="string",
     *             example="Search"
     *         ),
     *        ),
     *        @OA\Parameter(
     *          name="sort",
     *          in="query",
     *          @OA\Schema(
     *              type="array",
     *              maxItems=2,
     *              @OA\Items(ref="#/components/schemas/TaskSortEnum")
     *          ),
     *        ),
     *        @OA\Parameter(
     *          name="sortBy",
     *          in="query",
     *          @OA\Schema(
     *              type="array",
     *               maxItems=2,
     *               @OA\Items(ref="#/components/schemas/SortByEnum")
     *          )
     *        ),
     *        @OA\Response(
     *            response=200,
     *            description="Tasks list",
     *            @OA\JsonContent(
     *                type="object",
     *                @OA\Property(
     *                    property="data",
     *                    type="array",
     *                    @OA\Items(ref="#/components/schemas/BaseTaskResource")
     *                )
     *            )
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
     *
     * @param SearchTaskRequest $request
     * @return AnonymousResourceCollection|JsonResponse
     */
    public function index(SearchTaskRequest $request): AnonymousResourceCollection | JsonResponse
    {
        try {
            $tasks = $this->taskService->search($request->toDTO());
        } catch (Exception $exception) {
            return new JsonResponse([
                'message' => $exception->getMessage(),
            ], !is_int($exception->getCode()) || $exception->getCode() === 0 ? 500 : $exception->getCode());
        }

        return BaseTaskResource::collection($tasks);
    }

    /**
     * @OA\Post(
     *       path="/api/v1/tasks",
     *       summary="Create task",
     *       tags={"Tasks"},
     *       @OA\RequestBody(
     *           required=true,
     *           @OA\JsonContent(ref="#/components/schemas/StoreTaskRequest")
     *       ),
     *       @OA\Response(
     *           response=200,
     *           description="Task created",
     *           @OA\JsonContent(
     *                @OA\Property(property="message", type="string", example="Task created successfully.")
     *            )
     *       ),
     *       @OA\Response(
     *           response=401,
     *           description="Invalid credentials",
     *           @OA\JsonContent(
     *               @OA\Property(property="message", type="string", example="Invalid email or password")
     *           )
     *       ),
     *       @OA\Response(
     *            response=422,
     *            description="Validation Error",
     *            @OA\JsonContent(
     *                @OA\Property(property="message", type="string", example="Invalid email type")
     *            )
     *       ),
     *       @OA\Response(
     *           response=500,
     *           description="Internal error",
     *           @OA\JsonContent(
     *               @OA\Property(property="message", type="string", example="Something went wrong")
     *           )
     *       )
     *   )
     *
     * @param StoreTaskRequest $request
     * @return JsonResponse
     */
    public function store(StoreTaskRequest $request): JsonResponse
    {
        try {
            $this->taskService->create($request->toDTO());
        } catch (Exception $exception) {
            return new JsonResponse([
                'message' => $exception->getMessage(),
            ], !is_int($exception->getCode()) || $exception->getCode() === 0 ? 500 : $exception->getCode());
        }

        return new JsonResponse([
            'message' => 'Task created successfully.',
        ]);
    }

    /**
     * @OA\Get(
     *         path="/api/v1/tasks/{id}",
     *         summary="Tasks info",
     *         tags={"Tasks"},
     *         security={{"bearerAuth":{}}},
     *         @OA\Parameter(
     *           name="id",
     *           in="path",
     *           description="Task ID",
     *           required=true,
     *           @OA\Schema(type="integer")
     *         ),
     *         @OA\Response(
     *             response=200,
     *             description="Task",
     *             @OA\JsonContent(ref="#/components/schemas/TaskResource")
     *         ),
     *         @OA\Response(
     *             response=401,
     *             description="Unauthorized",
     *             @OA\JsonContent(
     *                 @OA\Property(property="message", type="string", example="Unauthenticated.")
     *             )
     *         ),
     *         @OA\Response(
     *             response=500,
     *             description="Internal error",
     *             @OA\JsonContent(
     *                 @OA\Property(property="message", type="string", example="Something went wrong")
     *             )
     *         )
     *     )
     *
     * @param Task $task
     * @return TaskResource|JsonResponse
     * @throws AuthorizationException
     */
    public function show(Task $task): TaskResource|JsonResponse
    {
        $this->authorize('view', $task);

        try {
            $task = $this->taskService->loadRelations($task);
        } catch (Exception $exception) {
            return new JsonResponse([
                'message' => $exception->getMessage(),
            ], !is_int($exception->getCode()) || $exception->getCode() === 0 ? 500 : $exception->getCode());
        }

        return new TaskResource($task);
    }

    /**
     * @OA\Post(
     *        path="/api/v1/tasks/{id}",
     *        summary="Update task",
     *        tags={"Tasks"},
     *        @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Task ID",
     *          required=true,
     *          @OA\Schema(type="integer")
     *        ),
     *        @OA\RequestBody(
     *            required=true,
     *            @OA\JsonContent(ref="#/components/schemas/UpdateTaskRequest")
     *        ),
     *        @OA\Response(
     *            response=200,
     *            description="Task updated",
     *            @OA\JsonContent(
     *                 @OA\Property(property="message", type="string", example="Task updated successfully.")
     *             )
     *        ),
     *        @OA\Response(
     *            response=401,
     *            description="Invalid credentials",
     *            @OA\JsonContent(
     *                @OA\Property(property="message", type="string", example="Invalid email or password")
     *            )
     *        ),
     *        @OA\Response(
     *             response=422,
     *             description="Validation Error",
     *             @OA\JsonContent(
     *                 @OA\Property(property="message", type="string", example="Invalid email type")
     *             )
     *        ),
     *        @OA\Response(
     *            response=500,
     *            description="Internal error",
     *            @OA\JsonContent(
     *                @OA\Property(property="message", type="string", example="Something went wrong")
     *            )
     *        )
     *    )
     * @param Task $task
     * @param UpdateTaskRequest $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(Task $task,UpdateTaskRequest $request): JsonResponse
    {
        $this->authorize('update', $task);

        try {
            $this->taskService->update($task, $request->toDTO());
        } catch (Exception $exception) {
            return new JsonResponse([
                'message' => $exception->getMessage(),
            ], !is_int($exception->getCode()) || $exception->getCode() === 0 ? 500 : $exception->getCode());
        }

        return new JsonResponse([
            'message' => 'Task updated successfully.',
        ]);
    }

    /**
     * @OA\Delete(
     *         path="/api/v1/tasks/{id}",
     *         summary="Delete task",
     *         tags={"Tasks"},
     *         @OA\Parameter(
     *           name="id",
     *           in="path",
     *           description="Task ID",
     *           required=true,
     *           @OA\Schema(type="integer")
     *         ),
     *         @OA\Response(
     *             response=200,
     *             description="Task deleted",
     *             @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="Task deleted successfully.")
     *              )
     *         ),
     *         @OA\Response(
     *             response=401,
     *             description="Invalid credentials",
     *             @OA\JsonContent(
     *                 @OA\Property(property="message", type="string", example="Invalid email or password")
     *             )
     *         ),
     *         @OA\Response(
     *             response=500,
     *             description="Internal error",
     *             @OA\JsonContent(
     *                 @OA\Property(property="message", type="string", example="Something went wrong")
     *             )
     *         )
     *     )
     *
     * @param Task $task
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function delete(Task $task): JsonResponse
    {
        $this->authorize('delete', $task);

        try {
            $this->taskService->delete($task);
        } catch (Exception $exception) {
            return new JsonResponse([
                'message' => $exception->getMessage(),
            ], !is_int($exception->getCode()) || $exception->getCode() === 0 ? 500 : $exception->getCode());
        }

        return new JsonResponse([
            'message' => 'Task deleted successfully.',
        ]);
    }

    /**
     * @OA\Post(
     *         path="/api/v1/tasks/{id}/done",
     *         summary="Mark as done",
     *         tags={"Tasks"},
     *         @OA\Parameter(
     *           name="id",
     *           in="path",
     *           description="Task ID",
     *           required=true,
     *           @OA\Schema(type="integer")
     *         ),
     *         @OA\Response(
     *             response=200,
     *             description="Task updated",
     *             @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="Task mark as done successfully.")
     *              )
     *         ),
     *         @OA\Response(
     *             response=401,
     *             description="Invalid credentials",
     *             @OA\JsonContent(
     *                 @OA\Property(property="message", type="string", example="Invalid email or password")
     *             )
     *         ),
     *         @OA\Response(
     *              response=422,
     *              description="Validation Error",
     *              @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="Invalid email type")
     *              )
     *         ),
     *         @OA\Response(
     *             response=500,
     *             description="Internal error",
     *             @OA\JsonContent(
     *                 @OA\Property(property="message", type="string", example="Something went wrong")
     *             )
     *         )
     *     )
     *
     * @param Task $task
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function markAsDone(Task $task): JsonResponse
    {
        $this->authorize('markAsDone', $task);

        try {
            $this->taskService->markAsDone($task);
        } catch (Exception $exception) {
            return new JsonResponse([
                'message' => $exception->getMessage(),
            ], !is_int($exception->getCode()) || $exception->getCode() === 0 ? 500 : $exception->getCode());
        }

        return new JsonResponse([
            'message' => 'Task mark as done successfully.',
        ]);
    }
}
