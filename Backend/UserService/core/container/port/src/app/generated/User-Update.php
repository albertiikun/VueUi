<?php
/**
 * @OA\Put(
 *     path="/api/users/:update",
 *     summary="User-Update",
 *     tags={"User"},
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
*       property="lastName",
*       type="string"
*   ),
*
*   @OA\Property(
*       property="phoneNumber",
*       type="string"
*   ),
*
*   @OA\Property(
*       property="birthDate",
*       type="string"
*   ),
*
*   @OA\Property(
*       property="city_id",
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