<?php
/**
 * @OA\Get(
 *     path="/api/users/:username",
 *     summary="User-CheckUsernameExist",
 *     tags={"User"},
  *
 *       @OA\Parameter(
 *          name="userName",
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
