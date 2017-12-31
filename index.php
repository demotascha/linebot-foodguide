<?php

/**
 * Copyright 2016 LINE Corporation
 *
 * LINE Corporation licenses this file to you under the Apache License,
 * version 2.0 (the "License"); you may not use this file except in compliance
 * with the License. You may obtain a copy of the License at:
 *
 *   https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */

/**
 * example sheet
 * https://docs.google.com/spreadsheets/d/16uXte1K6TQWZeiR_X1OquJD98T6SuUNbgqLYfiid1fY/edit#gid=0
 * sheet with json format
 * https://spreadsheets.google.com/feeds/list/16uXte1K6TQWZeiR_X1OquJD98T6SuUNbgqLYfiid1fY/od6/public/values?alt=json
 */
const GOOGLE_SHEET_PATH = '<your sheet with json format>';

const CHANNEL_ACCESS_TOKEN = '<your channel access token>';
const CHANNEL_SECRET = '<your channel secret>';

require_once('line-bot-sdk-tiny/LINEBotTiny.php');

$channelAccessToken = CHANNEL_ACCESS_TOKEN;
$channelSecret = CHANNEL_SECRET;
$gSheet = GOOGLE_SHEET_PATH;

$client = new LINEBotTiny($channelAccessToken, $channelSecret);
foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
        case 'message':
            $message = $event['message'];
            $isMatchKeywords = false;
            $image = '';
            $tableTitle = '';

            $json = file_get_contents($gSheet);
            $data = json_decode($json, true);

            foreach ($data['feed']['entry'] as $item) {
                $keywords = explode(',', $item['gsx$keyword']['$t']);

                if (in_array($message['text'], $keywords)) {
                    $isMatchKeywords = true;
                    $image = $item['gsx$photourl']['$t'];
                    $tableTitle = $item['gsx$title']['$t'];
                }
            }

            switch ($message['type']) {
                case 'text':
                    if (!$isMatchKeywords) {
                        $client->replyMessage(array(
                            'replyToken' => $event['replyToken'],
                            'messages' => array(
                                    array(
                                        'type' => 'text',
                                        'text' => 'Hello 我今天只看得懂人名或外號, 如：黃XX / Demo',
                                    )
                                )
                            )
                        );
                    } else {
                        $client->replyMessage(array(
                            'replyToken' => $event['replyToken'],
                            'messages' => array(
                                array(
                                    'type' => 'text',
                                    'text' => 'Hi ' . $message['text'] . ' 感謝您來參加婚禮',
                                ),
                                array(
                                    'type' => 'text',
                                    'text' => '您的座位是在 ' . $tableTitle . ', 可依照下圖紅色圈圈處移動',
                                ),
                                array(
                                    'type' => 'image',
                                    'originalContentUrl' => $image,
                                    'previewImageUrl' => $image,
                                ),
                                array(
                                    'type' => 'sticker',
                                    'packageId' => '1',
                                    'stickerId' => '2',
                                ),
                            ),
                        ));
                    }
                    break;
                default:
                    error_log("Unsupporeted message type: " . $message['type']);
                    break;
            }
            break;
        default:
            error_log("Unsupporeted event type: " . $event['type']);
            break;
    }
};
