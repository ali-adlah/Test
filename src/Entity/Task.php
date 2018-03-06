<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 19.02.2018
 * Time: 10:57
 */

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;


class Task
{
    /**
     * @Assert\NotBlank()
     */
    protected $task;
    /**
     * @Assert\NotBlank()
     * Assert\Type("\DateTime")
     */
    protected $dueDate;

    public function getTask()
    {
        return $this->task;
    }

    public function setTask($task)
    {
        $this->task = $task;
    }

    public function getDueDate()
    {
        return $this->dueDate;
    }

    public function setDueDate(\DateTime $dueDate = null)
    {
        $this->dueDate = $dueDate;
    }

}