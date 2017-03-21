<?php

namespace alphayax\rssfs\controller;

use alphayax\rssfs\model\Directory;

/**
 * Class Page
 * @package alphayax\rssfs
 */
class Page
{
    /** @var \alphayax\rssfs\model\Directory */
    protected $directory;

    /** @var bool */
    protected $includeSubFolders;

    /**
     * Page constructor.
     * @param \alphayax\rssfs\model\Directory $directory
     * @param bool                            $includeSubFolder
     */
    public function __construct(Directory $directory, bool $includeSubFolder = false)
    {
        $this->directory = $directory;
        $this->includeSubFolders = $includeSubFolder;
        $this->rss = new \SimpleXMLElement('<rss></rss>');
        $this->rss->addAttribute('version', '2.0');
        $this->initRssHead();
        $this->addFilesFromDirectory($this->directory->getDirectoryAd());
    }

    /**
     *
     */
    protected function initRssHead()
    {
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

    /**
     * Add the files in the directory
     * @param string $directory
     */
    protected function addFilesFromDirectory(string $directory)
    {
        $dir = new \DirectoryIterator($directory);
        foreach ($dir as $fileinfo) {
            $this->addFile($fileinfo);
        }
    }

    /**
     * @param \DirectoryIterator $fileInfo
     */
    protected function addFile(\DirectoryIterator $fileInfo)
    {
        if ($fileInfo->isDot()) {
            return;
        }

        if ($fileInfo->isDir()) {
            if ($this->includeSubFolders) {
                $this->addFilesFromDirectory($fileInfo->getRealPath());
            }
            return;
        }

        $item = $this->rss->addChild('item');

        $item->addChild('title', $fileInfo->getBasename()); //add title node under item
        $item->addChild('link', $this->directory->getAccessUrl() . '/' . $fileInfo->getBasename());
        $guid = $item->addChild('guid', md5($fileInfo->getRealPath()));
        $guid->addAttribute('isPermaLink', 'false');

        $item->addChild('description', '<![CDATA[' . htmlentities($fileInfo->getBasename()) . ']]>');

        $date_rfc = gmdate(DATE_RFC2822, $fileInfo->getCTime());
        $item->addChild('pubDate', $date_rfc);
    }

    /**
     * @return \SimpleXMLElement
     */
    public function getXML()
    {
        return $this->rss->asXML();
    }

    public function display()
    {
        header('Content-Type: text/xml; charset=utf-8', true);
        echo $this->getXML();
    }

}
