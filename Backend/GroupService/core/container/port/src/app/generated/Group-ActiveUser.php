<?php
/**
 * @OA\Post(
 *     path="/api/groups/:active-user",
 *     summary="Group-ActiveUser",
 *     tags={"Group"},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *
 *   @OA\Property(
*       property="user_id",
*       type="string"
*   ),
*
*   @OA\Property(
*       property="group_id",
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
