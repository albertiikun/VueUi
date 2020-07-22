<?php
/**
 * @OA\Post(
 *     path="/swagger/register",
 *     summary="Adds a new swagger method",
 *     tags={"Swagger"},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="uri",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="fileName",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="method",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="summary",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="tag",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="property",
 *                     type="string"
 *                 ),
 *                 example={"uri": "string",
 *                 "fileName":"string","method":"Post","summary":"string","tag":"string",
 *                 "property": {
 *                  {"name": "string","type":"string"},
 *                  {"name": "string", "type":"string"},
 *                  {"name": "string", "type":"string"}
 *                  }}
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK"
 *     )
 * )
 */
