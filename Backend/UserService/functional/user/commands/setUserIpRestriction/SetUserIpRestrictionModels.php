<?php

namespace Functional\user\commands\setUserIpRestriction;

use Carbon\Carbon;
use Core\myvendor\common\Exceptions\RestrictionIpAddresseAlreadyExists;
use Core\myvendor\common\Exceptions\RestrictionIpAddressesAlreadyExists;
use Domain\entities\UserIpRestriction;
use Ramsey\Uuid\Uuid;

trait SetUserIpRestrictionModels
{
    private $_userIpRestrictionModel;

    public function __construct()
    {
        $this->_userIpRestrictionModel = new UserIpRestriction();
    }

    private function insertRestriction($userId, $ipAddresses)
    {
        if (is_array($ipAddresses)) {

            $restriction = $this->_userIpRestrictionModel->where('user_id', $userId)->whereIn('ipAddress', $ipAddresses)->get();
            if (count($restriction) == 0) {

                foreach ($ipAddresses as $ipAddress) {
                    $data[] = [
                        'id' => Uuid::uuid4(),
                        'user_id' => $userId,
                        'ipAddress' => $ipAddress,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                }
                $this->_userIpRestrictionModel::insert($data);
            } else {
                foreach ($restriction as $restrict) {
                    $exist[] = $restrict->ipAddress;
                }

                throw new RestrictionIpAddressesAlreadyExists($exist);
            }

        } else {
            $restriction = UserIpRestriction::where('user_id', $userId)->where('ipAddress', $ipAddresses)->first();
            if (!$restriction) {
                $this->_userIpRestrictionModel = $this->_userIpRestrictionModel;
                $this->_userIpRestrictionModel->user_id = $userId;
                $this->_userIpRestrictionModel->ipAddress = $ipAddresses;
                $this->_userIpRestrictionModel->save();
            } else {
                throw new RestrictionIpAddresseAlreadyExists($restriction->ipAddress);
            }
        }
    }
}
