<?php

namespace DigitSoft\Checkbox;

/**
 * Simple config class for the API usage.
 */
class Config
{
    public string $apiBaseUrl = 'https://api.checkbox.ua/api/v1';

    public string $licenseKey;
    // PIN
    public ?string $cashierPinCode;
    // Or login + pass
    public ?string $cashierLogin;
    public ?string $cashierPass;

    protected static ?array $configAttributes = null;

    public function __construct(
        string $licenseKey, ?string $cashierPinCode = null, ?string $cashierLogin = null, ?string $cashierPass = null
    )
    {
        $this->licenseKey = $licenseKey;
        $this->cashierPinCode = $cashierPinCode;
        $this->cashierLogin = $cashierLogin;
        $this->cashierPass = $cashierPass;
    }

    /**
     * Make a new instance with auth by PIN-code.
     *
     * @param  string $licenseKey
     * @param  string $cashierPinCode
     * @return static
     */
    public static function makeWithPin(string $licenseKey, string $cashierPinCode): static
    {
        return new static($licenseKey, $cashierPinCode);
    }

    /**
     * Make a new instance with auth by login and password.
     *
     * @param  string $licenseKey
     * @param  string $cashierLogin
     * @param  string $cashierPass
     * @return static
     */
    public static function makeWithLoginPass(string $licenseKey, string $cashierLogin, string $cashierPass): static
    {
        return new static($licenseKey, null, $cashierLogin, $cashierPass);
    }
}
