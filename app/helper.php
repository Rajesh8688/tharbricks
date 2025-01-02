<?php 
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use App\Services\FirebaseService;
use Illuminate\Support\Facades\File;
use GuzzleHttp\Exception\RequestException;

if (! function_exists('unique_slug')) {
    function unique_slug($title = '', $model = 'Ad', $id = '')
    {
        //dd($title, $model,$id);
        $slug = Str::slug($title);
        //get unique slug...
        $nSlug = $slug;
        $i = 0;

        $model = str_replace(' ', '', "\App\Models\ " . $model);
        $slugcount = $model::whereSlug($nSlug);
        if (!empty($id)) {
            $slugcount = $slugcount->where('id', '!=', $id);
        }
        $slugcount = $slugcount->count();
       // ddd($slugcount);

        while ($slugcount > 0) {
            $i++;
            $nSlug = $slug . '-' . $i;
        }
        if ($i > 0) {
            $newSlug = substr($nSlug, 0, strlen($slug)) . '-' . $i;
        } else {
            $newSlug = $slug;
        }
        return $newSlug;
    }
}
//function for deleteImage image

if (! function_exists('deleteImage')) {
    function deleteImage($imagePath, $imageName)
       {
           $originalPath = $imagePath;
   
           // Delete the previous image
           $imageCheck = $originalPath . $imageName;
   
           if (File::exists($imageCheck)) {
               \File::delete($imageCheck);
           }
           return true;
       }
   }

   if(! function_exists('imagenameMaker')){
    function imagenameMaker($imageOriginalName , $extension = 'png'){
        if(!empty($imageOriginalName)){
            $imageName = Str::slug($imageOriginalName) . '_' . time() . '_' . uniqid() . '.' . $extension;
            return $imageName;
        }
        else{
            //empty
            return 'empty'. time() . '_' . uniqid() . '.png';
        }
       
    }
    
    if (! function_exists('unique_slug')) {
        function unique_slug($title = '', $model = 'Ad', $id = '')
        {
            //dd($title, $model,$id);
            $slug = Str::slug($title);
            //get unique slug...
            $nSlug = $slug;
            $i = 0;
    
            $model = str_replace(' ', '', "\App\Models\ " . $model);
            $slugcount = $model::whereSlug($nSlug);
            if (!empty($id)) {
                $slugcount = $slugcount->where('id', '!=', $id);
            }
            $slugcount = $slugcount->count();
           // ddd($slugcount);
    
            while ($slugcount > 0) {
                $i++;
                $nSlug = $slug . '-' . $i;
            }
            if ($i > 0) {
                $newSlug = substr($nSlug, 0, strlen($slug)) . '-' . $i;
            } else {
                $newSlug = $slug;
            }
            return $newSlug;
        }
    }

    function getBase64ImageExtension($base64Image)
    {
        // Extract the base64 image data
        $data = explode(',', $base64Image);

        // Extract the image format
        $format = explode(';', $data[0])[0];

        // Extract the image extension from the format
        $extension = explode('/', $format)[1];

        return $extension;
    }

    if (! function_exists('base64imageUpload')) {
        function base64imageUpload($image , $path){
            if(!empty($image) && !empty($path)){
                try{
                    $extension = getBase64ImageExtension($image);
                    
                    $image = explode("base64,", $image)[1];
                    // Decode the image
                    $image = base64_decode($image);
                    
                    // Generate a unique filename
                    $filename = sha1(date('YmdHis') . rand(10, 90)) . '.'.$extension;

                    
            
                    // Specify the path where you want to save the image
                    $originalpath = public_path($path . $filename);
            
                    // Ensure the directory exists
                    if (!File::exists(public_path($originalpath))) {
                        File::makeDirectory(public_path($originalpath), 0755, true);
                    }
            
                    // Save the image to the specified path
                    file_put_contents($originalpath, $image);
            
                    // Return the file path or URL
                    $url = url($path . $filename);
                    
                   
                    //print_r($url);exit;
                    
                    return ['status' => true , 'url' => $url , 'message' => "uploaded successfully" , "filename" => $filename];
            
                } catch(Exception $e){
                    return ['status' => false , 'url' => '' , 'message' => $e];
                }
            }else{
                return ['status' => false , 'url' => '' , 'message' => "image and path required" , "filename" => ""];
            }
            
        }
    }

    // if (! function_exists('sendNotification')) {
    //     function sendNotificationFcm($notification_id, $title, $message, $id = 0, $type = "default", $sendMode = 'topic')
    //     {
    
    //         $accesstoken = env('FCM_KEY');
    
    //         $url = "https://fcm.googleapis.com/fcm/send";
    
    //         $notification = [
    //             'title' => $title,
    //             'body' => $message,
    //             'type' => $type,
    //             'id' => (string)$id,
    //             'sound' => 'default',
    //             'android_channel_id' => '1',
    //         ];
    //         $data = [
    //             'title' => $title,
    //             'body' => $message,
    //             'type' => $type,
    //             'id' => (string)$id,
    //             'status' => 'done',
    //             'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
    //         ];
    
    
    //         if ($sendMode == 'topic') {
    //             $arrayToSend = [
    //                 'to' => $notification_id,
    //                 'data' => $data,
    //                 'notification' => $notification,
    //                 'priority' => 'high',
    //                 'channel_id' => '1',
    //             ];
    //         }
    
    //         if ($sendMode == 'device') {
    //             $arrayToSend = [
    //                 'registration_ids' => $notification_id,
    //                 'data' => $data,
    //                 'notification' => $notification,
    //                 'priority' => 'high',
    //                 'channel_id' => '1',
    //             ];
    //         }
    
    //         // echo json_encode($arrayToSend);exit;
    
    //         $ch = curl_init();
    
    //         $headers = array();
    //         $headers[] = 'Content-Type: application/json';
    //         $headers[] = 'Authorization: key=' . $accesstoken;
    //         $ch = curl_init();
    //         curl_setopt($ch, CURLOPT_URL, $url);
    //         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    //         curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrayToSend));
    //         curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    //         $rest = curl_exec($ch);
    
    //         // print_r($rest);exit;
    
    //         if ($rest === false) {
    //             // throw new Exception('Curl error: ' . curl_error($crl));
    //             // print_r('Curl error: ' . curl_error($crl));
    //             $result_noti = 0;
    //         } else {
    //             $result_noti = 1;
    //         }
    
    //         //curl_close($crl);
    //         // print_r($result_noti);die;
    //         return $result_noti;
    //     }
    // }

    
    if (! function_exists('translator')) {
        function translator($message , $json = null){
            if(!empty($json)){
                $jsonArray = json_decode($json , true);
                return __('lang.'.$message , $jsonArray);
            }
            return __('lang.'.$message );
        }
    }

    if (! function_exists('sendNotification')) {
            function sendNotification($token,$data)
            {
                $client = new Client();
                //$accessToken = env('FCM_KEY');
                $firebase = new FirebaseService();
                $accessToken = $firebase->getAccessToken();
                //$accessToken = '802905ab2015bd388c9b92ffaee24e3f12414377';
                //dd($accessToken);
                //dd($accessToken);
                // $message = [
                //     'message' => [
                //         'token' => $token,
                //         'notification' => [
                //             'title' => 'test',
                //             'body' => 'test body',
                //         ],
                //         'data' => [],
                //     ],
                // ];

                $message = [
                    'message' => [
                        'token' => $token,
                        'notification' => [
                            'title' => 'test',
                            'body' => 'body',
                        ],
                        'data' => ["key1"=> "value1",
                        "key2"=> "value2"],
                    ],
                ];
                //dd($message);
    
        
                try {
                    $response = $client->post('https://fcm.googleapis.com/v1/projects/' . env('PROJECT_ID') . '/messages:send', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $accessToken,
                            'Content-Type' => 'application/json',
                        ],
                        'json' => $message
                    ]);
                    $message = json_decode($response->getBody(), true);
                    $status = true;
                    return ['status' => $status, 'message' => $message];
                } catch (RequestException $e) {
                    dd($e);
                    $message = json_decode($e->getResponse()->getBody()->getContents(), true);
                    $status = false;
                    return ['status' => $status, 'message' => $message];
                }
            }
        }
     
    if (! function_exists('callApi')) {
        function callApi($url, $method = 'GET', $params = [], $headers = [])
        {
            $client = new Client();

            try {
                // Set up options with parameters and headers
                $options = [
                    'headers' => $headers,
                ];

                if ($method == 'GET') {
                    $options['query'] = $params;
                } else {
                    $options['json'] = $params;
                }

                // Send the request
                $response = $client->request($method, $url, $options);

                // Return the response as an array
                return [
                    'status' => true,
                    'data' => json_decode($response->getBody()->getContents(), true),
                ];
            } catch (\Exception $e) {
                // Handle errors and return them
                return [
                    'status' => false,
                    'error' => $e->getMessage(),
                ];
            }
        }
    }    



}
?>