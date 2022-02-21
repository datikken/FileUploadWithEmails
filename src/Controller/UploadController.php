<?php

namespace App\Controller;

use App\Service\UploadService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\File;

class UploadController extends AbstractController
{
    /**
     * @param UploadService $uploadService
     */
    public function __construct(UploadService $uploadService)
    {
        $this->uploadService = $uploadService;
    }

    public function getFileByFileName($fileName)
    {
        $stream = $this->uploadService->read($fileName);
        $response = new Response(stream_get_contents($stream));

        return $response;
    }

    /**
     * @param Request $request
     * @return Response
     * @throws \League\Flysystem\FilesystemException
     */
    public function index(Request $request)
    {
        $file = $request->files->get('attachments');
        $uploaded = $this->uploadService->upload($file);
//        $this->uploadService->remove($uploaded);

        return new Response('File: ' . $uploaded . '  successfully uploaded!');
    }
}