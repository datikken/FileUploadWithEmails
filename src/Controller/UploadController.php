<?php

namespace App\Controller;

use App\Service\UploadService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UploadController extends AbstractController
{
    /**
     * @param UploadService $uploadService
     */
    public function __construct(UploadService $uploadService)
    {
        $this->uploadService = $uploadService;
    }

    /**
     * @param Request $request
     * @return Response
     * @throws \League\Flysystem\FilesystemException
     */
    public function index(Request $request)
    {
        $file = $request->files->get('attachments');
        $uploaded = $this->uploadService->uploadToLocal($file);
//        $this->uploadService->remove($uploaded);

        return new Response('File: ' . $uploaded . '  successfully uploaded!');
    }
}