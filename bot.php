<?php
$access_token = 'Byn9e9F5Rc0g8qLCu4r3TXOCtNzBiWSAo6g6pTFr+YoU4+Ammyv2RqRSJqLxENJhff1q4YW/3Er36lUm5Ce1Gubj/rOpkSiXGnGKCTUJ+lZtyJQZLa5QYdo1eKLmIfkev+OcNRW+fq4tGNGf+xgd+wdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
        if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];
            
            if ($text == 'สวัสดี'){

                $messages = [
                    'type' => 'text',
                    'text' => 'งานยังไม่เสร็จครับ! ขอเลื่อนเป็นพรุ่งนี้ได้ไหมครับ T^T'
                ];

            }elseif (strtolower($text) == 'ideabranch'){

                $messages = [
                    'type' => 'text',
                    'text' => 'ครับ!! ตอนนี้ผมปั่นงานอยู่ ถ้าสนใจจ้างไอเดียบรานช์ติดต่อคุณแพร ถ้าเรื่องเงินๆ ทองๆ ต้องคุณม เลยครับ'
                ];

            }elseif ($text == 'ideabranch'){

                $messages = [
                    'type' => 'text',
                    'text' => 'ตอนนี้บอทยังไม่เก่ง ถ้าสนใจจ้างไอเดียบรานช์ติดต่อคุณแพร ถ้าเรื่องเงินๆ ทองๆ ต้องคุณแม'
                ];

            }elseif ($text == 'คุณแจน'){
                
                 $messages = [
                        'type' => 'image',
                        'originalContentUrl' => 'https://ideabranch.co.th/img/team/ideabranc-team-9.png',
                        'previewImageUrl' => 'https://ideabranch.co.th/img/team/ideabranc-team-9.png'
                ];
                
             }elseif ($text == 'คุณอาร์ท'){
                
                 $messages = [
                        'type' => 'image',
                        'originalContentUrl' => 'https://ideabranch.co.th/img/team/ideabranc-team-3.png',
                        'previewImageUrl' => 'https://ideabranch.co.th/img/team/ideabranc-team-3.png'
                ];
                
             }elseif ($text == 'คุณวี'){
                
                 $messages = [
                        'type' => 'image',
                        'originalContentUrl' => 'https://ideabranch.co.th/img/team/ideabranc-team-2.png',
                        'previewImageUrl' => 'https://ideabranch.co.th/img/team/ideabranc-team-2.png'
                ];
                
             }elseif ($text == 'คุณเม'){
                
                 $messages = [
                    'type' => 'text',
                    'text' => 'ทวงเงินลูกค้าด้วยครับ'
                ];
                
             }elseif ($text == 'คุณแพร'){
                
                 $messages = [
                    'type' => 'text',
                    'text' => 'วันนี้ไปร้านไหนดีครับ?'
                ];
                
             }elseif ($text == 'คุณปอนด์'){
                
                 $messages = [
                    'type' => 'text',
                    'text' => '...'
                ];
                
             }elseif ($text == 'คืนนี้ร้านไหนดี'){
                
                 $messages = [
                    'type' => 'template',
                    'altText' => 'this is a confirm template',
                    'template' => {
                        'type' => 'confirm',
                        'text' => 'Are you sure?',
                        'actions' => [
                            {
                              'type' => 'message',
                              'label' => 'Yes',
                              'text' => 'yes'
                            },
                            {
                              'type' => 'message',
                              'label' => 'No',
                              'text' => 'no'
                            }
                        ]
                    }
                ];
                
             }  
             
            //  else {

            //     $messages = [
            //         'type' => 'text',
            //         'text' => $text
            //     ];
            // }

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";
?>