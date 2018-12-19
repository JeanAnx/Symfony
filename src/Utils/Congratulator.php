<?php

namespace App\Utils;

use App\Repository\AuthorRepository;
use phpDocumentor\Reflection\Types\Self_;
use Symfony\Contracts\Translation\TranslatorInterface;

class Congratulator
{
    private $message;
    private $author;

    private $authorRepository;
    private $translator;

    const CONGRATS = [
        'moderate',
        'extra',
        'crazy',
    ];

    public function __construct(AuthorRepository $authorRepository , TranslatorInterface $translator)
    {
        $this->authorRepository = $authorRepository;
        $this->translator = $translator;
    }

    public function thank()
    {

        $message = self::CONGRATS[array_rand(self::CONGRATS)];

        $authors = $this->authorRepository->findAll();

        $theAuthor = $authors[array_rand($authors)]->getName();

        return $this->translator->trans("congrats.$message" , [
            '%name%' => $theAuthor,
        ]);

    }
}