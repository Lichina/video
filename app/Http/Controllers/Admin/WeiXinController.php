<?php

/**

 * Created by PhpStorm.

 * User: echo

 * Date: 2017/12/14

 * Time: 15:56

 */



namespace App\Http\Controllers\Admin;



/**

 * version:3.0

 * by:淡心心心

 */



use App\Http\Controllers\Controller;



class WeiXinController extends Controller

{

    public function responseMsg()

    {



        $postStr = file_get_contents('php://input'); # php7的方式 输入流

        if (!empty($postStr)) {



            libxml_disable_entity_loader(true);

            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);

            $fromUsername = $postObj->FromUserName;

            $toUsername = $postObj->ToUserName;

            $keyword = trim($postObj->Content);



            $event = $postObj->Event;

            $time = time();

            $textTpl = "<xml>

							<ToUserName><![CDATA[%s]]></ToUserName>

							<FromUserName><![CDATA[%s]]></FromUserName>

							<CreateTime>%s</CreateTime>

							<MsgType><![CDATA[%s]]></MsgType>

							<Content><![CDATA[%s]]></Content>

							<FuncFlag>0</FuncFlag>

							</xml>";

            switch ($postObj->MsgType) {

                case 'event':



                    if ($event == 'subscribe') {

                        //关注后的回复

                        $contentStr = config('wxconfig.recontent');

                        $msgType = 'text';

                        $textTpl = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);

                        echo $textTpl;



                    }

                    break;

                case 'text': {

                    $newsTpl = "<xml>

							<ToUserName><![CDATA[%s]]></ToUserName>

							<FromUserName><![CDATA[%s]]></FromUserName>

							<CreateTime>%s</CreateTime>

							<MsgType><![CDATA[news]]></MsgType>

							<ArticleCount>1</ArticleCount>

							<Articles>

							<item>

							<Title><![CDATA[%s]]></Title> 

							<Description><![CDATA[%s]]></Description>

							<PicUrl><![CDATA[%s]]></PicUrl>

							<Url><![CDATA[%s]]></Url>

							</item>							

							</Articles>

							</xml>";

                    if ($keyword <> "") {

                        $title = '《' . $keyword . '》,不要忘记帮忙分享哦';



                        $des1 = "";

                        //图片地址

                        $picUrl1 = config('wxconfig.reimg');

                        //跳转链接

                        $url = "http://" . config('webset.webdomin') . "/search/" . $keyword . ".html";



                        $resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, $title, $des1, $picUrl1, $url);



                        echo $resultStr;

                    }

                    $contentStr = " \r\n 输入电影名如：画江湖之不良人 即可在线观看！\r\n ";





                    $msgType = 'text';

                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);

                    echo $resultStr;

                }

                    break;

                default:

                    break;

            }



        } else {

            echo "你好！欢迎进入" . config('webset.webname') . "微信公众号";

            exit;

        }

    }



}