<?php
use PHPUnit\Framework\TestCase;

class DirectoryTest extends TestCase
{

    /**
     * @dataProvider directoryPathProvider
     * @param $path
     */
    public function testPath($path)
    {
        $directory = new \alphayax\rssfs\model\Directory($path);
        $this->assertEquals($directory->getDirectoryAd(), realpath($path));

        $directory->setDirectoryAd($path);
        $this->assertEquals($directory->getDirectoryAd(), realpath($path));
    }

    /**
     * @dataProvider languageProvider
     * @param $language
     */
    public function testLanguage($language)
    {
        $directory = new \alphayax\rssfs\model\Directory(__DIR__);
        $directory->setLanguage($language);
        $this->assertEquals($directory->getLanguage(), $language);
    }

    /**
     * @dataProvider descriptionProvider
     * @param $desc
     */
    public function testDescription($desc)
    {
        $directory = new \alphayax\rssfs\model\Directory(__DIR__);
        $directory->setDescription($desc);
        $this->assertEquals($directory->getDescription(), $desc);
    }

    /**
     * @dataProvider descriptionProvider
     * @param $title
     */
    public function testTitle($title)
    {
        $directory = new \alphayax\rssfs\model\Directory(__DIR__);
        $directory->setTitle($title);
        $this->assertEquals($directory->getTitle(), $title);
    }

    /**
     * @dataProvider descriptionProvider
     * @param $accessUrl
     */
    public function test($accessUrl)
    {
        $directory = new \alphayax\rssfs\model\Directory(__DIR__);
        $directory->setAccessUrl($accessUrl);
        $this->assertEquals($directory->getAccessUrl(), $accessUrl);
    }


    public function directoryPathProvider()
    {
        return [
            [__DIR__],
            [__DIR__ . '/data/'],
            ['.'],
        ];
    }

    public function languageProvider()
    {
        return [
            ['fr_FR'],
            ['en_US'],
            ['en_GB'],
        ];
    }

    public function descriptionProvider()
    {
        return [
            ['Lorem ipsum dolor sit amet'],
            [md5(time())],
        ];
    }

}
