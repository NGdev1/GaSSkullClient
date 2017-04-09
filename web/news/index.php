<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 29.03.17
 * Time: 17:41
 */

require_once "../../bootstrap.php";

\Utils\Utils::enableLogging();

function getNewsArray()
{
    $response = array();

    $rss = 'https://kazanfirst.ru/feed/';

    $data = file_get_contents($rss);

    $data = str_replace("content:encoded", "content_encoded", $data);
    $data = str_replace("<![CDATA[", "", $data);
    $data = str_replace("]]>", "", $data);

//Проверяем ссылку на ленту
    $xml = @simplexml_load_string($data);
    if ($xml === false) {
        return $response;
    }

    $pnum = 0;
    $response["feed"] = array();

    foreach ($xml->xpath('//item') as $item) {
        $pnum++;
        if ($pnum > 19) {
            break;
        }

        $profilePic = "https://kazanfirst.ru/wp-content/themes/kazanfirst/images/logo.png";
        $title = (string)$item->title;
        //$category = (string)$item->{'category'};
        $description = (string)$item->content_encoded->p[0] . "\n" . (string)$item->content_encoded->p[1] . "\n" . (string)$item->content_encoded->p[2] . "\n" . (string)$item->content_encoded->p[3];
        try {
            $image = (string)$item->content_encoded->p->img;
        } catch (Exception $e) {
            $image = "";
        }
        $time = (strtotime((string)$item->{'pubDate'}) * 1000);
        $link = (string)$item->{'link'};

        $cmt = array();
        $cmt['id'] = $pnum;
        $cmt['name'] = $title;
        $cmt['profileImage'] = $profilePic;

        $cmt['description'] = "   " . $description;
        $cmt['image'] = $image;
        $cmt['timeStamp'] = $time;
        $cmt['url'] = $link;

        array_push($response["feed"], $cmt);
    }


    return $response;
}

echo json_encode(getNewsArray());