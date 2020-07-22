<?php
/**
 * @OA\Get(
 *     path="/api/groups/:activated-users",
 *     summary="Group-GetActivatedUsers",
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

 *      @OA\Response(
 *          response=200,
 *          description="successful operation"
 *       ),
 *          security={{"apiKey":{}}}
 * )
 */
