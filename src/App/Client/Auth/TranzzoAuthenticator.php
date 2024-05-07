<?php
/**
 * Description of TranzzoAuthenticator.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Tranzzo\App\Client\Auth;

use Dots\Tranzzo\App\Client\Auth\DTO\TranzzoAuthDTO;
use Saloon\Contracts\Authenticator;
use Saloon\Http\PendingRequest;

class TranzzoAuthenticator implements Authenticator
{
    public const API_AUTH_HEADER = 'X-API-AUTH';

    public const API_KEY_HEADER = 'X-API-KEY';

    public function __construct(
        private readonly TranzzoAuthDTO $authDTO,
    ) {
    }

    public static function fromAuthDTO(TranzzoAuthDTO $dto): static
    {
        return new static($dto);
    }

    public function set(PendingRequest $pendingRequest): void
    {
        $pendingRequest->headers()->add(self::API_AUTH_HEADER, $this->getApiAuthHeader());
        $pendingRequest->headers()->add(self::API_KEY_HEADER, $this->getApiKeyHeader());
    }

    private function getApiKeyHeader(): string
    {
        return $this->authDTO->getEndpointKey();
    }

    private function getApiAuthHeader(): string
    {
        return sprintf('CPAY %s:%s', $this->authDTO->getApiKey(), $this->authDTO->getApiSecret());
    }
}
