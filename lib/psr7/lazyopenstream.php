<?php

/**
 * Has been copied form https://github.com/guzzle/psr7
 */

namespace BX\Router\PSR7;


use Psr\Http\Message\StreamInterface;

/**
 * Lazily reads or writes to a file that is opened only after an IO operation
 * take place on the stream.
 */
final class LazyOpenStream implements StreamInterface
{
    use StreamDecoratorTrait;

    /** @var string */
    private $filename;

    /** @var string */
    private $mode;

    /**
     * @param string $filename File to lazily open
     * @param string $mode     fopen mode to use when opening the stream
     */
    public function __construct(string $filename, string $mode)
    {
        $this->filename = $filename;
        $this->mode = $mode;
    }

    /**
     * Creates the underlying stream lazily when required.
     */
    protected function createStream(): StreamInterface
    {
        return stream_for(try_fopen($this->filename, $this->mode));
    }
}