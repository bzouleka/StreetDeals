<?php
    /**
     * Created by PhpStorm.
     * User: Stagiaire
     * Date: 24/07/2018
     * Time: 09:39
     */

    namespace App\Service;


    use Symfony\Component\HttpFoundation\File\UploadedFile;

    class FileUploader
    {

        private $targetDirectory;

        public function __construct($targetDirectory)
        {
            $this->targetDirectory = $targetDirectory;
        }

        public function upload(UploadedFile $file)
        {
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            $file->move($this->getTargetDirectory(), $fileName);

            return $fileName;
        }

        public function getTargetDirectory()
        {
            return $this->targetDirectory;
        }

    }