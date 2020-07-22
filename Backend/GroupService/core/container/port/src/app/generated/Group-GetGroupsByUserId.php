<?php
/**
 * @OA\Get(
 *     path="/api/groups/:user-id",
 *     summary="Group-GetGroupsByUserId",
 *     tags={"Group"},
  *
 *       @OA\Parameter(
 *          name="userId",
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
