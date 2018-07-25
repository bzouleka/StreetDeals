<?php
    /**
     * Created by PhpStorm.
     * User: Stagiaire
     * Date: 23/07/2018
     * Time: 16:10
     */

    namespace App\Service;


    class Email
    {
        protected $mailer;


        /**
         * Email constructor.
         * @param \swift_mailer $mailer
         */
        public function __construct(\Swift_mailer $mailer)
    {
        $this->mailer = $mailer;
    }
        public function sendEmail($subject, $from, $to, $body){

            $message = $this->mailer->createMessage()

                ->setSubject($subject)
                ->setFrom($from)
                ->setTo($to)
                ->setBody($body);


            return $this->mailer->send($message);



        }

    }



