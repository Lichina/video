<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Common\CommonController;
use App\Http\Controllers\Controller;
use function GuzzleHttp\Psr7\str;
use QL\QueryList;

class CoreController extends Controller
{
    private $ql;
    private $common;
    private $domin;
    private $opts = [
        // 伪造http头
        'headers' => [
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36',
        ]
    ];

    //初始化采集类
    public function __construct()
    {
        $this->ql = new QueryList();
        $this->domin = "https://www.360kan.com";
        $this->common= new CommonController();

    }

    #生成首页电视数据
    public function getIndexDsj()
    {
        $data = $this->dmList('all', 1);
        print_r($data);
    }

    #采集首页电视数据
    public function indexDsCollect()
    {
        $rules = [
            'title' => ['ul:eq(10) .s1', 'text', ''],
            'url' => ['ul:eq(10) a.js-link', 'href', ''],
            'img' => ['ul:eq(10) .js-playicon img', 'data-src', ''],
            'pf' => ['ul:eq(10) .s2', 'text', ''],
            'js' => ['ul:eq(10) .w-newfigure-hint', 'text'],
        ];

        $data = $this->ql->get($this->domin, '', $this->opts)->rules($rules)->query()->getData();
        return $data->all();
    }
    #采集电影列表数据
    public function dyList($cat, $page)
    {
        $url = $this->domin . '/dianying/list?rank=rankhot&cat=' . $cat . '&area=all&act=all&year=all&pageno=' . $page;
        //$url = 'https://www.360kan.com/dianying/list?rank=rankhot&cat=all&area=all&act=all&year=all&pageno=3';
        $rules = [
            'title' => ['ul:eq(8) .s1', 'text', ''],
            'url' => ['ul:eq(8) a.js-tongjic', 'href', '', function ($content) {
                return base64_encode($this->domin . $content);
            }],
            'img' => ['ul:eq(8) .cover.g-playicon img', 'src', ''],
            'pf' => ['ul:eq(8) .s2', 'text', ''],
            'year' => ['ul:eq(8) .hint', 'text'],
            'star' => ['ul:eq(8) .star', 'text', '']
        ];
        $data = $this->ql->get($url)->rules($rules)->query()->getData();
        $this->ql->destruct();
        return $data->all();
    }

    #采集电视剧列表数据
    public function dsjList($cat, $page)
    {
        $url = $this->domin . '/dianshi/list?rank=rankhot&cat=' . $cat . '&area=all&act=all&year=all&pageno=' . $page;
        $rules = [
            'title' => ['.list.g-clear .s1', 'text', ''],
            'url' => ['.list.g-clear a.js-tongjic', 'href', '', function ($content) {
                return base64_encode($this->domin . $content);
            }],
            'img' => ['.list.g-clear .cover.g-playicon img', 'src', ''],
            'js' => ['.list.g-clear .hint', 'text', ''],
            'star' => ['.list.g-clear .star', 'text', '']
        ];
        $data = $this->ql->get($url)->rules($rules)->query()->getData();
        return $data->all();
    }

    #采集综艺列表数据
    public function zyList($cat, $page)
    {
        $url = $this->domin . '/zongyi/list?rank=rankhot&cat=' . $cat . '&area=all&act=all&pageno=' . $page;
        $rules = [
            'title' => ['.list.g-clear .s1', 'text', ''],
            'url' => ['.list.g-clear a.js-tongjic', 'href', '', function ($content) {
                return base64_encode($this->domin . $content);
            }],
            'img' => ['.list.g-clear .cover.g-playicon img', 'src', ''],
            'js' => ['.list.g-clear .hint', 'text', ''],
            'star' => ['.list.g-clear .star', 'text', '']
        ];
        $data = $this->ql->get($url)->rules($rules)->query()->getData();
        return $data->all();
    }

    #采集动漫列表数据
    public function dmList($cat, $page)
    {
        $url = $this->domin . '/dongman/list?rank=rankhot&cat=' . $cat . '&area=all&act=all&pageno=' . $page;
        $rules = [
            'title' => ['.list.g-clear .s1', 'text', ''],
            'url' => ['.list.g-clear a.js-tongjic', 'href', '', function ($content) {
                return base64_encode($this->domin . $content);
            }],
            'img' => ['.list.g-clear .cover.g-playicon img', 'src', ''],
            'js' => ['.list.g-clear .hint', 'text', ''],
        ];
        $data = $this->ql->get($url)->rules($rules)->query()->getData();
        return $data->all();
    }

    #获取电影播放列表
    public function getDyPlay($url)
    {
        $rules = [
            'title'=>['.title-left.g-clear h1','text',''],
            'desc' => ['.item-desc.js-close-wrap', 'text', '-span'],
            'playname' => ['.top-list-zd.g-clear a[data-daochu^="to="]', 'text', '-span'],
            'play' => ['.top-list-zd.g-clear a[data-daochu^="to="]', 'href', '', function ($content) {
                if (strpos($content, 'cps')&&strpos($content, 'youku')) {
                    $arr = explode('&', $content);
                    $url = str_replace('url=', '', $arr['1']);
                    return $url;

                } else {
                    if(strpos($content, '?')){
                        $lenth = strpos($content, '?');
                        return substr($content, 0, $lenth);
                    }
                    else{
                        return $content;
                    }

                }

            }]
        ];
        $data = $this->ql->get($url)->rules($rules)->query()->getData();
        return $data->all();
    }

    #获取电视剧播放列表
    public function getDsjPlay($url)
    {
        $rules = [
            'title'=>['.title-left.g-clear h1','text',''],
            'desc' => ['.item-desc.js-close-wrap', 'text', '-span'],
        ];
        $data = $this->ql->get($url)->rules($rules)->query()->getData();
        return $data->all();
    }

    #获取综艺播放剧集
    public function getZyPlay($url)
    {
        $rules = [
            'bt'=>['.title-left.g-clear h1','text',''],
            'zd' => ['.ea-site', 'text', ''],
            'desc' => ['.item-desc.js-close-wrap', 'text', '-span'],
            'title' => ['.js-year-page .s1', 'text', ''],
            'href' => ['.js-year-page a.js-link', 'href'],
            'time' => ['.js-year-page .w-newfigure-hint', 'text', '']
        ];
        $data = $this->ql->get($url)->rules($rules)->query()->getData();
        return $data->all();
    }

    #获取搜索结果
    public function getSearch($key){
        $url = 'https://so.360kan.com/index.php?kw='.$key;
        $rules = [
            'title'=>['.b-mainpic a','title',''],
            'url'=>['.b-mainpic a','href','',function($content){
                 $url = str_replace('http://','https://',$content);
                 return base64_encode($url);
            }],
            'img'=>['.b-mainpic img','src',''],
            'type'=>['.cont .playtype','text',''],
            'desc'=>['.js-b-fulldesc','data-full']
        ];
        $data = $this->ql->get($url)->rules($rules)->query()->getData();
        return $data->all();
    }

    #------后台核心逻辑--------
    #获取影片总数
    public function getTotal(){
        $url = $this->domin.'/dianshi/list.php';
        $rules = [
            'total'=>['.app span','text','']
        ];
        $data = $this->ql->get($url)->rules($rules)->query()->getData();
        return $data->all();
    }

    #获取尝鲜url
    public function getCx($key,$dizhi){
        $url = 'http://'.$dizhi.'/index.php?m=vod-search';
        $arr = ['wd'=>$key,'submit'=>'search'];
        $html = $this->common->curl_post($url,$arr);
        $rules = [
            'url'=>['.xing_vb4:eq(0) a','href','']
        ];
        $data = $this->ql->html($html)->rules($rules)->query()->getData();
        $res = $data->all();
        $res[0]['url'] = 'http://'.$dizhi.$res[0]['url'];
        return $res;

    }

    public function getCxData($url){
        $rules = [
            'dyname'=>['.vodh h2','text'],
            'dydesc'=>['.vodplayinfo:eq(1)','text',''],
            'dylogo'=>['.lazy','src'],
            'dyaddr'=>['ul:eq(6) li','text']
        ];
        $data = $this->ql->get($url)->rules($rules)->query()->getData();
        return $data->all();
    }
}