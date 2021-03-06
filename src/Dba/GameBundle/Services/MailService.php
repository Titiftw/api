<?php

namespace Dba\GameBundle\Services;

use DateTime;
use Dba\GameBundle\Entity\Mail;
use Dba\GameBundle\Entity\Player;
use Swift_Message;

class MailService extends BaseService
{
    const EMAIL_NO_REPLY = 'no-reply@rpg-dbadventure.com';

    /*
     * Send and email to a player
     *
     * @param Mail $mail Mail
     *
     * @return boolean
     */
    public function send(Mail $mail)
    {
        $content = $this->container->get('templating')->render(
            'DbaGameBundle::emails/' . $mail->getTemplateName() . '.html.twig',
            array_merge(
                $mail->getParameters(),
                ['player' => $mail->getPlayer()]
            )
        );

        $message = new Swift_Message($mail->getSubject());
        $message->setFrom(self::EMAIL_NO_REPLY)
            ->setTo($mail->getPlayer()->getEmail());
        $message->setBody(
            $content,
            'text/html'
        );

        if ($this->container->get('mailer')->send($message)) {
            $mail->setSentAt(new DateTime());
            $mail->setMessageSent($content);
            $this->em()->persist($mail);
            $this->em()->flush();
        }
    }

    /*
     * Send and email to a player
     *
     * @param Player $player Player who buy
     * @param string $subject Subject of the mail
     * @param string $template Template to use
     * @param array $parameters Template parameters
     *
     * @return boolean
     */
    public function save(Player $player, $subject, $template, array $parameters = [])
    {
        $mail = new Mail();
        $mail->setSubject($subject);
        $mail->setTemplateName($template);
        $mail->setParameters($parameters);
        $mail->setPlayer($player);

        $this->em()->persist($mail);
        $this->em()->flush();
    }
}
