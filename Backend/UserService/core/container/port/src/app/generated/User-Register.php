<?php
/**
 * @OA\Post(
 *     path="/api/users/:register",
 *     summary="User-Register",
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
*       property="userName",
*       type="string"
*   ),
*
*   @OA\Property(
*       property="role_id",
*       type="string"
*   ),
*
*   @OA\Property(
*       property="email",
*       type="string"
*   ),
*
*   @OA\Property(
*       property="password",
*       type="string"
*   ),
*
*   @OA\Property(
*       property="password_confirmation",
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
