<?php
namespace App\Utils;

use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileManager
{
    /**
     * @var ContainerInterface $_container
     */
    private $_container;

    public function __construct(ContainerInterface $container)
    {
        $this->_container = $container;
    }

    public function uploadFile(UploadedFile $uploadedFile)
    {
        if ($uploadedFile instanceof UploadedFile)
        {
            $filename = $this->generateUniqueName() . '.' . $uploadedFile->guessExtension();

            $uploadedFile->move(
                $this->getTargetDirectory(),
                $filename
            );
            return $filename;
        }
    }

    public function getTargetDirectory()
    {
        return $this->_container->getParameter('uploads_directory');
    }

    public function generateUniqueName()
    {
        return md5(uniqid());
    }
    /// XXX: maybe add a remove function not required at the moment :)
}