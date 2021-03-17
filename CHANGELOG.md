# 5.1.1

- Updated docs.

# 5.1.0

- Added the `IHasStateSample` interface.
- Added the `THasStateSample` trait.

# 5.0.0

- Working with transition dispatchers rebuilt:
  - Removed all methods for getting/setting dispatchers names.
  - Removed constants with dispatchers names fields.
  - Dispatchers are extracting by transition name now.
- Redundant transition methods from `IHasTransitions`/`THasTransitions` removed. 
- Redundant state methods from `IHasStates`/`THasStates` removed. 

# 4.1.0

- Rebuilt `IHasEntity`/`THasEntity`.

# 4.0.0

- Dynamic repositories support added.
- Dynamic install/uninstall plugins support added.
- Removed redundant (repositories and install/uninstall plugins) classes.
- Inherit "Missed" exceptions from `MissedOrUnknown`.
- Removed collections - direct repositories using instead. 
- This changelog added.

# 3.8.1

- Rm samples names.

# 3.8.0

- Up to installer v3.

# 3.7.0

- Up to installer v3.

# 3.6.0

- Use repo-get

# 3.5.0

- Use `extas-values`

# 3.4.0

- Remove entity_name and entity_sample_name from ISchema.

# 3.3.0

- Remove states_names and transition_names fields from a schema.

# 3.2.0

- use dispatchers priority

# 3.1.0

- added context to a transition dispatcher executor

# 3.0.0

- Fully rebuilt package.
- Renamed classes from Workflow<Something> to <Something>.
- Added samples.
- Left only transit() method in the Workflow class.

# 2.0.1

- added tests for transition errors

# 2.0.0

- Transitions dipatchers moved to the jeyroik/extas-workflow-dispatchers package.
- Removed type from transition dispatchers templates.
- Tests added.
- Transitions dipatchers moved to the jeyroik/extas-workflow-dispatchers package
- Dispatchers paths changed from extas\components\plugins\workflows\conditions and extas\components\plugins\workflows\validators to extas\components\workflows\transitions\dispatchers. All dispatchers now placed in one namespace.
- You should require jeyroik/extas-workflow-dispatchers yourself to use dispatchers.
- Now all package functionallity is covered by tests.

# 1.0.8

- added conditions context

# 1.0.7

- misstype fix

# 1.0.6

- rm foundation dep
- allow to return null on entityTemplate
- upd base dep ver
- added extas-parameters dep

# 0.11.0

- Added entityEdited to transition dispatchers.
- Removed all workflow stages.
- entityEdited
- Now you can update entity data while triggering and transit this changes through all triggers. At the same time you have unchanged source entity data, if you need it.