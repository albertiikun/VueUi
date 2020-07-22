<?php
/**
 * @OA\Get(
 *     path="/api/payments",
 *     summary="Payment-GetPayments",
 *     tags={"Payment"},
  *
 *       @OA\Parameter(
 *          name="itemsPerPage",
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
