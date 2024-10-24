<?php

namespace DigitSoft\Checkbox;

use GuzzleHttp\Client;
use DigitSoft\Checkbox\TokenStorage\JWTStorage;
use DigitSoft\Checkbox\RouteGroups\TaxesRouteGroup;
use DigitSoft\Checkbox\RouteGroups\ShiftsRouteGroup;
use DigitSoft\Checkbox\RouteGroups\CashierRouteGroup;
use DigitSoft\Checkbox\RouteGroups\ReportsRouteGroup;
use DigitSoft\Checkbox\Exceptions\ValidationException;
use DigitSoft\Checkbox\RouteGroups\ReceiptsRouteGroup;
use DigitSoft\Checkbox\RouteGroups\TransactionsRouteGroup;
use DigitSoft\Checkbox\RouteGroups\CashRegistersRouteGroup;
use DigitSoft\Checkbox\Exceptions\InvalidCredentialsException;
use DigitSoft\Checkbox\Exceptions\BadRequestExceptionFactory;

class CheckboxJsonApi
{
    // Keep sync with package version in composer.json
    public const string SDK_VERSION = '0.2.0';

    protected Routes $routes;

    protected Client $guzzleClient;

    protected Config $config;

    protected ?JWTStorage $tokenStorage = null;

    /** @var int Connect timeout in seconds */
    protected int $connectTimeout;

    protected array $defaultHeaders;

    protected ?string $authTokenCashier = null;

    /**
     * Constructor
     *
     * @param  Config                                           $config
     * @param  \DigitSoft\Checkbox\TokenStorage\JWTStorage|null $tokenStorage
     * @param  int                                              $connectTimeoutSeconds
     */
    public function __construct(Config $config, ?JWTStorage $tokenStorage = null, int $connectTimeoutSeconds = 5)
    {
        $this->config = $config;
        $this->tokenStorage = $tokenStorage;
        $this->connectTimeout = $connectTimeoutSeconds;

        $this->initConfiguration();
    }

    /**
     * Get route group for the cashier operations.
     *
     * @return \DigitSoft\Checkbox\RouteGroups\CashierRouteGroup
     */
    public function cashier(): CashierRouteGroup
    {
        return new CashierRouteGroup($this);
    }

    /**
     * Get route group for shifts.
     *
     * @return \DigitSoft\Checkbox\RouteGroups\ShiftsRouteGroup
     */
    public function shifts(): ShiftsRouteGroup
    {
        return new ShiftsRouteGroup($this);
    }

    /**
     * Get route group for cash registers (пРРО).
     *
     * @return \DigitSoft\Checkbox\RouteGroups\CashRegistersRouteGroup
     */
    public function cashRegisters(): CashRegistersRouteGroup
    {
        return new CashRegistersRouteGroup($this);
    }

    /**
     * Get route group for the receipts (чеки).
     *
     * @return \DigitSoft\Checkbox\RouteGroups\ReceiptsRouteGroup
     */
    public function receipts(): ReceiptsRouteGroup
    {
        return new ReceiptsRouteGroup($this);
    }

    /**
     * Get route group for the reports.
     *
     * @return \DigitSoft\Checkbox\RouteGroups\ReportsRouteGroup
     */
    public function reports(): ReportsRouteGroup
    {
        return new ReportsRouteGroup($this);
    }

    /**
     * Get route group for the taxes.
     *
     * @return \DigitSoft\Checkbox\RouteGroups\TaxesRouteGroup
     */
    public function taxes(): TaxesRouteGroup
    {
        return new TaxesRouteGroup($this);
    }

    /**
     * Get route group for transactions.
     *
     * @return \DigitSoft\Checkbox\RouteGroups\TransactionsRouteGroup
     */
    public function transactions(): TransactionsRouteGroup
    {
        return new TransactionsRouteGroup($this);
    }

    /**
     * Save a JWT token of the cashier.
     *
     * @param  string|null $token
     * @return $this
     */
    public function setCashierAuthToken(?string $token): static
    {
        $this->authTokenCashier = $token;

        return $this;
    }

    /**
     * Determines whether cashier JWT token was set.
     *
     * @return bool
     */
    public function hasCashierAuthToken(): bool
    {
        return isset($this->authTokenCashier);
    }

    /**
     * Get previously stored cashier token.
     *
     * @return string|null
     */
    public function getCashierAuthTokenFromStorage(): ?string
    {
        $conf = $this->config;
        if (! isset($this->tokenStorage) || ! isset($conf->licenseKey)) {
            return null;
        }
        if (isset($conf->cashierPinCode)) {
            return $this->tokenStorage->getTokenByPin($conf->licenseKey, $conf->cashierPinCode);
        }

        return isset($conf->cashierLogin, $conf->cashierPass)
            ? $this->tokenStorage->getTokenByLogin($conf->licenseKey, $conf->cashierLogin, $conf->cashierPass)
            : null;
    }

    /**
     * Store cashier token.
     *
     * @param  string|null $token
     * @return void
     */
    public function setCashierAuthTokenToStorage(?string $token): void
    {
        $conf = $this->config;
        if (! isset($this->tokenStorage) || ! isset($conf->licenseKey)) {
            return;
        }
        if (isset($conf->cashierPinCode)) {
            $this->tokenStorage->setTokenByPin($conf->licenseKey, $conf->cashierPinCode, $token);
        } elseif (isset($conf->cashierLogin, $conf->cashierPass)) {
            $this->tokenStorage->setTokenByLogin($conf->licenseKey, $conf->cashierLogin, $conf->cashierPass, $token);
        }
    }

    /**
     * Get a builder for API routes.
     *
     * @return \DigitSoft\Checkbox\Routes
     */
    public function routeBuilder(): Routes
    {
        return $this->routes;
    }

    /**
     * Get the HTTP client.
     *
     * @return \GuzzleHttp\Client
     */
    public function httpClient(): Client
    {
        return $this->guzzleClient;
    }

    /**
     * Get a config instance.
     *
     * @return \DigitSoft\Checkbox\Config
     */
    public function config(): Config
    {
        return $this->config;
    }

    /**
     * Initialize class.
     *
     * @return void
     */
    protected function initConfiguration(): void
    {
        // Route builder
        $this->routes = new Routes($this->config->apiBaseUrl);
        // HTTP client
        $this->guzzleClient = new Client([
            'verify' => false,
            'http_errors' => false,
        ]);
        // Default values for the properties
        // Set default headers
        $this->defaultHeaders = [
            'Content-Type' => 'application/json',
            'X-License-Key' => $this->config->licenseKey,
            'X-Client-Name' => 'DigitSoft PHP SDK',
            'X-Client-Version' => static::SDK_VERSION,
        ];
    }

    /**
     * Make a JSON request to the API and return a response as associative array.
     *
     * @param  string     $uri
     * @param  string     $method HTTP method
     * @param  array|null $body
     * @param  array      $headers
     * @param  array|null $optionsRewrite
     * @param  bool       $returnRaw Return RAW string response
     * @return array|string|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function sendJsonRequest(
        string $uri, string $method = 'GET', ?array $body = null, array $headers = [], ?array $optionsRewrite = null, bool $returnRaw = false
    ): array|string|null
    {
        $optionsAll = [
            'connect_timeout' => $this->connectTimeout,
            'headers' => array_merge($this->defaultHeaders, $headers),
        ];
        if ($body !== null) {
            $optionsAll['body'] = json_encode($body);
        }
        if ($optionsRewrite !== null) {
            $optionsAll = array_merge($optionsRewrite);
        }

        $response = $this->httpClient()->request($method, $uri, $optionsAll);
        $contents = $response->getBody()->getContents();
        $jsonResponse = json_decode($contents, true);

        $this->validateResponseStatus($jsonResponse, $response->getStatusCode());

        return $returnRaw ? $contents : $jsonResponse;
    }

    /**
     * Make a JSON request to the API and return a response as associative array with JWT token of the cashier.
     *
     * @param  string     $uri
     * @param  string     $method
     * @param  array|null $body
     * @param  array      $headers
     * @param  array|null $optionsRewrite
     * @param  bool       $returnRaw Return RAW string response
     * @return array|string|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \DigitSoft\Checkbox\Exceptions\InvalidCredentialsException
     */
    public function sendJsonRequestAuthorized(
        string $uri, string $method = 'GET', ?array $body = null, array $headers = [], ?array $optionsRewrite = null, bool $returnRaw = false
    ): array|string|null
    {
        $headers['Authorization'] = 'Bearer ' . $this->authTokenCashier;

        return $this->sendJsonRequest($uri, $method, $body, $headers, $optionsRewrite, $returnRaw);
    }

    /**
     * Make a general JSON response validation.
     *
     * @param  array|mixed $json
     * @param  int         $statusCode
     * @return void
     * @throws \Exception
     */
    protected function validateResponseStatus(mixed $json, int $statusCode): void
    {
        $jsonArray = is_array($json) ? $json : [];
        switch ($statusCode) {
            case 400:
                $message = $jsonArray['message'] ?? '';

                throw BadRequestExceptionFactory::getExceptionByMessage($message);
            case 401:
            case 403:
                throw new InvalidCredentialsException($jsonArray['message']);
            case 422:
                throw new ValidationException($jsonArray);
        }

        if (! empty($jsonArray['message'])) {
            throw new \Exception($jsonArray['message']);
        }
    }
}
