<?php

namespace Nicolasfoco\ApiTwitter\Utils;

enum HTTPResponseCodes: int
{
    case Ok = 200;
    case NotFound = 404;
    case BadRequest = 400;
    case NoContent = 204;
    case ServerError = 500;
    case Unauthorized = 401;
    case MethodNotAllowed = 405;

    public static function getHeaderMessage(self $httpResponseCode): string
    {
        return match ($httpResponseCode) {
            self::Ok => "HTTP/1.0 200 OK",
            self::NotFound => "HTTP/1.0 404 Not Found",
            self::BadRequest => "HTTP/1.0 400 Bad Request",
            self::NoContent => "HTTP/1.0 204 No Content",
            self::ServerError => "HTTP/1.0 500 Server Error",
            self::Unauthorized => "HTTP/1.0 401 Unauthorized",
            self::MethodNotAllowed => "HTTP/1.0 405 Method Not Allowed",
        };
    }
}
