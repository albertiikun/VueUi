<?php
/**
 * @OA\Post(
 *     path="/api/groups/:add-user",
 *     summary="Group-AddUser",
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