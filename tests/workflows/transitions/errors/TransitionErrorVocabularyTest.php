<?php

use PHPUnit\Framework\TestCase;
use extas\components\workflows\transitions\errors\TransitionErrorVocabulary;

/**
 * Class TransitionErrorVocabularyTest
 *
 * @author jeyroik@gmail.com
 */
class TransitionErrorVocabularyTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $env = \Dotenv\Dotenv::create(getcwd() . '/tests/');
        $env->load();
    }

    public function testBaseMethods()
    {
        $this->assertEquals(
            'Not applicable entity template',
            TransitionErrorVocabulary::translate(50101)
        );
        $this->assertEquals(
            'Validation failed',
            TransitionErrorVocabulary::translate(50102)
        );
        $this->assertEquals(
            'Schema has not this transition',
            TransitionErrorVocabulary::translate(50103)
        );
        $this->assertEquals(
            'Can not transit entity to this state',
            TransitionErrorVocabulary::translate(50104)
        );
        $this->assertEmpty(TransitionErrorVocabulary::translate(400));
    }
}
