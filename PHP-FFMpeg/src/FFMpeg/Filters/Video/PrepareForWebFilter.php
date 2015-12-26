<?php

/**
 * @author Vlad Jula-Nedelcu <vlad.nedelcu@gmail.com>
 */
namespace FFMpeg\Filters\Video;

use FFMpeg\Format\VideoInterface;
use FFMpeg\Media\Video;

/**
 * Prepares the movie for web (pseudo)streaming.
 * Meaning moving the moov atom to the beginning so it will start faster.
 */
class PrepareForWebFilter implements VideoFilterInterface
{
    private $priority;

    /**
     * @inheritdoc
     */
    public function __construct($priority = 13)
    {
        $this->priority = $priority;
    }

    /**
     * {@inheritdoc}
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * {@inheritdoc}
     */
    public function apply(Video $video, VideoInterface $format)
    {
        return array('-movflags', '+faststart');
    }
}
