<?php
/**
 * @OA\Get(
 *     path="/api/users/:username-email-id",
 *     summary="User-GetUsernameAndEmailById",
 *     tags={"User"},
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
