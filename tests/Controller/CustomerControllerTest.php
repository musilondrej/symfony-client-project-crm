<?php

namespace App\Tests\Controller;

use App\Entity\Customer;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class CustomerControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $customerRepository;
    private string $path = '/customer/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->customerRepository = $this->manager->getRepository(Customer::class);

        foreach ($this->customerRepository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Customer index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first()->text());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'customer[name]' => 'Testing',
            'customer[description]' => 'Testing',
            'customer[email]' => 'Testing',
            'customer[phone]' => 'Testing',
            'customer[website]' => 'Testing',
            'customer[vatId]' => 'Testing',
            'customer[isActive]' => 'Testing',
            'customer[isBillable]' => 'Testing',
            'customer[defaultHourlyRate]' => 'Testing',
            'customer[currency]' => 'Testing',
            'customer[createdAt]' => 'Testing',
            'customer[updatedAt]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->customerRepository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Customer();
        $fixture->setName('My Title');
        $fixture->setDescription('My Title');
        $fixture->setEmail('My Title');
        $fixture->setPhone('My Title');
        $fixture->setWebsite('My Title');
        $fixture->setVatId('My Title');
        $fixture->setIsActive('My Title');
        $fixture->setIsBillable('My Title');
        $fixture->setDefaultHourlyRate('My Title');
        $fixture->setCurrency('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Customer');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Customer();
        $fixture->setName('Value');
        $fixture->setDescription('Value');
        $fixture->setEmail('Value');
        $fixture->setPhone('Value');
        $fixture->setWebsite('Value');
        $fixture->setVatId('Value');
        $fixture->setIsActive('Value');
        $fixture->setIsBillable('Value');
        $fixture->setDefaultHourlyRate('Value');
        $fixture->setCurrency('Value');
        $fixture->setCreatedAt('Value');
        $fixture->setUpdatedAt('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'customer[name]' => 'Something New',
            'customer[description]' => 'Something New',
            'customer[email]' => 'Something New',
            'customer[phone]' => 'Something New',
            'customer[website]' => 'Something New',
            'customer[vatId]' => 'Something New',
            'customer[isActive]' => 'Something New',
            'customer[isBillable]' => 'Something New',
            'customer[defaultHourlyRate]' => 'Something New',
            'customer[currency]' => 'Something New',
            'customer[createdAt]' => 'Something New',
            'customer[updatedAt]' => 'Something New',
        ]);

        self::assertResponseRedirects('/customer/');

        $fixture = $this->customerRepository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getEmail());
        self::assertSame('Something New', $fixture[0]->getPhone());
        self::assertSame('Something New', $fixture[0]->getWebsite());
        self::assertSame('Something New', $fixture[0]->getVatId());
        self::assertSame('Something New', $fixture[0]->getIsActive());
        self::assertSame('Something New', $fixture[0]->getIsBillable());
        self::assertSame('Something New', $fixture[0]->getDefaultHourlyRate());
        self::assertSame('Something New', $fixture[0]->getCurrency());
        self::assertSame('Something New', $fixture[0]->getCreatedAt());
        self::assertSame('Something New', $fixture[0]->getUpdatedAt());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Customer();
        $fixture->setName('Value');
        $fixture->setDescription('Value');
        $fixture->setEmail('Value');
        $fixture->setPhone('Value');
        $fixture->setWebsite('Value');
        $fixture->setVatId('Value');
        $fixture->setIsActive('Value');
        $fixture->setIsBillable('Value');
        $fixture->setDefaultHourlyRate('Value');
        $fixture->setCurrency('Value');
        $fixture->setCreatedAt('Value');
        $fixture->setUpdatedAt('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/customer/');
        self::assertSame(0, $this->customerRepository->count([]));
    }
}
