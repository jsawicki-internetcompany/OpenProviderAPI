<?php

use OpenProviderAPI\OpenProviderApi;
use OpenProviderAPI\OpenProviderReply;
use OpenProviderAPI\OpenProviderRequest;
use PHPUnit\Framework\TestCase;

class OpenProviderApiTest extends TestCase
{
    private OpenProviderAPI $openProviderApi;
    private string $username = '';
    private string $password = '';

    protected function setUp(): void
    {
        parent::setUp();

        // Create a new API connection
        $this->openProviderApi = new OpenProviderApi();
    }

    public function testOpenProviderAPI(): void
    {
        $request = new OpenProviderRequest();
        $request->setCommand('checkDomainRequest')
            ->setAuth(array('username' => $this->username, 'password' => $this->password))
            ->setArgs(array(
                    'domains' => array(
                        array('name' => 'openprovider', 'extension' => 'nl'),
                        array('name' => 'non-existing-domain', 'extension' => 'co.uk')
                    )
                )
            );

        $reply = $this->openProviderApi->setDebug(1)->process($request);

        self::assertInstanceOf(OpenProviderReply::class, $reply);
    }

}
