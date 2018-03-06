<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 17.02.2018
 * Time: 23:30
 */

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;


class Author
{
    /**
     *  @Assert\NotBlank()
     */
    public $name;
    /**
     * @Assert\NotBlank()
     * @Assert\Choice(
     *     choices = { "fiction", "non-fiction" },
     *     message = "Choose a valid genre."
     * )
     */
    public $gerne;

}