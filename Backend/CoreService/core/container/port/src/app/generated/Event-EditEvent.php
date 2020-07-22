<?php
/**
 * @OA\Post(
 *     path="/api/events/:edit",
 *     summary="Event-EditEvent",
 *     tags={"Event"},
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
*       property="from",
*       type="string"
*   ),
*
*   @OA\Property(
*       property="to",
*       type="string"
*   ),
*
*   @OA\Property(
*       property="color",
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
