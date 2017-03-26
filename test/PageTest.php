<?php
use PHPUnit\Framework\TestCase;

class PageTest extends TestCase
{

    /**
     * @dataProvider directoryProvider
     * @param \alphayax\rssfs\model\Directory $directory
     */
    public function testNew( \alphayax\rssfs\model\Directory $directory)
    {
        $page = new \alphayax\rssfs\controller\Page( $directory);
        $xml = $page->getXML();
        $this->assertNotEmpty( $xml);
        $this->assertInternalType( 'string', $xml);
    }

    /**
     * @dataProvider directoryProvider
     * @param \alphayax\rssfs\model\Directory $directory
     * @param bool                            $includeSubDirs
     * @runInSeparateProcess
     */
    public function testRaw( \alphayax\rssfs\model\Directory $directory, bool $includeSubDirs = false)
    {
        $page = new \alphayax\rssfs\controller\Page( $directory, $includeSubDirs);

        ob_start();
        $page->display();
        $content = ob_get_contents();
        ob_end_clean();

        $this->assertNotEmpty( $content);
    }

    public function directoryProvider()
    {
        return [
            [new \alphayax\rssfs\model\Directory( __DIR__)],
            [new \alphayax\rssfs\model\Directory( __DIR__ . '/data/')],
            [new \alphayax\rssfs\model\Directory( __DIR__ . '/data/'), true],
        ];
    }

}
