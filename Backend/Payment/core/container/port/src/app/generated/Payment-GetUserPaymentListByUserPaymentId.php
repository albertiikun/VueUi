<?php
/**
 * @OA\Get(
 *     path="/api/payments/:user-payment-list",
 *     summary="Payment-GetUserPaymentListByUserPaymentId",
 *     tags={"Payment"},
  *
 *       @OA\Parameter(
 *          name="id",
 *          required=true,
 *          in="query",
 *          @OA\Schema(
 *              type="string"
 *          )
 *      ),
 *

 *      @OA\Response(
 *          response=200,
 *          description="successful operation"
 *       ),
 *          security={{"apiKey":{}}}
 * )
 */
