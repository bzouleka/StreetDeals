<?php
    /**
     * Created by PhpStorm.
     * User: Stagiaire
     * Date: 24/07/2018
     * Time: 09:52
     */

    namespace App\EventListener;


    use App\Entity\Product;
    use App\Service\FileUploader;
    use Doctrine\ORM\Event\LifecycleEventArgs;
    use Doctrine\ORM\Event\PreUpdateEventArgs;
    use Symfony\Component\HttpFoundation\File\File;
    use Symfony\Component\HttpFoundation\File\UploadedFile;

    class BrochureUploadListener
    {
        private $uploader;

        public function __construct(FileUploader $uploader)
        {
            $this->uploader = $uploader;
        }

        public function prePersist(LifecycleEventArgs $args)
        {
            $entity = $args->getEntity();

            $this->uploadFile($entity);
        }

        public function preUpdate(PreUpdateEventArgs $args)
        {
            $entity = $args->getEntity();

            $this->uploadFile($entity);
        }

        private function uploadFile($entity)
        {
            // upload only works for Product entities
            if (!$entity instanceof Product) {
                return;
            }

            $file = $entity->getPhoto();

            // only upload new files
            if ($file instanceof UploadedFile) {
                $fileName = $this->uploader->upload($file);
                $entity->setPhoto($fileName);
            }
        }


        public function postLoad(LifecycleEventArgs $args)
        {
            $entity = $args->getEntity();

            if (!$entity instanceof Product) {
                return;
            }

            if ($fileName = $entity->getPhoto()) {
                $entity->setPhoto(new File($this->uploader->getTargetDirectory().'/'.$fileName));
            }
        }

    }