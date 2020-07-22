<?php
/**
 * @OA\Post(
 *     path="/api/payments/:assign-payment",
 *     summary="Payment-AssignPaymentToUser",
 *     tags={"Payment"},
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
*   @OA\Property(
*       property="payment_id",
*       type="string"
*   ),
*
*   @OA\Property(
*       property="start_date",
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
