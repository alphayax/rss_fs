<?php

namespace alphayax\rssfs\controller;
use alphayax\rssfs\model\Directory;

/**
 * Class Page
 * @package alphayax\rssfs
 */
class Page {

    /** @var \alphayax\rssfs\model\Directory */
    protected $directory;

    /**
     * Page constructor.
     * @param \alphayax\rssfs\model\Directory $directory
     */
    public function __construct(Directory $directory) {
        $this->directory = $directory;
        $this->rss = new \SimpleXMLElement('<rss></rss>');
        $this->rss->addAttribute('version', '2.0');
        $this->initRssHead();
        $this->addFiles();
    }

    /**
     *
     */
    protected function initRssHead() {

        $this->rss->addChild('channel'); //add channel node
        $this->rss->addChild('title', $this->directory->getTitle());
        $this->rss->addChild('description', $this->directory->getDescription());
        $this->rss->addChild('link', $this->directory->getAccessUrl());
        $this->rss->addChild('language', $this->directory->getLanguage());

        //Create RFC822 Date format to comply with RFC822
        $date_f = date(DATE_RFC2822, time());
        $this->rss->addChild('lastBuildDate', $date_f); //feed last build date

        $this->rss->addChild('generator', 'RssFs');
    }

    protected function addFiles() {


        $dir = new \DirectoryIterator($this->directory->getDirectoryAd());
        foreach ($dir as $fileinfo) {
            if ($fileinfo->isDot()) {
                continue;
            }

            $item = $this->rss->addChild('item');

            $item->addChild('title', $fileinfo->getBasename()); //add title node under item
            $item->addChild('link', $this->directory->getAccessUrl() . '/' . $fileinfo->getBasename());
            $guid = $item->addChild('guid', md5($fileinfo->getRealPath()));
            $guid->addAttribute('isPermaLink', 'false');

            $item->addChild('description', '<![CDATA[' . htmlentities($fileinfo->getBasename()) . ']]>');

            $date_rfc = gmdate(DATE_RFC2822, $fileinfo->getCTime());
            $item->addChild('pubDate', $date_rfc);
        }
    }

    /**
     * @return \SimpleXMLElement
     */
    public function getXML() {

        return $this->rss;
    }

}
