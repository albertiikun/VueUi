<?php
/**
 * @OA\Get(
 *     path="/api/groups/:users-group-id",
 *     summary="Group-GetUsersByGroupId",
 *     tags={"Group"},
  *
 *       @OA\Parameter(
 *          name="id",
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
