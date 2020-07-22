<?php
/**
 * @OA\Get(
 *     path="/api/groups/:check-group-name",
 *     summary="Group-CheckGroupNameExist",
 *     tags={"Group"},
  *
 *       @OA\Parameter(
 *          name="name",
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
