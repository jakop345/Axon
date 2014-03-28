<?php
namespace Axon\Tests;

use Axon\Search;
use Axon\Search\Model\Torrent;

class SearchTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldSearchUsingRegisteredProviders()
    {
        $torrents = array(
            new Torrent()
        );

        $provider = $this->getMock('Axon\Search\Provider\ProviderInterface');
        $provider
            ->expects($this->once())
            ->method('search')
            ->with('foo', null)
            ->will($this->returnValue($torrents));

        $provider
            ->expects($this->any())
            ->method('getName')
            ->will($this->returnValue('test'));

        $search = new Search();
        $search->registerProvider($provider);
        $result = $search->search('foo');

        $this->assertEquals($torrents, $result);
    }
}
