<?php
/**
 * @OA\Get(
 *     path="/api/users/:deleted-id",
 *     summary="User-GetDeletedById",
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
