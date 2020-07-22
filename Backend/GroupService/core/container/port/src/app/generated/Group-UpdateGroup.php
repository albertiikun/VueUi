<?php
/**
 * @OA\Post(
 *     path="/api/groups/:update",
 *     summary="Group-UpdateGroup",
 *     tags={"Group"},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *
 *   @OA\Property(
*       property="id",
*       type="string"
*   ),
*
*   @OA\Property(
*       property="name",
*       type="string"
*   ),
*
*   @OA\Property(
*       property="subject_Id",
*       type="string"
*   ),
*
*   @OA\Property(
*       property="maxLevel",
*       type="string"
*   ),
*
*   @OA\Property(
*       property="studentLimit",
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
