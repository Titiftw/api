<?php

namespace Dba\GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Quest Object
 *
 * @ORM\Table(name="quest_object", indexes={@ORM\Index(name="quest_object_quest_id", columns={"quest_id"}),
 * @ORM\Index(name="quest_object_object_id", columns={"object_id"})})
 * @ORM\Entity(repositoryClass="Dba\GameBundle\Repository\QuestObjectRepository")
 */
class QuestObject
{
    /**
     * @var Quest
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     *
     * @ORM\ManyToOne(targetEntity="Dba\GameBundle\Entity\Quest", fetch="EAGER", inversedBy="objectsNeeded")
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="quest_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     * })
     * @JMS\Exclude
     */
    private $quest;

    /**
     * @var object
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     *
     * @ORM\ManyToOne(targetEntity="Dba\GameBundle\Entity\GameObject", fetch="EAGER")
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="object_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     * })
     */
    private $object;

    /**
     * @var int
     *
     * @ORM\Column(name="number", type="integer", nullable=false)
     * @Assert\NotBlank
     */
    private $number = 1;

    /**
     * Set number
     *
     * @param string $number
     *
     * @return QuestObject
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set quest
     *
     * @param Quest $quest
     *
     * @return QuestObject
     */
    public function setQuest(Quest $quest)
    {
        $this->quest = $quest;

        return $this;
    }

    /**
     * Get quest
     *
     * @return Quest
     */
    public function getQuest()
    {
        return $this->quest;
    }

    /**
     * Set object
     *
     * @param GameObject $object
     *
     * @return Quest
     */
    public function setObject(GameObject $object)
    {
        $this->object = $object;

        return $this;
    }

    /**
     * Get object
     *
     * @return object
     */
    public function getObject()
    {
        return $this->object;
    }
}
