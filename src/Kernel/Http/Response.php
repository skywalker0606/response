<?php
declare(strict_types=1);

namespace Response\Response;


use Hyperf\HttpMessage\Cookie\Cookie;
use Hyperf\HttpMessage\Exception\HttpException;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\Utils\Context;
use Hyperf\HttpServer\Response as HttpResponse;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

/**
 * Class Response
 * @package App\Kernel\Http
 */
class Response extends HttpResponse
{
    /**
     * Response constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->response = $container->get(ResponseInterface::class);
    }
    
    /**
     * @param array $data
     * @return PsrResponseInterface
     */
    public function success(array $data = []): PsrResponseInterface
    {
        return $this->response->json([
            'code' => 0,
            'data' => $data,
        ]);
    }
    
    /**
     * @param string $message
     * @param int    $code
     * @return PsrResponseInterface
     */
    public function fail(string $message = '', int $code = 1): PsrResponseInterface
    {
        return $this->response->json([
            'code' => $code,
            'message' => $message
        ]);
    }
    
    /**
     * @param Cookie $cookie
     * @return $this
     */
    public function cookie(Cookie $cookie)
    {
        $response = $this->response()->withCookie($cookie);
        Context::set(PsrResponseInterface::class, $response);
        return $this;
    }
    
    /**
     * @param HttpException $throwable
     * @return PsrResponseInterface
     */
    public function handleException(HttpException $throwable): PsrResponseInterface
    {
        return $this->response()
            ->withAddedHeader('Server', 'psy-1')
            ->withStatus($throwable->getStatusCode())
            ->withBody(new SwooleStream($throwable->getMessage()));
    }
    
    /**
     * @return PsrResponseInterface
     */
    public function response(): PsrResponseInterface
    {
        return Context::get(PsrResponseInterface::class);
    }
}