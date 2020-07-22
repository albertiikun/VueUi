<?php
/**
 * @OA\Get(
 *     path="/api/users/:deleted",
 *     summary="User-GetDeleted",
 *     tags={"User"},
  *
 *       @OA\Parameter(
 *          name="itemsPerPage",
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
