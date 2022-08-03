<?php

namespace App\Tests\Controller;

use App\Entity\Contact;
use App\Manager\ContactManager;
use Prophecy\PhpUnit\ProphecyTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContactControllerTest extends WebTestCase
{
    use ProphecyTrait;

    public function testContactListAvecDatabase(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/contacts/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('table tr:first-child td:first-child', 'Denise RUIZ');
    }

    public function testContactListAvecDatabaseMock(): void
    {
        $client = static::createClient();

        $contactManager = $this->prophesize(ContactManager::class);

        $contactManager->getAll()->willReturn([
            (new Contact())->setId(1)->setFirstName('John')->setLastName('Doe'),
            (new Contact())->setId(2)->setFirstName('Toto')->setLastName('Titi'),
        ]);

        // récupère le container, remplace le vrai service ContactManager, par la version
        // ci-dessus (nécessite que le service soit public) :
        $this->getContainer()->set(ContactManager::class, $contactManager->reveal());

        $crawler = $client->request('GET', '/contacts/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('table tr:first-child td:first-child', 'John DOE');
    }
}
