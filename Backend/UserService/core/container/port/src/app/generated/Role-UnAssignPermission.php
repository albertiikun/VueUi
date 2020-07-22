<?php
/**
 * @OA\Post(
 *     path="/api/roles/:unassign-permission",
 *     summary="Role-UnAssignPermission",
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
