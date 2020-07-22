<?php
/**
 * @OA\Get(
 *     path="/api/payments/:user-payments-group-id",
 *     summary="Payment-GetUserAssignedPaymentsByGroupId",
 *     tags={"Payment"},
  *
 *       @OA\Parameter(
 *          name="user_id",
 *          required=true,
 *          in="query",
 *          @OA\Schema(
 *              type="string"
 *          )
 *      ),
 *
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