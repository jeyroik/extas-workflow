<?php
namespace tests\workflows\states;

use Dotenv\Dotenv;
use extas\components\Item;
use extas\components\repositories\TSnuffRepositoryDynamic;
use extas\components\THasMagicClass;
use extas\components\workflows\states\StateSample;
use extas\components\workflows\states\THasStateSample;
use extas\interfaces\workflows\states\IHasStateSample;
use extas\interfaces\workflows\states\IStateSample;
use PHPUnit\Framework\TestCase;

class SampleTest extends TestCase
{
    use TSnuffRepositoryDynamic;
    use THasMagicClass;

    protected function setUp(): void
    {
        parent::setUp();
        $env = Dotenv::create(getcwd() . '/tests/');
        $env->load();
        $this->createSnuffDynamicRepositories([
            ['workflowStatesSamples', 'name', StateSample::class]
        ]);
    }

    public function tearDown(): void
    {
        $this->deleteSnuffDynamicRepositories();
    }

    public function testHasStateSample()
    {
        $this->getMagicClass('workflowStatesSamples')->create(new StateSample([
            StateSample::FIELD__NAME => 'test'
        ]));

        $hasStateSample = new class extends Item implements IHasStateSample {
            use THasStateSample;

            protected function getSubjectForExtension(): string
            {
                return 'test';
            }
        };

        $hasStateSample->setStateSampleName('test');
        $this->assertEquals('test', $hasStateSample->getStateSampleName());
        $this->assertInstanceOf(IStateSample::class, $hasStateSample->getStateSample());
    }
}
