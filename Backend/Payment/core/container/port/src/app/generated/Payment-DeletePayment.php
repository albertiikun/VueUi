<?php
/**
 * @OA\Delete(
 *     path="/api/payments/:delete",
 *     summary="Payment-DeletePayment",
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
