<?php

namespace App\Service;

use League\Flysystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Gedmo\Sluggable\Util\Urlizer;

class UploadService
{
    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * @param UploadedFile $file
     * @return string
     * @throws \League\Flysystem\FilesystemException
     */
    public function uploadLocal(UploadedFile $file): string
    {
        if ($file instanceof UploadedFile) {
            $originalFilename = $file->getClientOriginalName();
        } else {
            $originalFilename = $file->getFilename();
        }

        $newFilename = Urlizer::urlize(pathinfo($originalFilename, PATHINFO_FILENAME)).'-'.uniqid().'.'.$file->guessExtension();

        $stream = fopen($file->getRealPath(), 'r');
        $this->filesystem->writeStream(
          $newFilename,
          $stream
        );
        fclose($stream);

        return $newFilename;
    }

    /**
     * @param string $file
     * @return void
     * @throws \League\Flysystem\FilesystemException
     */
    public function remove(string $file): void
    {
        $this->filesystem->delete($file);
    }

    /**
     * @param string $file
     * @return void
     * @throws \League\Flysystem\FilesystemException
     */
    public function read(string $file): void
    {
        $this->filesystem->read($file);
    }
}