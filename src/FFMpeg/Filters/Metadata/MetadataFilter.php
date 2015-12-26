<?php
namespace FFMpeg\Filters\Metadata;

use FFMpeg\Exception\RuntimeException;
use FFMpeg\Filters\FilterInterface;
use FFMpeg\Format\VideoInterface;
use FFMpeg\Media\Video;

/**
 * Class MetadataFilter
 *
 * @see     http://wiki.multimedia.cx/index.php?title=FFmpeg_Metadata
 *
 * @package FFMpeg\Filters\Metadata
 */
class MetadataFilter implements FilterInterface
{
    /** @var integer */
    private $priority;

    private $metadata_fields = array();


    /**
     * @param int $priority
     */
    public function __construct($priority = 99)
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
     * @param string $field
     * @param string $value
     *
     * @return MetadataFilter
     */
    public function set($field, $value)
    {
        if ($value) {
            $this->metadata_fields[$field] = $value;
        }

        return $this;
    }

    /**
     * @param Video          $video
     * @param VideoInterface $format
     *
     * @return array
     */
    public function apply(Video $video, VideoInterface $format)
    {
        $commands = array();
        try {
            foreach ($this->metadata_fields as $field => $value) {
                $commands[] = '-metadata';
                $commands[] = $field . '="' . $value . '"';
            }
        } catch (RuntimeException $e) {

        }

        return $commands;
    }

}
