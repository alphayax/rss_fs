<?php

namespace alphayax\rssfs\model;

class Directory {

    /** @var string */
    protected $directory_ad;

    /** @var string */
    protected $accessUrl;

    /** @var string */
    protected $title;

    /** @var string */
    protected $description = '';

    /** @var string */
    protected $language = 'en-US';

    /**
     * @return string
     */
    public function getDirectoryAd(): string {
        return $this->directory_ad;
    }

    /**
     * @param string $directory_ad
     */
    public function setDirectoryAd($directory_ad) {
        $this->directory_ad = $directory_ad;
    }

    /**
     * @return string
     */
    public function getTitle(): string {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title) {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription(): string {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description) {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getLanguage(): string {
        return $this->language;
    }

    /**
     * @param string $language
     */
    public function setLanguage(string $language) {
        $this->language = $language;
    }

    /**
     * Directory constructor.
     * @param string $directory_ad
     */
    public function __construct(string $directory_ad) {
        $this->directory_ad = $directory_ad;
    }

    /**
     * @return string
     */
    public function getAccessUrl(): string {
        return $this->accessUrl;
    }

    /**
     * @param string $accessUrl
     */
    public function setAccessUrl(string $accessUrl) {
        $this->accessUrl = $accessUrl;
    }


}
