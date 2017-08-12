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

            }elseif (strtolower($text) == 'location'){
                
                                $messages = [
                                    'type': 'location',
                                    'title': 'IDEA BRANCH',
                                    'address': '50 GMM Grammy PLACE, 12th Floor Rd. (Asoke), Khlongtoeinuea,Wattana, 21 Sukhumvit Rd, Khlong Toei, Krung Thep Maha Nakhon 10110',
                                    'latitude': 13.7433933,
                                    'longitude': 100.5630251
                                ];
                
             } else {

                // Build message to reply back
                $messages = [
                    'type' => 'text',
                    'text' => $text
                ];
            }

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