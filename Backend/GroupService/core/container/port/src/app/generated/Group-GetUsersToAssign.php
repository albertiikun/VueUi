<?php
/**
 * @OA\Get(
 *     path="/api/groups/:users-to-assign",
 *     summary="Group-GetUsersToAssign",
 *     tags={"Group"},
  *
 *       @OA\Parameter(
 *          name="group_id",
 *          required=true,
 *          in="query",
 *          @OA\Schema(
 *              type="string"
 *          )
 *      ),
 *
 *
 *       @OA\Parameter(
 *          name="search",
 *          required=true,
 *          in="query",
 *          @OA\Schema(
 *              type="string"
 *          )
 *      ),
 *

 *      @OA\Response(
 *          response=200,
 *          description="successful operation"
 *       ),
 *          security={{"apiKey":{}}}
 * )
 */
