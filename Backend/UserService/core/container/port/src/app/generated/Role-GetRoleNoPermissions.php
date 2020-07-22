<?php
/**
 * @OA\Get(
 *     path="/api/roles/:has-not-permissions",
 *     summary="Role-GetRoleNoPermissions",
 *     tags={"Role"},
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