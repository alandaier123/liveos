<?php 

/*        $pageinfo = array('nowPage' => $page, 'maxPage' => $maxPage, 'position' => 4);
        
        $html['pagestr'] = lib_game_page::pageBar($pageinfo);*/

class page_lib{     
       
   
    //页码参数位置
    protected static $position = null;
    //当前网址参数
    protected static $url = null;
    //$_GET参数
    protected static $get = null;
    //是否ajax
    protected static $ajax = false;
    //页面锚点 (如:服务器列表页面)
    protected static $anchor = null;
    //页码后缀(如 .html)
    protected static $suffix = null;
    //页码前缀(如 page- )
    protected static $prefix = null;

    //获取当前网址页码/xsk/index/2.html 则传入3
    public static function pageNow($position = null) {
        if (!$position) {
            return 1;
        } else {
            $url = explode('/', explode('?', $_SERVER['REQUEST_URI'])[0]);
            return intval($url[$position])? : 1;
        }
    }

    /*
     * 获取分页html
     * 例如网址: /website/server/wy/6?from=111&where=222 (6为页码，则位置position=4)
     * 调用方法: 
     * lib_game_helper::pageBar(
     * array('nowPage' => 3, 'maxPage' => 99,'position'=>4, 'ajax'=>'cctv','anchor'=>'#list','suffix'=>'.html','prefix'=>'page-','seturl'=>array(2=>'index'))
     * );
     * 参数说明: nowPage 、 maxPage 必传,其它选传。
     * 
     * position页码位置， 若不传则页码为 $_GET['page'] ;
     * ajax分页点击JS事件，为可选参数; 
     * anchor页码锚点，可不传(如区服列表页面); 
     * suffix页码后缀，可不传; 
     * seturl网址参数强制设置，可不传(实现修改或定义某个位置的值:首页/xsk,分页/xsk/index/2.html); 
     * 
     * return  生成分页链接href 或 onclick的调用cctv方法
     */
    public static function pageBar($page) {
        if (!is_array($page) || !count($page)) {
            return '';
        }
        //非ajax需要知道当前网址
        if (!isset($page['ajax']) || false === $page['ajax']) {

            //分割问号前的参数
            self::$url = explode('/', explode('?', $_SERVER['REQUEST_URI'])[0]);

            //强制网址某个位置的参数
            if (isset($page['seturl'])) {
                self::$url = $page['seturl'] + self::$url;
                ksort(self::$url);
            }

            //若设置了页码位置
            if (isset($page['position'])) {
                self::$position = $page['position'];

                //强制页码位置1
                self::$url[self::$position] = 1;

                //获取问号后的参数
                if ($_GET) {
                    self::$get = "?" . http_build_query($_GET)? : null;
                }

                //锚点
                if (isset($page['anchor'])) {
                    self::$anchor = $page['anchor'];
                }

                //后缀
                if (isset($page['suffix'])) {
                    self::$suffix = $page['suffix'];
                }

                //前缀
                if (isset($page['prefix'])) {
                    self::$prefix = $page['prefix'];
                }
            } else {
                //否则抓取 $_GET所有参数;
                self::$get = $_GET? : array();
            }
        } else {
            self::$ajax = $page['ajax'];
        }

        $pageHtml = '';
        if ($page['maxPage'] > 1) {
            $pageHtml .= '<a ' . (1 == $page['nowPage'] ? '' : self::pageUrl(1)) . ' class="pageturn first">首页</a>';
            if (1 != $page['nowPage']) {
                $pageHtml .= '<a ' . self::pageUrl($page['nowPage'] - 1) . ' class="pageturn">上一页</a>';
            }
            $pLR = 2; //page left right
            $pA = $pLR * 2 + 1; // 2 now 2
            if ($pA < $page['maxPage']) {
                $pageStart = (0 < ($page['nowPage'] - $pLR)) ? ($page['nowPage'] - $pLR) : 1;
                $pageEnd = (($page['nowPage'] + $pLR) < $page['maxPage']) ? ($page['nowPage'] + $pLR) : $page['maxPage'];
                if (($pageEnd - $pageStart) < $pA) {
                    $pD = $pA - ($pageEnd - $pageStart) - 1; //差
                    if (0 >= ($page['nowPage'] - $pLR)) {
                        $pageEnd += $pD;
                    }
                    if (($page['nowPage'] + $pLR) >= $page['maxPage']) {
                        $pageStart -= $pD;
                    }
                }
            } else {
                $pageStart = 1;
                $pageEnd = $page['maxPage'];
            }
            for ($i = $pageStart; $i <= $pageEnd; $i++) {
                $pageHtml .= '<a ' . (($i == $page['nowPage']) ? 'class="currentpage pageThis"' : ' ' . self::pageUrl($i) . ' ') . '>' . $i . '</a>';
            }
            if ($page['nowPage'] != $page['maxPage']) {
                $pageHtml .= '<a ' . self::pageUrl($page['nowPage'] + 1) . ' class="pageturn">下一页</a>';
            }
            $pageHtml .= '<a ' . ($page['maxPage'] == $page['nowPage'] ? '' : self::pageUrl($page['maxPage'])) . ' class="pageturn last">末页</a>';
        }

        return $pageHtml;
    }

    //生成第几页的网址
    private static function pageUrl($page) {
        if (!self::$ajax) {
            if (isset(self::$position)) {
                self::$url[self::$position] = self::$prefix . $page . self::$suffix;
                return ' href="' . implode('/', self::$url) . self::$get . self::$anchor . '"';
            } else {
                self::$get['page'] = $page;
                return ' href="' . implode('/', self::$url) . '?' . http_build_query(self::$get) . '"';
            }
        } else {
            return ' onclick="javascript:' . self::$ajax . '(' . $page . ');"';
        }
    }



} 