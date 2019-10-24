# extas-workflow
Workflow package for Extas

# Установка пакета

`# composer require jeyroik/extas-workflow:*`

# Установка workflow

`# vendor/bin/extas i`

# Использование

Сразу после установки можно поиграть с демо-воркфлоу:

```php
use extas\components\workflows\Workflow;
use extas\components\SystemContainer;
use extas\interfaces\workflows\schemas\IWorkflowSchema;
use extas\interfaces\workflows\schemas\IWorkflowSchemaRepository;
use extas\interfaces\workflows\entities\IWorkflowEntity;

class MyEntity implements IWorkflowEntity
{
    protected $state = '';
    
    public function __construct($initState)
    {
        $this->state = $initState;
    }
    
    public function getStateName(): string
    {
        return $this->state;
    }
    
    public function setStateName(string $stateName): IWorkflowEntity
    {
        $this->state = $stateName;
        return $this;
    }
}

$schemaRepo = SystemContainer::getItem(IWorkflowSchemaRepository::class);
$schema = $schemaRepo->one([IWorkflowSchema::FIELD__NAME => 'demo']);

$testEntity = new \MyEntity('todo');
$transited = Workflow::transit($testEntity, 'done', $schema, new Context(['name' => 'jeyroik']));
// $transited == false, так как нет перехода из todo в done
echo $testEnity->getStateName(); // todo

$transited = Workflow::transit($testEntity, 'in_work', $schema, new Context(['name' => 'jeyroik']));
echo $testEntity->getStateName(); // in_work
```

В рамках перевода сущности из одного состояния в другое, существует четыре стадии. Рассмотрим их на нашем примере:

- `workflow.transition` - общая стадия, означает запуск перевода сущности.
- `workflow.from.todo` - стадия, означающая перевод из конкретного состояния.
- `workflow.to.in_work` - стадия, означающая перевод в конкретное состояние.
- `workflow.get_in_work` - стадия, означающая запуск конкретного перехода.

Таким образом, реализовав плагин для желаемой стадии, можно совершить дополнительные действия при переводе сущности из одного состояния в другое.

(i) Контекст рекомендуется использовать для передачи дополнительной информации о контексте смены состояния сущности.

# TODO

- Валидация параметров контекста по параметрам конечного состояния.