<?php
/**
 * @OA\Post(
 *     path="/api/payments/:make-paid-unpaid-id",
 *     summary="Payment-MakePaymentPaidOrUnpaid",
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
*       property="status",
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
