<?php


use Arnovr\OwncloudProvisioning\ResponseParser\XMLResponseParser;
use Arnovr\OwncloudProvisioning\Result\StatusResult;
use GuzzleHttp\Psr7\Response;

class XmlResultParserTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldParseToValidResult()
    {
        $validXml = '<?xml version="1.0"?><ocs><meta><statuscode>100</statuscode><status>ok</status></meta></ocs>';
        $response = new Response(200, [], $validXml);
        $resultParser = new XMLResponseParser();
        $result = $resultParser->parseResponse($response);

        $this->assertInstanceOf(StatusResult::class, $result);

        $this->assertEquals(
            100,
            $result->statusCode
        );
    }
    /**
     * @test
     */
    public function shouldParseToValidResultWithOtherStatusCode()
    {
        $validXml = '<?xml version="1.0"?><ocs><meta><statuscode>101</statuscode><status>ok</status></meta></ocs>';
        $response = new Response(200, [], $validXml);
        $resultParser = new XMLResponseParser();
        $result = $resultParser->parseResponse($response);

        $this->assertInstanceOf(StatusResult::class, $result);

        $this->assertEquals(
            101,
            $result->statusCode
        );
    }
}