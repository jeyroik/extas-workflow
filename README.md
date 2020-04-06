![PHP Composer](https://github.com/jeyroik/extas-workflow/workflows/PHP%20Composer/badge.svg?branch=master&event=push)
![codecov.io](https://codecov.io/gh/jeyroik/extas-workflow/coverage.svg?branch=master)
<a href="https://github.com/phpstan/phpstan"><img src="https://img.shields.io/badge/PHPStan-enabled-brightgreen.svg?style=flat" alt="PHPStan Enabled"></a>

# Описание

Пакет предоставляет механизм для организации перевода сущности из одного состояния в другое.

# Установка пакета

`# composer require jeyroik/extas-workflow:*`

# Тесты

`# composer run-script test`

# Термины

В рамках пакета используется следующее:

- Сущность `IWorkflowEntity` - объект, который требуется перевести из одного состояния в другое.
- Состояния `IWorkflowState` - состояние сущности, имеет описание и название.
- Переход `IWorkflowTransition` - объект, описывающий возможность перехода сущности из одного состояния в другое. 
  - Кроме переходов из конкретных состояний, попускается переход из любого (`*`) состояния.
- Схема `IWorkflowSchema` - объект, описывающий все доступные переходы для сущности.
- Обработчик перехода `ITransitionDispatcher` - обработчик, запускающийся для конкретных переходов в конкретных схемах.
  - На текущий момент данные обработчики используются для реализации валидаторов и триггеров.
  - Валидатор - проверка до перехода.
  - Триггер - функция, запускающаяся после перехода.
- Шаблон обработчика перехода `ITransitionDispatcherTemplate` - объект, описывающий функциональность, необходимые параметры и т.п.
- Рабочий процесс `IWorkflow` - объект совершающий перевод сущности из одного состояния в другое.

# Краткое описание процесса

При запуске перевода сущности из одного состояния в другое, происходит следующее:

- По схеме определяется возможен ли переход:
    - Запускаются все условия для данного перехода.
    - Запускаются все валидаторы для данного перехода.
- Если валидация прошла успешно, то у сущности меняется состояние.
  - Управление сменой состояния осуществляется с помощью интерфейса `IWorkflowEntity`. Т.е. все сущности, которые планируются гонять с помощью данного механизма, обязаны реализовывать данный интерфейс.
- После этого запускаются все триггеры для данного перехода.

# Предварительная установка компонентов workflow

Данный пакет предоставляет следующие установщики для extas-совместимой конфигурации (см. `jeyroik/extas-installer`):

- Устанавщик состояния:
```json
{
  "workflow_states": [
    {
      "name": "",
      "title": "",
      "description": "",
      "parameters": [
        {
          "name": ""
        }
      ]
    }
  ]
}
```
- Установщик переходов:
```json
{
  "workflow_transitions": [
    {
      "name": "",
      "title": "",
      "description": "",
      "state_from": "<state.name>",
      "state_to": "<state.name>"
    }
  ]
}
```
- Установщик шаблонов обработчиков переходов:
```json
{
  "workflow_transition_dispatcher_templates": [
    {
      "name": "",
      "title": "",
      "description": "",
      "class": "",
      "parameters": []
    }
  ]
}
```
- Установщик схем:
```json
{
  "workflow_schemas": [
    {
      "name": "",
      "title": "",
      "description": "",
      "states": ["<state.name>"],
      "transitions": ["<transition.name>"],
      "parameters": []
    }
  ]
}
```
- Установщик обработчиков переходов:
```json
{
  "workflow_transition_dispatchers": [
    {
      "type": "trigger|validator",
      "name": "",
      "template": "<template.name>",
      "schema_name": "<schema.name>",
      "transition_name": "<transition.name>|*",
      "parameters": []
    }
  ]
}
```
