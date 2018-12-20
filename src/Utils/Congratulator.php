<?php

namespace App\Utils;

use App\Repository\AuthorRepository;
use Symfony\Contracts\Translation\TranslatorInterface;

class Congratulator
{
    private $message;
    private $theAuthor;
    private $authors;

    private $authorRepository;
    private $translator;

    const CONGRATS = [
        'moderate',
        'extra',
        'crazy',
        'damn_girl',
        'meh'
    ];

    public function __construct(AuthorRepository $authorRepository ,
                                TranslatorInterface $translator)
    {
        $this->authorRepository = $authorRepository;
        $this->translator = $translator;
        $this->message = self::CONGRATS[array_rand(self::CONGRATS)];
        $this->authors = $this->authorRepository->findAll();
        $this->theAuthor = $this->authors[array_rand($this->authors)]->getName();

    }

    public function thank()
    {

        return $this->translator->trans("congrats.$this->message" , [
            '%name%' => $this->theAuthor,
        ]);

    }
}