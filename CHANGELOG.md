## Changelog


### 5.0

- CHG: Set namespace, reformat to PSR-2.
- ADD: Added Composer support.


### 4.0

- CHG: Removed function runYiiStatics(). Since Yii 1.1.14, you can now set path aliases in your configWeb. Remove calls to runYiiStatics() from your application, and see example-config/main.php for example on how to use aliases.


### 3.2

- REFACTOR: split up setMode(), determine mode in separate function. Also update some docs.

### 3.1

- ADD: optionally override project environment by creating configDir/mode.php with preferred value.

### 3.0

- CHG **attention**: use getenv() to determine environment mode (works for both webapps and console-apps). See updated instructions, it's not always backwards compatible.


### 2.5

- FIX: incorrectly setting yiic instead of yiit. Made $_mode protected. Reported by glaszig.

### 2.4

- FIX: add type checking when comparing INHERIT_KEY to prevent unexpected copying. Reported by mylonov.

### 2.3

- Separate getConfig() from setEnvironment() to allow extending. Small changes to allow extending.

### 2.2

- No functional change: Fixed incorrect config key in example file.

### 2.1

- Console application support is now optional, you may omit the 'configConsole' key.

### 2.0

- Support for console applications!
- **HOW TO UPGRADE**: rename key 'config' to 'configWeb' in config files and index files.


### 1.4

- Allow extending Environment class for overriding and extending constants (SERVER_VAR, CONFIG_DIR, MODE_xxx). Added more examples.

### 1.3

- Changed array_replace_recursive() to CMap::mergeArray(), since it wasn't producing expected results. Added showDebug(). Bugfix for PHP<5.3

### 1.2

- Initial release
