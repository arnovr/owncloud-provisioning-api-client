<?php

namespace Arnovr\OwncloudProvisioning\ResponseParser;

use Arnovr\OwncloudProvisioning\Result\GroupsList;
use Arnovr\OwncloudProvisioning\Result\User;
use Arnovr\OwncloudProvisioning\Result\UserList;
use Arnovr\OwncloudProvisioning\Result\StatusResult;
use Arnovr\OwncloudProvisioning\ResponseParser\Exception\ParseException;
use DOMDocument;
use DOMXPath;
use Psr\Http\Message\ResponseInterface;

class XMLResponseParser implements ResponseParser
{
    /**
     * @param ResponseInterface $response
     * @return StatusResult
     * @throws ParseException
     */
    public function parseResponse(ResponseInterface $response)
    {
        /** @var DOMDocument $domDocument */
        $domDocument = $this->createDomDocument($response->getBody()->getContents());

        return $this->parseStatusCodeResult($domDocument, new StatusResult());
    }

    /**
     * @param ResponseInterface $response
     * @return User
     * @throws ParseException
     */
    public function parseFindUser(ResponseInterface $response)
    {
        /** @var DOMDocument $domDocument */
        $domDocument = $this->createDomDocument($response->getBody()->getContents());
        $xpath = new DOMXpath($domDocument);

        $getUserResult = new User();
        $getUserResult->email = $this->getXPathNodeValue($xpath, '/ocs/data/email');
        $getUserResult->quota = $this->getXPathNodeValue($xpath, '/ocs/data/quota');
        $getUserResult->enabled = $this->getXPathNodeValue($xpath, '/ocs/data/enabled');

        $getUserResult = $this->parseStatusCodeResult($domDocument, $getUserResult);
        return $getUserResult;
    }

    /**
     * @param ResponseInterface $response
     * @return mixed
     */
    public function parseFindUsers(ResponseInterface $response)
    {
        /** @var DOMDocument $domDocument */
        $domDocument = $this->createDomDocument($response->getBody()->getContents());
        $xpath = new DOMXpath($domDocument);

        $findUsersResult = new UserList();
        $nodes = $xpath->query('/ocs/data/users/element');
        if ( $nodes->length > 0 )
        {
            foreach($nodes as $node)
            {
                $findUsersResult->users[] = $node->nodeValue;
            }
        }
        $findUsersResult = $this->parseStatusCodeResult($domDocument, $findUsersResult);
        return $findUsersResult;
    }

    /**
     * @param ResponseInterface $response
     * @return GroupsList
     */
    public function parseFindGroup(ResponseInterface $response)
    {
        /** @var DOMDocument $domDocument */
        $domDocument = $this->createDomDocument($response->getBody()->getContents());
        $xpath = new DOMXpath($domDocument);

        $findGroupsOfUserResult = new GroupsList();

        $nodes = $xpath->query('/ocs/data/groups/element');
        if ( $nodes->length > 0 )
        {
            foreach($nodes as $node)
            {
                $findGroupsOfUserResult->groups[] = $node->nodeValue;
            }
        }
        $findGroupsOfUserResult = $this->parseStatusCodeResult($domDocument, $findGroupsOfUserResult);
        return $findGroupsOfUserResult;
    }

    /**
     * @param $xml
     * @return DOMDocument
     *
     * @throws ParseException
     */
    private function createDomDocument($xml)
    {
        $domDocument = new \DOMDocument();
        if ($domDocument->loadXML($xml) === false) {
            throw new ParseException("Could not parse xml input");
        }
        return $domDocument;
    }

    /**
     * @param $domDocument
     * @param StatusResult $result
     * @return StatusResult
     */
    private function parseStatusCodeResult($domDocument, StatusResult $result)
    {
        $xpath = new DOMXpath($domDocument);
        $result->statusCode = $this->getXPathNodeValue($xpath, '/ocs/meta/statuscode');
        return $result;
    }

    /**
     * @param DOMXPath $xpath
     * @return string
     */
    private function getXPathNodeValue(DOMXPath $xpath, $node)
    {
        $nodes = $xpath->query($node);
        if ( $nodes->length > 0 )
        {
            return $nodes->item(0)->nodeValue;
        }
        return '';
    }
}
