<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $a1 = new Article();
        $a1
            ->setTitle('White House Ficus To Leave For Virginia Arboretum After Declining Trump’s Offer To Be Chief Of Staff')
            ->setContent(('WASHINGTON—As the Trump administration scrambles to find a replacement for outgoing advisor John Kelly, officials announced Monday that a high-level White House ficus would leave for the State Arboretum of Virginia after declining the president’s offer to be chief of staff. “The ficus has been honored to serve President Trump and the American people these last several months and plans to continue advancing the MAGA cause as a member of the private sector,” read a statement drafted by an aide for the ficus, noting that the potted shrub was one of the longest-tenured and most-trusted members of the Trump administration, spending countless hours working alongside the president from a sunny spot inside the Oval Office. “Rumors that the ficus was forced out following a heated argument with Jared Kushner are simply untrue. The ficus will spend the next few weeks helping with the transition of its replacement, a large fern, before departing to work in the tropical plant section of the arboretum.” At press time, the White House was reportedly thrown into chaos after the large fern confirmed it would not accept the new job.'))
        ;
        $manager->persist($a1);

        $a2 = new Article();
        $a2
            ->setTitle('The largest living amphibian is the 1.8 m (5 ft 11 in) Chinese giant salamander')
            ->setContent(('A newt is a salamander in the subfamily Pleurodelinae, also called eft during its terrestrial juvenile phase. Unlike other members of the family Salamandridae, newts are semiaquatic, alternating between aquatic and terrestrial habitats over the year, sometimes even staying in the water full-time. Not all aquatic salamanders are considered newts, however. More than 100 known species of newts are found in North America, Europe, North Africa and Asia. Newts metamorphose through three distinct developmental life stages: aquatic larva, terrestrial juvenile (eft), and adult. Adult newts have lizard-like bodies and return to the water every year to breed, otherwise living in humid, cover-rich land habitats.'))
        ;
        $manager->persist($a2);

        $a3 = new Article();
        $a3
            ->setTitle('Why amphibians are great')
            ->setContent(('Amphibians are ectothermic, tetrapod vertebrates of the class Amphibia. Modern amphibians are all Lissamphibia. They inhabit a wide variety of habitats, with most species living within terrestrial, fossorial, arboreal or freshwater aquatic ecosystems. Thus amphibians typically start out as larvae living in water, but some species have developed behavioural adaptations to bypass this. The young generally undergo metamorphosis from larva with gills to an adult air-breathing form with lungs. Amphibians use their skin as a secondary respiratory surface and some small terrestrial salamanders and frogs lack lungs and rely entirely on their skin. '))
        ;
        $manager->persist($a3);

        $a4 = new Article();
        $a4
            ->setTitle('Fox News Intern Fetching Coffee Tells Herself This Will All Pay Off When She Trump’s Secretary Of State One Day')
            ->setContent(('NEW YORK—In an effort to cope with the stressful task of fetching coffee for demanding staffers, Fox News intern Hattie Butler reportedly told herself Friday that this would all pay off when she was named President Trump’s secretary of state one day. “It’s really tough to keep everyone’s drink orders straight, but the quick thinking and multi-tasking abilities that I’ve demonstrated during this internship will be invaluable to president Trump when I’m serving as his secretary of state,” said the 23-year-old college graduate who reassured herself that if she paid her dues by delivering the correct beverages, she would eventually earn the right to determine U.S. policies toward foreign powers and navigate complex diplomatic issues that might place the world at the brink of war. “I’m a real go-getter, and my can-do attitude would make me a great asset to the president. Not just anyone can keep a cool head while trying to remember who takes their coffee half-caff and who gets three pumps of vanilla syrup with just a splash of soy milk, but if I keep at it, I can really see this unpaid internship helping me get my foot in the door at the U.S. State Department. Maybe one day I’ll help foster peace between the United States and Puerto Rico. It’s just a matter of time before I have an intern bringing me coffee!” At press time, Butler was drafting up a resume on her iPhone to send to the White House.'))
        ;
        $manager->persist($a4);

        $manager->flush();
    }
}
