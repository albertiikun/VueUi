<?php
/**
 * @OA\Put(
 *     path="/api/users/:update-password",
 *     summary="User-UpdatePassword",
 *     tags={"User"},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *
 *   @OA\Property(
*       property="oldPassword",
*       type="string"
*   ),
*
*   @OA\Property(
*       property="password",
*       type="string"
*   ),
*
*   @OA\Property(
*       property="id",
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
