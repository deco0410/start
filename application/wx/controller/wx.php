<?php
// 响应用户消息
// 微信公众账号响应给用户的不同消息类型
//微信服务器要和后台服务器进行通信首先要进行token验证，微信会通过get方式发送signature（微信加密签名）、nonce（随机数）、timestamp（时间戳）、echostr（随机字符串）。后台服务器获取之后会将timestamp、nonce与自身定义的TOKEN按照一定的顺序拼接成字符串，通过shal加密后获得的结果与signature进行对比，如果相同则把echostr返回给微信服务器。 表示验证成功。
header("content-type:text;charset=utf8");
define("TOKEN", "weixin");
//token验证是通过get传输数据，微信用户发送的数据通过post方式发送。先进行get请求，再进行post请求。
$wechatObj = new wechatCallbackapiTest();
//判断是get请求还是post请求。$_GET['echostr']如果存在，表示是进行token验证的get请求。反之是传输数据的post请求。
if (!isset($_GET['echostr'])) {
    $wechatObj->responseMsg();//响应数据
} else {
    $wechatObj->valid();//响应
}

class wechatCallbackapiTest
{
    public function valid()
    {
        $echoStr = $_GET["echostr"];
        if ($this->checkSignature()) {
            echo $echoStr;
            exit;
        }
    }

    private function checkSignature()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr);//对数组中的元素进行排序
        $tmpStr = implode($tmpArr);//将数组中的元素连接成一个字符串
        $tmpStr = sha1($tmpStr);//对字符串进行加密操作。

        if ($tmpStr == $signature) {
            return true;
        } else {
            return false;
        }
    }

    public function responseMsg()
    {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];//获取发送过来的数据。
        if (!empty($postStr)) {
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement');//把xml字符串载入到一个SimpleXMLelement对象中。simplexml_load_string()是一种xml解析器。
            $RX_TYPE = trim($postObj->MsgType);//trim去掉字符串两端kongge。

            //用户发送的消息类型判断
            switch ($RX_TYPE) {
                case "text":
                    $result = $this->receiveText($postObj);
                    break;
                case "image":
                    $result = $this->receiveImage($postObj);
                    break;
                case "voice":
                    $result = $this->receiveVoice($postObj);
                    break;
                case "video":
                    $result = $this->receiveVideo($postObj);
                    break;
                default:
                    $result = "unknow msg type: " . $RX_TYPE;
                    break;
            }
            echo $result;
        } else {
            echo "";
            exit;
        }
    }

    private function receiveText($object)
    {
        $keyword = trim($object->Content);

        if ($keyword == "文本") {
            //回复文本消息
            $content = "这是个文本消息";
            $result = $this->transmitText($object, $content);
        } else if ($keyword == "图文" || $keyword == "单图文") {
            //回复单图文消息
            $content = array();
            $content[] = array("Title" => "单图文标题",
                "Description" => "单图文内容",
                "PicUrl" => "http://discuz.comli.com/weixin/weather/icon/cartoon.jpg",
                "Url" => "http://m.cnblogs.com/?u=txw1958");
            $result = $this->transmitNews($object, $content);
        } else if ($keyword == "多图文") {
            //回复多图文消息
            $content = array();
            $content[] = array("Title" => "多图文1标题", "Description" => "", "PicUrl" => "http://discuz.comli.com/weixin/weather/icon/cartoon.jpg", "Url" => "http://m.cnblogs.com/?u=txw1958");
            $content[] = array("Title" => "多图文2标题", "Description" => "", "PicUrl" => "http://d.hiphotos.bdimg.com/wisegame/pic/item/f3529822720e0cf3ac9f1ada0846f21fbe09aaa3.jpg", "Url" => "http://m.cnblogs.com/?u=txw1958");
            $content[] = array("Title" => "多图文3标题", "Description" => "", "PicUrl" => "http://g.hiphotos.bdimg.com/wisegame/pic/item/18cb0a46f21fbe090d338acc6a600c338644adfd.jpg", "Url" => "http://m.cnblogs.com/?u=txw1958");
            $result = $this->transmitNews($object, $content);

        } else if ($keyword == "音乐") {
            //回复音乐消息
            $content = array("Title" => "最炫民族风",
                "Description" => "歌手：凤凰传奇",
                "MusicUrl" => "http://121.199.4.61/music/zxmzf.mp3",
                "HQMusicUrl" => "http://121.199.4.61/music/zxmzf.mp3");
            $result = $this->transmitMusic($object, $content);
        }

        return $result;
    }

    private function receiveImage($object)
    {
        //回复图片消息
        $content = array("MediaId" => $object->MediaId);
        $result = $this->transmitImage($object, $content);;
        return $result;
    }

    private function receiveVoice($object)
    {
        //回复语音消息
        $content = array("MediaId" => $object->MediaId);
        $result = $this->transmitVoice($object, $content);;
        return $result;
    }

    private function receiveVideo($object)
    {
        //回复视频消息
        $content = array("MediaId" => $object->MediaId, "ThumbMediaId" => $object->ThumbMediaId, "Title" => "", "Description" => "");
        $result = $this->transmitVideo($object, $content);;
        return $result;
    }

    /*
    * 回复文本消息，将要回复的xml消息进行包装。
    */
    private function transmitText($object, $content)
    {
        $textTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[%s]]></Content>
</xml>";
        $result = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $content);//sprintf（）这个函数的作用还是比较有意思的，可以搜索看看。
        return $result;
    }

    /*
    * 回复图片消息
    */
    private function transmitImage($object, $imageArray)
    {
        $itemTpl = "<Image>
 <MediaId><![CDATA[%s]]></MediaId>
</Image>";

        $item_str = sprintf($itemTpl, $imageArray['MediaId']);

        $textTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[image]]></MsgType>
$item_str
</xml>";

        $result = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }

    /*
    * 回复语音消息
    */
    private function transmitVoice($object, $voiceArray)
    {
        $itemTpl = "<Voice>
 <MediaId><![CDATA[%s]]></MediaId>
</Voice>";

        $item_str = sprintf($itemTpl, $voiceArray['MediaId']);

        $textTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[voice]]></MsgType>
$item_str
</xml>";

        $result = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }

    /*
    * 回复视频消息
    */
    private function transmitVideo($object, $videoArray)
    {
        $itemTpl = "<Video>
 <MediaId><![CDATA[%s]]></MediaId>
 <ThumbMediaId><![CDATA[%s]]></ThumbMediaId>
 <Title><![CDATA[%s]]></Title>
 <Description><![CDATA[%s]]></Description>
</Video>";

        $item_str = sprintf($itemTpl, $videoArray['MediaId'], $videoArray['ThumbMediaId'], $videoArray['Title'], $videoArray['Description']);

        $textTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[video]]></MsgType>
$item_str
</xml>";

        $result = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }

    /*
    * 回复图文消息
    */
    private function transmitNews($object, $arr_item)
    {
        if (!is_array($arr_item))
            return;

        $itemTpl = " <item>
 <Title><![CDATA[%s]]></Title>
 <Description><![CDATA[%s]]></Description>
 <PicUrl><![CDATA[%s]]></PicUrl>
 <Url><![CDATA[%s]]></Url>
 </item>
";
        $item_str = "";
        foreach ($arr_item as $item)
            $item_str .= sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);

        $newsTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[news]]></MsgType>
<Content><![CDATA[]]></Content>
<ArticleCount>%s</ArticleCount>
<Articles>
$item_str</Articles>
</xml>";

        $result = sprintf($newsTpl, $object->FromUserName, $object->ToUserName, time(), count($arr_item));
        return $result;
    }

    /*
    * 回复音乐消息
    */
    private function transmitMusic($object, $musicArray)
    {
        $itemTpl = "<Music>
 <Title><![CDATA[%s]]></Title>
 <Description><![CDATA[%s]]></Description>
 <MusicUrl><![CDATA[%s]]></MusicUrl>
 <HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
</Music>";

        $item_str = sprintf($itemTpl, $musicArray['Title'], $musicArray['Description'], $musicArray['MusicUrl'], $musicArray['HQMusicUrl']);

        $textTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[music]]></MsgType>
$item_str
</xml>";

        $result = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }
}