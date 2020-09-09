<?php
namespace tests\entities;

use Dotenv\Dotenv;
use extas\components\Item;
use extas\components\repositories\TSnuffRepositoryDynamic;
use extas\components\THasMagicClass;
use extas\components\workflows\entities\THasEntity;
use extas\interfaces\workflows\entities\IHasEntity;
use PHPUnit\Framework\TestCase;
use extas\components\workflows\entities\Entity;

/**
 * Class WorkflowEntityTest
 *
 * @author jeyroik@gmail.com
 */
class EntityTest extends TestCase
{
    use TSnuffRepositoryDynamic;
    use THasMagicClass;

    protected function setUp(): void
    {
        parent::setUp();
        $env = Dotenv::create(getcwd() . '/tests/');
        $env->load();
        $this->createSnuffDynamicRepositories([
            ['workflowEntities', 'name', Entity::class]
        ]);
    }

    public function testHasEntity()
    {
        $this->getMagicClass('workflowEntities')->create(new Entity([
            Entity::FIELD__NAME => 'test',
            Entity::FIELD__TITLE => 'is ok'
        ]));

        $item = new class ([
            IHasEntity::FIELD__ENTITY_NAME => 'test'
        ]) extends Item {
            use THasEntity;

            protected function getSubjectForExtension(): string
            {
                return '';
            }
        };

        $entity = $item->getEntity();
        $this->assertNotEmpty($entity, 'Can not find entity');

        $this->assertEquals('is ok', $entity->getTitle());
    }
}
