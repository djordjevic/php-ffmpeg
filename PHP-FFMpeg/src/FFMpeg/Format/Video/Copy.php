<?php

namespace FFMpeg\Format\Video;

/**
 * The X264 video format
 */
class Copy extends DefaultVideo
{
    /** @var boolean */
    private $bframesSupport = false;

    /**
     * @param string $audioCodec
     * @param string $videoCodec
     */
    public function __construct($audioCodec = 'copy', $videoCodec = 'copy')
    {
        $this
            ->setAudioCodec($audioCodec)
            ->setVideoCodec($videoCodec);
    }

    /**
     * {@inheritDoc}
     */
    public function supportBFrames()
    {
        return $this->bframesSupport;
    }

    /**
     * @param $support
     *
     * @return X264
     */
    public function setBFramesSupport($support)
    {
        $this->bframesSupport = $support;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getAvailableAudioCodecs()
    {
        return ['copy'];
    }

    /**
     * {@inheritDoc}
     */
    public function getAvailableVideoCodecs()
    {
        return ['copy'];
    }

    /**
     * {@inheritDoc}
     */
    public function getPasses()
    {
        return 1;
    }

    /**
     * @return int
     */
    public function getModulus()
    {
        return 1;
    }
}
