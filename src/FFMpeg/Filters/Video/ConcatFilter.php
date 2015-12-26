<?php
/**
 *
 * @author Vlad Jula-Nedelcu
 * @date   2015-06-10 11:10
 *
 */

namespace FFMpeg\Filters\Video;

use FFMpeg\Exception\InvalidArgumentException;
use FFMpeg\Format\VideoInterface;
use FFMpeg\Media\Video;


/**
 * Class ConcatFilter
 *
 * @package FFMpeg\Filters\Video
 */
class ConcatFilter implements VideoFilterInterface
{
    /** @var string */
    private $file;

    /** @var string */
    private $position;

    /** @var integer */
    private $priority;

    /**
     * @param string $file
     * @param string $position (append or prepend)
     * @param int    $priority
     *
     */
    public function __construct($file, $position = 'prepend', $priority = - 1)
    {
        if (!file_exists($file)) {
            throw new InvalidArgumentException(sprintf('File %s does not exist', $file));
        }

        $this->file = $file;
        $this->position = $position;
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
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * {@inheritdoc}
     */
    public function apply(Video $video, VideoInterface $format)
    {
        return ['-filter_complex', '[0:0] [0:1] [1:0] [1:1] concat=n=2:v=1:a=1 [v] [a]', '-map', '[v]', '-map', '[a]'];
    }
}
