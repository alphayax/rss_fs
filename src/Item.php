<?php
namespace alphayax\rssfs;

class Item {

    /** @var string */
    protected $directory_afi;

    /** @var string */
    protected $baseUrl;

    /**
     * Item constructor.
     * @param string $directory
     * @param string $baseUrl
     */
    public function __construct( string $directory, string $baseUrl) {
        $this->directory_afi = $directory;
        $this->baseUrl       = $baseUrl;
    }


    public function d() {


        $rss = new \SimpleXMLElement('<rss></rss>');
        $rss->addAttribute('version', '2.0');

        $channel = $rss->addChild('channel'); //add channel node

        $title = $rss->addChild('title', 'Inea'); //title of the feed
        $description = $rss->addChild('description', 'description line goes here'); //feed description
        $link = $rss->addChild('link', 'http://www.alphayax.com'); //feed site
        $language = $rss->addChild('language', 'en-us'); //language

        //Create RFC822 Date format to comply with RFC822
        $date_f = date("D, d M Y H:i:s T", time());
        $build_date = gmdate(DATE_RFC2822, strtotime($date_f));
        $lastBuildDate = $rss->addChild('lastBuildDate', $date_f); //feed last build date

        $generator = $rss->addChild('generator', 'PHP Simple XML'); //add generator node


        $host = 'https://inea.alphayax.com/';


        $dir = new \DirectoryIterator( $this->directory_afi);
        foreach ($dir as $fileinfo) {
            if ( ! $fileinfo->isDot()) {
                /*
                var_dump([
                    'getATime'    => date( DATE_RFC3339 ,$fileinfo->getATime()),
                    'getMTime'    => date( DATE_RFC3339 ,$fileinfo->getMTime()),
                    'getCTime'    => date( DATE_RFC3339 ,$fileinfo->getCTime()),
                    'getBasename' => $fileinfo->getBasename(),
                ]);
        */
                $item = $rss->addChild('item'); //add item node
                $title = $item->addChild('title', $fileinfo->getBasename()); //add title node under item
                $link = $item->addChild('link', $host . $fileinfo->getBasename()); //add link node under item
                $guid = $item->addChild('guid', $host . $fileinfo->getInode()); //add guid node under item
                $guid->addAttribute('isPermaLink', 'false'); //add guid node attribute

                $description = $item->addChild('description', '<![CDATA[' . htmlentities('sdfg') . ']]>'); //add description

                $date_rfc = gmdate(DATE_RFC2822, $fileinfo->getCTime());
                $item = $item->addChild('pubDate', $date_rfc); //add pubDate node
            }
        }

        return $rss;
    }
}
