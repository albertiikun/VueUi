<?php
/**
 * @OA\Post(
 *     path="/api/roles/:assign-permission",
 *     summary="Role-AssignPermission",
 *     tags={"Role"},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *
 *   @OA\Property(
*       property="role_id",
*       type="string"
*   ),
*
*   @OA\Property(
*       property="permission_id",
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
