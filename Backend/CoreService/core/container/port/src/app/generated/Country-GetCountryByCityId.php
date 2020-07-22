<?php
/**
 * @OA\Get(
 *     path="/api/country/:cityId",
 *     summary="Country-GetCountryByCityId",
 *     tags={"Country"},
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
