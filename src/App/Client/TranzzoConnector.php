<?php
/**
 * Description of TranzzoConnector.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Tranzzo\App\Client;

use Dots\Tranzzo\App\Client\Auth\DTO\TranzzoAuthDTO;
use Dots\Tranzzo\App\Client\Auth\TranzzoAuthenticator;
use Dots\Tranzzo\App\Client\Exceptions\TranzzoException;
use Dots\Tranzzo\App\Client\Requests\Payments\CreateHostedPaymentRequest;
use Dots\Tranzzo\App\Client\Requests\Payments\DTO\CreateHostedPaymentRequestDTO;
use Dots\Tranzzo\App\Client\Requests\Payments\DTO\PaymentOperationsRequestDTO;
use Dots\Tranzzo\App\Client\Requests\Payments\DTO\ResendPaymentWebhookRequestDTO;
use Dots\Tranzzo\App\Client\Requests\Payments\DTO\SplitCapturePaymentRequestDTO;
use Dots\Tranzzo\App\Client\Requests\Payments\DTO\VoidPaymentRequestDTO;
use Dots\Tranzzo\App\Client\Requests\Payments\PaymentOperationsRequest;
use Dots\Tranzzo\App\Client\Requests\Payments\ResendPaymentWebhookRequest;
use Dots\Tranzzo\App\Client\Requests\Payments\SplitCapturePaymentRequest;
use Dots\Tranzzo\App\Client\Requests\Payments\VoidPaymentRequest;
use Dots\Tranzzo\App\Client\Resources\Operation;
use Dots\Tranzzo\App\Client\Resources\Operations;
use Dots\Tranzzo\App\Client\Responses\CreateHostedPaymentResponseDTO;
use Dots\Tranzzo\App\Client\Responses\ErrorResponseDTO;
use RuntimeException;
use Saloon\Http\Connector;
use Saloon\Http\Response;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;
use Throwable;

class TranzzoConnector extends Connector
{
    use AlwaysThrowOnErrors;

    public function __construct(
        private readonly TranzzoAuthDTO $authDto,
        private readonly bool $testMode = false,
    ) {
    }

    /**
     * @throws TranzzoException
     */
    public function createHostedPayment(CreateHostedPaymentRequestDTO $dto): CreateHostedPaymentResponseDTO
    {
        $this->authenticateRequests();

        return $this->send(new CreateHostedPaymentRequest($dto, $this->isTestMode()))->dto();
    }

    /**
     * @throws TranzzoException
     */
    public function splitCapturePayment(SplitCapturePaymentRequestDTO $dto): Operation
    {
        $this->authenticateRequests();

        return $this->send(new SplitCapturePaymentRequest($dto, $this->isTestMode()))->dto();
    }

    /**
     * @throws TranzzoException
     */
    public function cancelPayment(VoidPaymentRequestDTO $dto): Operation
    {
        $this->authenticateRequests();

        return $this->send(new VoidPaymentRequest($dto, $this->isTestMode()))->dto();
    }

    /**
     * @throws TranzzoException
     */
    public function resendPaymentWebhook(ResendPaymentWebhookRequestDTO $dto): void
    {
        $this->authenticateRequests();

        $this->send(new ResendPaymentWebhookRequest($dto));
    }

    /**
     * @throws TranzzoException
     */
    public function getPaymentLastOperation(PaymentOperationsRequestDTO $dto): ?Operation
    {
        $this->authenticateRequests();

        return $this->getPaymentOperations($dto)->getLastOperation();
    }

    /**
     * @throws TranzzoException
     */
    public function getPaymentOperations(PaymentOperationsRequestDTO $dto): Operations
    {
        $this->authenticateRequests();

        return $this->send(new PaymentOperationsRequest($dto))->dto();
    }

    protected function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }

    public function resolveBaseUrl(): string
    {
        $host = config('tranzzo.hosts.production');
        if (! is_string($host)) {
            throw new RuntimeException('Invalid Tranzzo host');
        }

        return $host;
    }

    private function isTestMode(): bool
    {
        return $this->testMode;
    }

    private function authenticateRequests(): void
    {
        $this->authenticate(
            TranzzoAuthenticator::fromAuthDTO($this->authDto),
        );
    }

    public function getRequestException(Response $response, ?Throwable $senderException): ?Throwable
    {
        $errorResponse = ErrorResponseDTO::fromResponse($response);

        return new TranzzoException($errorResponse);
    }
}
