<?php
/**
 * @OA\Post(
 *     path="/api/payments/:create",
 *     summary="Payment-CreatePayment",
 *     tags={"Payment"},
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
