<?php
namespace vendor\framework;

class CrossOrigin
{
    private $origin;
    private $credentials;
    private $methods;
    private $headers;
    private $contentType;

    public function __construct(
        string $origin = '*',
        bool $credentials = true,
        array $methods = ['POST', 'GET', 'OPTIONS', 'DELETE', 'PUT'],
        array $headers = ['X-Requested-With', 'Content-Type', 'Origin', 'Authorization', 'Accept', 'Client-Security-Token', 'Accept-Encoding'],
        string $contentType = 'application/json; charset=utf-8'
    )
    {
        $this->origin = $origin;
        $this->credentials = $credentials;
        $this->methods = $methods;
        $this->headers = $headers;
        $this->contentType = $contentType;
    }

    public function getOrigin():string
    {
        return $this->origin;
    }

    public function setOrigin(string $origin): self
    {
        $this->origin = $origin;

        return $this;
    }

    public function getCredentials(): bool
    {
        return $this->credentials;
    }

    public function setCredentials(bool $credentials): self
    {
        $this->credentials = $credentials;

        return $this;
    }

    public function getMethods(): array
    {
        return $this->methods;
    }

    public function setMethods(array $methods): self
    {
        $this->methods = $methods;

        return $this;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function setHeaders(array $headers): self
    {
        $this->headers = $headers;

        return $this;
    }
 
    public function getContentType(): string
    {
        return $this->contentType;
    }

    public function setContentType(string $contentType): self
    {
        $this->contentType = $contentType;

        return $this;
    }

    /**
     * @param bool $sendHeaders
     * @return bool
     */
    public function checkOrigin(bool $sendHeaders = true): bool
    {
        $file = dirname(__DIR__, 2). "/Config/settings/cross_origin.php";
        if (file_exists($file)) {
            $tab = include_once $file;
            $request = new Request();
            $cross = null;
            foreach ($tab as $key => $item) {
                if (('*' === $key || $key === $request->origin) &&
                    in_array($request->method, $item['methods'])
                ) {
                    if ($sendHeaders) {
                        $tab[$key]["origin"] = $key;
                        $this->setProperties($tab[$key]);
                        $this->sendHTTPHeaders();
                    }
                    return true;
                }
            }
        }
        return false;
    }

    private function setProperties(array $tab): void
    {
        foreach ($tab as $key => $value) {
            if (property_exists($this, $key)) {
                call_user_func([$this, 'set'.ucfirst($key)], $value);
            }
        }
    }

    public function sendHTTPHeaders(): void
    {
        header("Access-Control-Allow-Origin: {$this->getOrigin()}");
        header("Access-Control-Allow-Credentials: {$this->getCredentials()}");
        header("Access-Control-Allow-Methods: " . implode(', ', $this->getMethods()));
        header("Access-Control-Allow-Headers: " . implode(', ', $this->getHeaders()));
        header("Content-Type: {$this->getContentType()}");
    }
}