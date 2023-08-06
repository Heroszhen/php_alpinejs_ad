<?php
namespace vendor\framework;

class Request
{
    public $headers;
    public $content;
    public $files;
    public $request;
    public $query;
    public $origin;
    public $method;

    public function __construct()
    {
        $this->headers = getallheaders();
        $this->content = json_decode(file_get_contents("php://input"), true);
        $this->request = $_POST;
        $this->query = $_GET;
        $this->origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : null;
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    public function isXmlHttpRequest(): bool
    {
        $xrw = "X-Requested-With";
        return (isset($this->headers[$xrw]) && $this->headers[$xrw] === "XMLHttpRequest" || isset($this->headers[strtolower($xrw)]) && $this->headers[strtolower($xrw)] === "XMLHttpRequest");
    }

    public function getAuthorization(): string
    {
        return isset($this->headers["Authorization"]) ? $this->headers["Authorization"] : "";
    }
}