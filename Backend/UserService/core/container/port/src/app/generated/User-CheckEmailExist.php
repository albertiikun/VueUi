<?php
/**
 * @OA\Get(
 *     path="/api/users/:email",
 *     summary="User-CheckEmailExist",
 *     tags={"User"},
  *
 *       @OA\Parameter(
 *          name="email",
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
