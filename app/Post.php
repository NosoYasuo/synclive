<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function GetId($title)
    {
        $user = $title;
        $url = "https://www.youtube.com/feeds/videos.xml?channel_id=" . $user;
        $rss = file_get_contents($url);
        $rss = preg_replace("/<([^>]+?):(.+?)>/", "<$1_$2>", $rss);
        $rss = simplexml_load_string($rss, 'SimpleXMLElement', LIBXML_NOCDATA);

        foreach ($rss->entry as $value) {
            return $value->yt_videoId;
            if ($value === 0) {
            } else {
                break;
            }
        }
    }
}
