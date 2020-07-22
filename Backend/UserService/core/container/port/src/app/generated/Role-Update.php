<?php
/**
 * @OA\Post(
 *     path="/api/roles/:update",
 *     summary="Role-Update",
 *     tags={"Role"},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *
 *   @OA\Property(
*       property="name",
*       type="string"
*   ),
*
*   @OA\Property(
*       property="role_id",
*       type="string"
*   ),
*

 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK"
 *     ),
 *         security={{"apiKey":{}}}
 * )
 */
