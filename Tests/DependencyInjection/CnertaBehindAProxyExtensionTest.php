<?php

namespace Cnerta\BehindAProxyBundle\Tests\DependencyInjection;

use Cnerta\BehindAProxyBundle\DependencyInjection\CnertaBehindAProxyExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class CnertaBehindAProxyExtensionTest extends \PHPUnit_Framework_TestCase
{

    public function testDefaultLoadedService()
    {
        $container = new ContainerBuilder();
        $loader = new CnertaBehindAProxyExtension();

        $loader->load(array(array()), $container);

        $this->assertTrue($container->hasDefinition('cnerta.baproxy'), 'The Cnerta ProxyService is not defined');
        $this->assertTrue($container->hasDefinition('cnerta.baproxy.proxylistner'), 'The cnerta.baproxy.proxylistner is not defined');        

    }

    public function testDefaultConfigurationExist()
    {
        
        $container = new ContainerBuilder();
        $loader = new CnertaBehindAProxyExtension();

        $loader->load(array(array()), $container);

        $this->assertTrue($container->hasParameter("cnerta_baproxy.enabled"), 'The "enabled" parameter is not defined');
        $this->assertTrue($container->hasParameter("cnerta_baproxy.host"), 'The "host" parameter is not defined');
        $this->assertTrue($container->hasParameter("cnerta_baproxy.port"), 'The "port" parameter is not defined');
        $this->assertTrue($container->hasParameter("cnerta_baproxy.login"), 'The "login" parameter is not defined');
        $this->assertTrue($container->hasParameter("cnerta_baproxy.password"), 'The "password" parameter is not defined');
        $this->assertTrue($container->hasParameter("cnerta_baproxy.load_default_stream_context"), 'The "load_default_stream_context" parameter is not defined');
    }

    public function testDefaultConfigurationValue()
    {

        $container = new ContainerBuilder();
        $loader = new CnertaBehindAProxyExtension();

        $loader->load(array(array()), $container);

        $this->assertFalse($container->getParameter("cnerta_baproxy.enabled"), 'The "enabled" parameter must be set to false');
        $this->assertNull($container->getParameter("cnerta_baproxy.host"), 'The "host" parameter must be set to null');
        $this->assertNull($container->getParameter("cnerta_baproxy.port"), 'The "port" parameter must be set to null');
        $this->assertNull($container->getParameter("cnerta_baproxy.login"), 'The "login" parameter must be set to null');
        $this->assertNull($container->getParameter("cnerta_baproxy.password"), 'The "password" parameter must be set to null');
        $this->assertFalse($container->getParameter("cnerta_baproxy.load_default_stream_context"), 'The "load_default_stream_context" parameter must be set to false');
    }

    public function testFullConfiguration()
    {
        $container = new ContainerBuilder();
        $loader = new CnertaBehindAProxyExtension();

        $httpExpected = array(
            'host_proxy' => "127.0.0.1",
            'port_proxy' => "80",
            'login_proxy' => "login",
            'password_proxy' => "password",
            'request_fulluri' => true,
        );

        $loader->load(array(array(
            'http' => $httpExpected,
            'https' => $httpExpected
        )), $container);

        $this->assertTrue($container->hasParameter("cnerta_baproxy.enabled"), 'The "enabled" parameter is not defined');
        $this->assertTrue($container->hasParameter("cnerta_baproxy.host"), 'The "host" parameter is not defined');
        $this->assertTrue($container->hasParameter("cnerta_baproxy.port"), 'The "port" parameter is not defined');
        $this->assertTrue($container->hasParameter("cnerta_baproxy.login"), 'The "login" parameter is not defined');
        $this->assertTrue($container->hasParameter("cnerta_baproxy.password"), 'The "password" parameter is not defined');
        $this->assertTrue($container->hasParameter("cnerta_baproxy.load_default_stream_context"), 'The "load_default_stream_context" parameter is not defined');
        $this->assertEquals($httpExpected, $container->getParameter("cnerta_baproxy.http"));
        $this->assertEquals($httpExpected, $container->getParameter("cnerta_baproxy.https"));

    }

}
