<?php
/**
 * @OA\Post(
 *     path="/api/groups/:active-group",
 *     summary="Group-ActiveGroup",
 *     tags={"Group"},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *
 *   @OA\Property(
*       property="group_id",
*       type="string"
*   ),
*
*   @OA\Property(
*       property="from",
*       type="string"
*   ),
*
*   @OA\Property(
*       property="to",
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
