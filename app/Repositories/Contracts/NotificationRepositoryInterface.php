<?php
/** 
* @file NotificationRepositoryInterface.php
* 
* PHP version 5 
* 
* @author Lakpriya De Silava <lakpriya.d@eyepax.com>
* @copyright Copyright (c) Eyepax IT Consulting (Pvt) Ltd. 
* 
*/

namespace App\Repositories\Contracts;

/**
 * Interface NotificationRepositoryInterface
 * @package App\Modules\Common\Repositories\Notification
 */
interface NotificationRepositoryInterface
{

    /**
     * @param $osType
     * @return mixed
     */
    public function sendNotifications($osType = '');

    /**
     * Save push messages to queue
     *
     * @param $receiveUserList
     * @param $title
     * @param string $message
     * @param $createdBy
     * @param int $badge
     * @param string $sound
     * @return bool
     */
    public function saveNotificationsToQueue($receiveUserList, $title, $message, $createdBy, $badge = 0, $sound = 'default');

    /**
     * @param $title
     * @param $message
     * @param $apStoreToken
     * @return mixed
     */
    public function iosPush($title, $message, $apStoreToken);

    /**
     * @param $title
     * @param $message
     * @param $apStoreToken
     * @param int $vibrate
     * @param int $sound
     * @return mixed
     */
    public function androidPush($title, $message, $apStoreToken, $vibrate = 1, $sound = 1);

    /**
     * @param $os
     * @return mixed
     */
    public function getPendingTokens($os);

    /**
     * @return mixed
     */
    public function updateSendDate();

}