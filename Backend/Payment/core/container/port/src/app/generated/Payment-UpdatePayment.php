<?php
/**
 * @OA\Post(
 *     path="/api/payments/:update",
 *     summary="Payment-UpdatePayment",
 *     tags={"Payment"},
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
*       property="price",
*       type="string"
*   ),
*
*   @OA\Property(
*       property="paymentSchedule_id",
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
