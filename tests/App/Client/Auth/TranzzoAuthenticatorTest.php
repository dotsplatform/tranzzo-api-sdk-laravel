<?php
/**
 * Description of TranzzoAuthenticatorTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Tests\App\Client\Auth;

use Dots\Tranzzo\App\Client\Auth\DTO\TranzzoAuthDTO;
use Dots\Tranzzo\App\Client\Auth\TranzzoAuthenticator;
use Saloon\Http\Connectors\NullConnector;
use Saloon\Http\PendingRequest;
use Tests\Mock\TestRequest;
use Tests\TestCase;

class TranzzoAuthenticatorTest extends TestCase
{
    public function testExpectsFromAuthDTO(): void
    {
        $authDTO = TranzzoAuthDTO::fromArray([
            'posId' => $this->uuid(),
            'apiKey' => $this->uuid(),
            'apiSecret' => $this->uuid(),
            'endpointKey' => $this->uuid(),
        ]);
        $expectedApiAuthHeader = sprintf('CPAY %s:%s', $authDTO->getApiKey(), $authDTO->getApiSecret());

        $pendingRequest = new PendingRequest(new NullConnector(), new TestRequest());

        $authenticator = TranzzoAuthenticator::fromAuthDTO($authDTO);
        $authenticator->set($pendingRequest);
        $this->assertEquals(
            $authDTO->getEndpointKey(),
            $pendingRequest->headers()->get(TranzzoAuthenticator::API_KEY_HEADER),
        );
        $this->assertEquals(
            $expectedApiAuthHeader,
            $pendingRequest->headers()->get(TranzzoAuthenticator::API_AUTH_HEADER),
        );
    }
}
