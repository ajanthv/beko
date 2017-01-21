<?php
/**
 * @file NotificationRepository.php
 *
 * PHP version 5
 *
 * @author Lakpriya De Silava <lakpriya.d@eyepax.com>
 * @copyright Copyright (c) Eyepax IT Consulting (Pvt) Ltd.
 *
 */

namespace App\Repositories;
use App\Models\OutgoingNotificationQueueModel;
use App\Repositories\Contracts\NotificationRepositoryInterface;


/**
 * Class NotificationRepository
 * @package App\Modules\Common\Repositories\Campus
 */
class NotificationRepository implements NotificationRepositoryInterface
{
    private $notification;

    /**
     * @param OutgoingNotificationQueueModel $notification
     */
    public function __construct(OutgoingNotificationQueueModel $notification)
    {
        $this->notification = $notification;
    }

    /**
     * @description Send push messages to specific ios user
     *
     * @param string $apStoreToken
     * @param string $title
     * @param string $message
     * @param int $badge
     * @param string $sound
     * @return mixed|void
     */
    public function iosPush($title, $message, $apStoreToken, $badge = 0, $sound = 'default')
    {

        $passphrase = 'zaq1xsw2!@#$';

        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', base_path('resources/certificate/ck_dist_2016_2_19.pem'));
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

        try {
            // Open a connection to the APNS server
            $fp = stream_socket_client(
                'ssl://gateway.push.apple.com:2195', $err,
                $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);


            // Create the payload body
            $body['aps'] = array(
                'alert' => $title,
                'sound' => $sound
            );

            $body['message'] = $message;

            // Encode the payload as JSON
            $payload = json_encode($body);

            // Build the binary notification
            $msg = chr(0) . pack('n', 32) . pack('H*', (string)$apStoreToken) . pack('n', strlen($payload)) . $payload;

            // Send it to the server
            $result = fwrite($fp, $msg, strlen($msg));

            fclose($fp);
        } catch (\Exception $ex) {

        }

    }

    /**
     * @param $title
     * @param $message
     * @param $apStoreToken
     * @param int $vibrate
     * @param int $sound
     * @return mixed|void
     */
    public function androidPush($title,  $message, $apStoreToken, $vibrate = 1, $sound = 1){

        // API access key from Google API Console
        //define('API_ACCESS_KEY', 'AIzaSyC8ZbJQTZMh2eT0G6ncE1-tEnxe9_fk7y4');

        if (is_array($apStoreToken)) {
            $registrationIds = $apStoreToken;
        } else {
            $registrationIds = [$apStoreToken];
        }


        // prep the bundle
        $msg = array
        (
            'message' => $message,
            'title' => $title,
            'vibrate' => $vibrate,
            'sound' => $sound
        );

        $fields = array
        (
            'registration_ids' => $registrationIds,
            'data' => $msg
        );

        $headers = array
        (
            'Authorization: key=' . env('GOOGLE_API_KEY'),
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);

    }

    /**
     * @description Send push messages to many users
     *
     * @param string $osType
     * @return bool
     * @throws \Exception
     */
    public function sendNotifications(
        $osType = ''
    )
    {

        $notificationQueue = $this->notification->whereNull('send_date');

        if(in_array($osType, ['IOS', 'ANDROID'])){
            $notificationQueue = $notificationQueue->where('os_type', $osType);
        }

        $notificationQueue = $notificationQueue->take(1000)->get();

        if (!$notificationQueue->isEmpty()) {

            $notificationIds = [];

            try {
                foreach ($notificationQueue as $notification) {

                    if ($notification->os_type == 'IOS') {
                        $this->iosPush($notification->title, $notification->message, $notification->notification_token, $notification->badge, $notification->sound);
                        usleep(150);

                    } elseif ($notification->os_type == 'ANDROID') {
                        $this->androidPush($notification->title, $notification->message, $notification->notification_token);
                        usleep(150);
                    }

                    $notificationIds[] = $notification->id;
                }

                $this->updateSendDate($notificationIds);

                return true;
            } catch (\Exception $ex) {
                throw $ex;
            }
        } else {
            return false;
        }
    }

    /**
     * @description Save push messages to queue
     *
     * @param $receiveUserList
     * @param $title
     * @param string $message
     * @param $createdBy
     * @param int $badge
     * @param string $sound
     * @return bool
     */
    public function saveNotificationsToQueue(
        $receiveUserList,
        $title,
        $message,
        $createdBy,
        $badge = 0,
        $sound = 'default'
    )
    {
        if (!empty($receiveUserList)) {

            $data = [];

            try {
                foreach ($receiveUserList as $id => $deviceArray) {

                    $i = 0;

                    foreach ($deviceArray as $device) {

                        if (!empty($device)) {
                            $data[$i]['user_id'] = $id;
                            $data[$i]['notification_token'] = $device->notification_token;
                            $data[$i]['os_type'] = $device->os_type;
                            $data[$i]['title'] = $title;
                            $data[$i]['message'] = str_limit(strip_tags($message),40);
                            $data[$i]['badge'] = $badge;
                            $data[$i]['sound'] = $sound;
                            $data[$i]['created_at'] = date('Y-m-d H:i:s');
                            $data[$i]['updated_at'] = date('Y-m-d H:i:s');
                            $data[$i]['created_by_id'] = $createdBy;

                            $i++;
                        }
                    }
                }

                $this->addNotificationQueue($data);

                return true;
            } catch (\Exception $ex) {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * @description add notification info
     *
     * @param array $data
     *
     * @return boolean
     */
    public function addNotificationQueue($data)
    {
        return !empty($data) ? $this->notification->insert($data) : false;
    }

    /**
     * @description get pending notifications
     *
     * @param string $os
     * @return object
     */
    public function getPendingTokens($os = 'IOS')
    {
        return $this->notification->where('os_type', $os)
            ->whereNull('send_date')
            ->orderBy('created_at', 'ASC')
            ->offset(0)
            ->take(1000)
            ->get();
    }


    /**
     * @description update send date of notifications
     *
     * @param array $id
     * @return mixed|void
     */
    public function updateSendDate($id = []){
        if(!empty($id)) {
            $this->notification->whereIn('id',$id)->update(['send_date' => date('Y-m-d H:i:s')]);
        }
    }

}