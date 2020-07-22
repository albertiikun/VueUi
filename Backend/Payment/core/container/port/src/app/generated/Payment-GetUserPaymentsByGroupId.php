<?php
/**
 * @OA\Get(
 *     path="/api/payments/:get-users-by-group-id",
 *     summary="Payment-GetUserPaymentsByGroupId",
 *     tags={"Payment"},
  *
 *       @OA\Parameter(
 *          name="group_id",
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
